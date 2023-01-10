<?php

namespace App\Http\Controllers;

use App\Models\Models\Leader_board_detail;
use App\Models\Models\Leaderboard;
use App\Models\Models\Users;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

use Auth;

class LeaderboardController extends Controller
{

    private $uploadPath = "public/assets/images/users";
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $user_type = Auth::user()->user_type;

        if ($user_type == 2)
        {
            $agents = Users::where('user_type', 2)->where('status', 1)->where('team_leader', 0)->get();

            $this->data['agents'] = $agents;

            $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
                ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
                ->where('leader_board.status',1)
                ->where('is_trash', null)
                ->groupBy('leader_id', 'leader_board.id')
                ->orderby('totalcommission' , 'DESC')
                ->get();

            $this->data['leader_board'] = $leader_board;

            $leaderboard_memebers = Leaderboard::where('status', 1)->where('team_leader', 0)->get();

            // dd($leader_board);

            $this->data['leader_board'] = $leader_board;

            $this->data['leaderboard_memebers'] = $leaderboard_memebers;

            return view('leaderboard.show', $this->data);

        } else {

            $agents = Users::where('user_type', 2)->where('status', 1)->get();

            $this->data['agents'] = $agents;

            $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
                ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
                ->where('leader_board.status',1)
                ->where('is_trash', null)
                ->groupBy('leader_id', 'leader_board.id')
                ->orderby('totalcommission' , 'DESC')
                ->get();




            $leaderboard_memebers = Leaderboard::where('status', 1)->get();

            $leaderboard_details_2023 = array();
            $leaderboard_details_2023_2 = array();

            foreach($leaderboard_memebers as $data)
            {
                $result = Leader_board_detail::where('leader_id', $data->id)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where('is_trash', null)
                    ->sum('net_commission');

                $result2 = Leader_board_detail::where('leader_id', $data->id)
                    ->whereYear('created_at', Carbon::now()->year)
                    ->where('is_trash', null)
                    ->get();

                array_push($leaderboard_details_2023, $result);
                array_push($leaderboard_details_2023_2, $result2);
            }
            // dd($leaderboard_details_2023_2);









            // dd($leaderboard_memebers);

            $this->data['leader_board'] = $leader_board;

            $this->data['leaderboard_memebers'] = $leaderboard_memebers;

            return view('leaderboard.show', $this->data);
        }

    }


   public function monthly_ranking()
    {

        $leader_board = Leaderboard::selectRaw('sum(leader_board_detail.net_commission) AS totalcommission, leader_board.*')
        ->leftJoin('leader_board_detail', 'leader_board_detail.leader_id', '=', 'leader_board.id')
        ->where('leader_board.status', 1)
        ->groupBy('leader_id', 'leader_board.id')
        ->orderby('totalcommission' , 'DESC')
        ->whereMonth('leader_board_detail.created_at', Carbon::now()->month)
        ->get();


        $data = [];

        foreach($leader_board as $row) {
           $data['label'][] = $row->name;
           $data['data'][] = (int) $row->totalcommission;
         }

       $this->data['chart_data'] = json_encode($data);


        $this->data['leader_board'] = $leader_board;


        $this->data['month'] = Carbon::now()->month;




        return view('leaderboard.monthly_ranking', $this->data);
    }




    public function monthly_ranking_by_month(Request $request)
    {
        //
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

            $this->data['month'] = $month;

            $this->data['leader_board'] = $leader_board;



        return view('stats.monthly_ranking', $this->data);
    }





    public function leader_board_detail($id)
    {
        $user_type = Auth::user()->user_type;

        if ($user_type == 2)
        {
            return view('error');
        }



        $leader_board = Leaderboard::where('id', $id )->first();

        $leader_detail = Leader_board_detail::where('is_trash', '!=', 1)->orWhereNull('is_trash')->where(  'leader_id' , $id )->orderby('id' , 'DESC')->whereDate('created_at', '>', date('2023-01-01'))->get();

        $leader_net_commision = Leader_board_detail::where('leader_id', $id)->whereDate('created_at', '>', date('2022-12-17'))->where('is_trash', 0)->sum('net_commission');



        $this->data['leader_net_commision'] = $leader_net_commision;

        $this->data['leader_board'] = $leader_board;

        $this->data['leader_detail'] = $leader_detail;

        $this->data['user_id'] = $id;

        return view('leaderboard.detail', $this->data );
    }



    public function leader_board_detail_edit_leader($id)
    {
        $leader_board = Leaderboard::where('id', $id )->first();

        $this->data['leader_board'] = $leader_board;

        $this->data['user_id'] = $id;


        return view('leaderboard.edit_leaderboard', $this->data );

    }







    public function leader_store_detail(Request $request)
    {

        $bool=0;

		if($bool==0)
		{

            $leader_detail = new Leader_board_detail();

            $leader_detail->leader_id = $request->leader_id;
            $leader_detail->lead_source = $request->lead_source;
            $leader_detail->sale_value = $request->sale_value;
            $leader_detail->rent_value = $request->rent_value;
            $leader_detail->net_commission = $request->net_commission;
            $leader_detail->leader_detail = $request->description;
            $leader_detail->save();

            return Redirect::back()->with('message','Leader Board Details has Been Generated Successfully.');
        }
        else
        {
            return Redirect::back()->with('message','Leader Board Details is already Exist.');
        }
    }



    /**
     * Show the form for creating a new resource.
     *u755
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $agents = Users::where('user_type', 2)->get();

        $this->data['agents'] = $agents;

        return view('leaderboard.create', $this->data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         *
         * Check if the selected agent is already assigned in the leaderboard using a reverse try-catch statement.
         *
         */
        try {
            Leaderboard::where('agent_id', $request->agent)->firstOrFail();

        } catch (\Exception $e) {
            $agent = Users::find($request->agent);

            // Create a new leader and assign the details of the agent.
            $Users = new Leaderboard();
            $Users->agent_id = $agent->id;
            $Users->name = $agent->name;
            $Users->email = $agent->email;
            $Users->image = $agent->image;
            $Users->status = 1;

            // if($image = $request->file('agent_image'))
            // {
            //     $destinationPath = $this->uploadPath;
            //     $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
            //     $image->move($destinationPath."/", $profileImage);
            //     $Users->image = "$profileImage";
            //     $Users->save();
            // }

            $Users->save();

            return redirect('leader_board')->with('message','The selected agent has been added to the Leaderboard');

        }
        $leaderboard_member = Leaderboard::where('agent_id', $request->agent)->get();
        // dd($leaderboard_member[0]->created_at);
        $date = date('2022-12-17').' 00:00:00';
        if ($leaderboard_member[0]->created_at <= $date)
        {
            $leaderboard_member[0]->created_at = Carbon::now();
            $leaderboard_member[0]->save();
        }

        return redirect('leader_board')->with('error','The selected agent has been re-listed in the Leaderboard');

    }



    public function delete($id)
    {
         $data = Leaderboard::find($id);
        if (!empty($data))
        {
            try {
                $leader = Leaderboard::find($id);
                $leader->status = 0;
                $leader->save();
            }
            catch(\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Leader has been deleted successfully.');
        }
        return Redirect::back()->with('error','The record does not exist. Refresh the page & try again.');
    }


    public function leader_board_detail_edit($id)
    {


        $leader_detail = Leader_board_detail::where('id', $id)->first();

        $this->data['leader_detail'] = $leader_detail;




        return view('leaderboard.edit', $this->data);
    }




    public function leader_board_leader_update(Request $request, $id)
    {


        $leader_board = Leaderboard::find($id);



        if (!empty($leader_board)) {

            $leader_board->name = $request->name;
            $leader_board->office = $request->office;
            $leader_board->email = $request->email;

            $leader_board->status = 1;


            if($image = $request->file('agent_image'))
            {

                $destinationPath = $this->uploadPath;
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath."/", $profileImage);


                $leader_board->image = "$profileImage";

                $leader_board->save();
            }

            $leader_board->save();
        }



        return Redirect::back()->with('message', 'Leaderboard User Info has Been Updated Successfully.');

    }





    public function leader_board_detail_update(Request $request, $id)
    {



        $leader_detail = Leader_board_detail::find($id);


        if (!empty($leader_detail)) {

            $leader_detail->sale_value = $request->sale_value;
            $leader_detail->rent_value = $request->rent_value;
            $leader_detail->net_commission = $request->net_commission;
            $leader_detail->lead_source = $request->lead_source;
            $leader_detail->leader_detail = $request->description;


            $leader_detail->save();
        }

        return Redirect::back()->with('message', 'Lead Details has Been Updated Successfully.');


    }







    public function leader_store_detail_delete_tx(Request $request, $id, $leader_id)
    {
        $authkey = $request->authkey;
        if ($authkey == 'amani@edge@1315')
        {
            $data = Leader_board_detail::find($id);
            $data->is_trash = 1;
            $data->is_trash_auth = 'Mrs. Amani';
            $data->save();
            return Redirect::to('/leader_board/detail/'.$leader_id)->with('message', 'Lead Details has Been Updated Successfully.');
        }
        elseif ($authkey == 'as@edge@1315')
        {
            $data = Leader_board_detail::find($id);
            $data->is_trash = 1;
            $data->is_trash_auth = 'Mr. Ashraff';
            $data->save();
            return Redirect::to('/leader_board/detail/'.$leader_id)->with('message', 'Lead Details has Been Updated Successfully.');

        }

        elseif ($authkey == 'finance@edge@1513')
        {
            $data = Leader_board_detail::find($id);
            $data->is_trash = 1;
            $data->is_trash_auth = 'Accounts';
            $data->save();
            return Redirect::to('/leader_board/detail/'.$leader_id)->with('message', 'Lead Details has Been Updated Successfully.');

        }
        else
        {
            return Redirect::to('/leader_board/detail/'.$leader_id)->with('errormsg', 'Authentication error.');
        }

    }




    public function agent_earnings()
    {
        $user_type = Auth::user()->user_type;
        $id = Auth::user()->id;
        // dd($id);

        if ($user_type == 2)
        {
            $leader_board = Leaderboard::where('agent_id', $id )->first();

            $leader_detail = Leader_board_detail::where('is_trash', '!=', 1)->orWhereNull('is_trash')->where(  'leader_id' , $leader_board->id )->orderby('id' , 'DESC')->get();

            $leader_net_commision = Leader_board_detail::where('leader_id', $leader_board->id)->sum('net_commission');

            $this->data['leader_net_commision'] = $leader_net_commision;

            $this->data['leader_board'] = $leader_board;

            $this->data['leader_detail'] = $leader_detail;

            $this->data['user_id'] = $id;

            return view('agent_earnings.show', $this->data );
        }
        else {
            return Redirect::back()->with('error', 'You are not a verified user for this action');
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
}
