<div class="row">
    <div class="col-lg-12">
        <div class="card-box">
            <div class="dropdown float-right">
                <a href="#" class="dropdown-toggle arrow-none card-drop" data-toggle="dropdown" aria-expanded="false">
                    <i class="mdi mdi-dots-vertical"></i>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Sales Report</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Export Report</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Profit</a>
                    <!-- item-->
                    <a href="javascript:void(0);" class="dropdown-item">Action</a>
                </div>
            </div>

            <!--  Modal content for the Large example -->
            <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    {{-- @livewire('user.users-form') --}}

                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="myLargeModalLabel">Detail Transaction</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table id="datatable-buttons" class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Kode </th>
                                            <th>Tanggal</th>
                                            <th>qty</th>
                                            <th class="text-right">Harga</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @foreach ($selectedData as $item)
                                            <tr>
                                                <td>{{ $loop->iteration }}</td>
                                                <td>{{ $item['date'] }}</td>
                                                <td>{{ $item['qty'] . ' buah' }}</td>
                                                <td class="text-right">Rp. {{ number_format($item['price']) }}</td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-soft-danger" data-dismiss="modal">Close</button>
                        </div>
                    </div><!-- /.modal-content -->


                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <h4 class="header-title mb-0">Total Transaction</h4>

            <button wire:click="create" type="button" class="btn btn-soft-info waves-effect waves-light mt-3 mb-3"
                data-toggle="modal"><i class="mdi mdi-briefcase-plus-outline mr-1"></i>
                Add New Transaction</button>

            @if ($trans->count())
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Kode Transaksi</th>
                                <th>Tanggal</th>
                                <th class="text-right">Total</th>
                                <th class="text-right">Detail</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($trans as $index => $u)
                                <tr>
                                    <td>{{ $index }}</td>
                                    @foreach ($u as $item)


                                    @endforeach
                                    <td>{{ $item->date }}</td>
                                    <td class="text-right">Rp. {{ number_format($u->sum('price')) }}</td>
                                    <td class="text-right">
                                        <button wire:click="selectedItem({{ $u }})" type="button"
                                            class="btn btn-soft-success waves-effect waves-light"><i
                                                class="mdi mdi-briefcase-outline"></i></button>
                                    </td>
                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>

            @endif
        </div> <!-- end card-box -->
    </div> <!-- end col-->
</div>
<!-- end row -->
