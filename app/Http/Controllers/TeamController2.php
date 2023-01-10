<?php

namespace App\Http\Controllers;

use App\Models\Models\Campaign_agent;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Campaign;
use App\Models\Models\Lead_details;
use App\Models\Models\Leads;
use App\Models\Models\Leads_type;
use App\Models\Models\Lead_status_type;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Imports\LeadImport;
use App\Models\Models\Property_portals;
use App\Models\Models\Portal_lead_detail;
use App\Models\Models\Website_lead_detail;
use App\Models\Models\Property_lead;
use App\Models\Models\Website;
use App\Models\Models\Team;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;

class TeamController extends Controller
{
    public function index()
    {
        // Get user status id
        $user_id = Auth::user()->team_leader;

        // get user id
        $id = Auth::user()->id;

        // get team id
        $user_team = Auth::user()->team_id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();




        if ( $user_id == '1') {
            $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);
        }

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();
        // dd($users);

        $team = Team::where('id', $user_team)->get();

        // dd($team[0]->id);

        $team_array = [];

        foreach($users as $data)
        {
            if($data->team_id == $user_team)
            {
                array_push($team_array, $data->id);
            }
        }
        dd($team_array);

        return $leads;

        $this->data['leads'] = $leads;

        return view('team.show', $this->data);

    }









    public function addNewAgent(Request $request)
    {
        $user_type = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ($user_type == 1)
        {

            if($request->user_member_type == 1)
            {
                try {
                    $team = Team::where('name', $request->team_name)->get();

                    $result = Users::where('id', $request->agent_id)->get();
                    $result->team_id = $team->id;
                    $result->team_leader = 1;
                    $result->save();
                }
                catch (\Exception $e)
                {
                    return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
                }
            }
            elseif ($request->user_member_type == 2)
            {
                try {
                    $team = Team::where('name', $request->team_name)->get();

                    $result = Users::where('id', $request->agent_id)->get();
                    $result->team_id = $team->id;
                    $result->team_leader = 2;
                    $result->save();
                }
                catch (\Exception $e)
                {
                    return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
                }
            }
        }
        else {
            return Redirect::back()->with('error', 'Your are not authorized!');
        }

        return Redirect::back()->with('message','The settings were applied successfully.');

    }













    public function search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );


        // $leads = $leads->

        if($request->search != null){
            $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads = $leads->where('campaign_id', $request->campaigns);
        }
        if($request->lead_status != null){
            $leads = $leads->where('lead_status', $request->lead_status)->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36);
        }
        // dd($leads);

        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->lead_source != null){
            $leads = $leads->where('lead_type', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }

        if($request->agent_id != null){
            // $leads = $leads->where('agent_id', $request->agent_id);
            $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', $request->agent_id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );
        }
        if($request->start_date != null){
            $leads = $leads->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date != null){
            $leads = $leads->where('created_at', '<=', $request->end_date);
        }

        $leads = $leads->orderby('id','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request->all();

        $this->data['leads'] = $leads;

        return view('team.show', $this->data);

    }


    public function team_details($id)
    {

        $this->data['lead_status_type'] = lead_status_type::all();


        $this->data['users'] = User::where('status','1')->where('user_type','2')->get();


        $leads = Leads::with(['users','lead_typess','lead_detailss','campaigns'])->where('id', $id )->first();


        $lead_detail = Lead_details::with(['users'])->where(  'lead_id' , $id )->orderby('id' , 'DESC')->get();




        $this->data['leads'] = $leads;



        $this->data['lead_detail'] = $lead_detail;



        return view('team.detail', $this->data);
    }








    public function portal()
    {
        $user_id = Auth::user()->team_leader;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Property_portals::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        if ( $user_id == '1') {
            // $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);

            $leads = Property_lead::with(['users','lead_detailss'])->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);
            // $leads = Property_lead::with(['users','lead_detailss'])->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);

        }

        //return $leads;

        $this->data['leads'] = $leads;

        return view('team.portal.show', $this->data);

    }


    public function portal_details($id)
    {

        $this->data['lead_status_type'] = lead_status_type::all();

        $leads = Property_lead::with(['users','lead_detailss'])->where('id', $id )->first();

        $this->data['users'] = User::where('status','1')->where('user_type','2')->get();


        $lead_id = $leads->id;

        $lead_detail = Portal_lead_detail::with(['users'])->where(  'lead_id' , $lead_id )->orderby('id' , 'DESC')->get();


        $this->data['leads'] = $leads;

        $this->data['lead_detail'] = $lead_detail;



        return view('team.portal.detail', $this->data);
    }




    public function website()
    {

        // $this->data['agent'] = Users::where('status','1')->get();

        $user_id = Auth::user()->team_leader;

        $this->data['lead_source'] = Leads_type::all();

        $id = Auth::user()->id;

        if ( $user_id == '1') {


            $leads = Website::with(['users','lead_detailss'])->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);

        }
        $this->data['leads'] = $leads;

        return view('team.website.show', $this->data);



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





        return view('team.website.details', $this->data);
    }






    public function portal_search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();
        // $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->all();


        // $leads = $leads->

        if($request->search != null){
            $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads = $leads->where('campaign_id', $request->campaigns);
        }
        if($request->lead_status != null){
            $leads = $leads->where('lead_status', $request->lead_status)->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36);
        }
        // dd($leads);

        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->lead_source != null){
            $leads = $leads->where('lead_type', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }

        if($request->agent_id != null){
            // $leads = $leads->where('agent_id', $request->agent_id);
            $leads = Property_lead::with(['users','lead_detailss'])->where('agent_id', $request->agent_id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );
        }
        if($request->start_date != null){
            $leads = $leads->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date != null){
            $leads = $leads->where('created_at', '<=', $request->end_date);
        }

        $leads = $leads->orderby('id','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request->all();

        $this->data['leads'] = $leads;

        return view('team.portal.show', $this->data);

    }







    public function website_search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = Website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();
        // $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->all();


        // $leads = $leads->

        if($request->search != null){
            $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
        }

        if($request->campaigns != null){
            $leads = $leads->where('campaign_id', $request->campaigns);
        }
        if($request->lead_status != null){
            $leads = $leads->where('lead_status', $request->lead_status)->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36);
        }
        // dd($leads);

        if($request->phone != null){
            $leads = $leads->where('phone', $request->phone);
        }
        if($request->lead_source != null){
            $leads = $leads->where('lead_type', $request->lead_source);
        }
        if($request->ref_number != null){
            $leads = $leads->where('ref_no', $request->ref_number);
        }

        if($request->agent_id != null){
            // $leads = $leads->where('agent_id', $request->agent_id);
            $leads = Website::with(['users','lead_detailss'])->where('agent_id', $request->agent_id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );
        }
        if($request->start_date != null){
            $leads = $leads->where('created_at', '>=', $request->start_date);
        }
        if($request->end_date != null){
            $leads = $leads->where('created_at', '<=', $request->end_date);
        }

        $leads = $leads->orderby('id','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request->all();

        $this->data['leads'] = $leads;

        return view('team.website.show', $this->data);

    }

}
