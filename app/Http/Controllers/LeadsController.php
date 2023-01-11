<?php

namespace App\Http\Controllers;

use App\Models\Models\Campaign;
use App\Models\Models\Lead_details;
use App\Models\Models\Leads;
use App\Models\Models\Leads_type;
use App\Models\Models\Lead_status_type;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Imports\LeadImport;
use App\Models\Models\Property_lead;
use App\Models\Models\Website;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use App\Notifications\cLeadAdded;


class LeadsController extends Controller
{

    protected $ref_no = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

       public function __construct()
    {

        $this->middleware('auth')->except('temporary_update');
    }


    public function importExportView()
    {
       return view('import');
    }

    public function import()
    {
        Excel::import(new LeadImport,request()->file('file'));

        return back();
    }


    public function index()
    {


        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        if ( $user_id == '1') {


            $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->orderby('created_at','DESC')->paginate(30);


        }
        elseif( $user_id == '2')
        {

            $leads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'agent_id' , $id )->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->orderby('updated_at','DESC')->paginate(30);

        }

        //return $leads;

        $this->data['leads'] = $leads;

        // Log::critical('Lead Page Loaded!');

        return view('leads.show', $this->data);
    }







    public function search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->whereDate('created_at', '>', date('2022-12-17'))->get();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

        if($request->search != null){
            $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads = $leads->where('campaign_id', $request->campaigns);
        }
        if($request->lead_status != null){
            $leads = $leads->where('lead_status', $request->lead_status)->whereDate('created_at', '>', date('2022-12-17'));
        }
        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->lead_source != null){
            $leads = $leads->where('lead_type', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }
        if($request->agent != null){
            $leads = $leads->where('agent_id', $request->agent);
        }
        if($request->start_date != null){
            $leads = $leads->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date != null){
            $leads = $leads->where('created_at', '<=', $request->end_date);
        }


        $leads = $leads->orderby('id','DESC');

        $leads = $leads->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

        $this->data['request'] = $request->all();



        $this->data['leads'] = $leads;

        return view('leads.show', $this->data);



    }


    public function search_agent(Request $request)
    {

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['lead_source'] = Leads_type::all();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id' , $request->agent)->whereDate('created_at', '>', date('2022-12-17'));

        if($request->search != null){
            $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads->where('campaign_id', $request->campaigns);
        }
        if($request->ref_number != null){
            $leads->where('ref_no', $request->ref_number);
        }
        if($request->phone != null){
            $leads->where('phone', $request->phone);
        }
        if($request->lead_status != null){
            $leads->where('lead_status', $request->lead_status);
        }
        if($request->lead_source != null){
            $leads->where('lead_type', $request->lead_source);
        }

        if($request->start_date != null){
            $leads->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date != null){
            $leads->where('created_at', '<=', $request->end_date);
        }


        $leads = $leads->orderby('id','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request;

        return $leads;

        $this->data['leads'] = $leads;

        return view('leads.show', $this->data);



    }




    public function closed_deal_leads()
    {

        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ( $user_id == '1') {


            $leads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'is_closed' , 1 )->orderby('id','DESC')->get();




        }
        elseif( $user_id == '2')
        {

            $leads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'agent_id' , $id )->where( 'is_closed' , 1 )->orderby('id','DESC')->get();

        }





        $this->data['leads'] = $leads;

        return view('leads.closed_deals', $this->data);

    }


    public function lead_details($id)
    {

        $this->data['lead_status_type'] = lead_status_type::all();


        $this->data['users'] = User::where('status','1')->where('user_type','2')->get();


        $leads = Leads::with(['users','lead_typess','lead_detailss','campaigns'])->where('id', $id )->first();


        $lead_detail = Lead_details::with(['users'])->where(  'lead_id' , $id )->orderby('id' , 'DESC')->get();




        $this->data['leads'] = $leads;



        $this->data['lead_detail'] = $lead_detail;



        return view('leads.detail', $this->data);
    }


    public function lead_change_status(Request $request)
    {


        $lead_id = $request->lead_id;

        $leads = Leads::find($lead_id);

        if (!empty($leads)) {

            $leads->lead_status = $request->lead_status_type;

            $leads->save();
        }

        return Redirect::back()->with('message','Lead Details has Been Generated Successfully.');
    }


    public function recycle_leads()
    {
        //

        $leads = Leads::with(['users','lead_typess','lead_detailss'])->where('is_trash','0')->where( 'is_recycle' , 1 )->orderby('updated_at','DESC')->get();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();


        $this->data['lead_source'] = Leads_type::all();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $this->data['leads'] = $leads;



        return view('leads.show_recycle', $this->data);
    }








    public function mass_recycle_leads(Request $request)
    {

        //
        $user_id = Auth::user()->id;


        if (!empty($request->lead_checkbox) && $request->mass_action == 'recycle')
        {
            foreach($request->lead_checkbox as $lead_to_change)
            {
                // dd($lead_to_change);
                $lead = Leads::find($lead_to_change);
                $lead->modifier = $user_id;
                $lead->is_recycle = 1;

                $lead->save();

            }
        }

        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');
    }











    public function recycle_search_campaign(Request $request)
    {


        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();


        $leads = Leads::with(['users' , 'lead_typess','lead_detailss' ])->where('is_trash','0')->where( 'is_recycle' , 1 );

        if($request->search != null){
            $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads = $leads->where('campaign_id', $request->campaigns);
        }

        // if($request->lead_status != null){
        //     $leads = $leads->where('lead_status', $request->lead_status);
        // }

        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }

        if($request->lead_source != null){
            $leads = $leads->where('lead_type', $request->lead_source);
        }

        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }

        if($request->agent != null){
            $leads = $leads->where('agent_id', $request->agent);
        }

        // if($request->start_date != null){
        //     $leads = $leads->where('created_at', '>=', $request->start_date);
        // }

        // if($request->end_date != null){
        //     $leads = $leads->where('created_at', '<=', $request->end_date);
        // }


        $leads = $leads->orderby('updated_at','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request->all();



        $this->data['leads'] = $leads;

        return view('leads.show_recycle', $this->data);



    }








    public function temporary_leads()
    {
        //

        $leads = Leads::with(['users','lead_typess','lead_detailss'])->where('is_temporary', 1 )->get();



        $this->data['users'] = Users::where('status','1')->get();



        $this->data['leads'] = $leads;



        return view('leads.show_temporary', $this->data);
    }




    public function trash_leads()
    {

        $leads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'is_trash' , 1 )->get();


        // $property_leads = Property_lead::with(['users', 'lead_detailss'])->where('is_trash', 1)->get();

        // $website_leads = Website::with(['users' , 'lead_detailss'])->where('is_trash', 1)->get();


        $this->data['leads'] = $leads;

        // $this->data['property_leads'] = $property_leads;

        // $this->data['website_leads'] = $website_leads;

        return view('leads.show_trash', $this->data);

    }





    public function transfer_agent_lead(Request $request)
    {
        // get auth user id
        $user_id = Auth::user()->id;

        // assign requests into variables
        $lead_id = $request->lead_id;

        $agent_id = $request->user;

        // get user and agent records
        $username = User::find($user_id);

        $agentname = User::find($agent_id);



        // get lead record and assign new agent with lead_status
        $leads = Leads::find($lead_id);

        if (!empty($leads)) {

            $leads->agent_id = $agent_id;
            $leads->lead_status = 5;
            $leads->is_recycle = 0;
            $leads->save();
        }


        // create new lead detail and set below data
        $leads_detail = new Lead_details();
        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_description = "Lead Transfer From ". $username->name . ' To ' . $agentname->name ;



        $leads_detail->save();


        $user = Users::where( 'id' , $agent_id )->first();


        \Mail::send('email/transfer',
        array(

        ), function($message) use ( $user)
          {

             $message->to($user->email)->subject('Edge Realty Lead Transfer Email');
          });



        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }



    public function reassign_agent(Request $request)
    {



        //
        $user_id = Auth::user()->id;

        $lead_id = $request->lead_id;

        $agent_id = $request->user;

        $username = User::find($user_id);

        $agentname = User::find($agent_id);




        $leads = Leads::find($lead_id);



        if (!empty($leads)) {

            $leads->agent_id = $agent_id;
            $leads->is_temporary = 0;

            $leads->save();
        }



        $leads_detail = new Lead_details();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_description = "Lead Transfer From Temporary this agent ". "$username->name" . ' To this' . $agentname->name ;

        $leads_detail->save();








        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }





    public function transfer_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Leads::find($id);


        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_recycle = 0;

            $leads->save();
        }


        $user_info = Users::find($user_id);

        $leads_detail = new Lead_details();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Lead Transfer From Recycle by " .$user_info->name;

        $leads_detail->save();



        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }



    public function transfer_temporary($id)
    {
        //



        $leads = Leads::find($id);


        if (!empty($leads)) {

            $leads->is_temporary = 0;

            $leads->save();
        }



        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }





    public function transfer_lead_trash($id)
    {
        //
        $user_id = Auth::user()->id;


        $leads = Leads::find($id);


        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_trash = 0;

            $leads->save();
        }



        $leads_detail = new Lead_details();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Lead Transfer From Trash";

        $leads_detail->save();



        return Redirect::to('/all_leads')->with('message','Lead has Been Transferd Successfully.');

    }



    public function move_recycle_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Leads::find($id);

        if (!empty($leads)) {


            $leads->modifier = $user_id;
            $leads->is_recycle = 1;

            $leads->save();
        }



        // $leads_detail = new Lead_details();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Recycle";

        // $leads_detail->save();




        return Redirect::to('/all_recycle')->with('message','Lead has Been Transferd Successfully.');

    }




    public function move_trash_lead($id)
    {
        //


        $user_id = Auth::user()->id;



        $leads = Leads::find($id);

        if (!empty($leads)) {


            $leads->agent_id = $user_id;
            $leads->is_trash = 1;

            $leads->save();
        }



        // $leads_detail = new Lead_details();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Trash";

        // $leads_detail->save();




        return Redirect::to('/all_leads')->with('message','Lead has Been Transferd Successfully.');

    }


    public function move_closed_leads($id)
    {
        //


        $user_id = Auth::user()->id;



        $leads = Leads::find($id);

        if (!empty($leads)) {


            $leads->agent_id = $user_id;
            $leads->lead_status = 6;
            $leads->is_closed = 1;

            $leads->save();
        }



        // $leads_detail = new Lead_details();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Trash";

        // $leads_detail->save();




        return Redirect::to('/all_leads')->with('message','Lead has Been Transferd Successfully to CLosed Deal.');

    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $this->data['lead_type'] = Leads_type::get();

        $this->data['user'] = User::where('status','1')->where('user_type','2')->get();

        $this->data['campagin'] = Campaign::get();


        return view('leads.create',$this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //


        $prefix = 'CL-';


        $leads = Leads::latest()->first();
        if(empty($leads)){
            $leads = new Leads();
            $leads->ref_no = 'CL-1000';
        }

        $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $leads->ref_no)[1];

        $this->ref_no = $ref+1;


        $bool=0;

		if($bool==0)
		{

            //
            $leads = new Leads();

            $leads->ref_no = $prefix.$this->ref_no ;
            $leads->inquiry = $request->inquiry;
            $leads->qualified_question = $request->qualified_ques;
            $leads->source = $request->source;
            $leads->full_name = $request->full_name;
            $leads->phone = $request->phone;
            $leads->email = $request->email;
            $leads->campaign_id = $request->campaign_id;
            $leads->is_recycle = 0;
            $leads->lead_status = 5;
            $leads->status = $request->status;
            $leads->agent_id = $request->agent_id;
            $leads->lead_type = $request->lead_type;

            $leads->save();

            $agent_id = $leads->agent_id;



            $user = Users::where( 'id' , $agent_id )->first();



            \Mail::send('email/lead',
            array(

            ), function($message) use ( $user)
              {

                 $message->to($user->email)->subject('Edge Realty Lead Email');
              });



            $website_leads2 = Leads::with(['users'])->where('ref_no', $leads->ref_no)->get();

            $website_leads3 = $website_leads2[0];

            // $website_leads3->users->notify(new cLeadAdded($leads));


            return redirect('all_leads')->with('message','Lead has Been Generated Successfully.');


        }
        else
        {
            return redirect('all_leads')->with('message','Lead is Already Exist.');

        }

    }


    public function lead_store_detail(Request $request)
    {
        // get auth user id
        $id = Auth::user()->id;

        $bool=0;

		if($bool==0)
		{
            //  create new lead detail
            $leads = new Lead_details();
            $leads->agent_id = $id;
            $leads->lead_status = $request->lead_status;
            $leads->lead_id = $request->lead_id;
            $leads->lead_description = $request->description;
            $leads->reminder_date = $request->reminder_date;
            $leads->save();

            // get lead record to add lead status
            $lead = Leads::find($request->lead_id);
            if (!empty($lead)) {

                $lead->lead_status = $request->lead_status;
                $lead->is_closed = 0;

                $lead->save();
            }

            return Redirect::back()->with('message','Lead Details has Been Generated Successfully.');
        }
        else
        {
            return Redirect::back()->with('message','Lead Detail is already Exist.');
        }

    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //

        $this->data['lead_type'] = Leads_type::get();

        $this->data['user'] = Users::get();

        $this->data['campagin'] = Campaign::get();


        $leads = Leads::with(['users','lead_typess','campaigns'])->where('id', $id )->first();



        $this->data['leads'] = $leads;

        return view('leads.edit' , $this->data);


    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //



        $leads = Leads::find($id);


        if (!empty($leads)) {

            $leads->inquiry = $request->inquiry;
            $leads->qualified_question = $request->qualified_ques;
            $leads->source = $request->source;
            $leads->full_name = $request->full_name;
            $leads->phone = $request->phone;
            $leads->email = $request->email;
            $leads->campaign_id = $request->campaign_id;
            $leads->is_recycle = 0;
            $leads->status = $request->status;
            $leads->agent_id = $request->agent_id;
            $leads->lead_type = $request->lead_type;

            $leads->save();
        }


        $agent_id = $leads->agent_id;

        $user = Users::where( 'id' , $agent_id )->first();

        // $lead_detail = Lead_details::where('leader_id', $leads->id);
        // dd($lead_detail);


        \Mail::send('email/update_lead',
        array(

        ), function($message) use ( $user)
          {

             $message->to($user->email)->subject('Edge Realty CRM Notification');
          });
        //  $message->to($user->email)->subject('Edge Realty Lead Email');

        $website_leads2 = Leads::with(['users'])->where('ref_no', $leads->ref_no)->get();

        $website_leads3 = $website_leads2[0];

        // $website_leads3->users->notify(new cLeadAdded($leads));



        return redirect('all_leads')->with('message','Lead has Been Updated Successfully.');
    }



    public function temporary_update()
    {
        $date = new \DateTime();
        $hour = $date->format('H');



        if($hour >= 13 && $hour < 23){



            $date = new \DateTime();
            $date->modify('-4 hours');
            $startDate = $date->format('Y-m-d H:i:s');



            $date = new \DateTime();
            $date->modify('-3 hours -40 minutes');
            $endDate = $date->format('Y-m-d H:i:s');


            $leads = Leads::with(['lead_detailss' ])->where('is_temporary', 0)->where('created_at', '>',$startDate)->where('created_at', '<', $endDate)->doesnthave('lead_detailss')->get();

            foreach ($leads as $lead) {
                $lead->is_temporary = 0;
                $lead->save();
            }


            echo "records {$leads->count()} has been updated";
        }
        else{
            echo "time is not valid to run the cronjob";

        }


    }



    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
