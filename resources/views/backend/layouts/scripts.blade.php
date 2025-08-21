    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="{{asset('backend')}}/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
    
    <script src="{{asset('backend')}}/vendor/apexcharts/apexcharts.js"></script>
    <script src="{{asset('backend')}}/vendor/apexcharts/charts.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="{{asset('backend')}}/js/main.js"></script>
    <script src="{{asset('backend')}}/js/custom.js"></script>
    @stack('js')
@if(session('success'))
<script>
    Swal.fire({
        icon: 'success',
        title: 'Success!',
        text: '{{ session('success')}}',
        timer: 3000,
        showConfirmButton: false
    });
</script> 
@endif 

<!-- Repeater Form -->


<!-- Repeater Form -->

 