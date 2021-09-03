@extends('layouts.app', ['title' => 'Sales Data'])

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
                            <li class="breadcrumb-item active">Sales Data</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Sales Data</h4>
                </div>
            </div>
        </div>

        @livewire('sale.index')

    @endsection
    @section('script')
        <script src="{{ asset('assets/js/jquery-3.6.0.min.js') }}"></script>
        <script src="{{ asset('assets/js/vendor.min.js') }}"></script>

        <script>
            window.addEventListener('openModal', event => {
                $("#custom-modal").modal('show');

            });
            window.addEventListener('closeModal', event => {
                $("#custom-modal").modal('hide');

            });
        </script>
    @endsection
