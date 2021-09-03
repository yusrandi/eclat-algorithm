<!-- bundle -->
<!-- Vendor js -->
{{-- <script src="{{asset('{{ asset('assets/js/vendor.min.js') }}')}}"></script> --}}

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-Piv4xVNRyMGpqkS2by6br4gNJ7DXjqk09RmUpJ8jgGtD7zP9yug3goQfGII0yAns" crossorigin="anonymous">
</script>

@yield('script')
<!-- App js -->

<script src="{{ asset('assets/js/app.min.js') }}"></script>

@yield('script-bottom')
<script src="{{ asset('https://cdn.jsdelivr.net/npm/sweetalert2@10') }}">
</script>

<x-livewire-alert::scripts />
{{-- <x-livewire-alert::scripts /> --}}
