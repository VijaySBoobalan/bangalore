<!-- Modal -->
<div class="modal fade in editEmployeeModal" id="editEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Edit Employee</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="UpdateEmployeeForm" method="post" class="form-validate-jquery UpdateEmployeeForm" data-parsley-validate name="form2" role="form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="row">
                        <input type="hidden" name="edit_employee_id" id="edit_employee_id" class="form-control edit_employee_id">
                        <div id="edit_form_output"></div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee Id</label>
                                <input type="text" name="employee_id" id="employee_id" class="form-control" placeholder="Employee Id" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" id="name" class="form-control" placeholder="Employee Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" id="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="number" name="mobile_number" id="mobile_number" class="form-control" placeholder="Mobile Number" minlength="10" maxlength="11" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" class="gender" value="male">Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" class="gender" value="female"> Fe-Male </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" id="city" class="form-control" placeholder="City" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" id="address" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary UpdateEmployee pull-left">Update</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
            <img id="loading-image1" src="{{ url('assets/img/savingloader.gif') }}" style="display:none;"/>
        </div>
    </div>
</div>


<div class="modal fade" id="DeleteModel" role="dialog">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Are You Sure ! You Want to Delete</h4>
            </div>
            <div class="modal-body">
                <form action="#">
                    <button type="button" class="btn btn-danger DeleteConfirmed" data-dismiss="modal">Delete </button>
                    <button type="button" style="float: right;" class="btn btn-default" data-dismiss="modal">Close</button>
                </form>
            </div>
        </div>
    </div>
</div>
