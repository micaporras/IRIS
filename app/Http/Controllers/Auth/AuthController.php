<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\ToDo;
use Session;

class AuthController extends Controller
{
    public function index() 
    {
        return view('auth.login');
    }

    public function registration() 
    {
        return view('auth.registration');
    }

    public function postRegistration(Request $request)
{ 
    $request->validate([
        'name' => ['required'],
        'email' => ['required', 'email', 'unique:users'],
        'password' => ['required', 'min:6']
    ]);
    
    $data = $request->only('name', 'email', 'password');
    $reg_ex = "/[!@#$%^&*()-+=]{1,}/";
    if(preg_match($reg_ex, $data['name'])) {
        return redirect('registration')->withSuccess('Invalid Credentials');
    }
    else{
        $createUser = $this->create($data);  
        return redirect('login')->withSuccess('User Created. Please login'); 
    }
    
    
    
    
}


    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);
        $checkLoginCredentials = $request->only('email', 'password');
        if(Auth::attempt($checkLoginCredentials)){
            return redirect('dashboard')->withSuccess('Logged In Successfully');
        }
        return redirect('login')->withSuccess('Wrong Credentials');
    }

    public function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => $data['password']
        ]);
    }

    public function logout() 
    {
        Session::flush();
        Auth::logout();
        return redirect('login');
    }

    public function dashboard()
    {
        if(Auth::check()){
            $month = date('m');
            $label = ["Completed", "Total" ];
            $task = ToDo::orderby('created_at')->get();
            $countCompletedTasks = ToDo::where('status', 'completed')->count();
            $countOngoingTasks = ToDo::where('status', 'On Going')->count();
            $countFailedTasks = ToDo::where('status', 'Failed To Do')->count();
            $total = ToDo::orderby('created_at')->count();
            $totalTasks = [$countCompletedTasks, $total];
            $tasksThisMonth = ToDo::whereRaw('MONTH(start) = ?', [$month])->count();
            $completedTasksThisMonth = ToDo::where('status', 'completed')
            ->whereRaw('MONTH(start) = ?', [$month])
            ->count();
            $totalTasks1 = [$completedTasksThisMonth, $tasksThisMonth];
            return view('dashboard', ['task' => $task], compact('countCompletedTasks','countOngoingTasks', 'countFailedTasks', 'totalTasks', 'label', 'totalTasks1', 'month'));
        }
        return redirect('login')->withSuccess('Login to access the dashboard');
    }

    
}
