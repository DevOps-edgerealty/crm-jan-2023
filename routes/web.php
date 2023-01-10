<?php

use Illuminate\Support\Facades\Route;

use App\Models\Models\Team;
use App\Models\Models\Member_team;
use App\Models\Models\Users;



/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/fetch-email', [App\Http\Controllers\FetchEmailController::class, 'index']);

Route::get('temporary_update', [App\Http\Controllers\LeadsController::class, 'temporary_update'])->name('temporary_update');

Route::get('property_listing_leads/temporary_update', [App\Http\Controllers\Property_leadController::class, 'temporary_update_portal'])->name('temporary_update_portal');

Route::get('website_leads/temporary_update', [App\Http\Controllers\Website_leadController::class, 'temporary_update'])->name('website_temporary_update');

Route::get('/facebook_lead_form', [App\Http\Controllers\Fetch_dataController::class, 'store'])->name('Store');



Auth::routes();

Route::get('/home', [App\Http\Controllers\FrontendController::class, 'index'])->name('dashboard');

Route::get('/', [App\Http\Controllers\FrontendController::class, 'index'])->name('dashboard-blank');

// Route::get('/', function() {
//     Log::critical('This is a critical message Sent from Laravel App');
//     return view('welcome');
// });
Route::get('/logout', function () {

    Auth::logout();

    return redirect('/login');

    })->name('logout');


    Route::get('/profile', [App\Http\Controllers\FrontendController::class, 'profile'])->name('leads');


//Listings
Route::get('/listings', [App\Http\Controllers\ListingController::class, 'index'])->name('listing');


// agent earnings
Route::get('/my-earnings', [App\Http\Controllers\LeaderboardController::class, 'agent_earnings'])->name('agent-earnings');



//campaign Leads

Route::get('/leads', [App\Http\Controllers\LeadsController::class, 'index'])->name('leads');

Route::get('/leads/create_leads', [App\Http\Controllers\LeadsController::class, 'create'])->name('create_leads');

Route::get('/leads/detail/{id}', [App\Http\Controllers\LeadsController::class, 'lead_details'])->name('lead_detail');

Route::Post('/leads/store', [App\Http\Controllers\LeadsController::class, 'store'])->name('leads');

Route::Post('/leads/lead_change_status', [App\Http\Controllers\LeadsController::class, 'lead_change_status'])->name('leads');

Route::Post('/leads/lead_store_detail', [App\Http\Controllers\LeadsController::class, 'lead_store_detail'])->name('lead_store_detail');

Route::Post('/leads/update/{id}', [App\Http\Controllers\LeadsController::class, 'update'])->name('update_leads');

Route::get('/leads/transfer/{id}', [App\Http\Controllers\LeadsController::class, 'transfer_lead'])->name('transfer_lead');

Route::Post('/leads/transfer_agent', [App\Http\Controllers\LeadsController::class, 'transfer_agent_lead'])->name('transfer_agent_lead');

Route::Post('/leads/temporary/reassign', [App\Http\Controllers\LeadsController::class, 'reassign_agent'])->name('reassign_agent');

Route::get('/leads/transfer_temporary/{id}', [App\Http\Controllers\LeadsController::class, 'transfer_temporary'])->name('transfer_temporary');

Route::get('/leads/transfer_trash/{id}', [App\Http\Controllers\LeadsController::class, 'transfer_lead_trash'])->name('transfer_lead_trash');

Route::get('/leads/move_recycle/{id}', [App\Http\Controllers\LeadsController::class, 'move_recycle_lead'])->name('move_recycle_lead');

Route::get('/leads/move_trash/{id}', [App\Http\Controllers\LeadsController::class, 'move_trash_lead'])->name('move_trash_lead');

Route::get('/leads/move_closed_leads/{id}', [App\Http\Controllers\LeadsController::class, 'move_closed_leads'])->name('move_closed_leads');

Route::get('/leads/edit/{id}', [App\Http\Controllers\LeadsController::class, 'edit'])->name('edit_leads');

