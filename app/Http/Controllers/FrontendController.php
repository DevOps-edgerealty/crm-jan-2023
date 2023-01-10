<?php

namespace App\Http\Controllers;

use App\Models\Models\Announcements;
use App\Models\Models\Campaign;
use App\Models\Models\Leads;
use App\Models\Models\Leaderboard;
use App\Models\Models\Leader_board_detail;
use App\Models\Models\Property_lead;
use App\Models\Models\Target;
use App\Models\Models\Property_portals;
use App\Models\Models\Users;
use App\Models\Models\Website;
use App\Models\User;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\Auth;
use Akaunting\Apexcharts\Chart;
use App\Models\Models\Portal_lead_detail;
use Carbon\Carbon;
use Illuminate\Notifications\Notification;
use App\Notifications\test;
// use Illuminate\Notifications\LeadAdded;

class FrontendController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {

        $user_id1 = Auth::user()->id;

        $user = Users::find($user_id1);

        $this->data['noti'] = null;

        foreach ($user->notifications as $notification) {
           $this->data['noti']= $notification;
        }

        $user_id = Auth::user()->user_type;
        $id = Auth::user()->id;




        // Check if user is an Admin, if so get data for admin references
        if ( $user_id == '1') {


            /**
             * Displays Lead Counts of all 03 categories (CAMPAIGN, PORTAL, WEBSITE) on dashboard right-top side
             */



            $dashboard_campaign_lead_count = Leads::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $dashboard_portal_lead_count = Property_lead::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $dashboard_website_lead_count = Website::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $dashboard_total_leads_2023 = $dashboard_campaign_lead_count + $dashboard_portal_lead_count + $dashboard_website_lead_count;

            $this->data['dashboard_campaign_lead_count'] = $dashboard_campaign_lead_count;

            $this->data['dashboard_portal_lead_count'] = $dashboard_portal_lead_count;

            $this->data['dashboard_website_lead_count'] = $dashboard_website_lead_count;

            $this->data['dashboard_total_leads_2023'] = $dashboard_total_leads_2023;

            // dd($dashboard_website_lead_count);

            $leads = Leads::with(['users','lead_typess'])->whereDate('created_at', '>', date('2022-12-17'))->get();

            $leadCount = $leads->where( 'is_recycle' , '0' )->count();

            $property_leads = Property_lead::where( 'is_recycle' , '0' )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $website = Website::where( 'is_recycle' , '0' )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $announcement = Announcements::where('status','1')->get();

            $leads_data = Leads::where( 'is_recycle' , '0' )->selectRaw('year(created_at) as year, monthname(created_at) as month, count(id) as total_leads')
                ->whereDate('created_at', '>', date('2022-12-17'))
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();

            $this->data['leads_data'] = $leads_data;




            /**
             *[tq]
             * All Leads for the year 2023
             *
             */
            // a count to loop through 12 months in a year
            $count = 0;

            // each lead count per month will be pushed into
            // arrays with respect to the months as indexes
            $campaign_obj_1 = array();
            $portal_obj_2 = array();
            $website_obj_3 = array();

            $campaign_leads_pre = [];
            $portal_leads_pre = [];
            $website_leads_pre = [];

            // grab the sum of all the leads per annum
            $campaign_total = 0;
            $portal_total = 0;
            $website_total = 0;

            while($count <= 11)
            {
                try {
                    $result1 = Leads::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();
                $count_c = $count + 1;
                $campaign_obj_1[$count_c] = $result1;
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;
                // dd($result1);


                $result2 = Property_lead::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();

                // dd($result2);
                $portal_obj_2[$count_c] = $result2;
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;

                $result3 = website::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();
                $website_obj_3[$count_c] = $result3;
                $website_leads_pre[$count] = $result3;
                $website_total = $website_total + $result3;

                } catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Opps! We encountered an error. Please contact the administrator.';

                    return view('home', $this->data);
                }

                $count = $count + 1;
            }


            $campaign_leads = [];
            foreach ($campaign_obj_1 as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($campaign_leads, $lead);
                // }

            }


            $portal_leads = [];
            foreach ($portal_obj_2 as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($portal_leads, $lead);
                // }
            }

            $website_leads = [];
            foreach ($website_obj_3 as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($website_leads, $lead);
                // }
            }
            // dd($portal_leads);





            /**
             *
             * Get highest value in arrays
             *
             */
            $cHigh = max($campaign_leads);
            $pHigh = max($portal_leads);
            $wHigh = max($website_leads);
            $max = 0;
            if ($cHigh > $pHigh)
            {
                if ($cHigh > $wHigh)
                {
                    $max = $cHigh;
                }
                else {
                    $max = $wHigh;
                }
            }
            else {
                if ($pHigh > $wHigh)
                {
                    $max = $pHigh;
                }
                else {
                    $max = $wHigh;
                }
            }
            $this->data['max'] = $max;






