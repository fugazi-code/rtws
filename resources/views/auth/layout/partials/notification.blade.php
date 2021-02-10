<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    $(document).ready(function () {
        $.ajax({
            url: '{{ route('notif') }}',
            method: 'POST',
            data:{ 'errors': {!! collect($errors->all()) !!}},
            success: function (value) {
                if(value.status == 'success') {
                    swal("Success!", "{{ Session::get('success') }}", "success");
                }
                if(value.status == 'error') {
                    swal("Error!", "{{ Session::get('error') }}", "error");
                }
                if(value.status == 'warning') {
                    swal("Warning!", "{{ Session::get('warning') }}", "warning");
                }
                {{--if(value.status == 'errors') {--}}
                {{--    swal("Errors!", "@foreach($errors->all() as $item){{ $item.'\n' }}@endforeach", "error");--}}
                {{--}--}}
            }
        });
    });
</script>
