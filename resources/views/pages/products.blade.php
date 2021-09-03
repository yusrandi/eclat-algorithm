@extends('layouts.app', ['title' => 'Products Data'])

@section('css')
    <link href="{{ asset('assets/libs/dropzone/min/dropzone.min.css') }}" rel="stylesheet" type="text/css" />

@endsection
@section('content')
    <!-- Start Content-->
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a
                                    href="javascript: void(0);">{{ config('app.name', 'Manyyu') }}</a></li>
                            <li class="breadcrumb-item active">Products Data</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Products Data</h4>
                </div>
            </div>
        </div>

        @livewire('product.index')

    @endsection

    @section('script')
        <script src="{{ asset('assets/libs/dropzone/min/dropzone.min.js') }}"></script>

        <!-- Init js-->
        <script src="{{ asset('assets/js/pages/form-fileuploads.init.js') }}"></script>

        <!-- Init js -->
        <script src="{{ asset('assets/js/pages/add-product.init.js') }}"></script>
        <script>
            window.addEventListener('openModal', event => {
                $("#custom-modal").modal('show');

            });
            window.addEventListener('closeModal', event => {
                $("#custom-modal").modal('hide');

            });

        </script>
        <script type="text/javascript">
            $(document).ready(function() {
                $("#custom-modal").on('hidden.bs.modal', function() {
                    livewire.emit('forceCloseModal');
                });


            });

        </script>
    @endsection