            /**
             *
             * leads for last year
             *
             */
            $count = 0;
            $cLast_year = 0;
            $pLast_year = 0;
            $wLast_year = 0;
            while($count <= 11)
            {
                $result1 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date('2023'))
                    ->count();

                $result2 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date('2023'))
                    ->count();

                $result3 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date('2023'))
                    ->count();

                $cLast_year = $cLast_year + $result1;
                $pLast_year = $pLast_year + $result2;
                $wLast_year = $wLast_year + $result3;
                $count = $count + 1;
            }

            $total_leads_2021 = ($cLast_year + $pLast_year + $wLast_year);
            $total_leads_2022 = ($campaign_total + $portal_total + $website_total);





            /**
             *
             * Rate of Growth
             *
             */
            $rog = (($total_leads_2022 )/$total_leads_2021) * 100;



            /**
             * Number of agents
             */
            $agent_count = Users::where('user_type', 2)->where('status', 1)->count();

            $this->data['agent_count'] = $agent_count;




            /**
             *
             * Monthly Ranking Section
             *
             */
            $agents = Users::where('user_type', 2)->where('status', 1)->get();

            $this->data['agents'] = $agents;


            /**
             * Total Commission of This Month
             */
            $leader_board_dashboard = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
            ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
            ->where('leader_board.status',1)
            ->whereDate('leader_board.created_at', '>', date('2023-01-01'))
            ->whereDate('leader_board_detail.created_at', '>', date('2023-01-01'))
            ->where('is_trash', null)
            ->groupBy('leader_id', 'leader_board.id')
            ->orderby('totalcommission' , 'DESC')->take(5)
            ->get();
            // dd($leader_board_dashboard);

            $leaderboard_memebers = Leaderboard::where('status', 1)->take(5)->get();

            $this->data['leaderboard_memebers'] = $leaderboard_memebers;


            /**
             * Total Commission of Last Month
             */
            $leader_board_last_month = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
            ->whereYear('leader_board_detail.created_at', '=', Carbon::now()->year)
            ->whereMonth('leader_board_detail.created_at', '=', Carbon::now()->subMonth()->month)
            ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
            ->where('leader_board.status',1)
            ->whereDate('leader_board.created_at', '>', date('2023-01-01'))
            ->where('is_trash', null)
            ->groupBy('leader_id', 'leader_board.id')
            ->orderby('totalcommission', 'DESC')
            ->get();

            // dd($leader_board_last_month);

            $leaderboard_total = 0;

            foreach($leader_board_last_month as $data)
            {
                $leaderboard_total = $leaderboard_total + $data->totalcommission;
            }



            /**
             * Total Target of this month
             */
            $target_data = Target::where('month', Carbon::now()->month)->where('year', Carbon::now()->year)->get();

            $target_total = 0;

            foreach($target_data as $data)
            {
                $target_total = $target_total + $data->target;
            }




            /**
             * Total Target of last month
             */
            $target_data2 = Target::where('month', Carbon::now()->subMonth()->month)->where('year', Carbon::now()->year)->get();

            $target_total_last_month = 0;

            foreach($target_data2 as $data)
            {
                $target_total_last_month = $target_total_last_month + $data->target;
            }




            $leader_board_this_month = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
            ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
            ->where('leader_board.status',1)
            ->where('is_trash', null)
            ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
            ->whereYear('leader_board_detail.created_at', Carbon::now()->year)
            ->groupBy('leader_id', 'leader_board.id')
            ->orderby('totalcommission' , 'DESC')
            ->get();

            $target_set = Target::where('month', Carbon::now()->month)->where('year', Carbon::now()->year)->get();
            $target_last_month = Target::where('month', Carbon::now()->month)->where('year', Carbon::now()->year)->get();
            // dd($target_set);


            $achievement_rate2=0;
            if( !$target_set->isEmpty() && !$leader_board_this_month->isEmpty() )
            {

                $target_var = 0; // target
                $commission_var = 0; // total commission

                foreach($target_set as $data)
                {
                    $target_var = $target_var + $data->target;
                }

                foreach($leader_board_this_month as $data)
                {
                    $commission_var = $commission_var + $data->totalcommission;
                }


                    $achievement_rate = 100 * ($commission_var) / $target_var;
                    $this->data['achievement_rate2'] = $achievement_rate;

            }
            else{
                $this->data['leaderboard_this_month'] = 0;
                $this->data['achievement_rate2'] = 0;
            }


            $this->data['target_total_last_month'] = $target_total_last_month;
            $this->data['leaderboard_total'] = $leaderboard_total;
            $this->data['target_total'] = $target_total;
            $this->data['leader_board_dashboard'] = $leader_board_dashboard;

            $this->data['campaign_leads_2023'] = $campaign_leads;
            $this->data['portal_leads_2023'] = $portal_leads;
            $this->data['website_leads_2023'] = $website_leads;

            $this->data['campaign_total'] = $campaign_total;
            $this->data['property_total'] = $portal_total;
            $this->data['website_total'] = $website_total;

            $this->data['total_leads'] = ($campaign_total + $portal_total + $website_total);
            $this->data['total_leads_2021'] = ($cLast_year + $pLast_year + $wLast_year);

            $this->data['rog'] = round($rog, 2);
        }




        elseif( $user_id == '2')
        {


            /**
             * Displays Lead Counts of all 03 categories (CAMPAIGN, PORTAL, WEBSITE) on dashboard right-top side
             */
            $dashboard_campaign_lead_count = Leads::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->where('agent_id', $user_id1)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $dashboard_portal_lead_count = Property_lead::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->where('agent_id', $user_id1)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $dashboard_website_lead_count = Website::where('is_recycle', 0)->where('is_trash', 0)->where('is_closed', 0)->where('agent_id', $user_id1)->whereDate('created_at', '>', date('2022-12-17'))->count();

            $this->data['dashboard_campaign_lead_count'] = $dashboard_campaign_lead_count;

            $this->data['dashboard_portal_lead_count'] = $dashboard_portal_lead_count;

            $this->data['dashboard_website_lead_count'] = $dashboard_website_lead_count;


            // Targets

            $nowMonth = Carbon::now()->month;

            $nowYear = Carbon::now()->year;

            $total_data_set = 0;


            $target_set = Target::where('agent_id', $user_id1)->where('month', Carbon::now()->month)->where('year', Carbon::now()->year)->get();

            $target_last_month = Target::where('agent_id', $user_id1)->where('month', Carbon::now()->subMonth()->month)->where('year', Carbon::now()->year)->get();

            if(!$target_last_month->isEmpty())
            {
                $this->data['target_last_month'] = $target_last_month[0];
            }
            else {
                $this->data['target_last_month'] = 0;
            }

            // dd($target_last_month);


            $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
            ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
            ->where('leader_board.status',1)
            ->where('is_trash', null)
            ->where('leader_board.agent_id', $id)
            ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
            ->whereYear('leader_board_detail.created_at', Carbon::now()->year)
            ->groupBy('leader_id', 'leader_board.id')
            ->orderby('totalcommission' , 'DESC')
            ->get();

            // dd($leader_board);

            if( !$target_set->isEmpty() && !$leader_board->isEmpty() )
            {
                $this->data['leaderboard_this_month'] = $leader_board[0]->totalcommission;

                $variable1 = $target_set[0]->target;
                $variable2 = $leader_board[0]->totalcommission;

                $achievement_rate = 100 * ($variable2) / $variable1;
                $this->data['achievement_rate'] = $achievement_rate;

            }
            else{
                $this->data['leaderboard_this_month'] = 0;
                $this->data['achievement_rate'] = 0;

            }



            $this->data['target_set'] = $target_set;

            $leads = Leads::with(['users','lead_typess'])->where( 'agent_id' , $id   )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $leadCount = $leads->where( 'agent_id' , $id   )->where( 'is_recycle' , '0' )->count();

            $property_leads = Property_lead::where( 'agent_id' , $id   )->where( 'is_recycle' , '0' )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $website = Website::where( 'agent_id' , $id   )->where( 'is_recycle' , '0' )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $announcement = Announcements::where('status','1')->get();





            /**
             * Get leaderboard details of the auth user
             * First check if the auth user has made any sales - meaning if the agent is on the leaderboard.
             * If so, then get the total commission, and the total rent/sale value
             *
             */

            $id = Auth::user()->id;
            if (Leaderboard::with('leaderboard', 'leader_detail')->where('agent_id', $id)->first())
            {
                $leaderboard_data = Leaderboard::with('leaderboard', 'leader_detail')->where('agent_id', $id)->get();
            // details of last month
            $leader_detail = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereMonth('created_at', '=', Carbon::now()->subMonth()->month)->get();

            // Get total number of contracts made
            $leader_detail_count = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereYear('created_at', date('2023'))->count();
            $this->data['leader_detail_count']= $leader_detail_count;

            // Get all the contracts into a variable
            $leader_detail_all = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->get();
            $this->data['leader_detail_all'] = $leader_detail_all;


            $array_2 = array();
            $total_net_commission = null;
            foreach($leader_detail as $detail)
            {
                // array_push($array_2, $detail->net_commission);
                $total_net_commission = $total_net_commission + $detail->net_commission;
            }
            // dd($total_net_commission);
            $this->data['total_net_commission'] = $total_net_commission;





            /**
             * Get the difference betweent the last month and the one before
             * the last to get the rate of growth to display on dashboard
             *
             */
            $leaderboard_data = Leaderboard::with('leaderboard', 'leader_detail')->where('agent_id', $id)->get();
            // $agent_leader_details = Users::with('leaderboard', 'leader_detail')->where('id', $id)->get();
            // dd($leaderboard_data[0]->id);


            $start = carbon::now()->startOfMonth();
            $today = carbon::now();
            $diff = $start->diffInDays($today);
            // dd($diff);



            /**
             * total commission for entire year until current month
             */
            $leader_detail_result_1 = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereYear('created_at', date('2023'))->get();
            $total_net_commission_result_1 = null;
            if(!empty($leader_detail_result_1))
            {
                foreach($leader_detail_result_1 as $data)
                {
                    $total_net_commission_result_1 = $total_net_commission_result_1 + $data->net_commission;
                }
            }



            /**
             * total commission for entire year until month before last
             */
            $leader_detail_result_0 = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereBetween('created_at', [Carbon::now()->month(0), Carbon::now()->subMonth(2)])->get();
            $total_net_commission_result_0 = 0;
            foreach($leader_detail_result_0 as $data)
            {
                $total_net_commission_result_0 = $total_net_commission_result_0 + $data->net_commission;
            }


            /**
             * total commission for entire year until last month
             */
            $leader_detail_result_last_month = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereBetween('created_at', [Carbon::now()->month(0), Carbon::now()->subMonth(1)])->get();
            $total_net_commission_result_last_month = 0;
            foreach($leader_detail_result_last_month as $data)
            {
                $total_net_commission_result_last_month = $total_net_commission_result_last_month + $data->net_commission;
            }



            /**
             *  total commission for last month only
             */
            $leader_detail_result_2 = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereBetween('created_at', [Carbon::now()->subMonth(2), Carbon::now()->subMonth(1)])->get();
            // dd($leader_detail_result_2);
            $total_net_commission_result_2 = null;
            if(!empty($leader_detail_result_2))
            {
                foreach($leader_detail_result_2 as $data)
                {
                    $total_net_commission_result_2 = $total_net_commission_result_2 + $data->net_commission;
                }
            }



            /**
             * total commission for current month
             */
             if(Carbon::now()->year == 2023 && Carbon::now()->month == 01)
             {
                 $total_net_commission_result_3 = 0;
                 $total_net_commission_result_2 = 0;
             }
             else{
                 $leader_detail_result_3 = Leader_board_detail::where('leader_id', $leaderboard_data[0]->id)->whereBetween('created_at', [Carbon::now()->subMonth(1), Carbon::now()])->get();
                $total_net_commission_result_3 = null;
                if(!empty($leader_detail_result_3))
                {
                    foreach($leader_detail_result_3 as $data)
                    {
                        $total_net_commission_result_3 = $total_net_commission_result_3 + $data->net_commission;
                    }
                }
             }



            /**
             * Rate of Growth in Commission
             *
             */
            if($total_net_commission_result_1 != 0 && $total_net_commission_result_last_month != 0 && Carbon::now()->year != 2023 && Carbon::now()->month != 01)
            {
                $rog_commission_last_month = ($total_net_commission_result_2 / $total_net_commission_result_last_month) * 100;
                $rog_commission_this_month = ($total_net_commission_result_3 / $total_net_commission_result_1) * 100;
                $this->data['rog_commission_last_month'] = round($rog_commission_last_month, 2);
                $this->data['rog_commission_this_month'] = round($rog_commission_this_month, 2);
            }

            $this->data['total_net_commission_1'] = $total_net_commission_result_1;
            $this->data['total_net_commission_last_month'] = $total_net_commission_result_2;
            $this->data['total_net_commission_this_month'] = $total_net_commission_result_3;
            } else {

                $this->data['total_net_commission_1'] = 0;
                $this->data['total_net_commission'] = 0;
                $this->data['total_net_commission_last_month'] = 0;
                $this->data['leader_detail_count']= 0;
                $this->data['leader_detail_all'] = 0;
                $this->data['total_net_commission_this_month'] = 0;

            }



            // dd($total_net_commission_result_1, $total_net_commission_result_2, $total_net_commission_result_3, $rog_commission_last_month, $rog_commission_this_month);





            /**
             * Get lead update categories
             *
             */
            // campaign
                // campaign not contacted
                $lead_cat_camp_result_1 = Leads::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('lead_detail.lead_status','=',null)
                                ->orWhere('lead_detail.lead_status','=',5);
                            }
                        )->count();

                // campaign interested
                $lead_cat_camp_result_2 = Leads::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('lead_detail.lead_status','=',1);
                            }
                        )->count();

                // campaign not interested
                $lead_cat_camp_result_3 = Leads::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('lead_detail.lead_status','=',2);
                            }
                        )->count();

                // campaign no answer
                $lead_cat_camp_result_4 = Leads::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('lead_detail.lead_status','=',3);
                            }
                        )->count();

                // campaing contacted
                $lead_cat_camp_result_5 = Leads::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('lead_detail.lead_status','=',4);
                            }
                        )->count();
            // campaign


            // website
                // Website not contacted
                $lead_cat_web_result_1 = Website::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('website_lead_detail.lead_status','=',null)
                                ->orWhere('website_lead_detail.lead_status','=',5);
                            }
                        )->count();

                // website interested
                $lead_cat_web_result_2 = Website::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('website_lead_detail.lead_status','=',1);
                            }
                        )->count();

                // website not interested
                $lead_cat_web_result_3 = Website::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('website_lead_detail.lead_status','=',2);
                            }
                        )->count();

                // website no answer
                $lead_cat_web_result_4 = Website::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('website_lead_detail.lead_status','=',3);
                            }
                        )->count();

                // website contacted
                $lead_cat_web_result_5 = Website::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('website_lead_detail.lead_status','=',4);
                            }
                        )->count();
            // website


            // portal
                // portal not contacted
                $lead_cat_port_result_1 = Property_lead::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('portal_lead_detail.lead_status','=',null)
                                ->orWhere('portal_lead_detail.lead_status','=',5);
                            }
                        )->count();

                // portal interested
                $lead_cat_port_result_2 = Property_lead::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('portal_lead_detail.lead_status','=',1);
                            }
                        )->count();

                //portal not interested
                $lead_cat_port_result_3 = Property_lead::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('portal_lead_detail.lead_status','=',2);
                            }
                        )->count();

                // portal no answer
                $lead_cat_port_result_4 = Property_lead::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('portal_lead_detail.lead_status','=',3);
                            }
                        )->count();

                // portal contacted
                $lead_cat_port_result_5 = Property_lead::with('lead_detailss')->where( 'is_temporary' , 0 )->whereYear('created_at', Carbon::now()->year)->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereHas('lead_detailss',
                            function($query){
                                $query
                                ->where('portal_lead_detail.lead_status','=',4);
                            }
                        )->count();
            // portal

            // total cat not contaced
            $total_cat_not_contacted = $lead_cat_port_result_1 + $lead_cat_web_result_1 + $lead_cat_camp_result_1;

            // total cat interested
            $total_cat_interested = $lead_cat_port_result_2 + $lead_cat_web_result_2 + $lead_cat_camp_result_2;

            // total cat not interested
            $total_cat_not_interested = $lead_cat_port_result_3 + $lead_cat_web_result_3 + $lead_cat_camp_result_3;

            // total cat no answer
            $total_cat_no_answer = $lead_cat_port_result_4 + $lead_cat_web_result_4 + $lead_cat_camp_result_4;

            // total cat contaced
            $total_cat_contacted = $lead_cat_port_result_5 + $lead_cat_web_result_5 + $lead_cat_camp_result_5;

            // dd($total_cat_not_contacted, $total_cat_interested, $total_cat_not_interested, $total_cat_no_answer, $total_cat_contacted);






            /**
             * Total leads
             */
            $total_leads_property_l = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $total_leads_website_l = Website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $total_leads_campaign_l = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where('agent_id', Auth::user()->id)
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->count();

            $total_all_leads_accumulated = $total_leads_property_l + $total_leads_website_l + $total_leads_campaign_l;


            $this->data['total_cat_not_contacted'] = $total_cat_not_contacted;
            $this->data['total_cat_interested'] = $total_cat_interested;
            $this->data['total_cat_not_interested'] = $total_cat_not_interested;
            $this->data['total_cat_no_answer'] = $total_cat_no_answer;
            $this->data['total_leads_property_l'] = $total_leads_property_l;
            $this->data['total_cat_contacted'] = $total_cat_contacted;
            $this->data['total_leads_website_l'] = $total_leads_website_l;
            $this->data['total_leads_campaign_l'] = $total_leads_campaign_l;
            $this->data['total_all_leads_accumulated'] = $total_all_leads_accumulated;

            // dd($total_all_leads_accumulated, $total_cat_not_contacted, $total_cat_interested, $total_cat_not_interested, $total_cat_no_answer, $total_cat_contacted);







            /**
             *
             * All Leads for the year 2023
             *
             */
            // a count to loop through 12 months in a year
            $count = 0;

            // each lead count per month will be pushed into
            // arrays with respect to the months as indexes
            $campaign_obj_1 = array();
            $portal_obj_2 = array();
            $website_obj_3 = array();

            $campaign_leads_pre = [];
            $portal_leads_pre = [];
            $website_leads_pre = [];

            // grab the sum of all the leads per annum
            $campaign_total = 0;
            $portal_total = 0;
            $website_total = 0;

            while($count <= 11)
            {
                try {
                    $result1 = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $count_c = $count + 1;
                $campaign_obj_1[$count_c] = $result1;
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $portal_obj_2[$count_c] = $result2;
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;

                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $website_obj_3[$count_c] = $result3;
                $website_leads_pre[$count] = $result3;
                $website_total = $website_total + $result3;

                } catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                    return view('home', $this->data);
                }
                $count = $count + 1;
            }




            $campaign_leads = [];
                    foreach ($campaign_obj_1 as $lead)
                    {
                        // if ($lead != 0)
                        // {
                            array_push($campaign_leads, $lead);
                        // }

                    }
                    // dd($campaign_leads);

                    $portal_leads = [];
                    foreach ($portal_obj_2 as $lead)
                    {
                        // if ($lead != 0)
                        // {
                            array_push($portal_leads, $lead);
                        // }
                    }

                    $website_leads = [];
                    foreach ($website_obj_3 as $lead)
                    {
                        // if ($lead != 0)
                        // {
                            array_push($website_leads, $lead);
                        // }
                    }



            /**
             * Get highest value in arrays
             */
            $cHigh = 0;
            $pHigh = 0;
            $wHigh = 0;
            if (!empty($campaign_leads))
            {
                $cHigh = max($campaign_leads);
            }

            if (!empty($portal_leads))
            {
                $pHigh = max($portal_leads);
            }

            if (!empty($website_leads))
            {
                $wHigh = max($website_leads);
            }

            $max = 0;
            if ($cHigh > $pHigh)
            {
                if ($cHigh > $wHigh)
                {
                    $max = $cHigh;
                }
                else {
                    $max = $wHigh;
                }
            }
            else {
                if ($pHigh > $wHigh)
                {
                    $max = $pHigh;
                }
                else {
                    $max = $wHigh;
                }
            }
            $this->data['max'] = $max;




            /**
             *
             * leads for last year
             *
             */
            $count = 0;
            $cLast_year = 0;
            $pLast_year = 0;
            $wLast_year = 0;
            while($count <= 11)
            {
                $result1 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();

                $result2 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();

                $result3 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', Carbon::now()->year)
                    ->count();

                $cLast_year = $cLast_year + $result1;
                $pLast_year = $pLast_year + $result2;
                $wLast_year = $wLast_year + $result3;
                $count = $count + 1;
            }

            $total_leads_2021 = ($cLast_year + $pLast_year + $wLast_year);
            $total_leads_2022 = ($campaign_total + $portal_total + $website_total);





            /**
             *
             * Rate of Growth
             *
             */
            if($total_leads_2021 != 0)
            {
                $rog = (($total_leads_2022 )/$total_leads_2021) * 100;
                $this->data['rog'] = round($rog, 2);

            }




            $this->data['campaign_leads'] = $campaign_leads;
            $this->data['portal_leads'] = $portal_leads;
            $this->data['website_leads'] = $website_leads;

            $this->data['campaign_total'] = $campaign_total;
            $this->data['property_total'] = $portal_total;
            $this->data['website_total'] = $website_total;

            $this->data['total_leads'] = ($campaign_total + $portal_total + $website_total);
            $this->data['total_leads_2021'] = ($cLast_year + $pLast_year + $wLast_year);




            $leads_data = Leads::with(['users','lead_typess'])->where( 'is_recycle' , '0' )->where( 'agent_id' , $id )->selectRaw('year(created_at) as year, monthname(created_at) as month, count(id) as total_leads')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();


            // $leads_data_set_1 = Leads::with(['users','lead_typess'])->where( 'is_recycle' , '0' )->where( 'agent_id' , $id )->pluck('created_at')->format('Y-m-d') ;
            // dd($leads_data_set_1);

            $campaigns_data = Property_lead::with(['users','lead_detailss'])->where( 'is_recycle' , '0' )->where( 'agent_id' , $id )->selectRaw('year(created_at) as year, monthname(created_at) as month, count(id) as total_leads')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();

            $websites_data = Website::with(['users','lead_detailss'])->where( 'is_recycle' , '0' )->where( 'agent_id' , $id )->selectRaw('year(created_at) as year, monthname(created_at) as month, count(id) as total_leads')
                ->groupBy('year','month')
                ->orderByRaw('min(created_at) desc')
                ->get();

            // dd(($websites_data->isEmpty()) ? 0 : $websites_data[0]->total_leads);

            $total_lead_count = (($leads_data->isEmpty()) ? 0 : $leads_data[0]->total_leads) + (($campaigns_data->isEmpty()) ? 0 : $campaigns_data[0]->total_leads) + (($websites_data->isEmpty()) ? 0 : $websites_data[0]->total_leads);
            // dd($total_lead_count);
            // $total_lead_count = $leads_data[0]->total_leads + $campaigns_data[0]->total_leads + $websites_data[0]->total_leads;


            $this->data['leads_data'] = $leads_data;
            $this->data['campaigns_data'] = $campaigns_data;
            $this->data['total_lead_count'] = $total_lead_count;














        $var2 = Leaderboard::with('leader_detail')->where('agent_id', $id)->where('status', 1)->whereYear('created_at', Carbon::now()->year)->get();

        $var3 = Leaderboard::where('agent_id', $id)->whereYear('created_at', Carbon::now()->year)->get();

        $var4 = Leader_board_detail::where('is_trash', null)->orderBy('created_at', 'desc')->whereYear('created_at', Carbon::now()->year)->get();

        $var5 = [];

        foreach($var4 as $data)
        {
            if( !$var3->isEmpty() )
            {
                if($data->leader_id == $var3[0]->id)
                {
                    array_push($var5, $data);
                }
            }
            else{
                $this->data['no_leaderboard'] = 1;
                break;
                // return Redirect::view('/statistics/leads-vs-income')->with('error', "There are no transactions found for the selected agent");
            }
        }


        $count = 1;
        $var6 = [ 1 => 0, 2 => 1, 3 => 2, 4 =>3, 5 =>4, 6=>5, 7=>6, 8=>7, 9=>8, 10=>9, 11=>10, 12=>11];
        $var8 = 0;
        $var9 = 0;
        $var10 = 0;
        $var11 = 0;

        $date = Carbon::now();
        $year = 2023;

        while($count <=11 )
        {
            try {
                $var7 = 0;

                foreach($var5 as $data)
                {
                    $month = 0 + $data->created_at->format('m');

                    if($month == $count && $data->created_at->format('y') == Carbon::now()->year)
                    {
                        // Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('net_commission');
                        $var7 = $var7 + $data->net_commission;
                        $var9 = $var9 + $data->sale_value;
                        $var10 = $var10 + $data->rent_value;
                    }
                }
                $var8 = $var8 + $var7;

                $var6[$count] = $var7;

            }  catch (\Exception $e) {
                break;
                // return Redirect::to('error')->with('error','Could not deliver request. Please contact developer');
            }

            $count = $count + 1;

        }
        // dd($var6);

        $var11 = $var9 + $var10;


        // dd($var6);

        $var12 = [];

        foreach($var6 as $data)
        {
            array_push($var12, $data);
        }
        // dd($var6);




        /**
         *  Get all agents into variable
         */
        $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();


        $this->data['var12'] = $var12;

        $this->data['var8'] = $var8;

        $this->data['var9'] = $var9;

        $this->data['var10'] = $var10;

        $this->data['var11'] = $var11;








        /**
             *
             * All Leads for the year 2022
             *
             */
            // a count to loop through 12 months in a year
            $count = 0;

            // each lead count per month will be pushed into
            // arrays with respect to the months as indexes


            $campaign_leads_pre = [];
            $portal_leads_pre = [];
            $website_leads_pre = [];
            $total_income_pre = [];
            $total_leads_pre = [];
            $total_net_commission_pre = [];

            // grab the sum of all the leads per annum
            $campaign_total = 0;
            $portal_total = 0;
            $website_total = 0;

            $total_revenue = 0;
            $total_net_commission = 0;
            $total_leads_result = 0;
            $total_sales = 0;
            $total_rent = 0;
            $total_leads_final = 0;
            $total_commission_variable = 0;

            $date = Carbon::now();
            $year = $date->year;

            while($count <= 11)
            {
                try {
                    $result1 = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;


                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    // ->whereDate('created_at', '>', date('2022-12-17'))
                    ->count();
                $website_leads_pre[$count] = $result3;
                $website_total = $website_total + $result3;


                $total_leads_result = $result1 + $result2 + $result3;
                $total_leads_pre[$count] = $total_leads_result;

                $total_leads_final = $total_leads_final + $result1 + $result2 + $result3;

                } catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';
                }


                try {
                    $total_sale_value_company = Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('sale_value');

                    $total_rent_value_company = Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('rent_value');

                    $total_income = $total_sale_value_company + $total_rent_value_company;

                    $total_revenue = $total_revenue + $total_income;

                    $total_sales = $total_sales + $total_sale_value_company;

                    $total_rent = $total_rent + $total_rent_value_company;

                    $total_income_pre[$count] = $total_income;


                } catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';

                    return view('home', $this->data);
                }

                $this->data['total_sales'] = $total_sales;

                $this->data['total_rent'] = $total_rent;



                try {
                    $total_net_commission_company = Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('net_commission');

                    $total_net_commission = $total_net_commission + $total_net_commission_company;

                    $total_commission_variable = 0 + $total_net_commission_company;

                    $total_net_commission_pre[$count] = $total_commission_variable;

                }catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';

                    return view('home', $this->data);
                }


                $count = $count + 1;
            }


                // dd($total_income_pre);



            $campaign_leads = [];
            foreach ($campaign_leads_pre as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($campaign_leads, $lead);
                // }

            }

            $portal_leads = [];
            foreach ($portal_leads_pre as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($portal_leads, $lead);
                // }
            }

            $website_leads = [];
            foreach ($website_leads_pre as $lead)
            {
                // if ($lead != 0)
                // {
                    array_push($website_leads, $lead);
                // }
            }


            $total_leads_overall = [];
            foreach ($total_leads_pre as $data)
            {
                array_push($total_leads_overall, $data);
            }


            $total_income_company = [];
            foreach ($total_income_pre as $data)
            {
                array_push($total_income_company, $data);
            }



            $total_net_commission_company2 = [];
            foreach ($total_net_commission_pre as $data)
            {
                array_push($total_net_commission_company2, $data);
            }




            /**
             * Get leaderboard details based on time
             */

            $count = 0;

            $leaderboard_var1 = 0;
            $total_var1 = 0;
            $leaderboard_var2 = [];
            $date = Carbon::now();
            $year = $date->year;


            try {
                // $leaderboard_var1 = Leader_board_detail::with('leader_details')->where('is_trash', null)->whereYear('created_at', date($year))->get();


                $leader_board_v1 = Leaderboard::where('agent_id', $id )->first();

                $leader_detail_v2 = Leader_board_detail::where('is_trash', '!=', 1)->orWhereNull('is_trash')->where(  'leader_id' , $leader_board_v1->id )->orderby('id' , 'DESC')->get();

                $leader_net_commision_v3 = Leader_board_detail::where('leader_id', $leader_board_v1->id)->sum('net_commission');

                $this->data['leader_net_commision'] = $leader_net_commision_v3;

                $this->data['leader_board'] = $leader_board_v1;

                $this->data['leaderboard_var1'] = $leader_detail_v2;

                $this->data['user_id'] = $id;


            } catch (\Exception $e) {
                $this->data['error'] = $e->getMessage();
                $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';
            }



            /**
             *
             * Get highest value in arrays
             *
             */
            $cHigh = max($var6);
            $lHigh = max($total_leads_overall);
            $this->data['max'] = $cHigh;
            $this->data['max_l'] = $lHigh;



            /**
             *  Get all agents into variable
             */
            $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();

            $agent_name = Users::where('id', $id)->get();

            $this->data['agent_name'] = $agent_name[0];



            /**
             *  arrays
             */
            // $this->data['leaderboard_var1'] = $leaderboard_var1->reverse()->take(10);

            $this->data['total_net_commission_company2'] = $total_net_commission_company2;

            $this->data['total_income_company'] = $total_income_company;

            $this->data['total_leads_overall'] = $total_leads_overall;


            /**
             *
             */
            $this->data['users'] = $users;

            $this->data['total_net_commission'] = $total_net_commission;

            $this->data['total_sales_and_rent'] = $total_revenue;

            $this->data['total_leads_final'] = $total_leads_final;

            $this->data['campaign_total'] = $campaign_total;

            $this->data['portal_total'] = $portal_total;

            $this->data['website_total'] = $website_total;










        }



        $campaigns = Campaign::where('status' , '1' )->get();

        $campaingsCount = $campaigns->count();

        $target_data = Users::where('id', $id)->get();


        $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
        ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
        ->where('leader_board.status',1)
        ->where('is_trash', null)
        ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
        ->groupBy('leader_id', 'leader_board.id')
        ->orderby('totalcommission' , 'DESC')
        ->get();





        $this->data['campagins'] = $campaigns;

        $this->data['campaingsCount'] = $campaingsCount;

        $this->data['leads'] = $leads;

        $this->data['leadCount'] = $leadCount;

        $this->data['announcement'] = $announcement;

        $this->data['property_leads'] = $property_leads;

        $this->data['website'] = $website;

        $this->data['target'] = $target_data;


        // $this->data['ctoast'] = 0;
        // $this->data['ptoast'] = 1;
        // $this->data['wtoast'] = 1;




        return view('home', $this->data );
    }















    public function profile()
    {

        $userid = auth()->user()->id;

        $user = Users::where('id', $userid)->first();

        $this->data['users'] = $user;



        return view('users.profile' , $this->data);
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




    public function clearNotifications()
    {
        $user_id1 = Auth::user()->id;

        $user = Users::find($user_id1);

        $this->data['noti'] = null;

        foreach ($user->unreadNotifications as $notification) {

           $notification->markAsRead();

        }

        return Redirect::back();
    }
}
