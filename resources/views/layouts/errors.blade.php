<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.css">
<script src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
<script>
    toastr.options.closeButton = true;
</script>
@if(count($errors))

    <script>
        @foreach($errors->all() as $error)
            toastr.error('{{ $error }}');
        @endforeach
    </script>
        
@endif

@if(Session::has('success'))
    <script>
        toastr.success('{{ Session::get('success')[1] }}', '{{ Session::get('success')[0] }}');
    </script>
@endif

@if(Session::has('danger'))
    <script>
        toastr.error('{{ Session::get('danger') }}!');
    </script>
@endif

@if(Session::has('sorry'))
    <script>
        toastr.warning('{{ Session::get('sorry') }}!');
    </script>
@endif