Route::get('recycle_leads', [App\Http\Controllers\LeadsController::class, 'recycle_leads'])->name('recylce_leads');

Route::get('trash_leads', [App\Http\Controllers\LeadsController::class, 'trash_leads'])->name('trash_leads');

Route::get('closed_deal_leads', [App\Http\Controllers\LeadsController::class, 'closed_deal_leads'])->name('closed_deal_leads');

Route::get('temporary_leads', [App\Http\Controllers\LeadsController::class, 'temporary_leads'])->name('temporary_leads');

Route::get('importExportView', [App\Http\Controllers\LeadsController::class, 'importExportView'])->name('importExportView');

Route::POST('mass_recycle_leads', [App\Http\Controllers\LeadsController::class, 'mass_recycle_leads'])->name('mass_recycle_leads');






// Recycle Search
Route::get('recycle_leads/search', [App\Http\Controllers\LeadsController::class, 'recycle_search_campaign'])->name('recycle-search');

Route::get('property_listing/recycle_leads/search', [App\Http\Controllers\Property_leadController::class, 'recycle_search_portal'])->name('recycle-search-portal');

Route::get('website_leads/recycle_leads/search', [App\Http\Controllers\Website_leadController::class, 'recycle_search_website'])->name('recycle-search-website');







Route::get('/leads/search', [App\Http\Controllers\LeadsController::class, 'search'])->name('search');

Route::get('/leads/search_agent', [App\Http\Controllers\LeadsController::class, 'search_agent'])->name('search_agent');

Route::Post('import', [App\Http\Controllers\LeadsController::class, 'import'])->name('import');


//Property_lead

Route::get('/property_listing', [App\Http\Controllers\Property_leadController::class, 'index'])->name('leads');

Route::get('/property_listing/create_property_leads', [App\Http\Controllers\Property_leadController::class, 'create'])->name('create_leads');

Route::get('/property_listing/detail/{id}', [App\Http\Controllers\Property_leadController::class, 'property_listing_details'])->name('property_listing_detail');

Route::Post('/property_listing/store', [App\Http\Controllers\Property_leadController::class, 'store'])->name('leads');

Route::Post('/property_listing_leads/lead_store_detail', [App\Http\Controllers\Property_leadController::class, 'portal_lead_store_detail'])->name('lead_store_detail');

Route::Post('/property_listing_leads/update/{id}', [App\Http\Controllers\Property_leadController::class, 'update'])->name('update_leads');

Route::get('/property_listing_leads/edit/{id}', [App\Http\Controllers\Property_leadController::class, 'edit'])->name('edit_leads');

Route::get('/property_listing_leads/transfer/{id}', [App\Http\Controllers\Property_leadController::class, 'transfer_lead'])->name('transfer_lead');

Route::Post('/property_listing_leads/transfer_agent', [App\Http\Controllers\Property_leadController::class, 'transfer_agent_lead'])->name('transfer_agent_lead');

Route::Post('/property_listing_leads/temporary/reassign', [App\Http\Controllers\Property_leadController::class, 'reassign_agent'])->name('reassign_agent');

Route::get('/property_listing_leads/transfer_trash/{id}', [App\Http\Controllers\Property_leadController::class, 'transfer_lead_trash'])->name('transfer_lead_trash');

Route::get('/property_listing_leads/move_recycle/{id}', [App\Http\Controllers\Property_leadController::class, 'move_recycle_lead'])->name('move_recycle_lead');

Route::get('/property_listing_leads/move_trash/{id}', [App\Http\Controllers\Property_leadController::class, 'move_trash_lead'])->name('move_trash_lead');

Route::get('/property_listing_leads/move_closed_deal/{id}', [App\Http\Controllers\Property_leadController::class, 'move_closed_deal'])->name('move_closed_deal');

Route::get('/property_listing_leads/transfer_temporary/{id}', [App\Http\Controllers\Property_leadController::class, 'transfer_temporary'])->name('transfer_temporary');

