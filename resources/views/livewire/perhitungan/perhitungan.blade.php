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

            <div class="form-group row mb-3 mt-3">

                <div class="col-6">
                    <label for="">Minimum Nilai Support</label>
                    <input wire:model="minSupport" type="number" class="form-control " id="inputPassword3"
                        placeholder="Min nilai Support ">
                </div>

                <div class="col-6">
                    <label for="">Minimum Nilai Confidence</label>
                    <input wire:model="minCf" type="number" class="form-control " id="inputPassword3"
                        placeholder="Min Nilai Confidence">
                </div>

            </div>

            @if ($trans->count())
                <h4>Transaksi Awal</h4>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>
                                <th>TID</th>
                                <th>Item</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($trans as $key => $items)
                                <tr>
                                    <td>{{ $key }}</td>
                                    <td>
                                        @foreach ($items as $index => $item)
                                            @php
                                                if ($index != 0) {
                                                    echo ', ';
                                                }
                                                echo $item->product->name;
                                            @endphp
                                        @endforeach
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4>Transaksi Vertical</h4>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>
                                <th>Itemset</th>
                                <th>TID List</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $items)
                                <tr>
                                    <td>{{ $items->name }}</td>
                                    <td>
                                        @foreach ($items->transactions as $index => $item)
                                            @php
                                                if ($index != 0) {
                                                    echo ', ';
                                                }
                                                echo $item->kode;
                                            @endphp
                                        @endforeach
                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <h4>Hasil Penyilangan 2 Itemset</h4>
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>
                                <th width="30%">Itemset</th>
                                <th width="30%">TID List</th>
                                <th>Support</th>
                                <th>Confidence</th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $key => $item1)

                                @foreach ($products as $key => $item2)
                                    @if ($item1->id != $item2->id)

                                        @php
                                            $count = 0;
                                            $total = count($trans);
                                            $tdlist = [];
                                            foreach ($trans as $keyTrans => $items) {
                                                $tr_value = [];
                                                foreach ($items as $key => $value) {
                                                    $tr_value[$key] = $value['product_id'];
                                                }
                                                if (in_array($item1->id, $tr_value) & in_array($item2->id, $tr_value)) {
                                                    $count++;
                                                    // echo $keyTrans . ', ';
                                                    $tdlist[] = $keyTrans;
                                                }
                                            }
                                            
                                            $count1 = count($alltrans->where('product_id', $item1->id));
                                            $count2 = count($alltrans->where('product_id', $item2->id));
                                        @endphp



                                        @if ($count > 0)
                                            @if (($minSupport < number_format(($count / $total) * 100)) & ($minCf <
                                                number_format(($count / $count2) * 100))) <tr>
                                                <td>{{ $item1->name . ', ' . $item2->name }}
                                                <td>
                                                    @foreach ($tdlist as $item)
                                                        {{ $item . ', ' }}
                                                    @endforeach
                                                </td>
                                                <td>{{ '(' . $count . '/' . $total . ') * 100 = ' . number_format(($count / $total) * 100) . '%' }}
                                                </td>
                                                <td>{{ '(' . $count . '/' . $count2 . ') * 100 = ' . number_format(($count / $count2) * 100) . '%' }}
                                                </td>
                                                </tr>
                                        @endif

                                    @endif

                                @endif

                            @endforeach

            @endforeach
            </tbody>
            </table>
        </div>

        @endif


    </div> <!-- end card-box -->
</div> <!-- end col-->
</div>
<!-- end row -->
