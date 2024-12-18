<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use App\Models\Role;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\crew_boss;
use App\Models\Jobdescription;
use App\Models\Laborentry;
use App\Models\Allocatelabor;
use App\Models\setuppage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use App\Models\Ranch;
use App\Models\Block;
use App\Models\Acre;
use App\Models\Expense;
use App\Models\Nonjob;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function UserDashboard(Request $request){
        $userId = session('user_id');
        $clientId = session('client_id');
        $userName = session('user_name');
        $userEmail = session('user_email');
        $ranches = Ranch::with('blocks.acres')->get();
        $allusers = User::where('role', 4)->get();
        $alljobs = Jobdescription::latest()->get();

        $subcategories = Nonjob::all(); 
        $jobDescriptions = Jobdescription::all(); 
    
        // Create the structure you want for Labor and Non Labor
        $columnGroups = [
            'Labor' => [
                'Pruning' => $jobDescriptions->where('subcategory', 'Pruning')->pluck('name')->toArray(),
                'Thinning' => $jobDescriptions->where('subcategory', 'Thinning')->pluck('name')->toArray(),
                'Picking' => $jobDescriptions->where('subcategory', 'Picking')->pluck('name')->toArray(),
                'Development' => $jobDescriptions->where('subcategory', 'Development')->pluck('name')->toArray(),
                'Training' => $jobDescriptions->where('subcategory', 'Training')->pluck('name')->toArray(),
                'Hail net' => $jobDescriptions->where('subcategory', 'Hail net')->pluck('name')->toArray(),
                'Upkeep' => $jobDescriptions->where('subcategory', 'Upkeep')->pluck('name')->toArray(),
                'Unique Expenses' => $jobDescriptions->where('subcategory', 'Unique Expenses')->pluck('name')->toArray(),
            ],
            'Non Labor' => [
                'Other Farm Expenses' => $subcategories->where('subcategory', 'Other Farm Expenses')->pluck('name')->toArray(),
                'All Acre Expenses' => $subcategories->where('subcategory', 'All Acre Expenses')->pluck('name')->toArray(),
                'Other Development' => $subcategories->where('subcategory', 'Other Development')->pluck('name')->toArray(),
                'Over-head' => $subcategories->where('subcategory', 'Over-head')->pluck('name')->toArray(),
                'Inventory' => $subcategories->where('subcategory', 'Inventory')->pluck('name')->toArray(),
            ]
        ];

        if($clientId){
            $expense = Expense::with(['ranch', 'block', 'acres'])->where('user_id', $clientId)->get();
            
        } else{
            $expense = Expense::with(['ranch', 'block', 'acres'])->get();
           
        }

        $allcrew = [];
        $totalExpiredCount = 0;

        if($request->id){
                $clientId = $request->id;
                session(['client_id' => $clientId]);
                $month = session('month');
                $year = session('year');

                $totalJobsCount = Laborentry::where('client_id', $clientId)->get(['job_id'])->count();
                $totalUserCount = User::where('id', $clientId)->count();
                $totalExpiredCount = User::where('role', 5)->where('expired', 1)->count();
                $clientusername = Allocatelabor::with(['crewuser', 'clientuser', 'jobuser', 'ranchuser', 'blockuser', 'acreuser'])
                    ->when($clientId, function ($query) use ($clientId) {
                        return $query->where('client_id', $clientId);
                    })
                    ->when($year, function ($query) use ($year) {
                        return $query->whereYear('date', $year);
                    })
                    ->when($month, function ($query) use ($month) {
                        // Calculate date range based on duration
                        $startDate = now(); // Current date
                        switch ($month) {
                            case '1w':
                                $startDate = now()->subWeek(1);
                                break;
                            case '2w':
                                $startDate = now()->subWeeks(2);
                                break;
                            case '3w':
                                $startDate = now()->subWeeks(3);
                                break;
                            case '4w':
                                $startDate = now()->subWeeks(4);
                                break;
                            case '1m':
                                $startDate = now()->subMonth(1);
                                break;
                            case '3m':
                                $startDate = now()->subMonths(3);
                                break;
                            case '6m':
                                $startDate = now()->subMonths(6);
                                break;
                            case '12m':
                                $startDate = now()->subYear(1);
                                break;
                        }
                        return $query->where('date', '>=', $startDate);
                    })
                    ->orderBy('created_at', 'desc')
                    ->get();

                    foreach ($clientusername as $record) {
                        $setupPage = SetupPage::where('name', $record->client_id)
                            ->where('ranch_id', $record->ranch_id)
                            ->where('block_id', $record->block_id)
                            ->first();

                        if ($setupPage) {
                            // Attach variety name to the record
                            $record->variety_name = $setupPage->variety;

                            // Append variety name to the clientuser's name
                            if ($record->clientuser) {
                                $record->clientuser->name .= ' (' . $record->variety_name . ')';
                            }
                        } else {
                            $record->variety_name = 'Not Found';

                            // Handle when variety is not found
                            if ($record->clientuser) {
                                $record->clientuser->name .= ' (No Variety)';
                            }
                        }
                    }
                $getclient = User::where('role', 4)->get();
                

                $dashdata = [
                    'totalUserCount'=>'', 
                    'totalJobsCount'=>'', 
                    'totalExpiredCount'=>'', 
                    'Expense'=>$expense, 
                    'getclient'=>$getclient, 
                    'cost'=>'',
                    'percentageArray'=> '',
                    'monthlyCosts'=> '',
                    'allcrew'=> $allcrew,
                    'ranches' => '',
                    'clientusername' => $clientusername
                ];
                return response()->json($dashdata);
            } 
            else{

                $totalJobsCount = Jobdescription::count();
                $totalUserCount = User::where('role', 4)->count();
                $totalExpiredCount = User::where('role', 5)->where('expired', 1)->count();
        
                for ($i = 0; $i < 8; $i++) {
                    // Get the current month and year, subtracting $i months
                    $date = Carbon::now()->subMonths($i);
                    $month = $date->month;
                    $year = $date->year;
                
                    // Count users for the month
                    $userCount = User::where('role', 5)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->count();
                
                    // Count expired users for the month
                    $expiredCount = User::where('role', 5)
                        ->whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->where('expired', 1)
                        ->count();     
                        
                    // Add the counts to arrays
                    $allcrew[] = $userCount;    
                }

                $allcrew = array_reverse($allcrew);

                if ($totalExpiredCount > 0) {
                    $percentageExpired = ($totalExpiredCount / $totalUserCount) * 100;
                    $remainingPercentage = 100 - $percentageExpired;
                    $percentageArray = [$remainingPercentage, $percentageExpired];
                } else {
                    // If there are no users, set both to 0
                    $percentageArray = [0, 100];
                }

                $currentMonthExpense = Laborentry::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)->sum('amount');

                $currentMonthcost = Allocatelabor::whereMonth('created_at', Carbon::now()->month)
                ->whereYear('created_at', Carbon::now()->year)
                ->sum('total_amount');
                $monthlyCosts = [];
                for ($i = 0; $i < 8; $i++) {
                    // Get the month and year for the previous months
                    $month = Carbon::now()->subMonths($i)->month;
                    $year = Carbon::now()->subMonths($i)->year;

                    // Sum the total amount for the current month
                    $monthlyCosts[$i] = Allocatelabor::whereMonth('created_at', $month)
                        ->whereYear('created_at', $year)
                        ->sum('total_amount');
                }

                // Reverse the array to show the most recent month first
                $monthlyCosts = array_reverse($monthlyCosts);


                $getclient = User::where('role', 4)->get();

                $dashdata = [
                    'totalUserCount'=>$totalUserCount, 
                    'totalJobsCount'=>$totalJobsCount, 
                    'totalExpiredCount'=>$totalExpiredCount, 
                    'Expense'=>$currentMonthExpense, 
                    'getclient'=>$getclient, 
                    'cost'=>$currentMonthcost,
                    'percentageArray'=> $percentageArray,
                    'monthlyCosts'=> $monthlyCosts,
                    'allcrew'=> $allcrew
                ];

            }
        return view('dashboard.index', compact('userId', 'allusers', 'alljobs', 'ranches', 'dashdata', 'userName', 'userEmail', 'expense', 'columnGroups'));
    }

    public function get_crew_details(){
        $allusers = User::where('role', 4)->get();

        return response()->json(['data' => $allusers], 200);
    }

    public function User_profile(){
        $userId = Auth::id();
        //$user = User::findOrFail($userId);
        $user = DB::table('users')->join('users_role', 'users_role.id', '=', 'users.role')->select('users.*', 'users_role.role as role_name')->where('users.id', $userId)->first();
        // dd($user);
        // $user = User::where('id', '=', $userId)->latest()->get();
        return view('user.profile',compact('user'));
    }

    public function UserList() {

        $authRole = auth()->user()->role;
        if ($authRole == 2) {
            $users = User::join('users_role', 'users.role', '=', 'users_role.id')
                ->where('users.role', 5)
                ->select('users.*', 'users_role.name as role_name')
                ->latest()
                ->get();
        } else {
            // Otherwise, get all users except Admin (role 1)
            $users = User::join('users_role', 'users.role', '=', 'users_role.id')
                ->where('users_role.name', '!=', 'Admin')
                ->select('users.*', 'users_role.name as role_name')
                ->latest()
                ->get();
        }
    
        // Return the view with the users list
        return view('user.user_list', compact('users'));
    }

    public function AddUser() {
    
        $authRole = auth()->user()->role;
        if ($authRole == 2) {
            $userrole = Role::where('id', '=', 10)->get();
        } else {
            $userrole = Role::where('name', '!=', 'Admin')->get();
        }

        $crewrole = User::where('role', '=', 5)->get();
        $jobs = Jobdescription::latest()->get();
        return view('user.add_user', compact(['userrole', 'crewrole', 'jobs']));
    }


    public function UserRegister(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email', 
           
        ]);
    
        // Check if validation fails
        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $userId = DB::table('users')->insertGetId([
            'name' => $request->name,
            'email' => $request->email,
            'role' => $request->role,
            'password' => Hash::make($request->password)
        ]);

        if ($request->role == 10) {
            DB::table('users')->where('id', $userId)->update([
                'min_crew' => $request->min_people,
                'max_crew' => $request->max_people,
                
            ]);
            // Handle the crew selections if provided
            // if ($request->has('selectcrew')) {
            //     foreach ($request->input('selectcrew') as $crewId) {
            //         DB::table('users')->where('id', $crewId)->update([
            //             'is_assigned' => 1,
            //         ]);

            //         crew_boss::create([
            //             'boss_id' => $userId,
            //             'crew_id' => $crewId,
            //             'created_at' => '',
            //             'updated_at' => ''
            //         ]);

            //     }
            // }
        }


        return redirect()->route('user.list');
    }

    public function userupdateStatus(Request $request, $id)
    {
        $role = User::findOrFail($id);
        $role->status = $request->status;
        $role->save();

        return response()->json(['success' => true]);
    }

    public function EditUser($id){
        $authRole = auth()->user()->role;

        if ($authRole == 2) {
            $userrole = Role::where('id', '=', 2)->get();
        } else {
            // Otherwise, get all roles except 'Admin'
            $userrole = Role::where('name', '!=', 'Admin')->get();
        }
        $crewrole = User::where('role', '=', '5')->get();
        $user = User::find($id);
        return view('user.edit_user', compact(['user', 'userrole', 'crewrole']));
    }

    public function UpdateUser(Request $request){
        $user_id = $request->user_id;
        User ::find($user_id)->update([
            'name' => $request->name,
            'email' => $request->email,
            'birthday' => $request->birthday
        ]);
        return redirect()->route('user.list');

    }

    public function DeleteUser($id){
        User::find($id)->delete();
        return redirect()->route('user.list');
    }

    public function getclientdata(){
        $user = User::where('role', '=', '4')->get();
        return response()->json($user);
    }

    public function updatePeopleData(Request $request){
        $crewboss = $request->crewboss;
        User ::find($crewboss)->update([
            'min_crew' => $request->mincrew,
        ]);
        return response()->json(['mincrew' => $request->mincrew]);

    }

    public function maxPeopleData(Request $request){
        $crewboss = $request->crewboss;
        User ::find($crewboss)->update([
            'max_crew' => $request->maxcrew,
        ]);
        return response()->json(['maxcrew' => $request->maxcrew]);
    }

    public function get_mothlydata(Request $request)
    {
        $month = $request->input('month'); // Number of months to look back
        $year = $request->input('year');
        $week = '';

        $startDate = null;
        $endDate = null;

        if ($month && $year) {
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
    
            if ($week) {
                $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->addWeeks($week - 1)->startOfWeek();
                $endDate = $startDate->copy()->endOfWeek();
            }
        }
        elseif ($year) {
            $startDate = Carbon::createFromDate($year, 1, 1)->startOfYear();
            $endDate = Carbon::createFromDate($year, 12, 31)->endOfYear();
        }
        elseif ($month) {
            $currentYear = Carbon::now()->year;
            $startDate = Carbon::createFromDate($currentYear, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
        }
        else {
            $currentDate = Carbon::now();  // Get current date
    
            $month = $currentDate->month;
            $year = $currentDate->year;
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth();
            $endDate = $startDate->copy()->endOfMonth();
        }
    
        if ($week) {
            $startDate = Carbon::createFromDate($year, $month, 1)->startOfMonth()->addWeeks($week - 1)->startOfWeek();
            $endDate = $startDate->copy()->endOfWeek();
        }

        $totalUserCount = User::where('role', 4)
            ->when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()]);
            })
            ->count();

        $jobCount = Laborentry::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()]);
            })
            ->distinct('job_id')
            ->count('job_id');

        $totalAmountSum = Allocatelabor::when($startDate && $endDate, function ($query) use ($startDate, $endDate) {
                return $query->whereBetween('created_at', [$startDate->toDateTimeString(), $endDate->toDateTimeString()]);
            })
            ->sum('total_amount');

        return response()->json([
            'totalUserCount' => $totalUserCount,
            'totalJobsCount' => $jobCount,
            'cost' => $totalAmountSum,
        ]);
    }

    public function store_session_data(Request $request)
    {
        session([
            'month' => $request->input('month'),
            'year' => $request->input('year'),
        ]);

        return response()->json(['message' => 'Session data stored successfully']);
    }

}