Route::get('/property_listing_leads/recycle_leads', [App\Http\Controllers\Property_leadController::class, 'recycle_leads'])->name('recylce_leads');

Route::get('/property_listing_leads/temporary_leads', [App\Http\Controllers\Property_leadController::class, 'temporary_leads'])->name('temporary_leads');

Route::get('property_trash_leads', [App\Http\Controllers\Property_leadController::class, 'property_trash_leads'])->name('property_trash_leads');

Route::get('property_listing_leads/closed_deal_leads', [App\Http\Controllers\Property_leadController::class, 'closed_deal_leads'])->name('closed_deal_leads');

Route::Post('/property_listing_leads/lead_change_status', [App\Http\Controllers\Property_leadController::class, 'lead_change_status'])->name('leads');

Route::get('/property_listing/search', [App\Http\Controllers\Property_leadController::class, 'search'])->name('search');

// Route::get('/leads/transfer/{id}', [App\Http\Controllers\LeadsController::class, 'transfer_lead'])->name('transfer_lead');


//website_lead

Route::get('/website', [App\Http\Controllers\Website_leadController::class, 'index'])->name('leads');

Route::get('/website/create_website_leads', [App\Http\Controllers\Website_leadController::class, 'create'])->name('create_leads');

Route::get('/website/detail/{id}', [App\Http\Controllers\Website_leadController::class, 'website_details'])->name('website_detail');

Route::Post('/website/store', [App\Http\Controllers\Website_leadController::class, 'store'])->name('leads');

Route::Post('/website_leads/lead_store_detail', [App\Http\Controllers\Website_leadController::class, 'website_lead_store_detail'])->name('lead_store_detail');

Route::Post('/website_leads/update/{id}', [App\Http\Controllers\Website_leadController::class, 'update'])->name('update_leads');

Route::get('/website_leads/edit/{id}', [App\Http\Controllers\Website_leadController::class, 'edit'])->name('edit_leads');

Route::get('/website_leads/transfer/{id}', [App\Http\Controllers\Website_leadController::class, 'transfer_lead'])->name('transfer_lead');

Route::Post('/website_leads/transfer_agent', [App\Http\Controllers\Website_leadController::class, 'transfer_agent_lead'])->name('transfer_agent_lead');

Route::Post('/website_leads/temporary/reassign', [App\Http\Controllers\Website_leadController::class, 'reassign_agent'])->name('reassign_agent');

Route::get('/website_leads/transfer_trash/{id}', [App\Http\Controllers\Website_leadController::class, 'transfer_lead_trash'])->name('transfer_lead');

Route::get('/website_leads/move_recycle/{id}', [App\Http\Controllers\Website_leadController::class, 'move_recycle_lead'])->name('move_recycle_lead');

Route::get('/website_leads/move_trash/{id}', [App\Http\Controllers\Website_leadController::class, 'move_trash_lead'])->name('move_recycle_lead');

Route::get('/website_leads/move_closed/{id}', [App\Http\Controllers\Website_leadController::class, 'move_closed_leads'])->name('move_recycle_lead');

Route::get('website_trash_leads', [App\Http\Controllers\Website_leadController::class, 'website_trash_leads'])->name('website_trash_leads');

Route::get('/website_leads/recycle_leads', [App\Http\Controllers\Website_leadController::class, 'recycle_leads'])->name('recylce_leads');

Route::get('website_leads/closed_deal_leads', [App\Http\Controllers\Website_leadController::class, 'closed_deal_leads'])->name('closed_deal_leads');

Route::get('website_leads/temporary_leads', [App\Http\Controllers\Website_leadController::class, 'temporary_leads'])->name('temporary_leads');

Route::get('/website_leads/search', [App\Http\Controllers\Website_leadController::class, 'search'])->name('search');

Route::Post('/website_leads/lead_change_status', [App\Http\Controllers\Website_leadController::class, 'lead_change_status'])->name('leads');

