<div>
    <!--  Modal content for the Large example -->
    <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-centered">
            {{-- @livewire('user.users-form') --}}

            @livewire('product.create')

        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <div class="row">
        <div class="col-12">
            <div class="card-box">
                <div class="row">
                    <div class="col-lg-8">
                        <form class="form-inline">
                            <div class="form-group">
                                <label for="inputPassword2" class="sr-only">Search</label>
                                <input type="search" class="form-control" id="inputPassword2" placeholder="Search...">
                            </div>
                            <div class="form-group mx-sm-3">
                                <label for="status-select" class="mr-2">Sort By</label>
                                <select class="custom-select" id="status-select">
                                    <option selected="">All</option>
                                    <option value="1">Popular</option>
                                    <option value="2">Price Low</option>
                                    <option value="3">Price High</option>
                                    <option value="4">Sold Out</option>
                                </select>
                            </div>
                        </form>
                    </div>
                    <div class="col-lg-4">
                        <div class="text-lg-right mt-3 mt-lg-0">
                            <button type="button" class="btn btn-success waves-effect waves-light mr-1"><i
                                    class="mdi mdi-cog"></i></button>
                            <button wire:click="create" class="btn btn-soft-info waves-effect waves-light"><i
                                    class="mdi mdi-plus-circle mr-1"></i> Add New</button>
                        </div>
                    </div><!-- end col-->
                </div> <!-- end row -->
            </div> <!-- end card-box -->
        </div> <!-- end col-->
    </div>
    <!-- end row-->

    <div class="row">
        @foreach ($products as $item)
            <div class="col-md-6 col-xl-3">
                <div class="card-box product-box">

                    <div class="product-action">
                        <button wire:click="selectedItem({{ $item->id }}, 'update')"
                            class="btn btn-success btn-xs waves-effect waves-light"><i
                                class="mdi mdi-pencil"></i></button>
                        <button wire:click="selectedItem({{ $item->id }}, 'delete')"
                            class="btn btn-danger btn-xs waves-effect waves-light"><i
                                class="mdi mdi-close"></i></button>
                    </div>

                    <div class="bg-light">
                        <img src="{{ url('storage/products_photo_thumb', $item->image) }}" alt="product-pic"
                            class="img-fluid" style="height: 250px" />
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
                </div> <!-- end card-box-->
            </div> <!-- end col-->
        @endforeach


    </div>
