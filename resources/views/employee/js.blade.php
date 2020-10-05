<script src="http://malsup.github.com/jquery.form.js"></script>
<script>

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    var EmployeeTable= $('#EmployeeTable').DataTable({
        processing: true,
        serverSide: false,
        responsive: true,
        autoWidth: false,
        ajax: '{{ route("employee.index") }}',
        "columns": [
            { "data":"checkbox", orderable:false, searchable:false},
            { data: 'employee_id' },
            { data: 'name' },
            { data: 'email' },
            { data: 'mobile_number' },
            { data: 'address' },
            { data: 'city' },
            { data: 'action', orderable: false, searchable: false },
        ]
    });

    function dataTable(data) {
        var viewEmployeeTable= $('#viewEmployeeTable').DataTable({
            processing: true,
            serverSide: false,
            responsive: true,
            autoWidth: false,
            "bDestroy": true,
            ajax:{
                url:'{{ route("employee.view.salary") }}',
                data:{"id" : data},
            },
            "columns": [
                { data: 'base_salary' },
                { data: 'pf' },
                { data: 'esi' },
                { data: 'tds' },
                { data: 'net_salary' },
            ],
        });
    }

    var sectionId="";
    $( document ).ready(function() {
        $('.AddEmployee').on('click',function (e) {
            var form = $( "#AddEmployeeForm" );
            form.validate();
            e.preventDefault();
            var checkValid = form.valid();
            if(checkValid == true){
                $.ajax({
                    type: "post",
                    url: '{{ route("employee.store") }}',
                    data:$('#AddEmployeeForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        $(".AddEmployee").hide();
                        $("#loading-image").show();
                    },
                    success: function(data) {
                        if(data.error.length > 0){
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++){
                                error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                            }
                            $('#form_output').show();
                            $('#form_output').html(error_html);
                            $("#loading-image").hide();
                            $(".AddEmployee").show();
                            setTimeout(function(){ 
                                $('#form_output').hide();
                            }, 5000);
                        }else{
                            $('#AddEmployeeModal').modal('hide');
                            EmployeeTable.ajax.reload();
                            $("#AddEmployeeForm")[0].reset();
                            $("#loading-image").hide();
                            $(".AddEmployee").show();
                            toastr.success(['Employee ',' Successfully Added']);
                        }
                    }
                });
            }
        });

        $('body').on('click','.EditEmployee',function (e) {
            e.preventDefault();
            var employee_id = $(this).attr('id');
            if(employee_id != ''){
                $.ajax({
                    type: "get",
                    url: '{{ route("employee.edit") }}',
                    data:{employee_id:employee_id},
                    success: function(data) {
                        $('.edit_employee_id').val(data.id);
                        $('#employee_id').val(data.employee_id);
                        $('#name').val(data.name);
                        $('#email').val(data.email);
                        $('#mobile_number').val(data.mobile_number);
                        $('input:radio[name="gender"]').filter('[value="'+ data.gender +'"]').attr('checked', true);
                        $('#city').val(data.city);
                        $('#address').val(data.address);
                    }
                });
            }
        });

        $('body').on('click','.EmployeeSalary',function (e) {
            e.preventDefault();
            var salary_employee_id = $(this).attr('id');
            var employee_id_for_salary = $(this).attr('employee_id');
            $('.salary_employee_id').val(salary_employee_id);
            $('#employee_id_for_salary').val(employee_id_for_salary);
        });

        $('.UpdateEmployee').on('click',function (e) {
            var form = $( "#UpdateEmployeeForm" );
            form.validate();
            e.preventDefault();
            var checkValid = form.valid();
            if(checkValid == true){
                $.ajax({
                    type: "post",
                    url: '{{ route("employee.update") }}',
                    data:$('#UpdateEmployeeForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        $(".UpdateEmployee").hide();
                        $("#loading-image1").show();
                    },
                    success: function(data) {
                        if(data.error.length > 0){
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++){
                                error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                            }
                            $('#edit_form_output').show();
                            $('#edit_form_output').html(error_html);
                            $("#loading-image1").hide();
                            $(".UpdateEmployee").show();
                            setTimeout(function(){ 
                                $('#edit_form_output').hide();
                            }, 5000);
                        }else{
                            $('#editEmployeeModal').modal('hide');
                            EmployeeTable.ajax.reload();
                            $("#UpdateEmployeeForm")[0].reset();
                            $("#loading-image1").hide();
                            $(".UpdateEmployee").show();
                            toastr.success(['Employee ',' Successfully Updated']);
                        }
                    }
                });
            }
        });

        var employeeId = "";
        $('body').on('click','.DeleteEmployee',function () {
            var employee_id = $(this).attr('id');
            employeeId = employee_id;
        });

        $(".DeleteConfirmed").click(function(e) {
            e.preventDefault();
            if (employeeId != '') {
                $.ajax({
                    type: "delete",
                    url: '{{ route('employee.delete') }}',
                    data: {employee_id: employeeId},
                    success: function (data) {
                        if(data.status == 'error'){
                            toastr.error("something went wrong");
                            EmployeeTable.ajax.reload();
                        }else{
                            $('#DeleteModel').modal('hide');
                            toastr.success(['Employee ', 'Successfully Deleted']);
                            EmployeeTable.ajax.reload();
                        }
                    }
                });
            }
        });

        $(document).on('click', '#bulk_delete', function(){
            var id = [];
            if(confirm("Are you sure you want to Delete this data?"))
            {
                $('.employee_checkbox:checked').each(function(){
                    id.push($(this).val());
                });
                if(id.length > 0){
                    $.ajax({
                        url:"{{ route('employee.massremove')}}",
                        method:"get",
                        data:{id:id},
                        success:function(data)
                        {
                            if(data.status == 'success'){
                                toastr.success(['Employee ', 'Successfully Deleted']);
                                EmployeeTable.ajax.reload();
                            }else{
                                toastr.error(['Employee ', 'Cannot be Deleted']);  
                            }
                        }
                    });
                }else{
                    alert("Please select atleast one checkbox");
                }
            }
        });

        $('body').on('keyup keypress','.calculateSalary', function() {
            var base_salary = $('#base_salary').val();
            var pf = $('#pf').val();
            var esi = $('#esi').val();
            var tds = $('#tds').val();
            if(base_salary == ''){ base_salary = 0; }
            if(pf == ''){ pf = 0; }
            if(esi == ''){ esi = 0; }
            if(tds == ''){ tds = 0; }
            var TotalPF = base_salary*pf/100;
            var TotalESI = base_salary*esi/100;
            var TotalTDS = base_salary*tds/100;
            var TotalSalary = base_salary - TotalPF - TotalESI - TotalTDS;
            $('#net_salary').val(TotalSalary);
        });

        $('.AddEmployeeSalary').on('click',function (e) {
            var form = $( "#AddEmployeeSalaryForm" );
            form.validate();
            e.preventDefault();
            var checkValid = form.valid();
            if(checkValid == true){
                $.ajax({
                    type: "post",
                    url: '{{ route("employee.add.salary") }}',
                    data:$('#AddEmployeeSalaryForm').serialize(),
                    dataType: 'json',
                    beforeSend:function(){
                        $(".AddEmployeeSalary").hide();
                        $("#loading-image2").show();
                    },
                    success: function(data) {
                        if(data.status){
                            $('#AddEmployeeSalaryModal').modal('hide');
                            EmployeeTable.ajax.reload();
                            $("#AddEmployeeSalaryForm")[0].reset();
                            $("#loading-image2").hide();
                            $(".AddEmployeeSalary").show();
                            toastr.success(['Employee ',' Salary Successfully Added']);
                        }else{
                            var error_html = '';
                            for(var count = 0; count < data.error.length; count++){
                                error_html += '<div class="alert alert-danger">'+data.error[count]+'</div>';
                            }
                            $('#form_output').show();
                            $('#form_output').html(error_html);
                            $("#loading-image2").hide();
                            $(".AddEmployeeSalary").show();
                            setTimeout(function(){ 
                                $('#form_output').hide();
                            }, 5000);
                        }
                    }
                });
            }
        });
    });

</script>