Route::get('/website_leads/transfer_temporary/{id}', [App\Http\Controllers\Website_leadController::class, 'transfer_temporary'])->name('transfer_temporary');



// Route::get('/leads/transfer/{id}', [App\Http\Controllers\LeadsController::class, 'transfer_lead'])->name('transfer_lead');

Route::get('importExportView_website', [App\Http\Controllers\Website_leadController::class, 'importExportView_website'])->name('importExportView');

Route::Post('import_website', [App\Http\Controllers\Website_leadController::class, 'import_website'])->name('import');



//Annoucments
Route::get('/annoucments', [App\Http\Controllers\AnnouncementsController::class, 'index'])->name('annoucments');

Route::get('/annoucments/create_annoucments', [App\Http\Controllers\AnnouncementsController::class, 'create'])->name('create_annoucments');

Route::Post('/annoucments/store', [App\Http\Controllers\AnnouncementsController::class, 'store'])->name('annoucments');

Route::get('/annoucments/edit/{id}', [App\Http\Controllers\AnnouncementsController::class, 'edit'])->name('edit_annoucments');

Route::Post('/annoucments/update/{id}', [App\Http\Controllers\AnnouncementsController::class, 'update'])->name('update_annoucments');




// Campagins

Route::get('/campaign', [App\Http\Controllers\CampaignController::class, 'index'])->name('campaign');

Route::Post('/campaign/store', [App\Http\Controllers\CampaignController::class, 'store'])->name('store_campaign');

Route::Post('/campaign/update/{id}', [App\Http\Controllers\CampaignController::class, 'update'])->name('update_campaign');

Route::get('/campaign/edit/{id}', [App\Http\Controllers\CampaignController::class, 'edit'])->name('edit_campaign');

Route::get('/campaign/create_campaign', [App\Http\Controllers\CampaignController::class, 'create'])->name('create_campaign');


//User
Route::get('/users', [App\Http\Controllers\UsersController::class, 'index'])->name('user');

Route::get('/users/create_user', [App\Http\Controllers\UsersController::class, 'create'])->name('user_create');

Route::Post('/users/add-to-team/{id}', [App\Http\Controllers\UsersController::class, 'add_to_team'])->name('user_add_to_team');

Route::Post('/users/create-team', [App\Http\Controllers\UsersController::class, 'create_team'])->name('user_create_team');

Route::Post('/users/manage-team', [App\Http\Controllers\UsersController::class, 'manage_team'])->name('user_manage_team');

Route::Post('/users/store', [App\Http\Controllers\UsersController::class, 'store'])->name('store_user');

Route::get('/users/edit/{id}', [App\Http\Controllers\UsersController::class, 'edit'])->name('edit_users');

Route::Post('/users/update/{id}', [App\Http\Controllers\UsersController::class, 'update'])->name('update_users');

Route::Post('/users/status/update/{id}', [App\Http\Controllers\UsersController::class, 'userStatusUpdate'])->name('update_users_status');

Route::Post('/users/targets/{id}', [App\Http\Controllers\UsersController::class, 'targets'])->name('update_targets');



// Registration Routes...
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');


// Leader Board Routes...
Route::get('/leader_board', [App\Http\Controllers\LeaderboardController::class, 'index'])->name('leader_board');

Route::get('/leader_board/monthly_ranking', [App\Http\Controllers\LeaderboardController::class, 'monthly_ranking'])->name('monthly_ranking');


Route::Post('/leader_board/monthly_ranking_by_month', [App\Http\Controllers\StatisticsController::class, 'monthly_ranking_by_month'])->name('monthly_ranking_by_month');

Route::get('/leader_board/monthly_ranking_by_month', [App\Http\Controllers\StatisticsController::class, 'monthly_ranking_by_month'])->name('monthly_ranking_by_month');


Route::get('/leader_board/create_leader', [App\Http\Controllers\LeaderboardController::class, 'create'])->name('create_leader_board');

