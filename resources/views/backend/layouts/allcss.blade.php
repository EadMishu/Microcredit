<link rel="shortcut icon" href="{{asset('backend')}}/images/logo/sm-light.png" type="image/x-icon">
<!-- Bootstrap css -->
<link rel="stylesheet" href="{{asset('backend')}}/vendor/bootstrap/css/bootstrap.min.css">
<!-- Bootstrap icon -->
<link rel="stylesheet" href="{{asset('backend')}}/vendor/bootstrap/icon/bootstrap-icons.min.css">
<!-- Custom CSS -->
<link rel="stylesheet" href="{{asset('backend')}}/css/style.css">

<!-- Repeater Form -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>



<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: "{{ session('success') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

@if(session('error'))
<script>
    Swal.fire({
        icon: 'error',
        title: 'Error!',
        text: "{{ session('error') }}",
        timer: 3000,
        showConfirmButton: false
    });
</script>
@endif

