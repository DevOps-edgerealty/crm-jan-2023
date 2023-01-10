<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Models\Listings;
use App\Models\Models\Listing_image;
use App\Models\Models\listing_floor_plan;
use App\Models\Models\listing_document;
use App\Models\Models\listing_video;
use App\Models\Models\Listing_pf_category;
use App\Models\Models\Listing_pf_amenity;
use App\Models\Models\Listing_pf_community;
use App\Models\Models\Listing_pf_property_type;
use App\Models\Models\Listing_pf_sub_community;
use App\Models\Models\listing_pf_city;

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

class ListingController2 extends Controller
{
    private $uploadpathimg= "uploads/listings/img";
    private $uploadpathdocx= "uploads/listings/docx";
    private $uploadpathfloorplans= "uploads/listings/floor_plans";
    private $uploadpathvid= "uploads/listings/vid";



    public function __construct()
    {
        $this->middleware('auth')->except('temporary_update');
    }




    // Load Listing page
    public function index()
    {
        $user_id = Auth::user()->user_type;

        $id = Auth::user()->id;

        $this->data['agent'] = Users::where('status', '1')->get();

        if ($user_id == '1') {
            $listings = Listings::with('users')->where('is_trash', 0)->orderby('updated_at', 'DESC')->paginate(30);
            $communities = Listing_communities::orderby('name', 'ASC')->get();
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
        $this->data['pf_cities'] = null;
        // dd($listings);

        return view('listing2.show', $this->data);
    }









    public function showAddListingPage()
    {
        if (Auth::user()) {
            return view('listing2.addListing.page1');
        } else {
            Log::critical('Un-autorized user tried to access Add-Listing page!');
            return Redirect::back()->with('error', 'Your are not authorized!');
        }
    }





    public function addListingPage01(Request $request)
    {
        dd($request->pf);
    }






    public function page_three()
    {
        $listings = Listings::with('users')->where('is_trash', 0)->orderby('updated_at', 'DESC')->paginate(30);
        $communities = Listing_communities::orderby('name', 'ASC')->get();
        $emirates = Listing_emirates::all();
        $developers = Listing_developers::all();
        $agents = Users::where('user_type', '2')->get();

        $this->data['listings'] = $listings;
        $this->data['communities'] = $communities;
        $this->data['developers'] = $developers;
        $this->data['emirates'] = $emirates;
        $this->data['agents'] = $agents;

        return view('listing2.addListing.page3', $this->data);
    }



    public function page_four()
    {
        $listings = Listings::with('users')->where('is_trash', 0)->orderby('updated_at', 'DESC')->paginate(30);
        $communities = Listing_communities::orderby('name', 'ASC')->get();
        $emirates = Listing_emirates::all();
        $developers = Listing_developers::all();
        $agents = Users::where('user_type', '2')->get();

        $this->data['listings'] = $listings;
        $this->data['communities'] = $communities;
        $this->data['developers'] = $developers;
        $this->data['emirates'] = $emirates;
        $this->data['agents'] = $agents;

        return view('listing2.addListing.page4', $this->data);
    }








    public function customizeListing()
    {
        $listings = Listings::with('users')->where('is_trash', 0)->orderby('updated_at', 'DESC')->paginate(30);

        $communities = Listing_communities::orderby('name', 'ASC')->get();

        $emirates = Listing_emirates::all();

        $developers = Listing_developers::all();

        $agents = Users::where('user_type', '2')->get();

        $pf_category = Listing_pf_category::all();

        $pf_amenity = Listing_pf_amenity::all();

        $pf_property_type = Listing_pf_property_type::with('listing_pf_categories')->orderby('name', 'ASC')->get();

        $pf_sub_community = Listing_pf_sub_community::orderby('name', 'ASC')->get();

        $pf_community = Listing_pf_community::orderby('name', 'ASC')->get();




        $this->data['pf_categories'] = $pf_category;
        $this->data['pf_amenities'] = $pf_amenity;
        $this->data['pf_property_types'] = $pf_property_type;
        $this->data['pf_sub_communities'] = $pf_sub_community;
        $this->data['pf_communities'] = $pf_community;

        $this->data['listings'] = $listings;
        $this->data['communities'] = $communities;
        $this->data['developers'] = $developers;
        $this->data['emirates'] = $emirates;
        $this->data['agents'] = $agents;

        return view('listing2.customizeListing.show', $this->data);
    }






    public function customizeListing_category_store(Request $request)
    {
        $data = Listing_pf_category::all();

        try {
            // go through all the records one by one
            foreach ($data as $row) {
                // if the name matches, do the following and break the loop
                if ($row->name == $request->category) {
                    return Redirect::back()->with('error', 'Category name already exists.');
                }
            }

            // if all checks fine then create a new record
            $category = new Listing_pf_category();
            $category->name = $request->category;
            $category->save();
        } catch (\ Exception $e) {
            // return user friendly error message
            return Redirect::back()->with('error', 'Something went wrong in the Query! Please contact your administrator');
        }


        // retrieve the two newly created records for
        $cat = Listing_pf_category::where('name', $request->category)->get();
        if (!empty($cat)) {
            return Redirect::back()->with('message', 'Listing customizations applied successfully.');
        } else {
            return Redirect::back()->with('error', 'Something went wrong! No Details were detected.');
        }
    }








    public function customizeListing_property_type_store(Request $request)
    {
        $data = Listing_pf_property_type::all();

        try {
            // go through all the records one by one
            foreach ($data as $row) {
                // if the name matches, do the following and break the loop
                if ($row->name == $request->property_type) {
                    return Redirect::back()->with('error', 'Property type already exists.');
                }
            }

            // if all checks fine then create a new record
            $category = new Listing_pf_property_type();
            $category->name = $request->property_type;
            $category->category_id = $request->property_type_category;
            $category->save();
        } catch (\ Exception $e) {
            // return user friendly error message
            return Redirect::back()->with('error', 'Something went wrong in the Query! Please contact your administrator');
        }


        // retrieve the two newly created records for
        $cat = Listing_pf_property_type::where('name', $request->property_type)->get();
        if (!empty($cat)) {
            return Redirect::back()->with('message', 'Listing customizations applied successfully.');
        } else {
            return Redirect::back()->with('error', 'Something went wrong! No Details were detected.');
        }
    }












    public function customizeListing_property_type_update(Request $request, $id)
    {
        $pf_property_type = Listing_pf_property_type::find($id);

        if(!empty($pf_property_type))
        {
            try {
                $pf_property_type->name = $request->pf_property_type;
                $pf_property_type->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Listing customizations applied successfully.');
        }
        return Redirect::back()->with('error','No Details were detected.');

    }







    public function customizeListing_category_update(Request $request, $id)
    {
        $category = Listing_pf_category::find($id);

        if(!empty($category))
        {
            try {
                $category->name = $request->pf_category;
                $category->save();
            }
            catch (\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Listing customizations applied successfully.');
        }
        return Redirect::back()->with('error','No Details were detected.');
    }






    public function customizeListing_category_delete($id)
    {
        $data = Listing_pf_category::find($id);
        if (!empty($data))
        {
            try {
                Listing_pf_category::destroy($id);
            }
            catch(\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Category Deleted Successfully.');
        }
        return Redirect::back()->with('error','The record does not exist. Refresh the page & try again.');
    }





    public function customizeListing_property_type_delete($id)
    {
        $data = Listing_pf_property_type::find($id);
        if (!empty($data))
        {
            try {
                Listing_pf_property_type::destroy($id);
            }
            catch(\Exception $e)
            {
                return Redirect::back()->with('error','Something went wrong in the Query! Contact administrator');
            }
            return Redirect::back()->with('message','Property Type Deleted Successfully.');
        }
        return Redirect::back()->with('error','The record does not exist. Refresh the page & try again.');
    }

}