Route::Post('/leader_board/store', [App\Http\Controllers\LeaderboardController::class, 'store'])->name('store_leader_board');

Route::Post('/leader_board/delete/{id}', [App\Http\Controllers\LeaderboardController::class, 'delete'])->name('delete_leader_board');

Route::get('/leader_board/detail/{id}', [App\Http\Controllers\LeaderboardController::class, 'leader_board_detail'])->name('leader_board_detail');

Route::get('/leader_board/detail/edit_leader/{id}', [App\Http\Controllers\LeaderboardController::class, 'leader_board_detail_edit_leader'])->name('leader_board_leader_edit'); //---------Tuan

Route::Post('/leader_board/detail/update_leader/{id}', [App\Http\Controllers\LeaderboardController::class, 'leader_board_leader_update'])->name('leader_board_leader_update'); //---------Tuan

Route::get('/leader_board/detail/edit/{id}', [App\Http\Controllers\LeaderboardController::class, 'leader_board_detail_edit'])->name('leader_board_detail_edit');

Route::Post('/leader_board/detail/update/{id}', [App\Http\Controllers\LeaderboardController::class, 'leader_board_detail_update'])->name('leader_board_detail_update');

Route::Post('/leader_board/leader_store_detail', [App\Http\Controllers\LeaderboardController::class, 'leader_store_detail'])->name('leader_store_detail');

Route::Post('/leader_board/detail/delete/{id}/{leader_id}', [App\Http\Controllers\LeaderboardController::class, 'leader_store_detail_delete_tx'])->name('leader_store_detail_delete_tx');



//listing

Route::get('/listing', [App\Http\Controllers\ListingController::class, 'index'])->name('listing');

Route::get('/listing2', [App\Http\Controllers\ListingController2::class, 'index'])->name('listing');

Route::get('/listing2/add-listing/page-two', function () {

    return view('listing2.addListing.page2');

})->name('add-listing-page-two');

Route::get('/listing2/add-listing/page-three', [App\Http\Controllers\ListingController2::class, 'page_three'])->name('add-listing-page-three');

Route::get('/listing2/add-listing/page-four', [App\Http\Controllers\ListingController2::class, 'page_four'])->name('add-listing-page-four');

Route::Post('/listing2/page-one', [App\Http\Controllers\ListingController2::class, 'addListingPage01'])->name('add-listing-page-one'); //push data of page 01 into controller


// cutomize listing
Route::get('/listing2/customize-listing', [App\Http\Controllers\ListingController2::class, 'customizeListing'])->name('cutomize-listing');

Route::post('/listing_pf_customize/category/store', [App\Http\Controllers\ListingController2::class, 'customizeListing_category_store'])->name('cutomize-listing-category-store');

Route::post('/listing_pf_customize/category/update/{id}', [App\Http\Controllers\ListingController2::class, 'customizeListing_category_update'])->name('cutomize-listing-category-update');

Route::post('/listing_pf_customize/category/delete/{id}', [App\Http\Controllers\ListingController2::class, 'customizeListing_category_delete'])->name('cutomize-listing-category-delete');


Route::post('/listing_pf_customize/property_type/store', [App\Http\Controllers\ListingController2::class, 'customizeListing_property_type_store'])->name('cutomize-listing-property-store');

Route::post('/listing_pf_customize/property_type/update/{id}', [App\Http\Controllers\ListingController2::class, 'customizeListing_property_type_update'])->name('cutomize-listing-property-update');

Route::post('/listing_pf_customize/property_type/delete/{id}', [App\Http\Controllers\ListingController2::class, 'customizeListing_property_type_delete'])->name('cutomize-listing-property-delete');




Route::get('/listing2/add-listing/page-one', [App\Http\Controllers\ListingController2::class, 'showAddListingPage'])->name('show-add-listing-page');

Route::get('/listing/search', [App\Http\Controllers\ListingController::class, 'search'])->name('listing_search');

