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

            <h4 class="header-title mb-0">Total Users</h4>

            <!--  Modal content for the Large example -->
            <div class="modal fade" id="custom-modal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-lg modal-dialog-centered">
                    {{-- @livewire('user.users-form') --}}

                    @livewire('user.create')

                </div><!-- /.modal-dialog -->
            </div><!-- /.modal -->

            <button wire:click="create" type="button" class="btn btn-soft-info waves-effect waves-light mt-3 mb-3"
                data-toggle="modal"><i class="mdi mdi-briefcase-plus-outline mr-1"></i>
                Add New User</button>

            @if ($users->count())
                <div class="table-responsive">
                    <table id="datatable-buttons" class="table table-hover">
                        <thead>
                            <tr>

                                <th>#</th>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Phone</th>
                                <th>Address</th>
                                <th>Email</th>
                                <th>Hak Akses</th>
                                <th>Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @foreach ($users as $u)
                                <tr>

                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <img class="rounded-circle" src="{{ url('storage/photos_thumb', $u->image) }}"
                                            alt="Image" style="height: 50px; width: 50px;">

                                    </td>
                                    <td>{{ $u->name }}</td>

                                    <td>
                                        {{ $u->phone }}
                                    </td>
                                    <td>
                                        {{ $u->address }}
                                    </td>

                                    <td>
                                        {{ $u->email }}
                                    </td>

                                    <td>{{ $u->role_id == '1' ? ($u->role_id == '1' ? 'Admin' : 'Kasir') : ($u->role_id == '2' ? 'Kasir' : 'Customer') }}
                                    </td>

                                    <td>


                                        <button wire:click="selectedItem({{ $u->id }}, 'update')" type="button"
                                            class="btn btn-soft-success waves-effect waves-light "><i
                                                class="mdi mdi-briefcase-edit-outline"></i></button>
                                        <button wire:click="selectedItem({{ $u->id }}, 'delete')" type="button"
                                            class="btn btn-soft-danger waves-effect waves-light"><i
                                                class="mdi mdi-briefcase-remove-outline"></i></button>

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
