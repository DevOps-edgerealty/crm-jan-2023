<?php

namespace App\Http\Controllers;

use App\Models\Models\Leader_board_detail;
use Illuminate\Support\Facades\Auth;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Models\Users;
use App\Models\Models\Target;
use App\Models\Models\Team;
use App\Models\Models\Leaderboard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\ElseIf_;

class TargetController extends Controller
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

    public function showIndex()
    {
        $target_data = Target::with('targets')->get();

        $agents = Users::with('targets')->where('user_type', '2')->where('status', '1')->orderby('name')->get();

        // $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
        // ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
        // ->where('leader_board.status', 1)
        // ->where('is_trash', null)
        // ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
        // ->whereYear('leader_board_detail.created_at', Carbon::now()->year)
        // ->groupBy('leader_id', 'leader_board.id')
        // ->orderby('totalcommission' , 'DESC')
        // ->get();

        $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
            ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
            ->where('leader_board.status',1)
            ->where('is_trash', null)
            ->groupBy('leader_id', 'leader_board.id')
            ->orderby('totalcommission' , 'DESC')
            ->get();

        // dd($leader_board);

        $this->data['leaderboard_data'] = $leader_board;

        $this->data['agents'] = $agents;

        $this->data['target'] = $target_data;

        return view('users.includes.manage_targets', $this->data);
    }








    public function assign_target(Request $request)
    {

        try {
            $user = Users::find($request->agent_id);

        }
        catch(\Exception $e) {
            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target Assign : agent validation');
        }

        try{
            $target = new Target();
            $target->agent_id = $request->agent_id;
            $target->month = $request->month;
            $target->year = $request->year;
            $target->target = $request->target;
            $target->save();
        }
        catch(\Exception $e) {
            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target Assign : target storing');
        }

        return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned.');

    }







    public function delete_target($id)
    {

        try {
            $target = Target::find($id);

        }
        catch(\Exception $e) {
            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target Deletion : Target validation');
        }

        $target->delete();

        return Redirect::to('/manage-targets')->with('success','Target has been successfully deleted.');

    }




    public function target_update(Request $request)
    {

        try {
            $target = Target::find($request->id);
            // dd($target);

        }
        catch(\Exception $e) {
            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target update : agent validation');
        }

        try{
            $target = Target::find($request->id);
            $target->agent_id = $request->agent_id;
            $target->month = $request->month;
            $target->year = $request->year;
            $target->target = $request->target;
            $target->save();
        }
        catch(\Exception $e) {
            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target Update : target storing');
        }
        return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned');
    }






    public function target_update_create(Request $request)
    {

            // $nowMonth = Carbon::now()->month;
            // $nowYear = Carbon::now()->year;


            $target = Target::find($request->id);
            // dd($target);
            if($target)
            {
                if($target->agent_id == $request->agent_id)
                {
                    if( $target->month == Carbon::now()->month && $target->year == Carbon::now()->year )
                    {
                        $target = Target::find($request->id);
                        $target->agent_id = $request->agent_id;
                        $target->month = Carbon::now()->month;
                        $target->year = Carbon::now()->year;
                        $target->target = $request->target;
                        $target->save();
                        return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned.');

                    }
                    else{
                        try{
                            $target = new Target();
                            $target->agent_id = $request->agent_id;
                            $target->month = Carbon::now()->month;
                            $target->year = Carbon::now()->year;
                            $target->target = $request->target;
                            $target->save();
                            return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned.');
                        }
                        catch(\Exception $e) {
                            return Redirect::to('/manage-targets')->with('error','Could not deliver request. Error in Target Update : target storing');
                        }
                        return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned.');
                    }
                }
            }
            else {
                $target = new Target();
                $target->agent_id = $request->agent_id;
                $target->month = Carbon::now()->month;
                $target->year = Carbon::now()->year;
                $target->target = $request->target;
                $target->save();
                return Redirect::to('/manage-targets')->with('success','Target has been successfully assigned.');
            }
    }

}