Route::Post('/listing/store', [App\Http\Controllers\ListingController::class, 'store'])->name('listing_store');

Route::Post('/listing_customize/store', [App\Http\Controllers\ListingController::class, 'customize_store'])->name('listing_customize_store');

Route::Post('/listing_developer/update/{id}', [App\Http\Controllers\ListingController::class, 'developer_update'])->name('listing_developer_update');

Route::Post('/listing_developer/delete/{id}', [App\Http\Controllers\ListingController::class, 'developer_delete'])->name('listing_developer_delete');

Route::Post('/listing_community/update/{id}', [App\Http\Controllers\ListingController::class, 'community_update'])->name('listing_community_update');

Route::Post('/listing_community/delete/{id}', [App\Http\Controllers\ListingController::class, 'community_delete'])->name('listing_community_delete');

Route::Post('/listing_community/photos/upload_media', [App\Http\Controllers\ListingController::class, 'listing_photos_upload_media'])->name('listing_photos_upload_media');

Route::Post('/listing_community/photos/upload', [App\Http\Controllers\ListingController::class, 'listing_photos_upload'])->name('listing_photos_upload');




//Shendy's Team
Route::get('/team', [App\Http\Controllers\TeamController::class, 'index'])->name('team-campaign');

Route::get('/team/detail/{id}', [App\Http\Controllers\TeamController::class, 'team_details'])->name('team-detail');

Route::get('/team/search', [App\Http\Controllers\TeamController::class, 'search'])->name('team-search');

Route::get('/team/portal_leads', [App\Http\Controllers\TeamController::class, 'portal'])->name('team-portal');

Route::get('/team/portal_leads/detail/{id}', [App\Http\Controllers\TeamController::class, 'portal_details'])->name('team-portal-details');

Route::get('/team/portal/search', [App\Http\Controllers\TeamController::class, 'portal_search'])->name('team-portal-search');

Route::get('/team/website_leads', [App\Http\Controllers\TeamController::class, 'website'])->name('team-website');

Route::get('/team/website_leads/details/{id}', [App\Http\Controllers\TeamController::class, 'website_details'])->name('team-website_details');

Route::get('/team/website/search', [App\Http\Controllers\TeamController::class, 'website_search'])->name('team-search');

Route::get('/team/manage-team', [App\Http\Controllers\TeamController::class, 'manage_team'])->name('manage-team');

Route::POST('/team/delete-team/{id}', [App\Http\Controllers\TeamController::class, 'delete_team'])->name('delete-team');






//Analytics Admin
Route::get('/statistics', [App\Http\Controllers\StatisticsController::class, 'index'])->name('stats-index');

Route::get('/statistics/leads-vs-income', [App\Http\Controllers\StatisticsController::class, 'lead_vs_income'])->name('stats-leads-vs-income');

Route::Post('/statistics/leads-vs-income/search', [App\Http\Controllers\StatisticsController::class, 'lead_vs_income_search'])->name('stats-leads-vs-income-search');

Route::get('/statistics/search', [App\Http\Controllers\StatisticsController::class, 'search'])->name('stats-search');

Route::get('/statistics/msearch', [App\Http\Controllers\StatisticsController::class, 'search'])->name('stats-search');

Route::get('/statistics/monthly_ranking', [App\Http\Controllers\StatisticsController::class, 'monthly_ranking_index'])->name('stats-monthly-ranking');

Route::Post('/statistics/monthly_ranking_by_month', [App\Http\Controllers\StatisticsController::class, 'monthly_ranking_by_month'])->name('monthly_ranking_by_month');

Route::get('/statistics/lead_source', [App\Http\Controllers\StatisticsController::class, 'lead_source_index'])->name('lead_source_ranking');

Route::Post('/statistics/lead_source_ranking_by_month', [App\Http\Controllers\StatisticsController::class, 'lead_source_search'])->name('lead_source_search');

