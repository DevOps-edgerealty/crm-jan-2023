<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Log;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cache;

use App\Models\User;
use App\Models\Models\Users;
use App\Models\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use PhpParser\Node\Stmt\ElseIf_;

class UsersController extends Controller
{
    private $uploadPath = "public/assets/images/users";
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

        $user = Users::with('teams')->where('status', 1)->get();

        // $available_team_leaders = Users::with('teams')->where('team_leader', '!=', 1);

        // $available_team_members = Users::with('teams')->where('team_leader', '!=', 1)->orWhere('team_leader', '!=', 2);

        $team = Team::all();

        $this->data['user'] = $user;

        $this->data['team'] = $team;

        return view('users.show', $this->data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //

        return view('users.create');
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
            $Users = new User();


            $Users->name = $request->name;
            $Users->email = $request->email;
            $Users->phone = $request->phone;
            $Users->position = $request->position;
            $Users->phone = $request->phone;
            $Users->password = Hash::make($request->password);
            $Users->user_type = 2;
            $Users->status = 1;



            if($image = $request->file('agent_image'))
            {

                $destinationPath = $this->uploadPath;
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath."/", $profileImage);


                $Users->image = "$profileImage";

                $Users->save();
            }



            $Users->save();





            return redirect('users')->with('message','User has Been Generated Successfully.');


        }
        else
        {
            return redirect('users')->with('message','User is Already Exist.');

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
        $Users = Users::where('id', $id )->first();



        $this->data['Users'] = $Users;

        return view('users.edit' , $this->data);
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

        $Users = Users::find( $id );


        if (!empty($Users)) {

            $Users->name = $request->name;
            $Users->email = $request->email;
            $Users->phone = $request->phone;
            $Users->position = $request->position;
            $Users->phone = $request->phone;
            if($request->password != null){
                $Users->password = Hash::make($request->password);
            }
            $Users->user_type = 2;
             $Users->status = $request->status;



            if($image = $request->file('agent_image'))
            {

                $destinationPath = $this->uploadPath;
                $profileImage = date('YmdHis') . "." . $image->getClientOriginalExtension();
                $image->move($destinationPath."/", $profileImage);


                $Users->image = "$profileImage";

                $Users->save();
            }


            $Users->save();


        }

        return redirect('users')->with('message','User has Been Updated Successfully.');
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

    public function targets(Request $request, $id)
    {
        $Users = Users::find( $id );


        if (!empty($Users)) {

            $Users->target = $request->target;
            $Users->save();
        }

        return redirect('users')->with('message','User has Been Updated Successfully.');
    }






    public function userStatusUpdate(Request $request, $id){

        $users = Users::find( $id );

        if (!empty($users)) {

            try {
                $users->status = $request->status;
                $users->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
        }else {
                return Redirect::back()->with('error','User cannot be found!');
        }

        return redirect('users')->with('message','User has Been Updated Successfully.');

    }





    public function create_team(Request $request) {

        $user_type = Auth::user()->user_type;

        if ($user_type == 1)
        {


            /**
             *  Validation Check
             */
            $team_leader_check = Users::findOrFail($request->team_leader);
            $registered_name = Team::where('name', $request->team_name)->first();

            //validate team leader is a member
            // if ($request->team_leader == $request->team_member)
            // {
            //     return Redirect::back()->with('error','Validation Error - The Team Leader cannot be assigned as a Team Member');
            // }
            //validate team leader is already a leader
            if ($team_leader_check->team_leader == 1)
            {
                return Redirect::back()->with('error','Validation Error - Leader is already assigned to another team');
            }
            //validate team name
            elseif (!empty($registered_name))
            {
                if($registered_name->name === $request->team_name)
                {
                    return Redirect::back()->with('error','Validation Error - The team name already exists. Please use another name');
                }
            }


            // if ($request->create_team_group[0]['team_member'])
            // {

            //     foreach ($request->create_team_group as $team) {
            //         $member_id = $team['team_member'];

            //         $user = Users::findOrFail($member_id);

            //         if ($user->team_leader === 2)
            //         {
            //             return Redirect::back()->with('error-member', $user);
            //         }
            //     }
            // }






            // Create Team
            try {
                $result = new Team();
                $result->name = $request->team_name;
                $result->save();

                $team_id = $result->id;


            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            $team_name_status = 1;


            // Assign Team Leader
            try {
                $result = Users::findOrFail($request->team_leader);
                $result->team_leader = 1;
                $result->team_id = $team_id;
                $result->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error-leader', $team_name_status);
            }
            $team_leader_status = 1;




            // Assign Team
            // try {
            //     // dd($request);
            //     if ($request->create_team_group[0]['team_member'])
            //     {

            //         foreach ($request->create_team_group as $team) {
            //             $member_id = $team['team_member'];

            //             Users::where('id',$member_id)
            //             ->update([
            //                 'team_leader'=>'2',
            //                 'team_id' => $team_id
            //             ]);
            //         }
            //     }
            //     else {
            //         dd($request);
            //     }
            // }
            // catch (\Exception $e)
            // {
            //     return Redirect::back()->with('error-team', $team_leader_status);
            // }
        }
        else{
            return Redirect::back()->with('error', 'You are not authorized to perform this action');
        }

        return Redirect::back()->with('message','Team has Been successfully Created');
    }





    public function add_to_team(Request $request, $id)
    {
        $user_type = Auth::user()->user_type;
        if($user_type == 1)
        {
            /**
             *  Validation Check
             */
            if ($request->team_id == '1315@2015')
            {
                try {
                    $result = Users::findOrFail($id);
                    $result->team_leader = 0;
                    $result->team_id = null;
                    $result->save();

                } catch (\Exception $e)
                {
                    return Redirect::back()->with('error-leader', 'Could not remove user. Contact administrator!');
                }
                return redirect('users')->with('message','User has been removed from the team successfully');
            }

            //validate team name
            if (empty($request->team_id))
            {
                return Redirect::back()->with('error', 'Select a team first');
            }
            else {
                $result = Users::findOrFail($id);
                $result->team_leader = 2;
                $result->team_id = $request->team_id;
                $result->save();
                return redirect('users')->with('message','User has been added to the team successfully');
            }
        }
        else{
            return Redirect::back()->with('error', 'You are not authorized to perform this action');
        }
    }







    public function manage_team(Request $request) {
        $user_id = Auth::user()->user_type;

        if($user_id == 1)
        {
            try {
                $team_data = Team::where('id', $request->team_id)->get();

                if ($request->team_name != null) {
                    $team_data->name = $request->team_name;
                    $team_data->save();

                }
                elseif ($request->team_status == 1)
                {
                    $user_data = Users::where('team_id', $request->team_id);
                    foreach($user_data as $data)
                    {
                        $data->team_id = null;
                        $data->team_leader = 0;
                        $data->save();
                    }
                    $team_data->delete();
                }

            } catch (\Exception $e)
            {
                return Redirect::back()->with('error-leader', 'Could make the necessary changes. Contact administrator!');
            }

            return redirect('users')->with('message','The changes are successfull');

        }
        else {
            return Redirect::back()->with('error', 'You are not authorized to perform this action');
        }
    }

}
