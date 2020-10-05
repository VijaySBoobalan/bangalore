<!-- Modal -->
<div class="modal fade in AddEmployeeModal" id="AddEmployeeModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Add Employee</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="AddEmployeeForm" method="post" class="form-validate-jquery AddEmployeeForm" data-parsley-validate name="form2" role="form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="row">
                        <div id="form_output"></div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee Id</label>
                                <input type="text" value="{{ $employee_id }}" name="employee_id" class="form-control" placeholder="Employee Id" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Name</label>
                                <input type="text" name="name" class="form-control" placeholder="Employee Name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" name="email" class="form-control" placeholder="Email" required>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Mobile Number</label>
                                <input type="number" name="mobile_number" class="form-control" placeholder="Mobile Number" minlength="10" maxlength="11" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Gender</label>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="male" checked="">Male
                                    </label>
                                </div>
                                <div class="radio">
                                    <label>
                                        <input type="radio" name="gender" id="gender" value="female"> Fe-Male </label>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>City</label>
                                <input type="text" name="city" class="form-control" placeholder="City" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="address" placeholder="Address"></textarea>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary AddEmployee pull-left">Save</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
            <img id="loading-image" src="{{ url('assets/img/savingloader.gif') }}" style="display:none;"/>
        </div>
    </div>
</div>
