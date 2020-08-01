<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
    @if(Session::has('success'))
        swal("Success!", "{{ Session::get('success') }}", "success");
    @endif
    @if($errors->any())
        swal("Error!", "@foreach($errors->all() as $item){{ $item.'\n' }}@endforeach", "error");
    @endif
</script>
