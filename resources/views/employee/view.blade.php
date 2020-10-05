@extends('layouts.master')

@section('employee','active')

@section('BreadCrumb')
    <section class="content-header">
       <h4>Employe</h4>
        <ol class="breadcrumb">
            <li><a href="{{ url('home') }}"><i class="fa fa-dashboard"></i>Home</a></li>
            <li class="active">Employe</li>
        </ol>
    </section>
@endsection

@section('content')

    <div class="row">
        <div class="col-sm-12">
            @component('layouts.component.box-pannel',['title'=>'Country','color'=>env('TABPANELCOLOR')])
                @if(auth()->user()->user_type == 'admin')
                    <button type="button" class="btn btn-primary pull-right" id="AddEmployee" data-toggle="modal" data-target="#AddEmployeeModal"><i class="fa fa-plus"></i> Add Employee</button></a>
                    <br>
                    <hr>
                @endif
                <meta name="csrf-token" content="{{ csrf_token() }}">
                <div class="table-responsive">
                     <table class="table table-bordered table-hover" id="EmployeeTable">
                        <thead>
                            <tr>
                                <th><input type="checkbox" id="check_all">&nbsp;&nbsp;@if(auth()->user()->user_type == 'admin')<button type="button" name="bulk_delete" id="bulk_delete" class="btn btn-danger btn-xs"><i class="glyphicon glyphicon-remove"></i>Delete</button>@endif</th>
                                <th>Employee Id</th>
                                <th>Name</th>
                                <th>Email</th>
                                <th>Mobile Number</th>
                                <th>Address</th>
                                <th>City</th>
                                <th class="text-center">Action</th>
                            </tr>
                        </thead>
                    </table>
                </div>
             @endcomponent
        </div>
    </div>
    
    @include('employee.add')
    @include('employee.edit')
    @include('employee.salary')
    @include('employee.view_salary')

@endsection

@section('script')
    <script type="text/javascript">
        $('#check_all').on('click', function(e) {
            if($(this).is(':checked',true)){
               $(".checkbox").prop('checked', true);  
            }else{  
                $(".checkbox").prop('checked',false);  
            }  
        });

        $('.checkbox').on('click',function(){
            if($('.checkbox:checked').length == $('.checkbox').length){
                $('#check_all').prop('checked',true);
            }else{
                $('#check_all').prop('checked',false);
            }
        });
    </script>   

    @include('employee.js')

@endsection

