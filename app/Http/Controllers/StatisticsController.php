<?php

namespace App\Http\Controllers;

use App\Models\Models\Campaign_agent;
use Illuminate\Support\Facades\DB;
use App\Models\Models\Campaign;
use App\Models\Models\Lead_details;
use App\Models\Models\Leads;
use App\Models\Models\Leads_type;
use App\Models\Models\Lead_status_type;
use App\Models\Models\Leader_board_detail;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use App\Imports\LeadImport;
use App\Models\Models\Property_portals;
use App\Models\Models\Portal_lead_detail;
use App\Models\Models\Website_lead_detail;
use App\Models\Models\Leaderboard;
use App\Models\Models\Property_lead;
use App\Models\Models\Website;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use PhpParser\Node\Stmt\If_;

use function PHPUnit\Framework\isEmpty;

class StatisticsController extends Controller
{

    public function __construct()
    {

        $this->middleware('auth')->except('temporary_update');
    }

    public function index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;


        $this->data['agents'] = Users::where('status','1')->where('user_type', '2')->get();



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

            // grab the sum of all the leads per annum
            $campaign_total = 0;
            $portal_total = 0;
            $website_total = 0;
            $total_revenue = 0;

            $date = Carbon::now();
            $year = $date->year;

            while($count <= 11)
            {
                try {
                    $result1 = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;

                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $website_leads_pre[$count] = $result3;
                $website_total = $website_total + $result3;

                } catch (\Exception $e) {
                    $this->data['error'] = $e->getMessage();
                    $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                }





                try {
                    $total_sale_value_company = Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('sale_value');
                    $total_rent_value_company = Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('rent_value');

                    $total_income = $total_sale_value_company + $total_rent_value_company;
                    $total_revenue = $total_revenue + $total_income;
                    $total_income_pre[$count] = $total_income;

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

            $total_income_company = [];
            foreach ($total_income_pre as $data)
            {
                array_push($total_income_company, $data);
            }

            // dd($total_income_company);




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
                    ->whereYear('created_at', date('2021'))
                    ->count();

                $result2 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date('2021'))
                    ->count();

                $result3 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date('2021'))
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
            $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







            // dd($total_income_company[0]->totalcommission);

            $total_income_company = Leader_board_detail::sum('net_commission');

            // dd($total_income_distribution_company);













            $this->data['campaign_leads'] = $campaign_leads;
            $this->data['portal_leads'] = $portal_leads;
            $this->data['website_leads'] = $website_leads;

            $this->data['campaign_total'] = $campaign_total;
            $this->data['property_total'] = $portal_total;
            $this->data['website_total'] = $website_total;

            $this->data['total_leads'] = ($campaign_total + $portal_total + $website_total);
            $this->data['total_leads_2021'] = ($cLast_year + $pLast_year + $wLast_year);

            $this->data['rog'] = round($rog, 2);



