<!-- Modal -->
<div class="modal fade in AddEmployeeSalaryModal" id="AddEmployeeSalaryModal">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">×</span></button>
                <h4 class="modal-title">Salary</h4>
            </div>
            <div class="modal-body">
                <form action="#" id="AddEmployeeSalaryForm" method="post" class="form-validate-jquery AddEmployeeSalaryForm" data-parsley-validate name="form2" role="form">
                    <meta name="csrf-token" content="{{ csrf_token() }}">
                    @csrf
                    <div class="row">
                        <div id="form_output"></div>
                        <input type="hidden" name="salary_employee_id" id="salary_employee_id" class="form-control salary_employee_id">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Employee Id</label>
                                <input type="text" value="" id="employee_id_for_salary" name="employee_id" class="form-control" placeholder="Employee Id" readonly>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Base Salary</label>
                                <input type="text" name="base_salary" id="base_salary" class="form-control calculateSalary" placeholder="Base salary" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>PF %</label>
                                <input type="number" name="pf" id="pf" class="form-control calculateSalary" placeholder="PF %">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>ESI %</label>
                                <input type="number" name="esi" id="esi" class="form-control calculateSalary" placeholder="ESI %">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>TDS %</label>
                                <input type="number" name="tds" id="tds" class="form-control calculateSalary" placeholder="TDS">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="form-group">
                                <label>Net Salary</label>
                                <input type="number" name="net_salary" id="net_salary" class="form-control" placeholder="Net Salary" readonly>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary AddEmployeeSalary pull-left">Save</button>
                <button type="button" class="btn btn-default " data-dismiss="modal">Close</button>
            </div>
            <img id="loading-image2" src="{{ url('assets/img/savingloader.gif') }}" style="display:none;"/>
        </div>
    </div>
</div>
