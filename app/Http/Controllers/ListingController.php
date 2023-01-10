<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Listing;
use App\Models\Models\Listing_image;
use App\Models\Models\listing_floor_plan;
use App\Models\Models\listing_document;
use App\Models\Models\listing_video;

use App\Models\Models\Listing_communities;
use App\Models\Models\Listing_emirates;
use App\Models\Models\Listing_developers;
use App\Models\Models\Users;
use Auth;
use Exception;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Pagination\Paginator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\File;


class ListingController extends Controller
{

    private $uploadpathimg= "uploads/listings/img";
    private $uploadpathdocx= "uploads/listings/docx";
    private $uploadpathfloorplans= "uploads/listings/floor_plans";
    private $uploadpathvid= "uploads/listings/vid";

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function __construct()
    {

        $this->middleware('auth')->except('temporary_update');
    }

    public function index()
    {


        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['agent'] = Users::where('status','1')->get();

        if ( $user_id == '1') {


            $listings = Listing::with('users')->where( 'is_trash' , 0 )->orderby('updated_at','DESC')->paginate(30);
            $communities = Listing_communities::orderby('name','ASC')->get();
            $emirates = Listing_emirates::all();
            $developers = Listing_developers::all();
            $agents = Users::where('user_type', '2')->get();
        }

        //return $leads;

        $this->data['listings'] = $listings;
        $this->data['communities'] = $communities;
        $this->data['developers'] = $developers;
        $this->data['emirates'] = $emirates;
        $this->data['agents'] = $agents;
        // dd($listings);

        return view('listing.show', $this->data);
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



        //old code
            // dd($request->file('img_group_a'));

            // $count = [];
            // foreach($request->img_group_a as $image)
            // {
            //     // $imageval = $image['photo_other_img'];
            //     // $validatedData = $imageval->validate([
            //     //     'photo_other_img' => 'nullable|jpg|max:2048',
            //     // ]);

            //     // if($validatedData->fails())
            //     // {
            //     //     dd('fails');
            //     //     // return response()->json(array(
            //     //     //     'success' => false,
            //     //     //     'errors' => $validatedData->getMesseageBag()->toArray()
            //     //     // ), 400);
            //     // };

            //     // Validator::validate($image, [
            //     //     'photo_other_img' => [
            //     //         'nullable',
            //     //         File::image()
            //     //             ->max(12 * 1024),
            //     //     ],
            //     // ]);
            //     // $listing_id = 1;



            //     $image_name = $image['photo_other_img']->getClientOriginalName();
            //     $image_title = $image['photo_other_title'];
            //     $path = $this->uploadpathimg;
            //     $image['photo_other_img']->move($path."/"."$listing_id/", $image_name);
            //     // $path = $image['photo_other_img']->store('  public/listing/img');

            //     array_push($count, $image_name, $image_title);
            //     // dd($count);
            // }
            // dd('file stored');
            // return Redirect::back()->with('message','Listing Created Successfully.');


            // dd($request->all());
            // dd($request->img_group_a);
            // dd($request->img_group_a[0]['photo_other_img']);
            // foreach($request->img_group_a as $image)
            // {
            //     // echo $image['photo_other_img'];

            //     if($image['photo_other_img'])
            //     {
            //         dd($image['photo_other_img']);
            //     }
            //     else{
            //         dd($image);
            //     }
            // }
        //old code


        //Use a try catch statement to handle any further database error that pop-ups for user simplicity.
        try {

            //Eloquent ----- create a new listing record
            $listing = new Listing();

            //assign the requests into the attributes
            $listing->type = $request->type;
            $listing->purpose = $request->purpose;
            $listing->location = $request->location;
            $listing->emirates = $request->emirates;
            $listing->community = $request->community;
            $listing->unit = $request->unit;

            $listing->views = $request->views;
            $listing->external_reference = $request->external_reference;
            $listing->rent = $request->rent;
            $listing->frequency = $request->frequency;
            $listing->annual_commission = $request->annual_commission2;
            $listing->beds = $request->beds;

            $listing->baths = $request->baths;
            $listing->parking = $request->parking;
            $listing->year_of_built = $request->year_of_built;
            $listing->developer = $request->developer;
            $listing->plot_area = $request->plot_area;
            $listing->area = $request->area;

            $listing->deposit = $request->deposit2;
            $listing->cheques = $request->cheques;
            $listing->title = $request->title;
            $listing->description = $request->description;
            $listing->lsm = $request->lsm;
            $listing->transaction = $request->transaction;

            $listing->permit = $request->permit;
            $listing->permit_expiry = $request->permit_expiry;
            $listing->landlord = $request->landlord;
            $listing->assign_to = $request->assign_to;
            $listing->status = $request->status;
            $listing->note = $request->note;

            // Portals
            $listing->bayut = $request->bayut;
            $listing->property_finder = $request->property_finder;
            $listing->dubizzle = $request->dubizzle;
            $listing->generic = $request->generic;


            $listing->is_trash = 0;

            //Save the new listing record
            $listing->save();


        } catch (\Exception $e) {

            //return a user friendly error message
            $e->getMessage();
            return Redirect::back()->with('error', $e->getMessage());
        }



        /**
         *
         * Image upload and store
         *
         */
        $listing_id = $listing->id;


        //Main Photo
        if ($request->hasFile('photo_main_file'))
        {
            // dd($request->photo_main_file);
            $image = $request->photo_main_file;
            $image_name = $image->getClientOriginalName();
            $image_title = $request->photo_main_title;
            $path = $this->uploadpathimg;
            $ext = 'edgerealty_';
            $image_name_ext = $ext . $image_name;
            $image->move($path."/"."$listing_id/", $image_name_ext);
            // $path = $image['photo_other_img']->store('public/listing/img');

            // array_push($count, $image_name, $image_title);

            $listingImg = new Listing_image;
            $listingImg->listing_id = $listing_id;
            $listingImg->image = $image_name;
            $listingImg->is_default = 1;
            $listingImg->save();
        }


        //Additional Photos
        if ($request->hasFile('img_group_a')) {
            $count = [];
            foreach ($request->img_group_a as $image) {
                $image_name = $image['photo_other_img']->getClientOriginalName();
                $image_title = $image['photo_other_title'];
                $path = $this->uploadpathimg;
                $image['photo_other_img']->move($path."/"."$listing_id/", $image_name);
                // $path = $image['photo_other_img']->store('  public/listing/img');

                array_push($count, $image_name, $image_title);

                $listingImg = new Listing_image;
                $listingImg->listing_id = $listing_id;
                $listingImg->image = $image_name;
                $listingImg->is_default = 0;
                $listingImg->save();
                // dd($count);
            }
        }


        /**
         *
         * Floor_plan upload
         *
         */

        if ($request->hasFile('floor_group_a')) {
            $count = [];
            foreach ($request->floor_group_a as $image) {
                $image_name = $image['floor_plan_img']->getClientOriginalName();
                $image_title = $image['floor_plan_title'];
                $path = $this->uploadpathfloorplans;
                $ext = 'edgerealty_';
                $image_name_ext = $ext . $image_name;
                $image['floor_plan_img']->move($path."/"."$listing_id/", $image_name_ext);

                array_push($count, $image_name, $image_title);

                $listingImg = new Listing_floor_plan;
                $listingImg->listing_id = $listing_id;
                $listingImg->floor_plan = $image_name_ext;
                $listingImg->save();
            }
        }




        /**
         *
         * Document upload
         *
         */

        if ($request->hasFile('docx_group_a')) {
            $count = [];
            foreach ($request->docx_group_a as $image) {
                $image_name = $image['document_file']->getClientOriginalName();
                $image_title = $image['document_name'];
                $path = $this->uploadpathdocx;
                $ext = 'edgerealty_';
                $image_name_ext = $ext . $image_name;
                $image['document_file']->move($path."/"."$listing_id/", $image_name_ext);

                array_push($count, $image_name, $image_title);

                $listingImg = new Listing_document;
                $listingImg->listing_id = $listing_id;
                $listingImg->document = $image_name_ext;
                $listingImg->save();
            }
        }


        /**
         *
         * Video upload
         *
         */
        // dd($request->vid_group_a[0]['vid_name']);
        if ($request->vid_group_a[0]['vid_name']) {
            $count = [];

            // dd($request->vid_group_a);
            foreach ($request->vid_group_a as $vid) {
                // dd($vid['vid_link']);
                $vid_name = $vid['vid_name'];
                $vid_link = $vid['vid_link'];
                $vid_host = $vid['vid_host'];

                $listingVid = new Listing_video;
                $listingVid->listing_id = $listing_id;
                $listingVid->vid_name = $vid_name;
                $listingVid->vid_link = $vid_link;
                $listingVid->vid_host = $vid_host;
                $listingVid->save();
            }
        }














        return Redirect::back()->with('message','Listing Created Successfully.');

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

    public function customize_store(Request $request)
    {
        // we need to check of both the two request values are available due to 1:M relationship applied on the table
        if(!empty($request->community) && !empty($request->emirate))
        {
            $data = Listing_communities::all();

            try {

                // go through all the records one by one
                foreach($data as $row) {

                    // if the name matches, do the following and break the loop
                    if ($row->name == $request->name)
                    {
                        return Redirect::back()->with('error','Community name already exists.');
                        break;
                    }
                }

                // if all checks fine then create a new record
                $community = new Listing_communities();
                $community->name = $request->community;
                $community->emirates_id = $request->emirate;
                $community->save();

            }catch (\ Exception $e) {
                // return user friendly error message
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
        }

        // check if the request name is available
        if(!empty($request->developer))
        {
            $data2 = Listing_developers::all();

            // go through all the records one by one
            foreach($data2 as $row) {

                // if the name matches, do the following and break
                if ($row->name == $request->name)
                {
                    return Redirect::back()->with('error','Developer name already exists.');
                    break;
                }
            }

            // else create a new record
            $developer = new Listing_developers();
            $developer->name = $request->developer;
            $developer->save();
        }

        // retrieve the two newly created records for
        $comm = Listing_communities::where('name', $request->name)->get();
        $dev = Listing_developers::where('name', $request->name)->get();
        if (!empty($dev) || !empty($comm))
        {
            return Redirect::back()->with('message','Listing customizations applied successfully.');
        }
        else
        {
            return Redirect::back()->with('error','Something went wrong! No Details were detected.');

        }
    }








    public function developer_update(Request $request, $id)
    {
        $developer = Listing_developers::find($id);

        if(!empty($developer))
        {
            try {
                $developer->name = $request->developer;
                $developer->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Listing customizations applied successfully.');
        }
        return Redirect::back()->with('error','No Details were detected.');

    }







    public function community_update(Request $request, $id)
    {
        $community = Listing_communities::find($id);

        if(!empty($community))
        {
            try {
                $community->name = $request->community;
                $community->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Listing customizations applied successfully.');
        }
        return Redirect::back()->with('error','No Details were detected.');

    }






    public function community_delete($id)
    {
        $data = Listing_communities::find($id);
        if (!empty($data))
        {
            try {
                Listing_communities::destroy($id);
            }
            catch(\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Community Deleted Successfully.');
        }
        return Redirect::back()->with('error','The record does not exist. Refresh the page & try again.');
    }





    public function developer_delete($id)
    {
        $data = Listing_developers::find($id);
        if (!empty($data))
        {
            try {
                Listing_developers::destroy($id);
            }
            catch(\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Developer Deleted Successfully.');
        }
        return Redirect::back()->with('error','The record does not exist. Refresh the page & try again.');
    }







    public function search(Request $request)
    {


        $this->data['listing_communities'] = Listing_communities::orderby('id', 'desc')->get();

        $this->data['listing_developers'] = Listing_developers::orderby('id', 'desc')->get();

        $this->data['agent'] = Users::where('status','1')->get();


        $listings = Listing::with(['users' , 'Listing_developers', 'Listing_communities' ])->where( 'is_trash' , 0 );

        if($request->search != null){
            $listings = $listings->where('purpose', 'LIKE', "%{$request->search}%");
        }

        if($request->ref_number != null){
            $listings = $listings->where('id', $request->ref_number);
        }
        if($request->location != null){
            $listings = $listings->where('location', $request->location);
        }
        if($request->type != null){
            $listings = $listings->where('type', $request->type);
        }


        if( (($request->bed_min != null) && ($request->bed_max != null)) &&  ($request->bed_max >= $request->bed_min)){

            $listings = $listings->whereBetween('beds', [$request->bed_min, $request->bed_max]);
        }
        if( (($request->bed_min != null) && ($request->bed_max = null)) ){
            $listings = $listings->where('beds', $request->bed_min);
        }
        if( (($request->bed_min = null) && ($request->bed_max != null)) ){
            $listings = $listings->where('beds', $request->max);
        }


        if($request->frequency != null){
            $listings = $listings->where('frequency', $request->frequency);
        }
        if($request->agent != null){
            $listings = $listings->where('assign_to', $request->agent);
        }

        // $listings = $listings->orderby('id','DESC');

        // $listings = $listings->paginate(30);

        $this->data['request'] = $request->all();

        $communities = Listing_communities::orderby('name','ASC')->get();
        $emirates = Listing_emirates::all();
        $developers = Listing_developers::all();
        $agents = Users::where('user_type', '2')->get();

        $this->data['communities'] = $communities;
        $this->data['developers'] = $developers;
        $this->data['emirates'] = $emirates;
        $this->data['agents'] = $agents;

        $this->data['listings'] = $listings->get();

        return view('listing.show', $this->data);



    }










    public function listing_photos_upload(Request $request)
    {
        $path = storage_path('tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }
}
