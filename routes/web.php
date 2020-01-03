<?php

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



Route::get('/','UserController@index');

Route::get('user-login', function () {
    return view('web.login');
});

Route::get('signup', function () {
    return view('web.signup');
});


Route::get('editprofile','UserController@editprofile');
Route::get('myprofile','UserController@myprofile');
Route::get('gps-map','UserController@gpsmap');
Route::get('door-hanger','UserController@doorhanger');
Route::get('user-register','UserController@userRegister');
Route::get('contact-us','UserController@contactUs');
Route::get('/redirect/{service}','UserController@redirect');
Route::get('/callback/{service}','UserController@callback');
Route::get('current-jobs/{page}','UserController@currentJobs');
Route::get('complete-jobs/{page}','UserController@completeJobs');


/*Route::get('web_myprofile', function () {
    return view('web.web_myprofile');
});
*/
Route::post('webuserRegister','UserController@webuserRegister');
Route::post('websignup', 'UserController@websignup');
Route::post('weblogin', 'UserController@weblogin');
Route::post('webeditprofile', 'UserController@webeditprofile');
Route::post('emailnotidatatoggel','UserController@emailnotidatatoggel');
Route::post('webviewprofile', 'UserController@webviewprofile');
Route::post('postContactForm', 'UserController@postContactForm');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('flyer-conversion','UserController@flyerConversion');
Route::post('addCustomer','UserController@addCustomer');
Route::get('job-details/{id}','UserController@jobDetails');
Route::get('forgetPassword','UserController@forgetPassword');
Route::post('forgetPass','UserController@forgetPass');
Route::any('resetPasswordForm/{content}','UserController@resetPasswordForm');
Route::any('changeForgotPassword','UserController@changeForgotPassword');
Route::get('addJobs','UserController@addJobs');
Route::get('notifications','UserController@notifications');
Route::get('webLogout', 'UserController@webLogout');
Route::post('gps_inprogress_job', 'UserController@gps_inprogress_job');

/*Admin Panel*/
Route::get('4admin',function(){

	return view('admin.login');
});

Route::get('changePasswordForm',function(){

	return view('admin.changePassword');
});
Route::post('changeAdminPassword','AdminController@changeAdminPassword');

Route::get('dashboard','AdminController@dashboard');


Route::post('adminLogin','AdminController@adminLogin');
Route::get('adminLogout','AdminController@adminLogout');
Route::get('adminProfile','AdminController@adminProfile');
Route::post('editAdminProfile','AdminController@editAdminProfile');
Route::get('users/{type}','AdminController@users');
Route::post('bulkdeletion','AdminController@bulkdeletion');

Route::get('clients/{type}','AdminController@clients');
Route::get('userProfile/{id}','AdminController@userProfile');
Route::get('clientProfile/{id}','AdminController@clientProfile');
Route::get('aboutDoorHanger','AdminController@aboutDoorHanger');

Route::get('updateBanner/{id}','AdminController@updateBanner');
Route::get('addBannerForm','AdminController@addBannerForm');
Route::post('addBanner','AdminController@addBanner');
Route::post('suspendUser','AdminController@suspendUser');
Route::post('postHanger','AdminController@postHanger');

Route::post('activeBanner','AdminController@activeBanner');
Route::post('deleteBanner','AdminController@deleteBanner');
Route::post('activeContent','AdminController@activeContent');
Route::post('deleteContent','AdminController@deleteContent');

Route::get('reports','AdminController@reports');
Route::post('addEmployee','AdminController@addEmployee');
Route::post('addCompany','AdminController@addCompany');
Route::post('addJob','AdminController@addJob');
Route::post('updateJob','AdminController@updateJob');
Route::get('joblist','AdminController@joblist');
Route::get('jobDetail/{id}','AdminController@jobDetail');
Route::post('submitFlyers', 'AdminController@submitFlyers');
Route::get('staticPages/{title}','AdminController@staticPages');
Route::post('staticPages/{title}/update','AdminController@UpdateStaticPages');
Route::get('/getStaticPages/{title}', 'AdminController@getStaticPagesView');
Route::get('/homeSliderForm', 'AdminController@homeSliderForm');
Route::get('/sliderContent', 'AdminController@sliderContent');
Route::post('/addSlider', 'AdminController@addSlider');
Route::post('updateSlider', 'AdminController@updateSlider');
Route::get('updateSliderForm/{id}', 'AdminController@updateSliderForm');
Route::post('deleteSlider', 'AdminController@deleteSlider');
Route::post('deleteJobs', 'AdminController@deleteJobs');



Route::get('aboutContent', 'AdminController@aboutContent');
Route::get('aboutContentForm', 'AdminController@aboutContentForm');
Route::post('postAboutHome', 'AdminController@postAboutHome');
Route::get('updateAboutForm/{id}', 'AdminController@updateAboutForm');
Route::post('updateAboutHome', 'AdminController@updateAboutHome');
Route::post('deleteUser', 'AdminController@deleteUser');

Route::post('getUserEditData', 'AdminController@getUserEditData');

Route::get('flyersconversion', 'AdminController@flyersconversion');
Route::get('flyerconversiondta/{id}', 'AdminController@flyerconversiondta');
Route::get('myjobsdetails/{id}/{type}', 'AdminController@myjobsdetails');

Route::post('users/updateEmployeeData', 'AdminController@updateEmployeeData');
Route::post('clients/updateClientData', 'AdminController@updateClientData'); 
/*Admin Panel*/



