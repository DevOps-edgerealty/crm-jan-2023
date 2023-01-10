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
use Illuminate\Pagination\Paginator;
use App\Models\Models\Website;
use App\Models\Models\Team;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
use Auth;

class TeamController extends Controller
{
    public function index()
    {
        // Get user status id
        $user_id = Auth::user()->team_leader;

        // get user id
        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();




        if ( $user_id == '1') {
            $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', 38)->orWhere('agent_id', 37)->orWhere('agent_id', 24)->orWhere('agent_id', 36)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);
        }


        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();
        $this->data['team_members'] = $team_members;

        // dd($team_members);


        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            // dd($leads_1[0]);
            $allItems = $allItems->merge($leads_1);

            // array_push($leads_2, $leads_1);
        }


        $allItems = $allItems->sortByDesc('created_at');
        $leads_paged = $this->paginate($allItems);

        $leads_paged->withPath('team');


        $this->data['leads'] = $leads_paged;
        // $this->data['users'] = $users;


        return view('team.show', $this->data);

    }


















    public function paginate($items, $perPage = 30, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        // return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options, ['path'  => $this->request->url(),
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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

        // $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );




        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();
        $this->data['team_members'] = $team_members;

        // dd($team_members);


        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            // dd($leads_1[0]);
            $allItems = $allItems->merge($leads_1);

            // array_push($leads_2, $leads_1);
        }





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



        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;




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


        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;


        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Property_lead::with(['users','lead_detailss'])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            $allItems = $allItems->merge($leads_1);
        }


        $allItems = $allItems->sortByDesc('created_at');
        $leads_paged = $this->paginate($allItems);

        $leads_paged->withPath('portal_leads');



        //return $leads;

        $this->data['leads'] = $leads_paged;

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



        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;



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



        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;




        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Website::with(['users','lead_detailss'])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            $allItems = $allItems->merge($leads_1);
        }


        $allItems = $allItems->sortByDesc('created_at');
        $leads_paged = $this->paginate($allItems);

        $leads_paged->withPath('website_leads');




        $this->data['leads'] = $leads_paged;

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



// get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;




        return view('team.website.details', $this->data);
    }
















    public function portal_search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        // $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();
        // $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->all();



        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;


        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Property_lead::with(['users','lead_detailss'])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            $allItems = $allItems->merge($leads_1);
        }


        $leads = $allItems->sortByDesc('created_at');

        // dd($leads);



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




        // $leads = $leads->sortByDesc('created_at');
        // $leads = $this->paginate($leads);

        // $leads->withPath('portal/search');


        $this->data['leads'] = $leads;
        $this->data['request'] = $request->all();


        return view('team.portal.show', $this->data);

    }





















    public function website_search(Request $request)
    {

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();

        // $leads = Website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();
        // $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->all();





        // get team id
        $user_team = Auth::user()->team_id;

        // get active agents
        $users = Users::where('status', 1)->where('team_leader', 0)->get();

        // get team members
        $team_members = Users::where('team_id', $user_team)->where('team_leader', 2)->get();

        $this->data['team_members'] = $team_members;


        $allItems = new \Illuminate\Database\Eloquent\Collection;

        foreach($team_members as $data)
        {
            $leads_1 = Website::with(['users','lead_detailss'])
                ->where('agent_id', $data->id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            $allItems = $allItems->merge($leads_1);
        }


        $leads = $allItems->sortByDesc('created_at');





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












    public function manage_team()
    {

        $team = Team::all();
        $users = User::where('status', 1)->where('user_type', 2)->orderBy('name')->get();

        $this->data['users'] = $users;
        $this->data['team'] = $team;

        return view('users.includes.manage_team', $this->data);
    }




    public function update_team($id, Request $request)
    {
        // dd($request->old_leader);
         $result = Team::find($id);
         $result2 = Users::find($request->team_leader);
         $result3 = Users::find($request->old_leader);

        if(!empty($result))
        {
            try {
                $result->name = $request->team_name;
                $result->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }

        }


        if(!empty($result2))
        {
            try {
                $result2->team_id = $id;
                $result2->team_leader = 1;
                $result2->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }

        }



        if(!empty($result3))
        {
            try {
                $result3->team_id = 'null';
                $result3->team_leader = 2;
                $result3->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }

        }


        return Redirect::back()->with('message','Listing customizations applied successfully.');

        // return Redirect::back()->with('error','No Details were detected.');
    }








    public function delete_team($id, Request $request)
    {
        $result = Team::find($id);
        // $result2 = Users::find($request->team_leader);
        $result3 = Users::find($request->old_leader);


        if(!empty($result))
        {
            try {
                $result->delete();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }

        }



        if(!empty($result3))
        {
            try {
                $result3->team_id = 0;
                $result3->team_leader = 0;
                $result3->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }

        }

        return Redirect::back()->with('message','Listing customizations applied successfully.');

    }

}
