<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RanchController;
use App\Http\Controllers\Role\RoleController;
use App\Http\Controllers\BlockController;
use App\Http\Controllers\AcreController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Ajax\TwoFactorController;
use App\Http\Controllers\JobdescriptionController;
use App\Http\Controllers\Setup\SetupController;
use App\Http\Controllers\Setup\CrewsetupController;
use App\Http\Controllers\Labor\LaborController;
use App\Http\Controllers\AllocateController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\DatabaseControlller;
use App\Http\Controllers\NonjobController;
use App\Http\Controllers\SubcategoryController;



// Authentication Routes
Route::get('/', [LoginController::class, 'showLoginForm'])->name('login');
//Route::middleware('auth')->post('/login', [LoginController::class, 'login']);

Route::post('login', [LoginController::class, 'login']);
Route::get('logout', [LoginController::class, 'logout'])->name('logout');


// Password Reset Routes
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');

// Protected Routes
Route::middleware('auth')->group(function() {

    // login Controller

    Route::post('/saveClient', [LoginController::class, 'saveClient']);
    Route::get('/otp', [LoginController::class, 'showOtpForm'])->name('otpvarify.form');
    Route::post('otpuser.verify', [LoginController::class, 'userverifyOtp'])->name('otp');

     //Ajax Rout 2fa
     Route::get('/2fa-setup', [TwoFactorController::class, 'showSetupForm']);
     Route::post('2fa-enable', [TwoFactorController::class, 'EnableGoogleAuth'])->name('2fa-enable');



    // UserController routes

    Route::get('user/profile', [UserController::class, 'User_profile'])->name('user.profile');
    Route::get('/dashboard', [UserController::class, 'UserDashboard'])->name('user.dashboard');
    Route::get('user/list', [UserController::class, 'UserList'])->name('user.list');
    Route::post('user/{role}/update-status', [UserController::class, 'userupdateStatus']);
    Route::get('add/user', [UserController::class, 'AddUser'])->name('add.user');
    Route::post('user/register', [UserController::class, 'UserRegister'])->name('user.register');
    Route::get('/edit/user/{id}', [UserController::class, 'EditUser'])->name('edit.user');
    Route::post('/update/user', [UserController::class, 'UpdateUser'])->name('update.user');
    Route::get('/delete/user/{id}', [UserController::class, 'DeleteUser'])->name('delete.user');
    Route::get('/get_mothlydata', [UserController::class, 'get_mothlydata'])->name('get_mothlydata');
    Route::post('/store-session-data', [UserController::class, 'store_session_data']);
    Route::get('get-crew-details', [UserController::class, 'get_crew_details'])->name('user.profile');
    


    // RoleController routes
    Route::get('role', [RoleController::class, 'index'])->name('user.role');
    Route::post('/roles', [RoleController::class, 'store'])->name('roles.store');
    Route::post('roles/{role}/update-status', [RoleController::class, 'updateStatus'])->name('roles.update-status');
    Route::get('get/{role}/role', [RoleController::class, 'getrole'])->name('get.role');
    Route::get('/delete/role/{id}', [RoleController::class, 'DeleteRole'])->name('delete.role');

    // RanchController routes
    Route::get('/ranch/list', [RanchController::class, 'RanchList'])->name('ranch.list');
    Route::get('/add/ranch', [RanchController::class, 'AddRanch'])->name('add.ranch');
    Route::post('/store/ranch', [RanchController::class, 'StoreRanch'])->name('store.ranch');
    Route::post('ranch/{role}/update-status', [RanchController::class, 'ranchupdateStatus']);
    Route::get('/edit/ranch/{id}', [RanchController::class, 'EditRanch'])->name('edit.ranch');
    Route::post('/update/ranch', [RanchController::class, 'UpdateRanch'])->name('update.ranch');
    Route::get('/delete/ranch/{id}', [RanchController::class, 'DeleteRanch'])->name('delete.ranch');

    // BlockController routes
    Route::get('/block/list', [BlockController::class, 'BlockList'])->name('block.list');
    Route::get('/add/block', [BlockController::class, 'AddBlock'])->name('add.block');
    Route::post('/store/block', [BlockController::class, 'StoreBlock'])->name('store.block');
    Route::post('block/{role}/update-status', [BlockController::class, 'blockupdateStatus']);
    Route::get('/edit/block/{id}', [BlockController::class, 'EditBlock'])->name('edit.block');
    Route::post('/update/block', [BlockController::class, 'UpdateBlock'])->name('update.block');
    Route::get('/delete/block/{id}', [BlockController::class, 'DeleteBlock'])->name('delete.block');

    // AcreController routes
    Route::get('/acre/list', [AcreController::class, 'AcreList'])->name('acre.list');
    Route::get('/add/acre', [AcreController::class, 'AddAcre'])->name('add.acre');
    Route::get('block/ajax/{ranch_id}', [AcreController::class, 'GetBlock']);
    Route::post('/store/acre', [AcreController::class, 'StoreAcre'])->name('store.acre');
    Route::get('/edit/acre/{id}', [AcreController::class, 'EditAcre'])->name('edit.acre');
    Route::post('/update/acre', [AcreController::class, 'UpdateAcre'])->name('update.acre');
    Route::get('/delete/acre/{id}', [AcreController::class, 'DeleteAcre'])->name('delete.acre');
    Route::post('acre/{role}/update-status', [AcreController::class, 'acreupdateStatus']);

    // jobdescriptionController routes
    Route::get('jobdescription', [JobdescriptionController::class, 'JobdescriptionList'])->name('job.list');
    Route::post('storejob', [JobdescriptionController::class, 'storejob']);
    Route::post('job/{role}/update-status', [JobdescriptionController::class, 'updateStatusjob'])->name('job.update-status');
    Route::get('get/{role}/job', [JobdescriptionController::class, 'getjob'])->name('get.job');
    Route::get('/delete/job/{id}', [JobdescriptionController::class, 'DeleteJob'])->name('delete.jobs');


    // NonlaborjobController routes
    Route::get('nonjob', [NonjobController::class, 'NonlaborJobList'])->name('nonjob.list');
    Route::post('nonstorejob', [NonjobController::class, 'Nonstorejob']);
    Route::post('nonjob/{role}/update-status', [NonjobController::class, 'updateStatusjob'])->name('job.update-status');
    Route::get('get/{role}/nonjob', [NonjobController::class, 'getjob'])->name('get.job');
    Route::get('/delete/nonjob/{id}', [NonjobController::class, 'DeleteJob'])->name('nondelete.jobs');


    // Client Setuppage Controller routes
    Route::get('setuppage', [SetupController::class, 'SetupList'])->name('setup.page');
    Route::post('setupstore', [SetupController::class, 'Setupstore']);
    Route::get('addsetup', [SetupController::class, 'Addsetup'])->name('add.setup');
    Route::post('setup/{role}/update-status', [SetupController::class, 'updateStatussetup']);
    Route::get('/editsetup/{id}', [SetupController::class, 'Editsetup'])->name('edit.setup');
    Route::get('/delete/{id}', [SetupController::class, 'Deletesetup'])->name('delete.setup');

    // Crew Setup Controller routes
    Route::get('crewsetup', [CrewsetupController::class, 'CrewSetup'])->name('crew.setup');
    Route::post('crewsetupstore', [CrewsetupController::class, 'CrewSetupstore']);
    Route::get('addcrewsetupget', [CrewsetupController::class, 'Addcrewsetupget'])->name('add.crewsetupget');
    Route::post('crewsetup/{role}/update-status', [CrewsetupController::class, 'updateStatuscrew']);
    Route::get('edit/crewsetup/{id}', [CrewsetupController::class, 'Editcrewsetup'])->name('edit.crewsetup');
    Route::get('/deletecrewsetup/{id}', [CrewsetupController::class, 'Deletecrewsetup'])->name('delete.crewsetup');
    Route::get('get/{role}/ofpeople', [CrewsetupController::class, 'Ofpeople']);
    Route::post('newcrew', [CrewsetupController::class, 'New_crew']);
    Route::post('updatepeopledata', [CrewsetupController::class, 'updatePeopleData']);
    

    // Labor Entry Controller routes
    Route::get('lobor', [LaborController::class, 'index'])->name('lobor.entry');
    Route::post('laborestore', [LaborController::class, 'LaborSetupstore']);
    Route::get('addcrewsetup', [LaborController::class, 'Addcrewsetup'])->name('add.crewsetup');
    Route::post('labor/{id}/update-status', [LaborController::class, 'updateStatuslabor']);
    Route::get('get/{id}/labor', [LaborController::class, 'getlabor']);
    Route::get('/deletelaborsetup/{id}', [LaborController::class, 'DeleteLabor'])->name('delete.laborsetup');
    Route::get('greendatarow', [LaborController::class, 'greendatarow']);
    Route::post('getclientranch', [LaborController::class, 'getclientranch']);


    // Labor Allocate Controller routes
    Route::get('allocate', [AllocateController::class, 'index'])->name('labor.allocate');
    Route::post('allocateadd', [AllocateController::class, 'AddAllocate']);
    Route::post('allocate/{id}/update-status', [AllocateController::class, 'updateStatusallocate']);
    Route::post('getcrew/{id}/data', [AllocateController::class, 'getcrewdata']);
    Route::post('getallcrew', [AllocateController::class, 'getallcrew']);
    Route::post('allocatedetailsdata', [AllocateController::class, 'Allocatedetails']);
    Route::post('updateLabor', [AllocateController::class, 'updateLabor']);
    Route::get('/deleteallocate/{id}', [AllocateController::class, 'DeleteAllocate'])->name('delete.allocate');



    // disable session Login Controller routes
    Route::post('/disable-modal', [LoginController::class, 'disableModal'])->name('disable.modal');
    Route::post('/getclientdata', [UserController::class, 'getclientdata']);

    // Invoice Controller routes
    Route::get('invoice', [InvoiceController::class, 'Index'])->name('invoice.entry');
    Route::get('getinvoicedata', [InvoiceController::class, 'Getinvoice']);
    Route::post('menualallocateadd', [InvoiceController::class, 'AddAllocate']);
    Route::post('invoicestatus', [InvoiceController::class, 'invoicestatus']);
    Route::post('getinvoicestatus', [InvoiceController::class, 'getinvoicestatus']);
    Route::get('/deleteinvoice/{id}', [InvoiceController::class, 'DeleteInvoice'])->name('delete.invoice');
    Route::post('updateInvoice', [InvoiceController::class, 'updateInvoice']);

    // Todo Controller routes
    Route::get('todo', [TodoController::class, 'index'])->name('todo.list');


     // Expense Controller routes
     Route::get('expense', [ExpenseController::class, 'index'])->name('expense.list');
     Route::post('/update-cell', [ExpenseController::class, 'updateCell']);


    //  Database Controller routes
     Route::match(['get', 'post'], 'database', [DatabaseControlller::class, 'index'])->name('data.base');
     Route::get('/deletedatabase/{id}', [DatabaseControlller::class, 'Deletedatabase'])->name('delete.database');

     //  Subcategory Controller routes
    Route::get('jobsubcategory', [SubcategoryController::class, 'index'])->name('jobsubcategory');
    Route::post('addsubcategory', [SubcategoryController::class, 'Add_subcategory']);
    Route::get('get/{role}/subcategory', [SubcategoryController::class, 'Get_subcategory'])->name('get.subcategory');
    Route::post('subcategory/{role}/update-status', [SubcategoryController::class, 'updateStatus_subcategory']);
    Route::get('/deletesubcategory/{id}', [SubcategoryController::class, 'Deletesubcategory'])->name('delete.subcategory');
     
   

});
