    <footer class="main-footer">
        <strong>Copyright &copy; </strong> All rights reserved.
    </footer>
</div>
<script src="{{ asset('/assets/js/app.min.js') }}"></script>
<script src="{{ asset('/assets/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/jszip.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/pdfmake.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/vfs_fonts.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/buttons.html5.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/buttons.print.min.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/date-dd-MMM-yyyy.js') }}"></script>
<script src="{{ asset('/assets/js/datatable/jquery-ui.js') }}"></script>
<script src="{{ asset('/assets/js/validation.js') }}"></script>

<script src="{{ asset('/assets/js/select2.min.js') }}"></script>
<script src="{{ url('assets/plugins/icheck/icheck.js') }}"></script>


<script src="//cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js" type="text/javascript"></script>

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>

<script>
    $(document).ready( function () {
        $('.DataTable').DataTable({
            "aaSorting": []
        });
        $('.select2').select2();
    });
</script>
@yield('script')