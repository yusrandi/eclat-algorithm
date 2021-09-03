@extends('layouts.app', ['title' => 'Users Data'])

@section('css')

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
                            <li class="breadcrumb-item active">Users Data</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Users Data</h4>
                </div>
            </div>
        </div>
        @livewire('user.index')
    @endsection

    @section('script')

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
