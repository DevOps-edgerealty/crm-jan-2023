<?php

namespace App\Http\Controllers;

use App\Imports\WebsiteImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Website;
use App\Models\Models\Users;
use App\Models\Models\Website_lead_detail;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Models\Lead_status_type;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;
use App\Notifications\wLeadAdded;


class Website_leadController extends Controller
{

    protected $ref_no = null;

    public function __construct()
    {
        $this->middleware('auth')->except(['store_lead_api','temporary_update']);

    }
    /**
     * Display a listing of the resource
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ( $user_id == '1') {

            $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->orderby('updated_at','DESC')->paginate(30);

        }
        elseif( $user_id == '2')
        {

            $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'agent_id' , $id   )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->orderby('updated_at','DESC')->paginate(30);
        }



        $this->data['leads'] = $leads;

        return view('website.show', $this->data);



    }



    public function lead_change_status(Request $request)
    {


        $lead_id = $request->lead_id;

        $leads = website::find($lead_id);

        if (!empty($leads)) {

            $leads->lead_status = $request->lead_status_type;

            $leads->save();
        }

        return Redirect::back()->with('message','Lead Details has Been Generated Successfully.');
    }




    public function search(Request $request)
    {




        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

        if($request->search != null){
            $leads->where('name', 'LIKE', "%{$request->search}%");
        }

        if($request->email != null){
            $leads->where('email', $request->email);
        }

        if($request->full_name != null){
            $leads->where('name', $request->full_name);
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
        if($request->agent != null){
            $leads->where('agent_id', $request->agent);
        }
        // if($request->start_date != null){
        //     $leads->where('created_at', '>=', $request->start_date);
        // }
        // if($request->end_date != null){
        //     $leads->where('created_at', '<=', $request->end_date);
        // }


        $leads = $leads->orderby('id','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request;


        $this->data['leads'] = $leads;

        return view('website.show', $this->data);



    }


    public function closed_deal_leads()
    {


        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ( $user_id == '1') {


            $leads = website::with(['users',])->orderby('updated_at','DESC')->where( 'is_closed' , 1 )->get();


        }
        elseif( $user_id == '2')
        {

            $leads = website::with(['users'])->where( 'agent_id' , $id   )->where( 'is_closed' , 1 )->orderby('updated_at','DESC')->get();


        }




        $this->data['leads'] = $leads;

        return view('website.close_deals', $this->data);

    }


    public function temporary_leads()
    {


        $website_leads = Website::with(['users' , 'lead_detailss'])->where('is_temporary', 1)->get();

        $this->data['users'] = Users::where('status','1')->get();

        $this->data['website_leads'] = $website_leads;


        return view('website.show_temporary', $this->data);

    }



    public function importExportView_website()
    {
       return view('import_website');
    }




    public function import_website()
    {
        Excel::import(new WebsiteImport,request()->file('file'));


        return back();
    }



    public function website_details($id)
    {


        $this->data['lead_status_type'] = lead_status_type::all();

        $this->data['users'] = User::where('status','1')->where('user_type','2')->get();

        $leads = Website::with(['users','lead_detailss'])->where('id', $id )->first();


        $lead_id = $leads->id;



        $lead_detail = Website_lead_detail::with(['users'])->where(  'lead_id' , $lead_id )->orderby('id' , 'DESC')->get();


        //return $lead_detail;

        $this->data['leads'] = $leads;

        $this->data['lead_detail'] = $lead_detail;





        return view('website.detail', $this->data);

    }



    public function website_lead_store_detail(Request $request)
    {
        //

        $id = Auth::user()->id;



        $bool=0;

		if($bool==0)
		{

            // create new lead detail
            $leads = new Website_lead_detail();
            $leads->agent_id = $id;
            $leads->lead_status = $request->lead_status;
            $leads->lead_id = $request->lead_id;
            $leads->lead_description = $request->description;
            $leads->reminder_date = $request->reminder_date;
            $leads->save();


            // update current lead data
            $website_leads = Website::find($request->lead_id);
            if (!empty($website_leads)) {

                $website_leads->lead_status = $request->lead_status;
                $website_leads->is_closed = 0;
                $website_leads->save();
            }
            return Redirect::back()->with('message','Website Lead Details has Been Generated Successfully.');
        }
        else
        {
            return Redirect::back()->with('message','Lead Deatil is already Exist.');
        }

    }


    public function recycle_leads()
    {
        //
        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $website_leads = Website::with(['users' , 'lead_detailss'])->where('is_trash', 0)->where('is_recycle', 1)->orderby('updated_at','DESC')->get();



        $this->data['leads'] = $website_leads;

        return view('website.show_recycle', $this->data);
    }








    public function recycle_search_website(Request $request)
    {

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

        if($request->search != null){
            $leads = $leads->where('name', 'LIKE', "%{$request->search}%");
        }

        if($request->email != null){
            $leads->where('email', $request->email);
        }

        if($request->full_name != null){
            $leads = $leads->where('name', $request->full_name);
        }

        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }
        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->lead_status != null){
            $leads = $leads->where('lead_status', $request->lead_status);
        }
        if($request->agent != null){
            $leads = $leads->where('agent_id', $request->agent);
        }
        // if($request->start_date != null){
        //     $leads->where('created_at', '>=', $request->start_date);
        // }
        // if($request->end_date != null){
        //     $leads->where('created_at', '<=', $request->end_date);
        // }


        $leads = $leads->orderby('updated_at','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request;


        $this->data['leads'] = $leads;

        return view('website.show_recycle', $this->data);

    }





    public function website_trash_leads()
    {


        $website_leads = Website::with(['users' , 'lead_detailss'])->where('is_trash', 1)->get();


        $this->data['website_leads'] = $website_leads;


        return view('website.show_trash', $this->data);

    }


    public function transfer_lead($id)
    {
        // get auth user id
        $user_id = Auth::user()->id;




        // get website lead record
        $leads = Website::find($id);
        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_recycle = 0;
            $leads->lead_status = 5;
            $leads->save();
        }




        // create new lead detail and set below data
        $leads_detail = new Website_lead_detail();
        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_description = "Lead Transfer From Recycle";
        $leads_detail->save();



        return Redirect::back()->with('message', 'Lead has Been Transferred Successfully.');
    }



    public function transfer_agent_lead(Request $request)
    {
        //
        $user_id = Auth::user()->id;

        $lead_id = $request->lead_id;

        $agent_id = $request->user;

        $username = User::find($user_id);

        $agentname = User::find($agent_id);




        $leads = Website::find($lead_id);




        if (!empty($leads)) {

            $leads->agent_id = $agent_id;

            $leads->save();
        }



        $leads_detail = new Website_lead_detail();


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

             $message->to($user->email)->subject('Edge Realty Lead Email');
          });



        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }





    public function reassign_agent(Request $request)
    {

        $user_id = Auth::user()->id;

        $lead_id = $request->lead_id;

        $agent_id = $request->user;

        $username = User::find($user_id);

        $agentname = User::find($agent_id);

        $leads = Website::find($lead_id);

        if (!empty($leads)) {

            $leads->agent_id = $agent_id;
            $leads->is_temporary = 0;

            $leads->save();
        }

        $leads_detail = new Website_lead_detail();

        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_description = "Lead Transfer From Temporary this agent ". "$username->name" . ' To this' . $agentname->name ;

        $leads_detail->save();

        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }






    public function transfer_temporary($id)
    {
        //



        $leads = Website::find($id);


        if (!empty($leads)) {

            $leads->is_temporary = 0;

            $leads->save();
        }



        return Redirect::to('/all_leads')->with('message','Lead has Been Transferd Successfully.');

    }



    public function transfer_lead_trash($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Website::find($id);


        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_trash = 0;

            $leads->save();
        }



        $leads_detail = new Website_lead_detail();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_status = 5;
        $leads_detail->lead_description = "Lead Transfer From Trash";

        $leads_detail->save();



        return Redirect::to('/all_leads')->with('message', 'Lead has Been Transferd Successfully.');
    }







    public function move_recycle_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Website::find($id);

        if (!empty($leads)) {


            $leads->modifier = $user_id;
            $leads->is_recycle = 1;

            $leads->save();
        }



        // $leads_detail = new Website_lead_detail();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Recycle";

        // $leads_detail->save();




        return Redirect::to('/all-recycle')->with('message','Lead has Been Transferd Successfully.');
    }




    public function move_trash_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Website::find($id);

        if (!empty($leads)) {


            $leads->agent_id = $user_id;
            $leads->is_trash = 1;

            $leads->save();
        }



        // $leads_detail = new Website_lead_detail();


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



        $leads = Website::find($id);

        if (!empty($leads)) {


            $leads->agent_id = $user_id;
            $leads->lead_status = 6;
            $leads->is_closed = 1;

            $leads->save();
        }



        $leads_detail = new Website_lead_detail();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Deal is Closed";

        $leads_detail->save();



        return Redirect::to('/all_leads')->with('message','Lead has Been Transferd Successfully To Closed Deal.');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $this->data['user'] = Users::where('user_type','2')->get();

        return view('website.create', $this->data);

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
        $prefix = 'WL-';


        $leads = Website::latest()->first();
        if(empty($leads)){
            $leads = new Website();
            $leads->ref_no = 'WL-1000';
        }

        $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $leads->ref_no)[1];

        $this->ref_no = $ref+1;



        $bool=0;

		if($bool==0)
		{

            //
            $website_leads = new Website();


            $website_leads->ref_no = $prefix.$this->ref_no;
            $website_leads->agent_id = $request->agent;
            $website_leads->inquiry = $request->inquiry;
            $website_leads->source = $request->source;
            $website_leads->name = $request->full_name;
            $website_leads->phone = $request->phone;
            $website_leads->email = $request->email;
            $website_leads->status = 1;
            $website_leads->lead_status = 5;
            $website_leads->is_recycle = 0;

            $website_leads->save();

            $agent_id = $website_leads->agent_id;

            $user = Users::where('id', $agent_id)->first();


            \Mail::send(
                'email/lead',
                array(),
                function ($message) use ($user) {

                    $message->to($user->email)->subject('Edge Realty Website Lead Email');
                }
            );


            $website_leads2 = Website::with(['users'])->where('ref_no', $website_leads->ref_no)->get();

            $website_leads3 = $website_leads2[0];

            // $website_leads3->users->notify(new wLeadAdded($website_leads));






            return redirect('all_leads')->with('message','Website Lead has Been Generated Successfully.');


        }
        else
        {
            return redirect('all_leads')->with('message','Website Lead is Already Exist.');

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

        $this->data['user'] = Users::get();




        $leads = Website::with(['users'])->where('id', $id )->first();



        $this->data['leads'] = $leads;

        return view('website.edit' , $this->data);

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
        $website_leads = Website::find($id);


        if (!empty($website_leads)) {


            $website_leads->agent_id = $request->agent;
            $website_leads->inquiry = $request->inquiry;
            $website_leads->source = $request->source;
            $website_leads->name = $request->full_name;
            $website_leads->phone = $request->phone;
            $website_leads->email = $request->email;
            $website_leads->status = $request->status;



            $website_leads->save();

            $agent_id = $website_leads->agent_id;

            $user = Users::where( 'id' , $agent_id )->first();


            \Mail::send('email/update_website_lead',
            array(

            ), function($message) use ( $user)
              {

                 $message->to($user->email)->subject('Edge Realty Lead Email');
              }
            );

            $website_leads2 = Website::with(['users'])->where('ref_no', $website_leads->ref_no)->get();

            $website_leads3 = $website_leads2[0];

            // $website_leads3->users->notify(new wLeadAdded($website_leads));

        }

        return redirect('all_leads')->with('message','Website Lead has Been Updated Successfully.');


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

    public function store_lead_api(Request $request)
    {
        $old_lead = Website::select()->orderBy('id',  'desc')->first();
        $ref_no = '1000';
        if(!empty($old_lead)){
            $ref_no = $old_lead->ref_no;
            $ref_no = explode('-', $ref_no)[1];
        }

        $ref_no = $ref_no+1;
        $website_leads = new Website();

        $website_leads->ref_no = 'WL-'.$ref_no;
        $website_leads->agent_id = $request->agent;
        $website_leads->inquiry = $request->inquiry;
        $website_leads->website_url = $request->page_url;
        $website_leads->name = $request->full_name;
        $website_leads->phone = $request->phone;
        $website_leads->email = $request->email;
        $website_leads->status = 1;
        $website_leads->lead_status = 5;
        $website_leads->is_recycle = 0;


        $website_leads->save();
    }



    public function temporary_update()
    {

        $date = new \DateTime();
        $date->modify('-3 hours');
        $startDate = $date->format('Y-m-d H:i:s');

        $date = new \DateTime();
        $date->modify('-4 hours');
        $endDate = $date->format('Y-m-d H:i:s');



        $leads = Website::with(['lead_detailss' ])->where('is_temporary', 0)->where('created_at', '>',$startDate)->where('created_at', '<', $endDate)->doesnthave('lead_detailss')->get();




        foreach ($leads as $lead) {
            $lead->is_temporary = 0;
            $lead->save();
        }


        echo "records {$leads->count()} has been updated";

    }




}



