<?php

namespace App\Http\Controllers;

use App\Models\Models\Property_lead;
use App\Models\User;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Webklex\IMAP\Facades\Client;
use App\Notifications\LeadAdded;


class FetchEmailController extends Controller
{
    protected $ref_no = null;
    protected $prefix = 'PL-';
    public function index()
    {

        //Read all property lead data by descending order
        $lead = Property_lead::orderBy('id', 'DESC')->first();

        //if data gathered is empty create one blank record
        if(empty($lead)){
            $lead = new Property_lead();
            $lead->ref_no = 'PL-1000';
            $lead->uid = 0;
        }

        //gather all agent's name and id
        $agents = User::selectRaw('LOWER(`name`) as name, id')->pluck('id', 'name');
        require(__DIR__ . '../../../simple_html_dom.php');

        //Connect to IMAP email client
        $oClient = Client::account('default'); // defined in config/imap.php
        $oClient->connect();

        //Get all messages from INBOX
        $oFolder = $oClient->getFolder('INBOX');
        $date = date('d.m.Y');

        //Gather all messages form date
        $aMessage = $oFolder->messages()->since($date)->get();
        // $aMessage = $oFolder->messages()->unseen()->get();

        //Create empty list
        $lead_data = [];
        if(!empty($aMessage)){

            //For each message do the following
            foreach ($aMessage as $oMessage) {

                //Assgign empty array of details
                $data = [
                    'ref_no' => '',
                    'inquiry' => '',
                    'name' => '',
                    'email' => '',
                    'phone' => '',
                    'location' => '',
                    'property_detail' => '',
                    'property_location' => '',
                    'property_ref' => '',
                    'property_id' => '',
                    'property_url' => '',
                    'property_portal_id' => '',
                    'agent_id' => '',
                    'is_recycle' => '',
                    'status' => '1',
                    'property_title' => '',
                ];

                //For the message get the respective property_leads info from database by comparing UID
                $data['uid'] = $oMessage->getUid();
                $old_lead = Property_lead::where('uid', $data['uid'])->first();
                if(!empty($old_lead)) continue;

                // if($data['uid'] <= @$lead->uid) continue;
                $index = 0;

                //get the SENDER's email address from the message
                $from = $oMessage->getFrom()[0]->mail;

                //
                if(in_array($from, ['no-reply23@email.dubizzle.com', 'noreply@bayut.com', 'no-reply@propertyfinder.ae', 'web@edgerealty.ae'])){
                    $data['from'] = $from;

                    //get subject form message
                    $subject = $oMessage->getSubject();
                    $data['subject'] = $subject[0];


                    if($from == 'no-reply@propertyfinder.ae' ){
                        if($subject == 'Call summary'){

                            //get the htmlnody f the mail
                            $html = str_get_html($oMessage->getHTMLBody());

                            //assign inquiry as 'call lead'
                            $data['inquiry'] = 'Call Lead';

                            //read the message body and add to empty DATA array
                            foreach ($html->find('table') as $mainDiv) {
                                $index++;
                                $greetings = [];
                                if($index == 4 ){
                                    foreach ($mainDiv->find('p') as $p) {
                                        $greetings[] = $p->plaintext;
                                    }
                                    $string = $greetings[0];
                                    $string = explode(',', $string);
                                    $name = substr($string[0], strpos($string[0], "Dear ") + 5);
                                    $name = ($name != null) ? strtolower($name) : $name;
                                    $data['agent_id'] = (@$agents[$name]) ? @$agents[$name] : 0;
                                }
                                if($index == 5){
                                    foreach ($mainDiv->find('a') as $a) {
                                        $number = str_replace(' ', '', $a->plaintext);
                                    }

                                    $data['phone'] = $number;

                                }
                            }

                            //strip the ref number and add 01
                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;

                            //assign the data gathered for one message into empty array defined earlier
                            $lead_data[] = $data;
                        }

                        $search = 'propertyfinder.ae - Contact Edge Realty Real Estate';
                        if(preg_match("/{$search}/i", $subject)) {
                            $html = str_get_html($oMessage->getHTMLBody());
                            $count_images = count($html->find('img'));
                            if($count_images != 7) continue;

                            foreach ($html->find('table') as $mainDiv) {
                                $index++;
                                if($index == 7){
                                    $string = $mainDiv->childNodes(0)->plaintext;
                                    $string = explode(',', $string);
                                    $name = substr($string[0], strpos($string[0], "Dear ") + 5);
                                    $name = ($name != null) ? strtolower($name) : $name;
                                    $data['agent_id'] = (@$agents[$name]) ? @$agents[$name] : 0;

                                    $string = $string[1];
                                    $string = explode('has sent you a message regarding your property', $string);
                                    $data['name'] = trim($string[0]);
                                    $data['property_title'] = $mainDiv->find('a', 1)->plaintext;
                                    $data['property_ref'] = str_replace(' ', '', $mainDiv->find('a', 2)->plaintext);
                                    $data['email'] = str_replace(' ', '', $mainDiv->find('a', 3)->plaintext);
                                    $data['phone'] = str_replace(' ', '', $mainDiv->find('a', 4)->plaintext);
                                    $data['inquiry'] = $mainDiv->find('a', 3)->prev_sibling()->prev_sibling()->prev_sibling()->prev_sibling()->prev_sibling()->plaintext;
                                }

                            }
                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;
                            $lead_data[] = $data;
                            // dd($lead_data);


                        }

                    }

                    //if sender is Dubbizle follow the same strategy as above
                    else if($from == 'no-reply23@email.dubizzle.com' || $from == 'web@edgerealty.ae' ){

                        if($subject == 'You just got a Dubizzle phone lead!' || $subject == 'You missed a call'){
                            $html = str_get_html($oMessage->getHTMLBody());
                            $data['inquiry'] = ($subject == 'You just got a Dubizzle phone lead!') ? 'Call Lead' : 'Missed Call';
                            foreach ($html->find('table') as $mainDiv) {
                                $index++;
                                if($index == 5){
                                    $name = str_replace(['Hello', ','], [''], $mainDiv->find('p', 0)->plaintext);
                                    $name = ($name != null) ? strtolower($name) : $name;
                                    $data['agent_id'] = (@$agents[trim($name)]) ? @$agents[trim($name)] : 0;
                                    $data['phone'] = str_replace(['Caller Number', ' '], [''], $mainDiv->find('li', 2)->plaintext);
                                }
                            }
                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;
                            $lead_data[] = $data;
                        }

                        $search = 'dubizzle - someone is interested in your';
                        if(preg_match("/{$search}/i", $subject)) {
                            $html = str_get_html($oMessage->getHTMLBody());
                            foreach ($html->find('table') as $mainDiv) {
                                $index++;
                                if($index == 5){
                                    $data['property_title'] = trim($mainDiv->find('a', 1)->plaintext);
                                    $para =  $mainDiv->find('p', 1);
                                    $para  = explode('<br>', $para);

                                    $data['property_ref'] = substr(strip_tags($para[0]), strpos(strip_tags($para[0]), "Ref No: ") + 8);
                                    $data['name'] = substr(strip_tags($para[1]), strpos(strip_tags($para[1]), "Name: ") + 6);
                                    $data['phone'] = substr(strip_tags($para[2]), strpos(strip_tags($para[2]), "Telephone: ") + 11);
                                    $data['email'] = substr(strip_tags($para[3]), strpos(strip_tags($para[3]), "Email: ") + 7);
                                    $data['inquiry'] = substr(strip_tags($para[4]), strpos(strip_tags($para[4]), "Message: ") + 9);
                                }
                            }

                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;
                            $lead_data[] = $data;
                        }

                    }

                    //if sender is Dubbizle follow the same strategy as above
                    else if ($from == 'noreply@bayut.com'){

                        if($subject == 'Bayut.com Lead Notification: CALL Missed' || $subject == 'Bayut.com Lead Notification: CALL Received'){
                            $html = str_get_html($oMessage->getHTMLBody());
                            $data['inquiry'] = ($subject == 'Bayut.com Lead Notification: CALL Received') ? 'Call Lead' : 'Missed Call';
                            foreach ($html->find('table') as $mainDiv) {
                                $index++;

                                if($index == 2){
                                    $name = '';
                                    if($mainDiv->find('tr', 5)->children(0)->plaintext == 'Received By:' || $mainDiv->find('tr', 5)->children(0)->plaintext == 'Missed By:' ){
                                        $name = $mainDiv->find('tr', 5)->children(1)->plaintext;
                                    }
                                    $name = ($name != null) ? strtolower($name) : $name;

                                    //This line is conneced to LINE 28 above and it will crosscheck the agent name in database and return the id.
                                    $data['agent_id'] = (@$agents[trim($name)]) ? @$agents[trim($name)] : 0;
                                    $data['phone'] = $mainDiv->find('a', 0)->plaintext;
                                }
                            }

                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;
                            $lead_data[] = $data;
                        }


                        $search = 'New Lead! You have received a rental inquiry on Bayut';
                        $search_sale = 'New Lead! You have received a sale inquiry on Bayut';
                        if(preg_match("/{$search}/i", $subject) || preg_match("/{$search_sale}/i", $subject)) {
                            $html = str_get_html($oMessage->getHTMLBody());
                            foreach ($html->find('table') as $mainDiv) {
                                $index++;
                                if($index == 3){

                                    $email_data =  $mainDiv->find('td', 1)->innertext.'<br>';
                                    // return $email_data;

                                    $email_data = htmlentities($email_data);

                                    $email_data = explode('&lt;br /&gt;', $email_data);

                                    $name = trim(str_replace(['Hi ', ','], [''], $email_data[0]));
                                    $name = ($name != null) ? strtolower($name) : $name;
                                    $data['agent_id'] = (@$agents[$name]) ? @$agents[$name] : 0;
                                    $data['inquiry'] = html_entity_decode($email_data[7]);
                                    // return  $data['property_title'];
                                    $data['name'] = trim(substr(strip_tags($email_data[12]), strpos(strip_tags($email_data[12]), "Name: ") + 6));

                                    $data['email'] = trim(substr(strip_tags($email_data[13]), strpos(strip_tags($email_data[13]), "Email: ") + 7));
                                    $data['phone'] = trim(substr(strip_tags($email_data[14]), strpos(strip_tags($email_data[14]), "Phone: ") + 7));
                                    $data['property_title'] = trim(substr(strip_tags($email_data[20]), strpos(strip_tags($email_data[20]), "Property: ") + 10));

                                    $data['location'] = html_entity_decode(trim(substr(strip_tags($email_data[21]), strpos(strip_tags($email_data[21]), "Location: ") + 10)));
                                    $data['property_ref'] = trim(substr(strip_tags($email_data[22]), strpos(strip_tags($email_data[22]), "Reference: ") + 11));
                                    $data['property_portal_id'] = trim(substr(strip_tags($email_data[23]), strpos(strip_tags($email_data[23]), "Bayut ID: ") + 10));
                                    $data['property_url'] = trim(substr(strip_tags($email_data[24]), strpos(strip_tags($email_data[24]), "URL: ") + 5));
                                }
                            }
                            $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $lead->ref_no)[1];
                            $this->ref_no = $ref+1;
                            $data['ref_no'] = $this->prefix.$this->ref_no;

                            $lead_data[] = $data;
                        }
                    }


                }

            }

            //if defined empty list lead_data is not null then save all data into data base
            if($lead_data != null){
                // dd($lead_data);
                foreach($lead_data  as $lead){

                    $property_lead = new Property_lead();

                    $property_lead->ref_no = $lead['ref_no'];
                    $property_lead->inquiry = $lead['inquiry'];
                    $property_lead->name = $lead['name'];
                    $property_lead->email = $lead['email'];
                    $property_lead->phone = $lead['phone'];
                    if($lead['location']) $property_lead->location = $lead['location'];
                    if($lead['property_detail']) $property_lead->property_detail = $lead['property_detail'];
                    if($lead['property_location']) $property_lead->property_location = $lead['property_location'];
                    $property_lead->property_ref = $lead['property_ref'];

                    if($lead['property_id']) $property_lead->property_id = $lead['property_id'];
                    if($lead['property_url']) $property_lead->property_url = $lead['property_url'];
                    if($lead['property_portal_id']) $property_lead->property_portal_id = $lead['property_portal_id'];

                    $property_lead->agent_id = ($lead['agent_id']) ? $lead['agent_id'] : '0';
                    $property_lead->status = $lead['status'];
                    $property_lead->lead_status = 5;
                    $property_lead->property_title = $lead['property_title'];
                    $property_lead->uid = $lead['uid'];
                    $property_lead->subject = $lead['subject'];
                    $property_lead->from = $lead['from'];

                    $property_lead->save();

                    $website_leads2 = Property_lead::with(['users'])->where('ref_no', $property_lead->ref_no)->get();

                    $website_leads3 = $website_leads2[0];

                    $website_leads3->users->notify(new LeadAdded($property_lead));

                    if($lead['agent_id'])
                    {
                        $agentid = Users::find($lead['agent_id']);
                    }

                }

            }
        }

    }
}
