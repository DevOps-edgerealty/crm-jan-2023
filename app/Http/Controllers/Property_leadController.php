<?php

namespace App\Http\Controllers;

use App\Models\Models\Portal_lead_detail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Property_lead;
use App\Models\Models\Property_portals;
use App\Models\Models\Users;
use App\Models\User;
use App\Models\Models\Leads;
use App\Models\Models\Lead_status_type;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use App\Notifications\LeadAdded;


class Property_leadController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('temporary_update_portal');
    }

    protected $ref = null;
    protected $ref_no = null;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //

        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['portals'] = Property_portals::all();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        if ( $user_id == '1') {


            $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);


        }
        elseif( $user_id == '2')
        {

            $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);

        }



        //return $leads;

        $this->data['leads'] = $leads;

        return view('property_lead.show', $this->data);


    }



    public function lead_change_status(Request $request)
    {


        $lead_id = $request->lead_id;

        $leads = Property_lead::find($lead_id);

        if (!empty($leads)) {

            $leads->lead_status = $request->lead_status_type;

            $leads->save();
        }

        return Redirect::back()->with('message','Lead Details has Been Generated Successfully.');
    }




    public function search(Request $request)
    {



        $this->data['portals'] = Property_portals::all();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

        if($request->search != null){
            $leads->where('name', 'LIKE', "%{$request->search}%");
        }
        if($request->lead_status != null){
            $leads->where('lead_status', $request->lead_status);
        }
        if($request->email != null){
            $leads->where('email', $request->email);
        }
        if($request->phone != null){
            $leads->where('phone', $request->phone);
        }
        if($request->portals != null){
            $leads->where('lead_type', $request->portals);
        }
        if($request->lead_source != null){
            $leads->where('from', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads->where('ref_no', $request->ref_number);
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

        return view('property_lead.show', $this->data);



    }



    public function closed_deal_leads()
    {

        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ( $user_id == '1') {


            $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_closed' , 1 )->orderby('id','DESC')->get();


        }
        elseif( $user_id == '2')
        {

            $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_closed' , 1 )->where( 'agent_id' , $id   )->orderby('id','DESC')->get();

        }


        $this->data['leads'] = $leads;

        return view('property_lead.closed_deals', $this->data);

    }



    public function property_listing_details($id)
    {

        $this->data['lead_status_type'] = lead_status_type::all();

        $leads = Property_lead::with(['users','lead_detailss'])->where('id', $id )->first();

        $this->data['users'] = User::where('status','1')->where('user_type','2')->get();


        $lead_id = $leads->id;

        $lead_detail = Portal_lead_detail::with(['users'])->where(  'lead_id' , $lead_id )->orderby('id' , 'DESC')->get();


        $this->data['leads'] = $leads;

        $this->data['lead_detail'] = $lead_detail;



        return view('property_lead.detail', $this->data);
    }



    public function portal_lead_store_detail(Request $request)
    {
        // get use auth id

        $id = Auth::user()->id;



        $bool=0;

		if($bool==0)
		{

            // create new lead detail
            $leads = new Portal_lead_detail();
            $leads->agent_id = $id;
            $leads->lead_status = $request->lead_status;
            $leads->lead_id = $request->lead_id;
            $leads->lead_description = $request->description;
            $leads->reminder_date = $request->reminder_date;
            $leads->save();


            // update lead status on lead
            $lead = Property_lead::find($request->lead_id);
            if (!empty($lead)) {
                $lead->lead_status = $request->lead_status;
                $lead->is_closed = 0;
                $lead->save();
            }
            return Redirect::back()->with('message','Lead Details has Been Generated Successfully.');
        }
        else
        {
            return Redirect::back()->with('message','Lead Deatil is already Exist.');
        }

    }



    public function recycle_leads()
    {
        //

        $this->data['portals'] = Property_portals::all();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        $property_leads = Property_lead::with(['users', 'lead_detailss'])->where('is_trash', 0)->where('is_recycle', 1)->orderby('updated_at','DESC')->get();


        $this->data['leads'] = $property_leads;



        return view('property_lead.show_recycle', $this->data);
    }








    public function recycle_search_portal(Request $request)
    {



        $this->data['portals'] = Property_portals::all();


        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

        if($request->search != null){
            $leads = $leads->where('name', 'LIKE', "%{$request->search}%");
        }
        // if($request->lead_status != null){
        //     $leads = $leads->where('lead_status', $request->lead_status);
        // }
        if($request->email != null){
            $leads = $leads->where('email', $request->email);
        }
        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->portals != null){
            $leads = $leads->where('lead_type', $request->portals);
        }
        if($request->lead_source != null){
            $leads = $leads->where('from', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
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

        return view('property_lead.show_recycle', $this->data);



    }













    public function temporary_leads()
    {
        //



        $property_leads = Property_lead::with(['users', 'lead_detailss'])->where( 'is_trash' , 0 )->where('is_temporary', 1)->get();

        $this->data['users'] = Users::where('status','1')->get();

        $this->data['property_leads'] = $property_leads;



        return view('property_lead.show_temporary', $this->data);
    }





    public function property_trash_leads()
    {



        $property_leads = Property_lead::with(['users', 'lead_detailss'])->where('is_trash', 1)->get();






        $this->data['property_leads'] = $property_leads;



        return view('property_lead.show_trash', $this->data);

    }



    public function transfer_agent_lead(Request $request)
    {
        // Get auth user id
        $user_id = Auth::user()->id;

        // assign requests into variables
        $lead_id = $request->lead_id;
        $agent_id = $request->user;

        // get user details
        $username = User::find($user_id);

        // get agent details
        $agentname = User::find($agent_id);



        //get lead details
        $leads = Property_lead::find($lead_id);

        // change agent id associated with the lead
        if (!empty($leads)) {

            $leads->agent_id = $agent_id;
            $leads->lead_status = 5;
            $leads->is_recycle = 0;
            $leads->save();
        }



        // create a new lead_detail record
        $leads_detail = new Portal_lead_detail();

        // enter below data into record
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


        return Redirect::back()->with('message','Lead has Been Transferred Successfully.');

    }




    public function reassign_agent(Request $request)
    {



        //
        $user_id = Auth::user()->id;

        $lead_id = $request->lead_id;

        $agent_id = $request->user;

        $username = User::find($user_id);

        $agentname = User::find($agent_id);

        $leads = Property_lead::find($lead_id);


        if (!empty($leads)) {


            $leads->agent_id = $agent_id;
            $leads->is_temporary = 0;

            $leads->save();
        }



        $leads_detail = new Portal_lead_detail();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Lead Transfer From Temporary this agent ". "$username->name" . ' To this' . $agentname->name ;

        $leads_detail->save();


        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }






    public function transfer_temporary($id)
    {
        //



        $leads = Property_lead::find($id);


        if (!empty($leads)) {

            $leads->is_temporary = 0;

            $leads->save();
        }



        return Redirect::back()->with('message','Lead has Been Transferd Successfully.');

    }





    public function transfer_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Property_lead::find($id);


        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_recycle = 0;

            $leads->save();
        }



        $leads_detail = new Portal_lead_detail();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Lead Transfer From Recycle";

        $leads_detail->save();



        return Redirect::to('/all_leads')->with('message', 'Lead has Been Transferd Successfully.');
    }






    public function transfer_lead_trash($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Property_lead::find($id);


        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_trash = 0;

            $leads->save();
        }



        $leads_detail = new Portal_lead_detail();


        $leads_detail->agent_id = $user_id;
        $leads_detail->lead_id = $leads->id;
        $leads_detail->lead_description = "Lead Transfer From Trash";

        $leads_detail->save();



        return Redirect::to('/all_leads')->with('message', 'Lead has Been Transferd Successfully.');
    }




    public function move_recycle_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Property_lead::find($id);

        if (!empty($leads)) {


            $leads->modifier = $user_id;
            $leads->is_recycle = 1;

            $leads->save();
        }



        // $leads_detail = new Portal_lead_detail();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Recycle";

        // $leads_detail->save();




        return Redirect::to('/all_recycle')->with('message', 'Lead has Been Transferd Successfully.');
    }


    public function move_trash_lead($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Property_lead::find($id);

        if (!empty($leads)) {

            $leads->agent_id = $user_id;
            $leads->is_trash = 1;

            $leads->save();
        }

        // $leads_detail = new Portal_lead_detail();

        // $leads_detail->agent_id `= $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Trash";

        // $leads_detail->save();

        return Redirect::to('/all_leads')->with('message', 'Lead has Been Transferd Successfully Into Trash.');
    }





    public function move_closed_deal($id)
    {
        //
        $user_id = Auth::user()->id;



        $leads = Property_lead::find($id);

        if (!empty($leads)) {


            $leads->agent_id = $user_id;
            $leads->lead_status = 6;
            $leads->is_closed = 1;

            $leads->save();
        }


        // update lead status on lead



        // $leads_detail = new Portal_lead_detail();


        // $leads_detail->agent_id = $user_id;
        // $leads_detail->lead_id = $leads->id;
        // $leads_detail->lead_description = "Lead Transfer to Trash";

        // $leads_detail->save();



        return Redirect::to('/all_leads')->with('message', 'Lead has Been Transferd Successfully to Closed Deals.');

    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        $this->data['property_portals'] = Property_portals::get();

        $this->data['user'] = Users::where('user_type','2')->get();

        return view('property_lead.create', $this->data);
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
        $leads = Property_lead::latest()->first();

        $prefix = 'PL-';



        if(empty($leads)){
            $leads = new Leads();
            $leads->ref_no = 'PL-1000';
        }

        $ref = ($this->ref_no != null) ? $this->ref_no : explode('-', $leads->ref_no)[1];

        $this->ref_no = $ref+1;



        $bool=0;

		if($bool==0)
		{

            //
            $property_leads = new Property_lead();


            $property_leads->ref_no = $prefix.$this->ref_no ;
            $property_leads->from = $request->property_portal_id;
            $property_leads->agent_id = $request->agent;
            $property_leads->name = $request->full_name;
            $property_leads->inquiry = $request->inquiry;
            $property_leads->phone = $request->phone;
            $property_leads->email = $request->email;
            $property_leads->location = $request->location;
            $property_leads->property_detail = $request->property_detail;
            $property_leads->property_location = $request->property_location;
            $property_leads->property_ref = $request->property_ref;
            $property_leads->property_id = $request->property_id;
            $property_leads->property_url = $request->property_url;
            $property_leads->property_ref = $request->property_ref_no;
            $property_leads->status = 1;
            $property_leads->lead_status = 5;
            $property_leads->is_recycle = 0;


            $property_leads->save();

            $agent_id = $property_leads->agent_id;

            $user = Users::where( 'id' , $agent_id )->first();



            \Mail::send('email/lead',
            array(

            ), function($message) use ( $user)
              {

                 $message->to($user->email)->subject('Edge Realty Property Portal Lead Email');
              });


            $website_leads2 = Property_lead::with(['users'])->where('ref_no', $property_leads->ref_no)->get();

            $website_leads3 = $website_leads2[0];

            // $website_leads3->users->notify(new LeadAdded($property_leads));


            return redirect('all_leads')->with('message','Property Listing Lead has Been Generated Successfully.');


        }
        else
        {
            return redirect('all_leads')->with('message','Property Listing Lead is Already Exist.');

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

        $this->data['property_portals'] = Property_portals::get();

        $this->data['user'] = Users::get();




        $leads = Property_lead::with(['users'])->where('id', $id )->first();



        $this->data['leads'] = $leads;

        return view('property_lead.edit' , $this->data);


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



        $property_leads = Property_lead::find($id);


        if (!empty($property_leads)) {


            $property_leads->from = $request->property_portal_id;
            $property_leads->agent_id = $request->agent;
            $property_leads->name = $request->full_name;
            $property_leads->inquiry = $request->inquiry;
            $property_leads->phone = $request->phone;
            $property_leads->email = $request->email;
            $property_leads->location = $request->location;
            $property_leads->property_detail = $request->property_detail;
            $property_leads->property_location = $request->property_location;
            $property_leads->property_ref = $request->property_ref;
            $property_leads->property_id = $request->property_id;
            $property_leads->property_url = $request->property_url;
            $property_leads->property_ref = $request->property_ref_no;
            $property_leads->status = 1;
            $property_leads->is_recycle = 0;


            $property_leads->save();


            $agent_id = $property_leads->agent_id;

            $user = Users::where( 'id' , $agent_id )->first();

            \Mail::send('email/update_portal',
            array(

            ), function($message) use ( $user)
            {
                $message->to($user->email)->subject('Edge Realty Lead Email');
            });

            $website_leads2 = Property_lead::with(['users'])->where('ref_no', $property_leads->ref_no)->get();

            $website_leads3 = $website_leads2[0];

            // $website_leads3->users->notify(new LeadAdded($property_leads));

        }

        return redirect('all_leads')->with('message','Lead has Been Updated Successfully.');

    }




    public function temporary_update_portal()
    {

        $date = new \DateTime();
        $date->modify('-25 hours');
        $startDate = $date->format('Y-m-d H:i:s');

        $date = new \DateTime();
        $date->modify('-24 hours');
        $endDate = $date->format('Y-m-d H:i:s');



        $leads = Property_lead::with(['lead_detailss' ])->where('is_temporary', 0)->where('created_at', '>',$startDate)->where('created_at', '<', $endDate)->doesnthave('lead_detailss')->get();

        foreach ($leads as $lead) {
            $lead->is_temporary = 0;
            $lead->save();
        }

        echo "records {$leads->count()} has been updated";

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