        return view('stats.show', $this->data);
    }










    public function monthly_ranking_index()
    {
        /**
         *
         * Monthly Ranking Section
         *
         */

        $month = Carbon::now()->subMonth();
        $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
        ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
        ->where('leader_board.status', 1)
        ->groupBy('leader_id', 'leader_board.id')
        ->orderby('totalcommission' , 'DESC')
        // ->whereMonth('created_at', date(-1))
        ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
        ->whereYear('leader_board_detail.created_at', Carbon::now()->year)
        ->get();




        $data = [];
        // dd($leader_board);

        // if (is_array($leader_board) )
        // {

        // }
        // else{

        // }
        foreach($leader_board as $row) {
            $data['label'][] = $row->name;
            $data['data'][] = (int) $row->totalcommission;
        }


        $this->data['chart_data'] = json_encode($data);


        $this->data['leader_board'] = $leader_board;


        $this->data['month'] = Carbon::now()->month;

        $stats = $this->index();
        // dd($stats->rog);

        $this->data['rog'] = $stats->rog;

        // dd($leader_board);

        // dd($this->data);
        return view('stats.monthly_ranking_search', $this->data);

    }













    public function monthly_ranking_by_month(Request $request)
    {


        if ($request->month == '') {

            $month = Carbon::now()->month;

        }

        else

        {

            $month = $request->month;

        }



        $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
        ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
        ->where('leader_board.status', 1)
        ->groupBy('leader_id', 'leader_board.id')
        ->orderby('totalcommission', 'DESC')
        ->whereMonth('leader_board_detail.created_at', $month)
        ->get();


        $data = [];

        foreach ($leader_board as $row) {
            $data['label'][] = $row->name;
            $data['data'][] = (int) $row->totalcommission;
        }

        $this->data['chart_data'] = json_encode($data);
        // dd($leader_board);
        // $this->data['table_data'] = $data;

        $this->data['month'] = $month;

        $this->data['leader_board'] = $leader_board;

        $stats = $this->index();
        // dd($stats->rog);

        $this->data['rog'] = $stats->rog;


        return view('stats.monthly_ranking_search', $this->data);
    }












    /**
     *
     *Lead Source Ranking
     *
     */
    public function lead_source_index()
    {
        $month = Carbon::now()->month;

        // $result = Leader_board_detail::selectRaw('lead_source AS ValueFrequecy')
        // ->groupBy('lead_source')
        // ->orderBy('ValueFrequecy', 'DESC')
        // ->whereMonth('leader_board_detail.created_at', $month)
        // ->get();


        $leader_board = Leader_board_detail::select('lead_source', 'net_commission')
        ->where('lead_source', '!=', 'null')
        ->selectRaw('COUNT(*) AS count')
        ->groupBy('lead_source')
        ->orderByDesc('count')
        ->whereMonth('leader_board_detail.created_at', $month)
        ->get();

        // dd($leader_board);
        // select lead_source,COUNT(lead_source) AS ValueFrequency from leader_board_detail group by lead_source order by ValueFrequency DESC
        // dd($leader_board);


        $data_0 = [];
        $data_2 = [];
        foreach ($leader_board as $row) {
            $data_0['label'][] = $row->lead_source;
            array_push($data_2, $row->lead_source);
            $data_0['data'][] = (int) $row->count;
        }


        $data_3 = [];
        foreach($data_2 as $data)
        {
            $leader_board_2 = Leader_board_detail::with('leader_details')->where('lead_source', $data)->whereMonth('created_at', $month)->get();

            $total_comm = 0;

            foreach($leader_board_2 as $value)
            {
                $total_comm = $total_comm + $value->net_commission;
            }

            array_push($data_3, $total_comm);
        }

        $this->data['net_commission'] = $data_3;

        $this->data['chart_data'] = json_encode($data_0);

        $this->data['month'] = $month;

        $this->data['leader_board'] = $leader_board;

        $stats = $this->index();

        $this->data['rog'] = $stats->rog;



        return view('stats.lead_source_ranking', $this->data);
    }










    /**
     *
     * Lead Source Search by Month
     *
     */
    public function lead_source_search(Request $request)
    {
        if ($request->month == '') {

            $month = Carbon::now()->month;

        }

        else

        {

            $month = $request->month;

        }



        $leader_board = Leader_board_detail::select('lead_source')
        ->where('lead_source', '!=', 'null')
        ->selectRaw('COUNT(*) AS count')
        ->groupBy('lead_source')
        ->orderByDesc('count')
        ->whereMonth('leader_board_detail.created_at', $month)
        ->get();

        // dd($leader_board);


        $data_0 = [];
        $data_2 = [];
        $total_commission = 0;

        foreach ($leader_board as $row) {
            $data_0['label'][] = $row->lead_source;
            array_push($data_2, $row->lead_source);
            $data_0['data'][] = (int) $row->count;
        }


        $data_3 = [];
        foreach($data_2 as $data)
        {
            $leader_board_2 = Leader_board_detail::with('leader_details')->where('lead_source', $data)->whereMonth('created_at', $month)->get();
            // dd($leader_board_2);

            $total_comm = 0;

            foreach($leader_board_2 as $value)
            {
                $total_comm = $total_comm + $value->net_commission;
            }

            array_push($data_3, $total_comm);
        }


        $this->data['net_commission'] = $data_3;

        $this->data['chart_data'] = json_encode($data_0);

        $this->data['month'] = $month;

        $this->data['leader_board'] = $leader_board;

        $stats = $this->index();

        $this->data['rog'] = $stats->rog;

        return view('stats.lead_source_ranking', $this->data);
    }






    public function leader_detail_sources($source, $month)
    {
        $leader_board = Leader_board_detail::with('leader_details')->where('lead_source', $source)->whereMonth('created_at', $month)->get();

        $all_leaders = Leaderboard::all();

        $this->data['leader_board'] = $leader_board;

        $this->data['all_leaders'] = $all_leaders;

        return view('stats.lead_source_details', $this->data);
    }















    /**
     *
     * Search statistics
     *
     */
    public function search(Request $request)
    {
        $this->data['agents'] = Users::where('status','1')->where('user_type', '2')->get();



        $campaign_leads_pre = [];
        $portal_leads_pre = [];
        $website_leads_pre = [];

        $campaign_leads = [];
        $portal_leads = [];
        $website_leads = [];

        $campaign_total = 0;
        $portal_total = 0;
        $website_total = 0;

        if($request->lead_type !=   null){


            if ($request->lead_type == '1')
            {

                if (!empty($request->agent))
                {
                    $id = $request->agent;
                    /**
                     *
                     * All Leads for the year 2022
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
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $count_c = $count + 1;
                        $campaign_obj_1[$count_c] = $result1;
                        $campaign_leads_pre[$count] = $result1;
                        $campaign_total = $campaign_total + $result1;


                        $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $portal_obj_2[$count_c] = $result2;
                        $portal_leads_pre[$count] = $result2;
                        $portal_total = $portal_total + $result2;

                        $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $website_obj_3[$count_c] = $result3;
                        $website_leads_pre[$count] = $result3;
                        $website_total = $website_total + $result3;

                        } catch (\Exception $e) {
                            $this->data['error'] = $e->getMessage();
                            $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                            return view('home', $this->data );
                        }

                        $count = $count + 1;
                    }

                        // dd($campaign_obj_1, $website_obj_3, $portal_obj_2);





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
                     *
                     * Get highest value in arrays
                     *
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
                    // $cHigh = max($campaign_leads);
                    // $pHigh = max($);
                    // $wHigh = max($website_leads);
                    $maxy = 0;
                    if ($cHigh > $pHigh)
                    {
                        if ($cHigh > $wHigh)
                        {
                            $maxy = $cHigh;
                        }
                        else {
                            $maxy = $wHigh;
                        }
                    }
                    else {
                        if ($pHigh > $wHigh)
                        {
                            $maxy = $pHigh;
                        }
                        else {
                            $maxy = $wHigh;
                        }
                    }
                    $this->data['max'] = $maxy;




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
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $result2 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $result3 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
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
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







                    $this->data['campaign_leads'] = $campaign_leads;
                    $this->data['portal_leads'] = $portal_leads;
                    $this->data['website_leads'] = $website_leads;

                    $this->data['campaign_obj_1'] = $campaign_obj_1;
                    $this->data['portal_obj_2'] = $portal_obj_2;
                    $this->data['website_obj_3'] = $website_obj_3;


                    $this->data['campaign_total'] = $campaign_total;
                    $this->data['property_total'] = $portal_total;
                    $this->data['website_total'] = $website_total;

                    $this->data['total_leads'] = ($campaign_total + $portal_total + $website_total);
                    $this->data['total_leads_2021'] = ($cLast_year + $pLast_year + $wLast_year);

                    $this->data['rog'] = round($rog, 2);
                    $search = true;
                    $this->data['search'] = $search;
                    $this->data['max'] = $maxy;
                    $this->data['request'] = $request;
                    $agent_details = Users::find($request->agent);
                    $this->data['agent_name'] = $agent_details->name;

                    return view('stats.show', $this->data);
                }
                else
                {
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

                    // grab the sum of all the leads per annum
                    $campaign_total = 0;
                    $portal_total = 0;
                    $website_total = 0;

                    while($count <= 11)
                    {
                        try {
                            $result1 = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $campaign_leads_pre[$count] = $result1;
                        $campaign_total = $campaign_total + $result1;


                        $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $portal_leads_pre[$count] = $result2;
                        $portal_total = $portal_total + $result2;

                        $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $website_leads_pre[$count] = $result3;
                        $website_total = $website_total + $result3;

                        } catch (\Exception $e) {
                            $this->data['error'] = $e->getMessage();
                            $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                            return view('home', $this->data );
                        }

                        $count = $count + 1;
                    }




                    $campaign_leads = [];
                    foreach ($campaign_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($campaign_leads, $lead);
                        }

                    }

                    $portal_leads = [];
                    foreach ($portal_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($portal_leads, $lead);
                        }
                    }

                    $website_leads = [];
                    foreach ($website_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($website_leads, $lead);
                        }
                    }



                    /**
                     *
                     * Get highest value in arrays
                     *
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
                    // $cHigh = max($campaign_leads);
                    // $pHigh = max($);
                    // $wHigh = max($website_leads);
                    $maxy = 0;
                    if ($cHigh > $pHigh)
                    {
                        if ($cHigh > $wHigh)
                        {
                            $maxy = $cHigh;
                        }
                        else {
                            $maxy = $wHigh;
                        }
                    }
                    else {
                        if ($pHigh > $wHigh)
                        {
                            $maxy = $pHigh;
                        }
                        else {
                            $maxy = $wHigh;
                        }
                    }
                    $this->data['max'] = $maxy;




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
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $result2 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $result3 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
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
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







                    $this->data['campaign_leads'] = $campaign_leads;
                    $this->data['portal_leads'] = $portal_leads;
                    $this->data['website_leads'] = $website_leads;

                    $this->data['campaign_total'] = $campaign_total;
                    $this->data['property_total'] = $portal_total;
                    $this->data['website_total'] = $website_total;

                    $this->data['total_leads'] = ($campaign_total + $portal_total + $website_total);
                    $this->data['total_leads_2021'] = ($cLast_year + $pLast_year + $wLast_year);

                    $this->data['rog'] = round($rog, 2);

                    $search = true;
                    $this->data['search'] = $search;
                    $this->data['max'] = $maxy;
                    $this->data['request'] = $request;
                    return view('stats.show', $this->data);
                }

            }


            elseif ($request->lead_type == '2')
            {
                if (!empty($request->agent))
                {
                    $id = $request->agent;
                    $agent = Users::where('user_type','2')->where('id', $id)->get();


                    /**
                     *
                     * All Leads for the year 2022 by agent
                     *
                     */
                    // a count to loop through 12 months in a year
                    $count = 0;

                    // each lead count per month will be pushed into
                    // arrays with respect to the months as indexes
                    $campaign_leads_pre = [];

                    // grab the sum of all the leads per annum
                    $campaign_total = 0;

                    while($count <= 11)
                    {
                        try {
                            $result1 = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $campaign_leads_pre[$count] = $result1;
                        $campaign_total = $campaign_total + $result1;

                        } catch (\Exception $e) {
                            $this->data['error'] = $e->getMessage();
                            $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                            return view('home', $this->data );
                        }

                        $count = $count + 1;
                    }




                    $campaign_leads = [];
                    foreach ($campaign_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($campaign_leads, $lead);
                        }

                    }



                    /**
                     *
                     * Get highest value in arrays
                     *
                     */
                    $cHigh = 0;
                    if (!empty($campaign_leads)) {
                        $cHigh = max($campaign_leads);
                    }

                    $this->data['max'] = $cHigh;
                    // dd($max);




                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $cLast_year = 0;
                    while($count <= 11)
                    {
                        $result1 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $cLast_year = $cLast_year + $result1;
                        $count = $count + 1;
                    }

                    $total_leads_2021 = ($cLast_year);
                    $total_leads_2022 = ($campaign_total);





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







                    $this->data['campaign_leads'] = $campaign_leads;

                    $this->data['campaign_total'] = $campaign_total;

                    $this->data['total_leads'] = ($campaign_total);
                    $this->data['total_leads_2021'] = ($cLast_year );

                    $this->data['rog'] = round($rog, 2);

                }
                else
                {
                    $count = 0;
                    while ($count <= 11) {
                        $result1 = Leads::where('is_temporary', 0)->where('is_closed', 0)
                        ->where('is_trash', 0)->where('is_recycle', 0)
                        ->whereMonth('created_at', date($count+1))
                        ->whereYear('created_at', date('2022'))
                        ->count();
                        $campaign_leads_pre[$count] = $result1;
                        $campaign_total = $campaign_total + $result1;
                        $count++;
                    }

                    foreach ($campaign_leads_pre as $lead) {
                        if ($lead != 0) {
                            array_push($campaign_leads, $lead);
                        }
                    }



                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $Last_year = 0;
                    while($count <= 11)
                    {
                        $result = Leads::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $Last_year = $Last_year + $result;
                        $count = $count + 1;
                    }


                    $total_leads_2021 = ($Last_year);
                    $total_leads_2022 = ($campaign_total);





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;


                    $this->data['total_leads_2021'] = ($Last_year);
                    $this->data['total_leads'] = $campaign_total;
                    $this->data['campaign_total'] = $campaign_total;

                    $this->data['rog'] = round($rog, 2);
                }
            }



            elseif ($request->lead_type == '3')
            {
                if(!empty($request->agent))
                {
                    $id = $request->agent;
                    $agent = Users::where('user_type','2')->where('id', $id)->get();


                    /**
                     *
                     * All Leads for the year 2022 by agent
                     *
                     */
                    // a count to loop through 12 months in a year
                    $count = 0;

                    // each lead count per month will be pushed into
                    // arrays with respect to the months as indexes
                    $leads_pre = [];

                    // grab the sum of all the leads per annum
                    $total = 0;

                    while($count <= 11)
                    {
                        try {
                        $result = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $leads_pre[$count] = $result;
                        $total = $total + $result;

                        } catch (\Exception $e) {
                            $this->data['error'] = $e->getMessage();
                            $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                            return view('home', $this->data );
                        }

                        $count = $count + 1;
                    }



                    $portal_leads = [];
                    foreach ($leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($portal_leads, $lead);
                        }
                    }



                    /**
                     *
                     * Get highest value in arrays
                     *
                     */
                    $high = 0;
                    if (!empty($leads)) {
                        $high = max($website_leads);
                    }

                    $this->data['max'] = $high;
                    // dd($max);




                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $last_year = 0;
                    while($count <= 11)
                    {
                        $result = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $last_year = $last_year + $result;
                        $count = $count + 1;
                    }

                    $total_leads_2021 = $last_year ;
                    $total_leads_2022 = $total;





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







                    $this->data['portal_leads'] = $portal_leads;

                    $this->data['property_total'] = $total;

                    $this->data['total_leads'] = $total;

                    $this->data['total_leads_2021'] = $total_leads_2021;

                    $this->data['rog'] = round($rog, 2);

                }
                else {
                    $count = 0;
                    while ($count<= 11) {
                        $result2 = Property_lead::where('is_temporary', 0)->where('is_closed', 0)
                        ->where('is_trash', 0)->where('is_recycle', 0)
                        ->whereMonth('created_at', date($count+1))
                        ->whereYear('created_at', date('2022'))
                        ->count();
                        $portal_leads_pre[$count] = $result2;
                        $portal_total = $portal_total + $result2;
                        $count++;
                    }
                    foreach ($portal_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($portal_leads, $lead);
                        }
                    }




                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $Last_year = 0;
                    while($count <= 11)
                    {
                        $result = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $Last_year = $Last_year + $result;
                        $count = $count + 1;
                    }


                    $total_leads_2021 = ($Last_year);
                    $total_leads_2022 = ($portal_total);





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;

                    $this->data['total_leads_2021'] = ($Last_year);
                    $this->data['total_leads'] = $portal_total;
                    $this->data['portal_total'] = $portal_total;

                    $this->data['rog'] = round($rog, 2);
                }

            }



            elseif ($request->lead_type == '4')
            {
                if(!empty($request->agent))
                {
                    $id = $request->agent;
                    $agent = Users::where('user_type','2')->where('id', $id)->get();


                    /**
                     *
                     * All Leads for the year 2022 by agent
                     *
                     */
                    // a count to loop through 12 months in a year
                    $count = 0;

                    // each lead count per month will be pushed into
                    // arrays with respect to the months as indexes
                    $leads_pre = [];

                    // grab the sum of all the leads per annum
                    $total = 0;

                    while($count <= 11)
                    {
                        try {


                        $result = Website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2022'))
                            ->count();
                        $leads_pre[$count] = $result;
                        $total = $total + $result;

                        } catch (\Exception $e) {
                            $this->data['error'] = $e->getMessage();
                            $this->data['error_msg'] = 'Oh! We encountered an error. Please contact the administrator.';

                            return view('home', $this->data );
                        }

                        $count = $count + 1;
                    }



                    $website_leads = [];
                    foreach ($leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($website_leads, $lead);
                        }
                    }



                    /**
                     *
                     * Get highest value in arrays
                     *
                     */
                    $high = 0;
                    if (!empty($leads)) {
                        $high = max($website_leads);
                    }

                    $this->data['max'] = $high;
                    // dd($max);




                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $last_year = 0;
                    while($count <= 11)
                    {
                        $result = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $id)
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $last_year = $last_year + $result;
                        $count = $count + 1;
                    }

                    $total_leads_2021 = ($last_year );
                    $total_leads_2022 = ($total);





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;







                    $this->data['portal_leads'] = $portal_leads;

                    $this->data['property_total'] = $total;

                    $this->data['total_leads'] = ($total);
                    $this->data['total_leads_2021'] = ($last_year);

                    $this->data['rog'] = round($rog, 2);





                } else {


                    $count = 0;
                    while ($count <= 11)
                    {
                        $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                        ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                        ->whereMonth('created_at', date($count+1))
                        ->whereYear('created_at', date('2022'))
                        ->count();
                        $website_leads_pre[$count] = $result3;
                        $website_total = $website_total + $result3;
                        $count++;
                    }

                    foreach ($website_leads_pre as $lead)
                    {
                        if ($lead != 0)
                        {
                            array_push($website_leads, $lead);
                        }
                    }



                    /**
                     *
                     * leads for last year
                     *
                     */
                    $count = 0;
                    $Last_year = 0;
                    while($count <= 11)
                    {
                        $result = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                            ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                            ->whereMonth('created_at', date($count+1))
                            ->whereYear('created_at', date('2021'))
                            ->count();

                        $Last_year = $Last_year + $result;
                        $count = $count + 1;
                    }


                    $total_leads_2021 = ($Last_year);
                    $total_leads_2022 = ($website_total);





                    /**
                     *
                     * Rate of Growth
                     *
                     */
                    $rog = $total_leads_2021 == 0 ? 0 : (($total_leads_2022 - $total_leads_2021) /$total_leads_2021) * 100;


                    $this->data['total_leads_2021'] = ($Last_year);
                    $this->data['total_leads'] = $website_total;
                    $this->data['website_total'] = $website_total;

                    $this->data['rog'] = round($rog, 2);
                }
            }
            // dd($campaign_leads);

            else{
                return $this->index();
            }





            if (!empty($campaign_leads))
            {
                $this->data['campaign_leads'] = $campaign_leads;
                $this->data['max'] = max($campaign_leads);
                $this->data['website_leads'] = [];
                $this->data['portal_leads'] = [];

            }
            elseif (!empty($portal_leads))
            {
                $this->data['portal_leads'] = $portal_leads;
                $this->data['max'] = max($portal_leads);
                $this->data['campaign_leads'] = [];
                $this->data['website_leads'] = [];
            }
            elseif (!empty($website_leads))
            {
                $this->data['website_leads'] = $website_leads;
                $this->data['max'] = max($website_leads);
                $this->data['campaign_leads'] = [];
                $this->data['portal_leads'] = [];
            }
            else
            {
                $this->data['website_leads'] = [];
                $this->data['portal_leads'] = [];
                $this->data['campaign_leads'] = [];
                $this->data['total_leads'] = 0;
            }

        }
        else
        {

            return $this->index();
        }
        $search = true;
        $this->data['search'] = $search;
        $this->data['request'] = $request;
        if (!empty($request->agent)) {
            $agent_details = Users::find($request->agent);
            $this->data['agent_name'] = $agent_details->name;
        }














        return view('stats.show', $this->data);


    }








    public function lead_vs_income()
    {
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
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;


                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
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
                $leaderboard_var1 = Leader_board_detail::with('leader_details')->where('is_trash', null)->whereYear('created_at', date($year))->get();


            } catch (\Exception $e) {
                $this->data['error'] = $e->getMessage();
                $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';

                return Redirect::to('/statistics/leads-vs-income', $this->data);
            }


            // dd($leaderboard_var1->reverse()->take(10));



            /**
             *  Get all agents into variable
             */
            $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();



            /**
             *  arrays
             */
            $this->data['leaderboard_var1'] = $leaderboard_var1->reverse()->take(10);

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


            // dd($total_net_commission_pre);



        return view('stats.lead_vs_income', $this->data);

    }






    public function lead_vs_income_search(Request $request)
    {
        $var2 = Leaderboard::with('leader_detail')->where('agent_id', $request->agent)->where('status', 1)->get();

        $var3 = Leaderboard::where('agent_id', $request->agent)->get();

        $var4 = Leader_board_detail::where('is_trash', null)->orderBy('created_at', 'desc')->get();

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
                return Redirect::to('/statistics/leads-vs-income')->with('error', "There are no transactions found for the selected agent");
            }
        }

        $count = 1;
        $var6 = [ 1 => 0, 2 => 1, 3 => 2, 4 =>3, 5 =>4, 6=>5, 7=>6, 8=>7, 9=>8, 10=>9, 11=>10, 12=>11];
        $var8 = 0;
        $var9 = 0;
        $var10 = 0;
        $var11 = 0;

        $date = Carbon::now();
        $year = $date->year;

        while($count <= 12 )
        {
            try {
                $var7 = 0;

                foreach($var5 as $data)
                {
                    $month = 0 + $data->created_at->format('m');
                    if($month == $count)
                    {
                        // Leader_board_detail::where('is_trash', null)->whereMonth('created_at', date($count+1))->whereYear('created_at', date($year))->sum('net_commission');
                        $var7 = $var7 + $data->net_commission;
                        $var9 = $var9 + $data->sale_value;
                        $var10 = $var10 + $data->rent_value;
                    }
                }
                $var8 = $var8 + $var7;

                // dd($var6[$count]);


                $var6[$count] = $var7;

            }  catch (\Exception $e) {
                return Redirect::to('/statistics/leads-vs-income')->with('error','Could not deliver request. Please contact developer');

            }

            $count = $count + 1;
        }

        $var12 = [];
        foreach($var6 as $data)
        {
            array_push($var12, $data);
        }


        $var11 = $var9 + $var10;



        /**
         *
         * Get highest value in arrays
         *
         */
        $cHigh = max($var6);
        $lHigh = max($this->lead_vs_income()->total_leads_overall);
        $this->data['max'] = $cHigh;
        $this->data['max_l'] = $lHigh;

        /**
         *  Get all agents into variable
         */
        $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();

        // dd($var6);
        $this->data['var12'] = $var12;

        $this->data['var8'] = $var8;

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
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $request->agent)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $request->agent)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;


                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('agent_id', $request->agent)
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
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
                $leaderboard_var1 = Leader_board_detail::with('leader_details')->where('is_trash', null)->whereYear('created_at', date($year))->get();


            } catch (\Exception $e) {
                $this->data['error'] = $e->getMessage();
                $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';

                return view('error', $this->data);
            }


            // dd($leaderboard_var1->reverse()->take(10));



            /**
             *  Get all agents into variable
             */
            $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();

            $agent_name = Users::where('id', $request->agent)->get();

            $this->data['agent_name'] = $agent_name[0];



            /**
             *  arrays
             */
            $this->data['leaderboard_var1'] = $leaderboard_var1->reverse()->take(10);

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


            // dd($total_net_commission_pre);


        // dd($total_net_commission_pre);



        return view('stats.lead_vs_income_agents', $this->data);
    }












    public function lead_vs_income_agents()
    {
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
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $campaign_leads_pre[$count] = $result1;
                $campaign_total = $campaign_total + $result1;


                $result2 = Property_lead::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
                    ->count();
                $portal_leads_pre[$count] = $result2;
                $portal_total = $portal_total + $result2;


                $result3 = website::where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )
                    ->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )
                    ->whereMonth('created_at', date($count+1))
                    ->whereYear('created_at', date($year))
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
                $leaderboard_var1 = Leader_board_detail::with('leader_details')->where('is_trash', null)->whereYear('created_at', date($year))->get();


            } catch (\Exception $e) {
                $this->data['error'] = $e->getMessage();
                $this->data['error_msg'] = 'Oh! We encountered an error in statistics index. Please contact the administrator.';

                return Redirect::to('/statistics/leads-vs-income', $this->data);
            }


            // dd($leaderboard_var1->reverse()->take(10));



            /**
             *  Get all agents into variable
             */
            $users = Users::where('user_type', 2)->where('status', 1)->orderBy('name')->get();



            /**
             *  arrays
             */
            $this->data['leaderboard_var1'] = $leaderboard_var1->reverse()->take(10);

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


            // dd($total_net_commission_pre);



        return view('stats.agent_statisitcs_view', $this->data);

    }













}
