<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Employee;
use App\Mail\Mail;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Exception;
use Illuminate\Support\Facades\DB;
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
            'mobile_number' => ['required', 'string', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
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
        DB::beginTransaction();
        try{
            $EmployeeCount = Employee::get()->count();
            $str = strlen((string)$EmployeeCount);
            if($EmployeeCount == 0){
                $employee_id = "emp_00".++$EmployeeCount;
            }else{
                if($str >= 1){
                    $employee_id = "emp_00".++$EmployeeCount;
                }elseif($str >= 2){
                    $employee_id = "emp_0".++$EmployeeCount;
                }elseif($str >= 3){
                    $employee_id = "emp_".++$EmployeeCount;
                }
            }

            $employee = Employee::create([
                'employee_id' => $employee_id,
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'password' => Hash::make($data['password']),
                'gender' => $data['gender'],
                'address' => $data['address'],
                'city' => $data['city'],
            ]);

            $name = array('name'=>$data['name']);
       
            $details = [
                'email' => $data['email'],
                'password' => $data['password']
            ];

            $user = User::create([
                'name' => $data['name'],
                'email' => $data['email'],
                'mobile_number' => $data['mobile_number'],
                'password' => Hash::make($data['password']),
                'user_id' => $employee->id,
                'user_type' => 'employee',
            ]);

            $names = $data['name'];
            $details = array('email' => $data['email'],'password' => $data['password']);
            $emails = $data['email'];
            \Mail::send(['text'=>'email.register_mail'], $details, function($message) use($emails,$names) {
                $message->to($emails,$names);
                $message->subject('This is Your credentials ');
                $message->from(ENV('MAIL_USERNAME'),ENV('MAIL_FROM_NAME'));
            });
            DB::commit();
            return $user;
        }catch (\Exception $e){
            DB::rollback();
            return back();
        }
    }
}
