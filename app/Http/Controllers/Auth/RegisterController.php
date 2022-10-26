<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\LeaveCalculate;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Services\LeaveService;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
            'birthday' => ['required','date_format:Y-m-d'],
            'children' => ['required','numeric'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
//        $years= Carbon::parse($data['birthday'])->age;
//        dd($years);

//        return User::create([
//            'name' => $data['name'],
//            'email' => $data['email'],
//            'password' => Hash::make($data['password']),
//            'birthday' => $data['birthday'],
//            'children' => $data['children'],
//            'leave_number' => 20,
//            'sick-leave' => 0,
//        ]);

        $leaveService = new LeaveService();

        $user = new User;
        $user->name = $data['name'];
        $user->email = $data['email'];
        $user->password = Hash::make($data['password']);
        $user->leave_number = $leaveService->calculateLeaves($data['children'], $data['birthday']);
        $user->sick_leave = 0;
        $user->save();

        $leaveCalculate = new LeaveCalculate();
        $leaveCalculate->user_id = $user->id;
        $leaveCalculate->birthday = $data['birthday'];
        $leaveCalculate->starting_work = $data['starting_work'];
        $leaveCalculate->children = $data['children'];
        $leaveCalculate->save();

        return $user;
    }

}
