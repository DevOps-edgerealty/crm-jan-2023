<?php

namespace App\Http\Controllers;

use App\Imports\WebsiteImport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Models\Website;
use App\Models\Models\Users;
use App\Models\Models\Website_lead_detail;
use Illuminate\Support\Facades\Redirect;
use Maatwebsite\Excel\Facades\Excel;

class Website_leadController extends Controller
{
    protected $ref_no = null;

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
        //


        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        if ( $user_id == '1') {


            $leads = website::with(['users'])->where( 'is_recycle' , 0 )->get();



        }
        elseif( $user_id == '2')
        {

            $leads = website::with(['users'])->where( 'agent_id' , $id   )->where( 'is_recycle' , 0 )->get();

        }





        //return $leads;

        $this->data['leads'] = $leads;

        return view('website.show', $this->data);



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

        $leads = Website::with(['users'])->where('id', $id )->first();


        $lead_id = $leads->id;

        $lead_detail = Website_lead_detail::with(['users'])->where(  'lead_id' , $lead_id )->orderby('id' , 'DESC')->get();


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

            //
            $leads = new Website_lead_detail();


            $leads->agent_id = $id;
            $leads->lead_id = $request->lead_id;
            $leads->lead_description = $request->description;

            $leads->save();

            return Redirect::back()->with('message','Website Lead Details has Been Generated Successfully.');


        }
        else
        {
            return Redirect::back()->with('message','Lead Deatil is already Exist.');

        }

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
            $website_leads->is_recycle = 0;


            $website_leads->save();

            return redirect('website')->with('message','Website Lead has Been Generated Successfully.');


        }
        else
        {
            return redirect('website')->with('message','Website Lead is Already Exist.');

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
            $website_leads->name = $request->full_name;
            $website_leads->phone = $request->phone;
            $website_leads->email = $request->email;
            $website_leads->status = $request->status;



            $website_leads->save();
        }

        return redirect('website')->with('message','Website Lead has Been Updated Successfully.');


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
