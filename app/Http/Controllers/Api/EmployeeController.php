<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Employee;

class EmployeeController extends Controller
{
    public function EmployeeList(){
    	try {
            $Employee = Employee::paginate(20);
            $ReturnSuccessData = array(
                'employee'=>$Employee
            );
            return response()->json($ReturnSuccessData, 200);
        }catch (\Exception $e){
            return response()->json(['status'=>'error','message'=>'Error Some Thing Went Wrong!!'], 401);
        }
    }


    public function store(Request $request){
        try {
            $error_array = array();
            $success_output = '';
            if ($validation->fails())
            {
                foreach($validation->messages()->getMessages() as $field_name => $messages)
                {
                    $error_array[] = $messages;
                }
            }else{
                DB::beginTransaction();
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
                $employee = new Employee;
                $employee->employee_id = $employee_id;
                $employee->name = $request->name;
                $employee->email = $request->email;
                $employee->mobile_number = $request->mobile_number;
                $employee->gender = $request->gender;
                $employee->city = $request->city;
                $employee->address = $request->address;
                $employee->save();

                $user = User::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'mobile_number' => $request->mobile_number,
                    'password' => Hash::make($request->mobile_number),
                    'user_id' => $employee->id,
                    'user_type' => 'employee',
                ]);

                $names = $request->name;
                $details = array('email' => $request->email,'password' => $request->mobile_number);
                $emails = $request->email;
                \Mail::send(['text'=>'email.register_mail'], $details, function($message) use($emails,$names) {
                    $message->to($emails,$names);
                    $message->subject('This is Your credentials');
                    $message->from(ENV('MAIL_USERNAME'),ENV('MAIL_FROM_NAME'));
                });

                $success_output = 'Employee Successfully Added';
                DB::commit();
            }

            $output = array(
                'error'     =>  $error_array,
                'success'   =>  $success_output
            );
            return response()->json($output, 200);
        }catch (\Exception $e){
            return response()->json(['status'=>'error','message'=>'Error Some Thing Went Wrong!!'], 401);
        }
    }
}
