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
use App\Models\Models\Property_portals;
use App\Models\Models\Property_lead;
use App\Models\Models\Portal_lead_detail;
use App\Models\Models\Website;
use App\Models\User;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;
use Illuminate\Notifications\Notification;
use App\Notifications\LeadAdded;


use Illuminate\Support\Collection;
use Illuminate\Pagination\LengthAwarePaginator;
class AllLeadsController extends Controller
{
    protected $ref_no = null;
    protected $ref = null;

    public function __construct()
    {

        $this->middleware('auth')->except('temporary_update');
        $this->middleware('auth')->except(['store_lead_api','temporary_update']);
        $this->middleware('auth')->except('temporary_update_portal');



        /**
         *  Scratch Pad
         */

        // $books = Book:join('authors', 'books.author_id', '=', 'authors.id')
        //     ->where('authors.name', 'Chrissy beatty')
        //     ->where('title', 'like', '%a%')
        //     ->pluck('title')
        //     ->dd();

        // $author = Author::where('authors.name', 'Chrissy Beatty')->first();
        // $books = $author->books()
        //     ->where('title', 'like', '%a%')
        //     ->pluck('title')
        //     ->dd();

        // Author::has('books', '>', 5)->get()->dd();

        // Author::has('books.ratings')->get()->dd();

        // Autho::whereHas('books', function ($query){
        //     $query->where('title', 'like', '%a%');
        // })->get()->dd();


    }












    public function index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();





        // ================================================================================================

                    // $table1 = Leads::select(
                    //     'ref_no as reference_num',
                    //     'full_name',
                    //     'email',
                    //     'phone',
                    //     'qualified_question',
                    //     'campaigns.campaign_name as campaign ',
                    //     // 'campaign_name',
                    //     // 'lead_status',
                    //     // 'lead_description',
                    //     // 'name',
                    //     // 'updated_at',
                    //     'created_at'
                    //     )->with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );
                    // $table2 = Property_lead::select(
                    //     'ref_no as reference_num',
                    //     'name as name',
                    //     'email as email',
                    //     'phone as phone',
                    //     'inquiry as inquiry',
                    //     'from as source_lead',
                    //     'created_at'
                    //     )->with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->union($table1)->latest()->paginate(30);

                    // dd($table2);

                    // $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->union($table1)->union($table2)->get();;
                    // $tables = union($table1)->union($table2)->latest()->paginate;

        // ================================================================================================
                    // $a = Leads::with(['users','lead_typess','campaigns','lead_detailss', ])
                    // ->join('campaign', 'leads')
                    // ->join('lead_detail', 'leads')
                    // ->join('users', 'leads')
                    // ->select(

                    //     // id no
                    //     'leads.id as id',

                    //     // ref_no
                    //     'leads.ref_no as ref_no',

                    //     // name
                    //     'leads.full_name as name',

                    //     // email
                    //     'leads.email as email',

                    //     // phone
                    //     'leads.phone as phone',

                    //     // inquiry
                    //     'Leads.qualified_question as inquiry',

                    //     // lead_source
                    //     'campaign.campaign_name as lead_source',

                    //     // lead_status
                    //     'lead_detail.lead_status as lead_status',

                    //     // agent_feedback
                    //     'lead_detail.lead_description as agent_feedback',

                    //     // agent_name
                    //     'users.name as agent_name',

                    //     // updated_at
                    //     'Leads.updated_at as last_update',

                    //     // created_at
                    //     'Leads.created_at as created_at'

                    //     )
                    //     ->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC');

                    // // $b = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->union($a)->get();
                    // $result = $a;
                    // dd($result);

        // ================================================================================================


        /**
         *
         * Read all data from all 03 database as a RAW query.
         * Rename the column names to identify each record.
         * Provide a constraint of ORDER BY to the created_at column
         * No pagination will be required here since we load it into Java script Data Tables
         *
         */
        if ( $user_id == '1') {


            /**
             * Gathered all
             */
            $table1 = Leads::with(['users','lead_typess','campaigns', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();


            $table3 = Website::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table2 = Property_lead::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();


            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');

            // dd($leads);


            $var1 = Property_lead::with('users', 'lead_detailss')->where('ref_no', 'PL-8778')->get();

            // dd($var1[0]->lead_detailss->lead_status);
            $this->data['var1'] = $var1[0];



            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

            $wleads = Website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

        }
        elseif( $user_id == '2')
        {

            $cleads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'agent_id' , $id )->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);
            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);
            $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


