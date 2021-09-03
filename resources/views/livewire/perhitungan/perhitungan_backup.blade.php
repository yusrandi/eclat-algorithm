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
            <h4 class="header-title mb-0">Nilai Support Itemset 3</h4>
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
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>

                                <th>item 1</th>
                                <th>item 2</th>
                                <th>item 3</th>
                                <th>Jumlah</th>
                                <th>Jumlah Trx</th>
                                <th>Support</th>
                                <th>Cf 1</th>
                                <th>Cf 2</th>
                                <th>Cf 3</th>
                                <th>Keterangan</th>
                            </tr>
                        </thead>

                        <tbody>

                            @foreach ($products as $key => $item1)
                                @foreach ($products as $key => $item2)
                                    @foreach ($products as $key => $item3)
                                        @if ($item1->id != $item2->id && $item1->id != $item3->id)
                                            @if ($item2->id != $item3->id)
                                                @php
                                                    $itemValue = $item1->id . ',' . $item2->id . ',' . $item3->id;
                                                    $count = 0;
                                                    $total = count($trans);
                                                    foreach ($trans as $key => $items) {
                                                        $tr_value = [];
                                                        foreach ($items as $key => $value) {
                                                            $tr_value[$key] = $value['product_id'];
                                                        }
                                                        if (in_array($item1->id, $tr_value) & in_array($item2->id, $tr_value) & in_array($item3->id, $tr_value)) {
                                                            // echo ' true';
                                                            $count++;
                                                        }
                                                    }
                                                    $count1 = count($alltrans->where('product_id', $item1->id));
                                                    $count2 = count($alltrans->where('product_id', $item2->id));
                                                    $count3 = count($alltrans->where('product_id', $item3->id));
                                                @endphp
                                                @if ($count > 0)
                                                    @if (($count1 != 0) | ($count2 != 0) | ($count3 != 0))
                                                        @if ($minSupport < number_format(($count / $total) * 100))
                                                            @if (($minCf < number_format(($count / $count1) * 100)) |
                                                                ($minCf < number_format(($count / $count2) * 100)) |
                                                                ($minCf < number_format(($count / $count3) * 100))) <tr>
                                                                <td>{{ $item1->name }}</td>
                                                                <td>{{ $item2->name }}</td>
                                                                <td>{{ $item3->name }}</td>
                                                                <td>{{ $count }}</td>
                                                                <td>{{ $total }}</td>

                                                                {{-- nilai support --}}
                                                                <td>{{ number_format(($count / $total) * 100) . '%' }}
                                                                </td>

                                                                {{-- nilai confidence --}}
                                                                <td>{{ number_format(($count / $count1) * 100) . '%' }}
                                                                </td>
                                                                <td>{{ number_format(($count / $count2) * 100) . '%' }}
                                                                </td>
                                                                <td>{{ number_format(($count / $count3) * 100) . '%' }}
                                                                </td>
                                                                <td> - </td>
                                                                </tr>
                                                        @endif

                                                    @endif

                                                @endif

                                            @endif

                                        @endif
                                    @endif
                                @endforeach

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