Route::get('/statistics/lead_source_ranking_by_month/sources/{source}/{month}', [App\Http\Controllers\StatisticsController::class, 'leader_detail_sources'])->name('leader_detail_sources');




// Analytics Agents
Route::get('/my-statistics', [App\Http\Controllers\StatisticsController::class, 'lead_vs_income_agents'])->name('stats-leads-vs-income-agents');





// All Leads
Route::get('/all_leads', [App\Http\Controllers\AllLeadsController::class, 'index'])->name('all-leads-index');

Route::get('/all_leads/search', [App\Http\Controllers\AllLeadsController::class, 'search'])->name('all-leads-index-search');

Route::get('/my_leads/search', [App\Http\Controllers\AllLeadsController::class, 'closed_search'])->name('my-closed-leads-search');

Route::get('/all_recycle', [App\Http\Controllers\AllLeadsController::class, 'recycle_index'])->name('all-leads-recycle');

Route::get('/all_recycle/search', [App\Http\Controllers\AllLeadsController::class, 'recycle_search'])->name('all-leads-recycle-search');

Route::get('/all_temporary', [App\Http\Controllers\AllLeadsController::class, 'temp_index'])->name('all-leads-temp-index');

Route::get('/my_deals', [App\Http\Controllers\AllLeadsController::class, 'all_deals'])->name('all-deals-index-agent');

Route::get('/all_deals', [App\Http\Controllers\AllLeadsController::class, 'all_deals_admin'])->name('all-deals-index-admin');


// Route::get('paginate', 'AllLeadsController@index');

//Error pages
// Route::get('/o-auth/unauthorized', [App\Http\Controllers\StatisticsController::class, 'index'])->name('stats-index');




//Route for removing all TRUE not contacted portal leads
Route::get('/remove-leads', [App\Http\Controllers\HomeController::class, 'remove_leads'])->name('remove-leads');




// notifications
Route::get('/send-notify', [App\Http\Controllers\FrontendController::class, 'sendNotification'])->name('send-notification');

Route::get('/clear-notifications', [App\Http\Controllers\FrontendController::class, 'clearNotifications'])->name('clear-notifications');



// targets
Route::get('/manage-targets', [App\Http\Controllers\TargetController::class, 'showIndex'])->name('manage-targets');

Route::Post('/update-targets', [App\Http\Controllers\TargetController::class, 'target_update_create'])->name('create-targets');


// Agents get old leads
Route::get('/old-leads-re-imbursement-index', [App\Http\Controllers\AllLeadsController::class, 'old_leads_reimbursement_index'])->name('old-leads-re-imbursement-index');

Route::get('/old-leads-re-imbursement/search', [App\Http\Controllers\AllLeadsController::class, 'old_leads_reimbursement_search'])->name('old-leads-re-imbursement-search');

Route::get('/old_plead_change_date/{id}', [App\Http\Controllers\AllLeadsController::class, 'plead_update'])->name('plead-update');

Route::get('/old_clead_change_date/{id}', [App\Http\Controllers\AllLeadsController::class, 'clead_update'])->name('clead-update');

Route::get('/old_wlead_change_date/{id}', [App\Http\Controllers\AllLeadsController::class, 'wlead_update'])->name('wlead-update');






/**
 * Daily Report Routes
 *
 * This is used to gather information on the agent's
 * where-abouts while they are out of the office
 *
 */

Route::get('/daily-reports', [App\Http\Controllers\DailyReportController::class, 'index'])->name('daily-reports-admin-index');
Route::get('/my-daily-reports', [App\Http\Controllers\DailyReportController::class, 'agent_index'])->name('daily-reports-agent-index');
Route::post('/daily-report/store', [App\Http\Controllers\DailyReportController::class, 'store'])->name('daily-reports-store');
Route::post('/daily-reports/update', [App\Http\Controllers\DailyReportController::class, 'update'])->name('daily-reports-update');
Route::post('/daily-reports/delete/{id}', [App\Http\Controllers\DailyReportController::class, 'delete'])->name('daily-reports-delete');