            $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');
        }

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('all_leads');

        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;
        $this->data['sortedBy'] = 'updated_at';

        // $var1 = Leads::where('ref_no', 'CL-2087')->with('lead_detailss', 'users')->get();
        // dd($var1[0]->lead_detailss->lead_description, $var1[0]->users->name);


        // Log::critical('Lead Page Loaded!');

        return view('all_leads.leads.show', $this->data);
    }













    public function paginate($items, $perPage = 30, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);
        $items = $items instanceof Collection ? $items : Collection::make($items);
        // return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options, ['path'  => $this->request->url(),
        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
    }













    public function search(Request $request)
    {


        /**
         * DB script
         */
        // $var1 = Property_lead::select('id')->get();

        // $var2 = Portal_lead_detail::all();
        // // dd($var1);

        // $var3 = null;

        // foreach($var2 as $data=>$key)
        // {

        //     if($key->where('lead_id', $var1[0]))
        //     {
        //         $var3 = $key->where('lead_id', $var1[$data]);
        //     }
        // }
        // dd($var3, $var1[0]);



        $id = Auth::user()->id;

        $this->data['cleads'] = $this->index()->cleads;
        $this->data['pleads'] = $this->index()->pleads;
        $this->data['wpleads'] = $this->index()->wpleads;

        // check if lead is a ALL LEADS
        if ($request->lead_type == 1){



            $this->data['portals'] = Property_portals::all();

            $this->data['lead_source'] = Leads_type::all();

            $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

            $this->data['agent'] = Users::where('status','1')->get();

            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

            $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));


            $user_id = Auth::user()->user_type;

            if( $user_id == 1)
            {

                $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

                $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

                $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();;

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;

                $page_lead_status = $request->lead_status;
                // dd($table2[0]);

                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }

                if ($request->search != null) {

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->whereDate('created_at', '>', date('2022-12-17'))->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                    // dd($lead_search);

                }
                    // dd($leads[0]->lead_detailss->lead_status);


                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }


                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'updated_at';
                            break;

                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
            elseif( $user_id == '2')
            {

                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;


                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }
                // elseif($request->lead_status == '5' || $request->lead_status == null){

                //     $table_search1 = Leads::with('lead_detailss')->where('agent_id', $id)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                //     $table_search2 = Property_lead::with('lead_detailss')->where('agent_id', $id)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->with(['lead_detailss' => function ($query) {
                //         $query->where('lead_status', null)->orWhere('lead_status', 5);
                //     }])->get();

                //     $table_search3 = website::with('lead_detailss')->where('agent_id', $id)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->with(['lead_detailss' => function ($query) {
                //         $query->where('lead_status',  null)->orWhere('lead_status', 5);
                //     }])->get();

                //     $table_search4 = Property_lead::whereHas('lead_detailss', function ($query) {
                //         $query->where('lead_status', '=', '5');
                //     })->get();
                //     // dd($table_search4);

                //     // dd($table_search1);

                //     // $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->distinct()->get();

                //     // $table_search2 = Property_lead::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->distinct()->get();

                //     // $table_search3 = website::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->distinct()->get();

                //     $leads = $table_search1->merge($table_search2)->merge($table_search3);
                //     // dd($leads->take(7));



                // }


                if ($request->search != null) {
                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->whereDate('created_at', '>', date('2022-12-17'))->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('agent_id', $id)->where('is_closed', 0)->where('is_trash', 0)->whereDate('created_at', '>', date('2022-12-17'))->where('is_recycle', 0)->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('agent_id', $id)->where('is_closed', 0)->where('is_trash', 0)->whereDate('created_at', '>', date('2022-12-17'))->where('is_recycle', 0)->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                }

                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }


                // old raw data
                    //     /**
                    //      * Loop around the query variable above LEADS and
                    //      * find the respective AGENT ID among the array of
                    //      * leads and append it into the new array called FINAL_QUERY.
                    //      *
                    //      */
                    //     $final_query=array();
                    //     foreach($leads as $lead) {
                    //         if ( $lead->agent_id == $id ){
                    //             array_push($final_query, $lead);
                    //         }
                    //     }


                    //     /**
                    //      * Reassign the array name to LEADS bcz the below search code
                    //      * was copied from the ADMIN search code. Create another new
                    //      * array FILTERED_LEADS and append the filtered objects into the
                    //      * array.
                    //      *
                    //      */
                    //     $leads = $final_query;
                    //     $filtered_leads=array();







                    //     //------ NAME SEARCH
                    //     if ($request->search != null)
                    //     {
                    //         foreach($leads as $lead) {
                    //             if ( $lead->full_name == $request->search ){
                    //                 array_push($filtered_leads, $lead);
                    //             }
                    //         }
                    //         // $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                    //     }


                    //     // -------REF_NUMBER SEARCH
                    //     if($request->ref_number != null){

                    //         if(empty($filtered_leads)) {
                    //             foreach($leads as $lead) {
                    //                 if ( $lead->ref_no == $request->ref_number ){
                    //                     array_push($filtered_leads, $lead);
                    //                 }
                    //             }
                    //         }
                    //         else {
                    //             foreach($filtered_leads as $lead => $key) {
                    //                 if ( $key->ref_no == $request->ref_number ){
                    //                     $filtered_leads[$lead]= $lead;
                    //                 }
                    //             }
                    //         }
                    //         // $leads = $leads->where('ref_no', $request->ref_number);
                    //     }



                    //     // ------PHONE SEARCH
                    //     if($request->phone != null){

                    //         if(empty($filtered_leads)) {
                    //             foreach($leads as $lead) {
                    //                 if ( $lead->phone == $request->phone ){
                    //                     array_push($filtered_leads, $lead);
                    //                 }
                    //             }
                    //         }
                    //         else {
                    //             foreach($filtered_leads as $lead) {
                    //                 if ( $lead->phone == $request->phone ){
                    //                     $filtered_leads[$lead]= $lead;
                    //                 }
                    //             }
                    //         }

                    //         // $leads = $leads->where('phone', $request->phone);
                    //     }


                    //     // ------EMAIL SEARCH
                    //     if($request->phone != null){

                    //         if(empty($filtered_leads)) {
                    //             foreach($leads as $lead) {
                    //                 if ( $lead->email == $request->email ){
                    //                     array_push($filtered_leads, $lead);
                    //                 }
                    //             }
                    //         }
                    //         else {
                    //             foreach($filtered_leads as $lead) {
                    //                 if ( $lead->email == $request->email ){
                    //                     $filtered_leads[$lead]= $lead;
                    //                 }
                    //             }
                    //         }

                    //         // $leads = $leads->where('email', $request->email);
                    //     }



                    //     // -------LEAD STATUS SEARCH
                    //     if($request->lead_status != null){

                    //         if(empty($filtered_leads)) {
                    //             foreach($leads as $lead) {
                    //                 if ( $lead->lead_status == $request->lead_status ){
                    //                     array_push($filtered_leads, $lead);
                    //                 }
                    //             }
                    //         }
                    //         else {
                    //             foreach($filtered_leads as $lead => $key) {
                    //                 if ( $key->lead_status == $request->lead_status ){
                    //                     $key= $lead;
                    //                 }
                    //             }
                    //         }

                    //         // $leads = $leads->where('lead_status', $request->lead_status);
                    //     }



                    //     // ---------AGENT SEARCH
                    //     if($request->agent != null){

                    //         if(empty($filtered_leads)) {
                    //             foreach($leads as $lead) {
                    //                 if ( $lead->agent_id == $request->agent ){
                    //                     array_push($filtered_leads, $lead);
                    //                 }
                    //             }
                    //         }
                    //         else {
                    //             foreach($filtered_leads as $lead) {
                    //                 if ( $lead->agent_id == $request->agent ){
                    //                     $filtered_leads[$lead]= $lead;
                    //                 }
                    //             }
                    //         }

                    //         // $leads = $leads->where('agent_id', $request->agent);

                    //         /**
                    //          * Remove duplicate rows
                    //          */
                    //         foreach($leads as $lead =>$key){
                    //             dd($key, $lead);
                    //         }
                    //     }
                // old raw data
            }

            $leads_paged = $this->paginate($leads);

            $leads_paged->withPath(url('all_leads/search'));

            $leads_paged->total();

            // $this->data['page_lead_status'] = $page_lead_status;

            $this->data['all_types'] = true;

            $this->data['request'] = $request;

            $this->data['leads'] = $leads_paged;

            return view('all_leads.leads.show', $this->data);


        }


        // check if lead is a CAMPAIGN
        elseif ($request->lead_type == 2)
        {

            if(Auth::user()->user_type == 1){

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }


            } else{

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }

                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }






        }


        // check if lead is a PORTAL
        elseif ($request->lead_type == 3)
        {

            if(Auth::user()->user_type == 1) {
                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->portal != null){
                    $leads->where('from', $request->portal);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }
            } else {

                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

                if($request->search != null){
                    $leads->where('name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->lead_source != null){
                    $leads->where('from', $request->lead_source);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }



        }


        // check if lead is a WEBSITE
        elseif ($request->lead_type == 4)
        {

            if (Auth::user()->user_type == 1){
                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            } else {
                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
        }


        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = $leads->orderby('created_at','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request;

        $this->data['leads'] = $leads;

        $this->data['all_types'] = false;


        return view('all_leads.leads.search.show', $this->data);



    }














    public function recycle_index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();

        //old code
            // $table1 = DB::table('leads AS leads')
            // ->leftJoin('leads.campaign_id AS campaign_id', 'campaign.id')
            // ->select('ref_no', 'campaign_id');

            // $table2 = DB::table('Property_leads AS pleads')
            // ->leftJoin('leads.lead_description AS agent_feedback', 'lead_detailss.id')
            // ->select('ref_no', 'agent_feedback');

            // $table1->unionAll($table2)->get();

            // dd($table1);
        //old code
        // ================================================================================================

                    // $table1 = Leads::select(
                    //     'ref_no as reference_num',
                    //     'full_name',
                    //     'email',
                    //     'phone',
                    //     'qualified_question',
                    //     'campaigns.campaign_name as campaign ',
                    //     // 'campaign_name',
                    //     // 'lead_status',
                    //     // 'lead_description',
                    //     // 'name',
                    //     // 'updated_at',
                    //     'created_at'
                    //     )->with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );
                    // $table2 = Property_lead::select(
                    //     'ref_no as reference_num',
                    //     'name as name',
                    //     'email as email',
                    //     'phone as phone',
                    //     'inquiry as inquiry',
                    //     'from as source_lead',
                    //     'created_at'
                    //     )->with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->union($table1)->latest()->paginate(30);

                    // dd($table2);

                    // $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->union($table1)->union($table2)->get();;
                    // $tables = union($table1)->union($table2)->latest()->paginate;

        // ================================================================================================
                    // $a = Leads::with(['users','lead_typess','campaigns','lead_detailss', ])
                    // ->join('campaign', 'leads')
                    // ->join('lead_detail', 'leads')
                    // ->join('users', 'leads')
                    // ->select(

                    //     // id no
                    //     'leads.id as id',

                    //     // ref_no
                    //     'leads.ref_no as ref_no',

                    //     // name
                    //     'leads.full_name as name',

                    //     // email
                    //     'leads.email as email',

                    //     // phone
                    //     'leads.phone as phone',

                    //     // inquiry
                    //     'Leads.qualified_question as inquiry',

                    //     // lead_source
                    //     'campaign.campaign_name as lead_source',

                    //     // lead_status
                    //     'lead_detail.lead_status as lead_status',

                    //     // agent_feedback
                    //     'lead_detail.lead_description as agent_feedback',

                    //     // agent_name
                    //     'users.name as agent_name',

                    //     // updated_at
                    //     'Leads.updated_at as last_update',

                    //     // created_at
                    //     'Leads.created_at as created_at'

                    //     )
                    //     ->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC');

                    // // $b = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->union($a)->get();
                    // $result = $a;
                    // dd($result);

        // ================================================================================================


        /**
         *
         * Read all data from all 03 database as a RAW query.
         * Rename the column names to identify each record.
         * Provide a constraint of ORDER BY to the created_at column
         * No pagination will be required here since we load it into Java script Data Tables
         *
         */
        //old code
            // $leads = DB::select("SELECT * FROM
            //     (
            //         SELECT

            //             -- id
            //             Leads.id as id,

            //             -- ref no
            //             Leads.ref_no as ref_no,

            //             -- name
            //             Leads.full_name as full_name,

            //             -- email
            //             Leads.email as email,

            //             -- phone
            //             Leads.phone as phone,

            //             -- inquiry
            //             Leads.qualified_question as inquiry,

            //             -- lead_source
            //             campaign.campaign_name as lead_source,

            //             -- -- lead_status
            //             -- lead_detail.lead_status as lead_status,

            //             -- -- agent_feedback
            //             -- lead_detail.lead_description as agent_feedback,

            //             -- agent_name
            //             users.name as agent_name,

            //             -- agent_image_path
            //             users.image as agent_image_path,

            //             -- updated_at
            //             Leads.updated_at as last_update,

            //             -- created_at
            //             Leads.created_at as created_at


            //         FROM Leads, Campaign, lead_detail, users, lead_type
            //         WHERE is_temporary = 0
            //         AND is_closed = 0
            //         AND is_trash = 0
            //         AND is_recycle = 1
            //         AND Leads.agent_id = users.id
            //         AND Leads.lead_type = lead_type.id
            //         AND Leads.campaign_id = campaign.id
            //         AND lead_detail.lead_id = Leads.id

            //         UNION DISTINCT -- This statement will merge the above query with the one below
            //         SELECT

            //             -- id
            //             Property_lead.id as id,

            //             -- ref no
            //             Property_lead.ref_no,

            //             -- name
            //             Property_lead.name as full_name,

            //             -- email
            //             Property_lead.email as email,

            //             -- phone
            //             Property_lead.phone as phone,

            //             -- inquiry
            //             Property_lead.inquiry as inquiry,

            //             -- lead_source
            //             Property_lead.from as lead_source,

            //             -- -- lead_status
            //             -- portal_lead_detail.lead_status as lead_status,

            //             -- -- agent_feedback
            //             -- portal_lead_detail.lead_description as agent_feedback,

            //             -- agent_name
            //             users.name as agent_name,

            //             -- agent_image_path
            //             users.image as agent_image_path,

            //             -- updated_at
            //             Property_lead.updated_at as last_update,

            //             -- created_at
            //             Property_lead.created_at as created_at


            //         FROM Property_lead, portal_lead_detail, users
            //         WHERE is_temporary = 0
            //         AND is_closed = 0
            //         AND is_trash = 0
            //         AND is_recycle = 1
            //         AND Property_lead.agent_id = users.id
            //         AND portal_lead_detail.lead_id = Property_lead.id


            //         UNION DISTINCT -- This statement will merge the above query with the one below

            //         SELECT

            //             -- id
            //             website.id as id,

            //             -- ref no
            //             website.ref_no,

            //             -- name
            //             website.name as full_name,

            //             -- email
            //             website.email as email,

            //             -- phone
            //             website.phone as phone,

            //             -- inquiry
            //             website.inquiry as inquiry,

            //             -- lead_source
            //             website.source as lead_source,

            //             -- -- lead_status
            //             -- website_lead_detail.lead_status as lead_status,

            //             -- -- agent_feedback
            //             -- website_lead_detail.lead_description as agent_feedback,

            //             -- agent_name
            //             users.name as agent_name,

            //             -- agent_image_path
            //             users.image as agent_image_path,

            //             -- updated_at
            //             website.updated_at as last_update,

            //             -- created_at
            //             website.created_at as created_at


            //         FROM website, website_lead_detail, users
            //         WHERE is_temporary = 0
            //         AND is_closed = 0
            //         AND is_trash = 0
            //         AND is_closed = 0
            //         AND is_trash = 0
            //         AND is_recycle = 1
            //         AND website.agent_id = users.id
            //         AND website_lead_detail.lead_id = website.id

            //     ) AS D ORDER BY last_update DESC;");
        //old code

        $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

        $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

        $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();;

        $leads = $table1->merge($table2)->merge($table3)->sortByDesc('created_at');



        $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->orderby('created_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate();

        $wleads = website::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

        $pleads = Property_lead::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->orderby('id', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('all_recycle');

        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;

        try {
            Log::critical('All Recycle Page Loaded!');
        }
        catch (\Exception $e) {
            $e->getMessage();
            // return Redirect::back()->with('error', $e->getMessage());
            $this->data['error'] = $e->getMessage();
        }

        return view('all_leads.recycle.show', $this->data);

    }













    public function recycle_search(Request $request)
    {
        $id = Auth::user()->id;

        $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 1 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));
        $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 1 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));
        $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 1 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));

        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;


        // check if lead is a ALL LEADS
        if ($request->lead_type == 1){

            $this->data['portals'] = Property_portals::all();

            $this->data['lead_source'] = Leads_type::all();

            $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

            $this->data['agent'] = Users::where('status','1')->get();



            $user_id = Auth::user()->user_type;

            if( $user_id == 1)
            {

                $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->orderby('created_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

                $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

                $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();


                $leads = $table1->merge($table2)->merge($table3);


                $search_name = $request->search;
                // dd($table2[0]);

                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }

                if ($request->search != null) {
                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                    // dd($lead_search);

                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            break;
                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            break;
                        default:
                            $leads = $leads->sortByDesc('created_at');
                            break;
                    }
                }
            }
            elseif( $user_id == '2')
            {

                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $leads = $table1->merge($table2)->merge($table3);


                $search_name = $request->search;
                // dd($table2[0]);

                if($request->lead_status != null){



                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }

                if ($request->search != null) {
                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('agent_id', $id)->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('agent_id', $id)->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 1)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                    // dd($lead_search);

                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            break;
                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            break;
                        default:
                            $leads = $leads->sortByDesc('created_at');
                            break;
                    }
                }
            }

            $leads_paged = $this->paginate($leads);

            $leads_paged->withPath(url('all_recycle/search'));

            $leads_paged->total();

            $this->data['all_types'] = true;

            $this->data['request'] = $request;

            $this->data['leads'] = $leads_paged;

            return view('all_leads.recycle.show', $this->data);


        }


        // check if lead is a CAMPAIGN
        elseif ($request->lead_type == 2)
        {

            if(Auth::user()->user_type == 1){

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }


            } else{

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }

                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }

            }






        }


        // check if lead is a PORTAL
        elseif ($request->lead_type == 3)
        {

            if(Auth::user()->user_type == 1) {

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['portals'] = Property_portals::all();

                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }
                if($request->lead_source != null){
                    $leads->where('from', $request->lead_source);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }
            } else {

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['portals'] = Property_portals::all();

                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));

                if($request->search != null){
                    $leads = where('name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->email != null){
                    $leads = where('email', $request->email);
                }
                if($request->phone != null){
                    $leads = where('phone', $request->phone);
                }
                if($request->portals != null){
                    $leads = where('lead_type', $request->portals);
                }
                if($request->ref_number != null){
                    $leads = where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads = where('agent_id', $request->agent);
                }
                if($request->lead_source != null){
                    $leads->where('from', $request->lead_source);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }

            }



        }


        // check if lead is a WEBSITE
        elseif ($request->lead_type == 4)
        {

            if (Auth::user()->user_type == 1){

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }

            } else {
                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 1 )->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            break;

                    }
                }

            }



        }


        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = $leads->orderby('created_at','DESC');

        $leads = $leads->paginate(30);

        // $leads->withPath('all_recycle/search');

        $this->data['request'] = $request;

        $this->data['leads'] = $leads;

        $this->data['all_types'] = false;

        return view('all_leads.recycle.search.show', $this->data);

    }














    /**
     * Temoporary Leads Below
     *
     * This section contains code to load all temporary leads
     */
    public function temp_index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();



        $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('is_trash', 0)->where( 'is_temporary' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();
        // dd($table1);

        $table2 = Property_lead::with('users','lead_detailss')->where('is_trash', 0)->where( 'is_temporary' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

        $table3 = website::with('users','lead_detailss')->where('is_trash', 0)->where( 'is_temporary' , 1 )->whereDate('created_at', '>', date('2022-12-17'))->get();

        $leads = $table2->merge($table1)->merge($table3)->sortByDesc('updated_at');
        // dd($leads->where('ref_no', 'PL-3114'));


        $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('is_temporary', 1)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate();

        $wleads = website::with(['users','lead_detailss'])->where('is_temporary', 1)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

        $pleads = Property_lead::with(['users','lead_detailss'])->where('is_temporary', 1)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('all_temporary');

        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;

        Log::info('All Temporary Page Loaded');

        return view('all_leads.temporary.show', $this->data);
    }










    public function all_deals()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();

        /**
         *
         * Read all data from all 03 database as a RAW query.
         * Rename the column names to identify each record.
         * Provide a constraint of ORDER BY to the created_at column
         * No pagination will be required here since we load it into Java script Data Tables
         *
         */
        if ( $user_id == '1') {


            /**
             * Gathered all
             */
            $table1 = Leads::with(['users','lead_typess','campaigns', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();


            $table3 = Website::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table2 = Property_lead::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();


            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');

            // dd($leads->count());


            $var1 = Property_lead::with('users', 'lead_detailss')->where('ref_no', 'PL-8778')->get();

            // dd($var1[0]->lead_detailss->lead_status);
            $this->data['var1'] = $var1[0];



            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

            $wleads = Website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

        }
        elseif( $user_id == '2')
        {

            try {
                $cleads = Leads::with(['users','lead_typess','lead_detailss'])->where('agent_id', $id)->where('is_closed', 1)->where('lead_status', 6)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);
                $pleads = Property_lead::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_closed', 1)->where('lead_status', 6)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->orderby('id', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);
                $wleads = website::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_closed', 1)->where('lead_status', 6)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


                $table1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('lead_status', 6)->where('is_closed', 1)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('lead_status', 6)->where('is_closed', 1)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('lead_status', 6)->where('is_closed', 1)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');
            }
            catch (\Exception $e) {

                $this->data['leads'] = 0;
                $this->data['cleads'] = 0;
                $this->data['pleads'] = 0;
                $this->data['wleads'] = 0;
                $this->data['sortedBy'] = 'updated_at';

                return view('all_leads.deals.show', $this->data);
                // $this->data['error'] = $e->getMessage();
            }
        }

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('my_deals');

        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;
        $this->data['sortedBy'] = 'updated_at';

        // $var1 = Leads::where('ref_no', 'CL-2087')->with('lead_detailss', 'users')->get();
        // dd($var1[0]->lead_detailss->lead_description, $var1[0]->users->name);


        // Log::critical('Lead Page Loaded!');

        return view('all_leads.deals.show', $this->data);
    }








    public function all_deals_admin()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();


        try {
            $table1 = Leads::with(['users','lead_typess','campaigns', 'lead_detailss'])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table3 = Website::with(['users', 'lead_detailss'])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'))->get();

            $table2 = Property_lead::with(['users', 'lead_detailss'])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'))->get();

            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');

            // dd($leads->count());

            $var1 = Property_lead::with('users', 'lead_detailss')->where('ref_no', 'PL-8778')->get();

            // dd($var1[0]->lead_detailss->lead_status);
            $this->data['var1'] = $var1[0];

            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->orderby('created_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->whereDate('created_at', '>', date('2022-12-17'))->get();

            $wleads = Website::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->orderby('updated_at', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

            $pleads = Property_lead::with(['users','lead_detailss'])->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->orderby('id', 'DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);
        }
        catch (\Exception $e) {

            $this->data['cleads'] = 0;
            $this->data['pleads'] = 0;
            $this->data['wleads'] = 0;
            $this->data['sortedBy'] = 'updated_at';
            return view('all_leads.deals.show', $this->data);
        }

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('all_deals');


        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;
        $this->data['sortedBy'] = 'updated_at';

        return view('all_leads.deals.show', $this->data);
    }


















    // CLosed Deals Search

    public function closed_search(Request $request)
    {




        $id = Auth::user()->id;

        $this->data['cleads'] = $this->index()->cleads;
        $this->data['pleads'] = $this->index()->pleads;
        $this->data['wpleads'] = $this->index()->wpleads;

        // check if lead is a ALL LEADS
        if ($request->lead_type == 1){

            $this->data['portals'] = Property_portals::all();

            $this->data['lead_source'] = Leads_type::all();

            $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

            $this->data['agent'] = Users::where('status','1')->get();

            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

            $pleads = Property_lead::with(['users','lead_detailss'])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));

            $wleads = website::with(['users','lead_detailss'])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'));


            $user_id = Auth::user()->user_type;

            if( $user_id == 1)
            {

                $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->get();

                $wleads = website::with(['users','lead_detailss'])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);

                $pleads = Property_lead::with(['users','lead_detailss'])->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->whereDate('created_at', '>', date('2022-12-17'))->paginate(30);


                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where('lead_status', 6)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;

                $page_lead_status = $request->lead_status;
                // dd($table2[0]);

                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', 6)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', 6)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', 6)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }

                if ($request->search != null) {

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', 6)->where('full_name', $search_name)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', 6)->where('is_temporary', 0)->where('name', $search_name)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', 6)->where('is_temporary', 0)->where('name', $search_name)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                    // dd($lead_search);

                }
                    // dd($leads[0]->lead_detailss->lead_status);


                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }


                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'updated_at';
                            break;

                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
            elseif( $user_id == '2')
            {

                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('lead_status', 6)->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle', 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table2 = Property_lead::with('users','lead_detailss')->where('lead_status', 6)->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $table3 = website::with('users','lead_detailss')->where('lead_status', 6)->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->whereDate('created_at', '>', date('2022-12-17'))->get();

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;


                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', 6)->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', 6)->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', 6)->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }



                if ($request->search != null) {
                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', 6)->where('agent_id', $id)->where('full_name', $search_name)->where('is_temporary', 0)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('lead_status', 6)->where('name', $search_name)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('lead_status', 6)->where('name', $search_name)->where('agent_id', $id)->where('is_trash', 0)->where('is_recycle', 0)->whereDate('created_at', '>', date('2022-12-17'))->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                }

                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }

            $leads_paged = $this->paginate($leads);

            $leads_paged->withPath(url('my_leads/search'));

            $leads_paged->total();

            // $this->data['page_lead_status'] = $page_lead_status;

            $this->data['all_types'] = true;

            $this->data['request'] = $request;

            $this->data['leads'] = $leads_paged;

            return view('all_leads.leads.show', $this->data);


        }


        // check if lead is a CAMPAIGN
        elseif ($request->lead_type == 2)
        {

            if(Auth::user()->user_type == 1){

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }


            } else{

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }

                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }






        }


        // check if lead is a PORTAL
        elseif ($request->lead_type == 3)
        {

            if(Auth::user()->user_type == 1) {
                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->portal != null){
                    $leads->where('from', $request->portal);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }
            } else {

                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));

                if($request->search != null){
                    $leads->where('name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->lead_source != null){
                    $leads->where('from', $request->lead_source);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }



        }


        // check if lead is a WEBSITE
        elseif ($request->lead_type == 4)
        {

            if (Auth::user()->user_type == 1){
                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            } else {
                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->where('lead_status', 6)->whereDate('created_at', '>', date('2022-12-17'));

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
        }


        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = $leads->orderby('created_at','DESC');

        $leads = $leads->paginate(30);

        $this->data['request'] = $request;

        $this->data['leads'] = $leads;

        $this->data['all_types'] = false;


        return view('all_leads.deals.search.show', $this->data);



    }












    public function old_leads_reimbursement_index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['lead_source'] = Leads_type::all();

        $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->orderBy('name')->get();



        /**
         *
         * Read all data from all 03 database as a RAW query.
         * Rename the column names to identify each record.
         * Provide a constraint of ORDER BY to the created_at column
         * No pagination will be required here since we load it into Java script Data Tables
         *
         */
        if ( $user_id == '1') {


            /**
             * Gathered all
             */
            $table1 = Leads::with(['users','lead_typess','campaigns', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();


            $table3 = Website::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->get();

            $table2 = Property_lead::with(['users', 'lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->get();


            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');

            // dd($leads);


            $var1 = Property_lead::with('users', 'lead_detailss')->where('ref_no', 'PL-8778')->get();

            // dd($var1[0]->lead_detailss->lead_status);
            $this->data['var1'] = $var1[0];



            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->get();

            $wleads = Website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->get();

            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_closed' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->get();

        }
        elseif( $user_id == '2')
        {

            $cleads = Leads::with(['users','lead_typess','lead_detailss'])->where( 'agent_id' , $id )->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);
            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);
            $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'agent_id' , $id   )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);


            $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_temporary' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

            $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

            $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'agent_id' , $id )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

            $leads = $table1->merge($table2)->merge($table3)->sortByDesc('updated_at');
        }

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath('old-leads-re-imbursement-index');

        $this->data['leads'] = $leads_paged;
        $this->data['cleads'] = $cleads;
        $this->data['pleads'] = $pleads;
        $this->data['wleads'] = $wleads;
        $this->data['sortedBy'] = 'updated_at';

        // $var1 = Leads::where('ref_no', 'CL-2087')->with('lead_detailss', 'users')->get();
        // dd($var1[0]->lead_detailss->lead_description, $var1[0]->users->name);


        // Log::critical('Lead Page Loaded!');

        return view('all_leads.2022.show', $this->data);
    }







    public function old_leads_reimbursement_search(Request $request)
    {

        $id = Auth::user()->id;

        $this->data['cleads'] = $this->index()->cleads;
        $this->data['pleads'] = $this->index()->pleads;
        $this->data['wpleads'] = $this->index()->wpleads;

        // check if lead is a ALL LEADS
        if ($request->lead_type == 1){



            $this->data['portals'] = Property_portals::all();

            $this->data['lead_source'] = Leads_type::all();

            $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

            $this->data['agent'] = Users::where('status','1')->get();

            $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

            $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

            $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );


            $user_id = Auth::user()->user_type;

            if( $user_id == 1)
            {

                $cleads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('created_at','DESC')->get();

                $wleads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('updated_at','DESC')->paginate(30);

                $pleads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->orderby('id','DESC')->paginate(30);


                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();;

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;

                $page_lead_status = $request->lead_status;
                // dd($table2[0]);

                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }

                if ($request->search != null) {

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                    // dd($lead_search);

                }
                    // dd($leads[0]->lead_detailss->lead_status);


                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }


                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'updated_at';
                            break;

                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
            elseif( $user_id == '2')
            {

                $table1 = Leads::with('users','lead_typess','campaigns','lead_detailss')->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

                $table2 = Property_lead::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

                $table3 = website::with('users','lead_detailss')->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 )->get();

                $leads = $table1->merge($table2)->merge($table3);

                $search_name = $request->search;


                if($request->lead_status != null){

                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('agent_id', $id)->where('lead_status', $request->lead_status)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);

                }


                if ($request->search != null) {
                    $table_search1 = Leads::with('users', 'lead_typess', 'campaigns', 'lead_detailss')->where('agent_id', $id)->where('full_name', $search_name)->where('is_temporary', 0)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search2 = Property_lead::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('agent_id', $id)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $table_search3 = website::with('users', 'lead_detailss')->where('is_temporary', 0)->where('name', $search_name)->where('agent_id', $id)->where('is_closed', 0)->where('is_trash', 0)->where('is_recycle', 0)->get();

                    $leads = $table_search1->merge($table_search2)->merge($table_search3);
                }

                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->sortByDesc('updated_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        default:
                            $leads = $leads->sortByDesc('created_at');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }

            $leads_paged = $this->paginate($leads);

            $leads_paged->withPath(url('old-leads-re-imbursement/search'));

            $leads_paged->total();

            // $this->data['page_lead_status'] = $page_lead_status;


            $this->data['all_types'] = true;

            $this->data['request'] = $request;

            $this->data['leads'] = $leads_paged;

            return view('all_leads.2022.show', $this->data);


        }


        // check if lead is a CAMPAIGN
        elseif ($request->lead_type == 2)
        {

            if(Auth::user()->user_type == 1){

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }


            } else{

                $this->data['lead_source'] = Leads_type::all();

                $this->data['campaigns'] = Campaign::orderby('id', 'desc')->get();

                $this->data['agent'] = Users::where('status','1')->get();

                $leads = Leads::with(['users' , 'lead_typess', 'campaigns','lead_detailss' ])->where('agent_id', $id)->where( 'is_temporary' , 0 )->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );


                if($request->search != null){
                    $leads = $leads->where('full_name', 'LIKE', "%{$request->search}%");
                }

                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
                }
                if($request->phone != null){
                    $leads = $leads->where('phone', $request->phone);
                }
                if($request->email != null){
                    $leads = $leads->where('email', $request->email);
                }
                if($request->ref_number != null){
                    $leads = $leads->where('ref_no', $request->ref_number);
                }
                if($request->campaigns != null){
                    $leads = $leads->where('campaign_id', $request->campaigns);
                }
                if($request->agent != null){
                    $leads = $leads->where('agent_id', $request->agent);
                }
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }






        }


        // check if lead is a PORTAL
        elseif ($request->lead_type == 3)
        {

            if(Auth::user()->user_type == 1) {
                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->portal != null){
                    $leads->where('from', $request->portal);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }
            } else {

                $this->data['portals'] = Property_portals::all();


                $this->data['agent'] = Users::where('status','1')->get();


                $leads = Property_lead::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

                if($request->search != null){
                    $leads->where('name', 'LIKE', "%{$request->search}%");
                }
                if($request->lead_status != null){
                    $leads = $leads->where('lead_status', $request->lead_status);
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
                if($request->ref_number != null){
                    $leads->where('ref_no', $request->ref_number);
                }
                if($request->agent != null){
                    $leads->where('agent_id', $request->agent);
                }

                if($request->lead_source != null){
                    $leads->where('from', $request->lead_source);
                }

                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            }



        }


        // check if lead is a WEBSITE
        elseif ($request->lead_type == 4)
        {

            if (Auth::user()->user_type == 1){
                $this->data['agent'] = Users::where('status','1')->get();


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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;

                    }
                }

            } else {
                $this->data['agent'] = Users::where('status','1')->get();


                $leads = website::with(['users','lead_detailss'])->where( 'is_temporary' , 0 )->where('agent_id', $id)->where( 'is_closed' , 0 )->where( 'is_trash' , 0 )->where( 'is_recycle' , 0 );

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
                if($request->sort_by != null){
                    switch($request->sort_by) {
                        case '1':
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                        case '2':
                            $leads = $leads->orderby('updated_at','DESC');
                            $this->date['sortedBy'] = 'updated_at';
                            break;
                        default:
                            $leads = $leads->orderby('created_at','DESC');
                            $this->date['sortedBy'] = 'created_at';
                            break;
                    }
                }
            }
        }


        $this->data['portals'] = Property_portals::all();

        $this->data['agent'] = Users::where('status','1')->get();

        $leads = $leads->orderby('created_at','DESC');

        $leads = $leads->paginate(30);

        // $leads->withPath('old-leads-re-imbursement-search');

        $leads_paged = $this->paginate($leads);

        $leads_paged->withPath(url('old-leads-re-imbursement/search'));

        $this->data['request'] = $request;

        $this->data['leads'] = $leads;

        $this->data['all_types'] = false;


        return view('all_leads.2022.show', $this->data);



    }






    public function plead_update($id)
    {
        $fetch = Property_lead::find($id);

        // dd($fetch);

        if(!empty($fetch))
        {
            $fetch->created_at = Carbon::now();
            $fetch->save();

            return Redirect::to('old-leads-re-imbursement-index');
        }

        return Redirect::to('old-leads-re-imbursement-index');
    }


    public function clead_update($id)
    {
        $fetch = Leads::find($id);

        // dd($fetch);

        if(!empty($fetch))
        {
            $fetch->created_at = Carbon::now();
            $fetch->save();

            return Redirect::to('old-leads-re-imbursement-index');
        }

        return Redirect::to('old-leads-re-imbursement-index');

    }



    public function wlead_update($id)
    {
        $fetch = Website::find($id);



        if(!empty($fetch))
        {
            $fetch->created_at = Carbon::now();
            $fetch->save();

            return Redirect::to('old-leads-re-imbursement-index');
        }

        return Redirect::to('old-leads-re-imbursement-index');

    }

}
