<?php

namespace App\Http\Controllers;

use App\Models\Models\Announcements;
use Illuminate\Http\Request;

class AnnouncementsController extends Controller
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
        //
        $announcement = Announcements::get();


        $this->data['announcements'] = $announcement;



        return view('announcements.show', $this->data );

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //


        return view('announcements.create');
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
            $announcements = new Announcements();

            $announcements->status = $request->status;
            $announcements->announcements = $request->announcement;


            $announcements->save();


            return redirect('annoucments')->with('message','Annoucment has Been Generated Successfully.');


        }
        else
        {
            return redirect('annoucments')->with('message','Annoucment is Already Exist.');

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

        $announcement = Announcements::where('id', $id )->first();



        $this->data['announcement'] = $announcement;

        return view('announcements.edit' , $this->data);
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


        $announcements = Announcements::find($id);


        if (!empty($announcements)) {

           $announcements->status = $request->status;
           $announcements->announcements = $request->announcement;


           $announcements->save();
        }

        return redirect('annoucments')->with('message','Announcements has Been Updated Successfully.');
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
