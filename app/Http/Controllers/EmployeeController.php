<?php

namespace App\Http\Controllers;
use Validator;
use App\Mail\Mail;
use Illuminate\Http\Request;
use App\Models\Employee;
use App\Models\EmployeeSalary;
use App\Models\User;
use Yajra\DataTables\Facades\DataTables;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;

class EmployeeController extends Controller
{
    public function index()
    {
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
        if (request()->ajax()) {
            if(auth()->user()->user_type == 'admin'){
                $employee =  Employee::get();
            }elseif(auth()->user()->user_type == 'employee'){
                $employee =  Employee::where('id',auth()->user()->user_id);
            }
            return DataTables::of($employee)
                ->addIndexColumn()
                ->addColumn('action',function($employee){
                    $btn = "";
                    if(auth()->user()->user_type == 'admin'){
                        $btn.= '<a href="#" class="btn EmployeeSalary" id="'.$employee->id.'" employee_id="'.$employee->employee_id.'" data-toggle="modal" data-target="#AddEmployeeSalaryModal"">
                            <i class="fa fa-plus text-primary"></i>
                        </a>';
                    }
                    $btn.= '<a href="#" class="btn ViewEmployeeSalary" id="'.$employee->id.'" data-toggle="modal" data-target="#viewEmployeeSalaryModal" onclick="dataTable('.$employee->id.');">
                        <i class="fa fa-eye text-success"></i>
                    </a>';
                    $btn.= '<a href="#" class="btn EditEmployee" id="'.$employee->id.'" data-toggle="modal" data-target="#editEmployeeModal">
                        <i class="fa fa-pencil text-aqua"></i>
                    </a>';
                    if(auth()->user()->user_type == 'admin'){
                        $btn.= '<a href="#" id="'.$employee->id.'" class="btn DeleteEmployee" data-toggle="modal" data-target="#DeleteModel">
                            <i class="fa fa-trash-o" style="color:red;"></i>
                        </a>';
                    }
                    return $btn;
                })
                ->addColumn('checkbox', '<input type="checkbox" class="checkbox employee_checkbox" name="employee_checkbox[]" class="student_checkbox" value="{{$id}}" />')
            	->rawColumns(['checkbox','action'])
                ->make(true);
        }
    	return view('employee.view',compact('employee_id'));
    }

    public function store(Request $request){

    	$validation = Validator::make($request->all(), [
            'name' => ['required'],
            'gender' => ['required'],
            'city' => ['required', 'string'],
            'mobile_number' => ['required', 'numeric', 'digits_between:10,11', 'unique:users,mobile_number'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email'],
        ]);

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
        echo json_encode($output);
    }

    public function edit(Request $request){
    	return Employee::findorfail($request->employee_id);
    }

    public function update(Request $request){

    	$employee = Employee::findorfail($request->edit_employee_id);
        $user = User::where('email',$employee->email)->first();

    	$validation = Validator::make($request->all(), [
            'name' => ['required'],
            'gender' => ['required'],
            'city' => ['required', 'string'],
            'mobile_number' => ['required', 'numeric', 'digits_between:10,11', 'unique:users,mobile_number,'.$user->id],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$user->id],
        ]);

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

	        $user->name = $request->name;
	        $user->email = $request->email;
	        $user->mobile_number = $request->mobile_number;
	        $user->save();

	        $employee->name = $request->name;
            $employee->email = $request->email;
            $employee->mobile_number = $request->mobile_number;
            $employee->gender = $request->gender;
            $employee->city = $request->city;
            $employee->address = $request->address;
            $employee->save();

	        $names = $request->name;
	        $details = array('email' => $request->email,'password' => "same password.");
	        $emails = $request->email;
	        \Mail::send(['text'=>'email.register_mail'], $details, function($message) use($emails,$names) {
	            $message->to($emails,$names);
	            $message->subject('This is Your credentials');
	            $message->from(ENV('MAIL_USERNAME'),ENV('MAIL_FROM_NAME'));
	        });

            $success_output = 'Employee Successfully Update';
            DB::commit();
        }

        $output = array(
            'error'     =>  $error_array,
            'success'   =>  $success_output
        );
        echo json_encode($output);
    }

    public function delete(Request $request){
    	try{
	    	$employee = Employee::findorfail($request->employee_id);
            EmployeeSalary::whereIn('employee_id',$request->employee_id)->delete();
	        $user = User::where('email',$employee->email)->delete();
	        $employee->delete();
	        $Data['status'] = 'success';
	        return response()->json($Data);
        }catch (Exception $e){
            $Data['status'] = 'error';
            return response()->json($Data);
        }	
    }

    public function massremove(Request $request){
    	try{
	    	$employee = Employee::whereIn('id',$request->id)->get();
            EmployeeSalary::whereIn('employee_id',$request->id)->delete();
	        $user = User::whereIn('email',$employee->pluck('email'))->delete();
	        Employee::whereIn('id',$request->id)->delete();
	        $Data['status'] = 'success';
	        return response()->json($Data);
        }catch (Exception $e){
            $Data['status'] = 'error';
            return response()->json($Data);
        }	
    }   

    public function addsalary(Request $request){
        try{
            $employeeSalary = new EmployeeSalary;
            $employee = Employee::find($request->salary_employee_id);
            $employeeSalary->employee_id = $request->salary_employee_id;
            $employeeSalary->base_salary = $request->base_salary;
            $employeeSalary->pf = $request->pf;
            $employeeSalary->esi = $request->esi;
            $employeeSalary->tds = $request->tds;
            $employeeSalary->net_salary = $request->net_salary;
            $employeeSalary->save();

            $names = $employee->name;
            $details = array(
                            'base_salary' => $request->base_salary,
                            'pf' => $request->pf,
                            'esi' => $request->esi,
                            'tds' => $request->tds,
                            'net_salary' => $request->net_salary,
                        );
            $emails = $employee->email;
            \Mail::send(['text'=>'email.salary'], $details, function($message) use($emails,$names) {
                $message->to($emails,$names);
                $message->subject('This is your salary');
                $message->from(ENV('MAIL_USERNAME'),ENV('MAIL_FROM_NAME'));
            });

            $Data['status'] = 'success';
            return response()->json($Data);
        }catch (Exception $e){
            $Data['status'] = 'error';
            return response()->json($Data);
        }   
    }

    public function viewsalary(Request $request){
        if (request()->ajax()) {
            $EmployeeSalary =  EmployeeSalary::where('employee_id',$request->id)->get();
            return DataTables::of($EmployeeSalary)
                ->addIndexColumn()
                ->make(true);
        }  
    }
}
