<div class="row">
    <div class="col-8">
        <div class="card-box">
            <h4 class="card-title">Product List</h4>

            <div class="row">
                @foreach ($products as $item)
                    <div class="col-md-3 col-xl-4">
                        <div class="card-box product-box">

                            <div class="bg-light" wire:click="hahaha">
                                <img src="{{ url('storage/products_photo_thumb', $item->image) }}" alt="product-pic"
                                    class="img-fluid" style="height: 200px" />
                            </div>

                            <div class="product-info">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <h5 class="font-16 mt-0 sp-line-1"><a href="ecommerce-product-detail.html"
                                                class="text-dark">{{ $item->name }}</a> </h5>
                                        <div class="text-warning mb-2 font-13">
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                            <i class="fa fa-star"></i>
                                        </div>
                                        <h5 class="m-0"> <span class="text-muted"> Rp.
                                                {{ number_format($item->price) }}</span></h5>
                                    </div>
                                    <div class="col-auto">
                                        <div class="product-price-tag">
                                            {{ $item->stock }}
                                        </div>
                                    </div>
                                </div> <!-- end row -->
                            </div> <!-- end product info-->
                            <div class="col-md-12 text-center mt-3">
                                <button wire:click="addItem({{ $item->id }})"
                                    class="btn btn-soft-success waves-effect waves-light btn-block"><i
                                        class="mdi mdi-plus-circle mr-1"></i> Add to Cart</button>


                            </div>
                        </div> <!-- end card-box-->
                    </div> <!-- end col-->
                @endforeach
            </div>

        </div>
    </div>
    <div class="col-4">
        <div class="card-box">
            <h4 class="card-title">Sales Data</h4>
            <div class="table-responsive">
                <table id="datatable-buttons" class="table table-hover">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>qty</th>
                            <th class="text-right">Price</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach ($carts as $index => $item)
                            <tr>
                                <td>{{ $item['name'] }}</td>
                                <td>
                                    <i wire:click="increase({{ $item['rowId'] }})" class="fe-plus"
                                        style="cursor: pointer"></i>
                                    {{ $item['qty'] }}
                                    <i wire:click="decrease({{ $item['rowId'] }})" class="fe-minus"
                                        style="cursor: pointer"></i>
                                </td>
                                <td class="text-right">{{ number_format($item['price']) }}

                                    <i wire:click="remove({{ $item['rowId'] }})" class="fe-x ml-1"
                                        style="cursor: pointer"></i>


                                </td>

                            </tr>
                        @endforeach

                        <tr>
                            <td colspan="2" class="text-right">Sub Total :</td>
                            <td colspan="2" class="text-right">Rp. {{ number_format($summary['sub_total']) }}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Tax :</td>
                            <td colspan="2" class="text-right">Rp.{{ number_format($summary['pajak']) }}</td>
                        </tr>
                        <tr>
                            <td colspan="2" class="text-right">Total :</td>
                            <td colspan="2" class="text-right">Rp.{{ number_format($summary['total']) }}</td>
                        </tr>
                    </tbody>

                </table>

                @if ($carts)
                    <div class="col-md-12 text-center mt-3">

                        <button wire:click="saveTransaction()"
                            class="btn btn-soft-info waves-effect waves-light btn-block"><i
                                class="mdi mdi-plus-circle mr-1"></i> Save Transactions</button>


                    </div>
                @endif

            </div>



        </div>
    </div>
</div>
