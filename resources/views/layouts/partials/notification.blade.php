<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    @if(Session::has('success'))
        swal("Success!", "{{ Session::get('success') }}", "success");
    @endif
    @if(Session::has('error'))
        swal("Error!", "{{ Session::get('error') }}", "error");
    @endif
    @if($errors->any())
        swal("Error!", "@foreach($errors->all() as $item){{ $item.'\n' }}@endforeach", "error");
    @endif
</script>
