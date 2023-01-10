<?php

namespace App\Http\Controllers;

use App\Models\Models\Campaign;
use App\Models\Models\Lead_details;
use App\Models\Models\Leads;
use App\Models\Models\Leads_type;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Imports\LeadImport;
use App\Models\Models\Campaign_agent;
use App\Models\Models\Property_lead;
use App\Models\Models\Website;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use App\Notifications\cLeadAdded;

class fetch_dataController extends Controller
{

    protected $ref_no = null;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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

        $campign_agents = DB::select('
        select count(leads.id) as lead_count, campaign_agent.agent_id from campaign_agent
        left join leads on leads.campaign_id = campaign_agent.campaign_id and leads.agent_id = campaign_agent.agent_id
        where campaign_agent.campaign_id = '.$request->campaign_id.' group by campaign_agent.agent_id order by lead_count, agent_id

        ');
        // $campign_agents = Campaign_agent::where('campaign_id', $request->campaign_id)->inRandomOrder()->first();



        $agent_id = @$campign_agents[0]->agent_id;


        if ($agent_id == '') {

            $agent_id = 1;


        }



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
            $leads->preferred_number = $request->preferd_number;
            $leads->email = $request->email;
            $leads->campaign_id = $request->campaign_id;
            $leads->is_recycle = 0;
            $leads->status = $request->status;
            $leads->agent_id = $agent_id;
            $leads->lead_status = 5;
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

            $website_leads3->users->notify(new cLeadAdded($leads));


            return redirect('leads')->with('message','Lead has Been Generated Successfully.');


        }
        else
        {
            return redirect('leads')->with('message','Lead is Already Exist.');

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
