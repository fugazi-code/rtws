<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script>
        //window.history.forward(1);
        console.log('hah')
        console.log(document.referrer)
        @if(Session::has('success'))
        swal("Success!", "{{ Session::get('success') }}", "success").then(function(){
            window.location = window.location.href;
        });
        @endif
        @if(Session::has('error'))
        swal("Error!", "{{ Session::get('error') }}", "error").then(function(){
            window.location = window.location.href;
        });
        @endif
        @if(Session::has('warning'))
        swal("Warning!", "{{ Session::get('warning') }}", "warning").then(function(){
            window.location = window.location.href;
        });
        @endif
        @if($errors->any())
        swal("Error!", "@foreach($errors->all() as $item){{ $item.'\n' }}@endforeach", "error").then(function(){
            window.location = window.location.href;
        });
        @endif
</script>
