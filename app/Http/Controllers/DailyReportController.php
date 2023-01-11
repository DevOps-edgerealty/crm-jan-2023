<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


use App\Models\Models\Leader_board_detail;
use Illuminate\Support\Facades\Auth;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Models\Users;
use App\Models\Models\Daily_report;
use App\Models\Models\Team;
use App\Models\Models\Leaderboard;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\ElseIf_;

class DailyReportController extends Controller
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
        $user_type = Auth::user()->user_type;



        if($user_type == 1)
        {
            $fetch_data1 = Daily_report::with('daily_reports')->orderby('created_at','DESC')->paginate(30);  //all reports

            $fetch_data2 = Users::with('daily_reports')->where('user_type', '2')->where('status', '1')->orderby('name')->get(); //all users

            $this->data['daily_reports'] = $fetch_data1;

            return view('daily_report.show', $this->data);
        }else {
            return Redirect::to('/daily-reports')->with('error', 'Your are not authenticated');
        }

    }



    public function agent_index()
    {
        $user_type = Auth::user()->user_type;

        $user_id = Auth::user()->id;

        if($user_type == 2)
        {
            $fetch_data1 = Daily_report::with('daily_reports')->orderby('created_at','DESC')->where('agent_id', $user_id)->get();  //all reports

            $fetch_data2 = Users::with('daily_reports')->where('user_type', '2')->where('status', '1')->orderby('name')->get(); //all users

            $this->data['daily_reports'] = $fetch_data1;

            return view('daily_report.show', $this->data);
        }
        else {
            return Redirect::to('/my-daily-reports')->with('error', 'Your are not authenticated');
        }


    }





    public function store(Request $request)
    {
        $auth_user = Auth::user()->id;

        try {
            $user = Users::find($auth_user);

        }
        catch(\Exception $e) {
            return Redirect::to('/daily_-eports')->with('error', $e->getMessage());
        }

        try{
            $data = new Daily_report();
            $data->agent_id = $user->id;
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->reason = $request->reason;
            $data->others = $request->others;
            $data->time = $request->time;
            $data->location = $request->location;
            $data->save();

        }
        catch(\Exception $e) {
            dd($e->getMessage());
            return Redirect::back()->with('error',$e->getMessage());
        }

        return Redirect::back()->with('success','The report had been created successfully!');
    }







    public function update(Request $request)
    {

        $user_id = Auth::user()->id;

        try {
            $data = Daily_report::find($request->id);

        }
        catch(\Exception $e) {
            return Redirect::back()->with('error','Could not deliver request. Error in Target update : agent validation');
        }

        try{
            $data = Daily_report::find($request->id);
            $data->name = $request->name;
            $data->phone = $request->phone;
            $data->email = $request->email;
            $data->reason = $request->reason;
            $data->others = $request->others;
            $data->time = $request->time;
            $data->location = $request->location;
            $data->save();

        }
        catch(\Exception $e) {
            return Redirect::back()->with('error','Could not deliver request. Error in Target Update : report storing');
        }

        return Redirect::back()->with('success','Target has been successfully updated.');

    }




    public function delete($id)
    {

        $user_id = Auth::user()->id;



        if ($user_id == '1') {
            try {
                $data = Daily_report::find($id);
            } catch(\Exception $e) {
                return Redirect::back()->with('error', 'Could not deliver request. Error in Target update : agent validation');
            }

            try {
                $data = Daily_report::find($id);
                $data->delete();

            } catch(\Exception $e) {
                return Redirect::back()->with('error', 'Could not deliver request. Error in Target Update : target deletion');
            }

            return Redirect::back()->with('success', 'Target has been successfully deleted.');
        }
        else{
            return Redirect::back()->with('error','You are not authorized to perform this action');
        }


    }
}
