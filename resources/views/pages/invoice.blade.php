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
                            <li class="breadcrumb-item active">Invoice</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Invoice</h4>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card-box">
                    <!-- Logo & title -->
                    <div class="clearfix">

                        <div class="float-right">
                            <h4 class="m-0 d-print-none">Invoice</h4>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mt-3">
                                <p><b>Hello, Jones</b></p>
                                <p class="text-muted">Thanks a lot because you keep purchasing our products. Our company
                                    promises to provide high quality products for you as well as outstanding
                                    customer service for every transaction. </p>
                            </div>

                        </div><!-- end col -->
                        <div class="col-md-4 offset-md-2">
                            <div class="mt-3 float-right">
                                <p class="m-b-10"><strong>Order Date : </strong> <span class="float-right">
                                        &nbsp;&nbsp;&nbsp;&nbsp; {{ $tgl }}</span></p>

                            </div>
                        </div><!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table mt-4 table-centered">
                                    <thead>
                                        <tr>
                                            <th>#</th>
                                            <th>Item</th>
                                            <th style="width: 10%">Qty</th>
                                            <th style="width: 20%" class="text-right">Harga</th>
                                            <th style="width: 20%" class="text-right">Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($carts as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>
                                                    <b>{{ $item['name'] }}</b>
                                                </td>
                                                <td>{{ $item['qty'] }}</td>
                                                <td class="text-right">Rp. {{ number_format($item['pricesingle']) }}</td>
                                                <td class="text-right">Rp. {{ number_format($item['price']) }}</td>

                                            </tr>
                                        @endforeach


                                    </tbody>
                                </table>
                            </div> <!-- end table-responsive -->
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="row">
                        <div class="col-sm-6">
                            <div class="clearfix pt-5">
                                <h6 class="text-muted">Notes:</h6>

                                <small class="text-muted">
                                    All accounts are to be paid within 7 days from receipt of
                                    invoice. To be paid by cheque or credit card or direct payment
                                    online. If account is not paid within 7 days the credits details
                                    supplied as confirmation of work undertaken will be charged the
                                    agreed quoted fee noted above.
                                </small>
                            </div>
                        </div> <!-- end col -->
                        <div class="col-sm-6">
                            <div class="float-right">
                                <p><b>Sub-total: </b> <span class="float-right">
                                        {{ number_format($summary['sub_total']) }}</span></p>
                                <p><b>Discount (10%):</b> <span class="float-right"> &nbsp;&nbsp;&nbsp; 0</span></p>
                                <h3>Rp. {{ number_format($summary['sub_total']) }}</h3>
                            </div>
                            <div class="clearfix"></div>
                        </div> <!-- end col -->
                    </div>
                    <!-- end row -->

                    <div class="mt-4 mb-1">
                        <div class="text-right d-print-none">
                            <a href="javascript:window.print()" class="btn btn-primary waves-effect waves-light"><i
                                    class="mdi mdi-printer mr-1"></i> Print</a>
                            <a href="{{ url('/invoice/submit') }}"
                                class="btn btn-info waves-effect waves-light">Submit</a>
                        </div>
                    </div>
                </div> <!-- end card-box -->
            </div> <!-- end col -->
        </div>
        <!-- end row -->


    @endsection

    @section('script')

    @endsection
