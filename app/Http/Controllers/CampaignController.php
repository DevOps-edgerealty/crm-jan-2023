<?php

namespace App\Http\Controllers;

use App\Models\Models\Campaign;
use App\Models\Models\Campaign_agent;
use Illuminate\Http\Request;
use App\Models\Models\Leads_type;
use App\Models\Models\Users;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class CampaignController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    public function index()
    {
        //


         $campaign = Campaign::with(['lead_typess','campaign_agents.agent'])->orderBy('id', 'DESC')->get();

        // dd($campaign[9]->campaign_agents);



        $this->data['campaign'] = $campaign;



        return view('campaign.show', $this->data );
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

        return view('campaign.create', $this->data );
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

        $bool=0;

		if($bool==0)
		{


            //
            $campaign = new Campaign();

            $campaign->status = $request->status;
            $campaign->campaign_name = $request->campaign_name;
            $campaign->platform = $request->lead_type;

            $campaign->source = $request->source;

            $campaign->save();

            $campagin_id = $campaign->id;



            $campagin_agent = [];

            foreach($request->agent_group as $agent)
            {
                $campagin_agent[] = [
                    'campaign_id' => $campagin_id,
                    'agent_id' => $agent['agent_id'],
                ];
            }


            // foreach( $request->agent  as $agent)
            // {
            //     $campagin_agent[] = [
            //         'campaign_id' => $campagin_id,
            //         'agent_id' => $agent
            //     ];
            // }

            // dd($campagin_agent);



            DB::table('campaign_agent')->insert($campagin_agent);
            







            return redirect('campaign')->with('message','Campaign has Been Generated Successfully.');


        }
        else
        {
            return redirect('campaign')->with('message','Campaign is Already Exist.');

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

        $this->data['user'] = User::where('status','1')->where('user_type','2')->get();

        $campaign = Campaign::with(['lead_typess'])->where('id', $id )->first();

        $this->data['agents'] = Campaign_agent::where('campaign_id', $campaign->id)->pluck('agent_id')->toArray();
        // echo '<pre>FILE: ' . __FILE__ . '<br>LINE: ' . __LINE__ . '<br>';
        // print_r( $this->data['agents'] );
        // echo '</pre>'; die;




        $this->data['campaign'] = $campaign;
        // return $this->data;
        dd($this->data);

        return view('campaign.edit' , $this->data);

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

         $campaign = Campaign::find($id);


         if (!empty($campaign)) {

            $campaign->status = $request->status;
            $campaign->campaign_name = $request->campaign_name;
            $campaign->platform = $request->lead_type;
            $campaign->campaign_agent = $request->agent;
            $campaign->source = $request->source;


            $campaign->save();


            $campagin_id = $campaign->id;

            $campagin_agent = [];

            foreach($request->agent_group as $agent)
            {
                $campagin_agent[] = [
                    'campaign_id' => $campagin_id,
                    'agent_id' => $agent['agent_id'],
                ];
            }

            Campaign_agent::where('campaign_id', $campagin_id)->delete();



            DB::table('campaign_agent')->insert($campagin_agent);

         }

         return redirect('campaign')->with('message','Campaign has Been Updated Successfully.');

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
