<div class="modal-content">
    <div class="modal-header">
        <h4 class="modal-title" id="myLargeModalLabel">User Form</h4>
        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>

    </div>
    <div class="modal-body">
        <form class="needs-validation" novalidate>
            <div class="form-group">
                <label for="hori-pass1" class="col-sm-4 control-label">Foto User <span
                        class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input class="form-control" type="file" id="formFile" wire:model="image">
                    @error('image')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                    @if ($image)
                        <img src="{{ $image->temporaryUrl() }}" height="200px">
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Fullname <span class="text-danger">*</span>
                </label>
                <div class="col-sm-12">
                    <input wire:model="name" type="text" class="form-control" id="name" placeholder="e.g : Asep Udin">
                    @if ($errors->has('name'))
                        <small class="mt-2 text-danger">{{ $errors->first('name') }}</small>
                    @endif
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">User Phone Number <span
                        class="text-danger">*</span>
                </label>
                <div class="col-sm-12">
                    <input wire:model="phone" type="text" class="form-control" id="name" placeholder="e.g : 0897xxx">
                    @error('phone')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>
            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">User Address <span class="text-danger">*</span>
                </label>
                <div class="col-sm-12">
                    <input wire:model="address" type="text" class="form-control" id="name"
                        placeholder="e.g : Bps Sudiang">
                    @error('address')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="inputEmail3" class="col-sm-4 control-label">Email <span class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input wire:model="email" type="email" class="form-control" id="inputEmail3"
                        placeholder="e.g : google@gmail.com" autocomplete="off"
                        {{ $selectedItemId ? 'readonly' : '' }}>
                    @error('email')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group">
                <label for="hori-pass1"
                    class="col-sm-4 control-label">{{ $selectedItemId ? 'New Password ?' : 'Passowrd' }}<span
                        class="text-danger">*</span></label>
                <div class="col-sm-12">
                    <input wire:model="password" id="hori-pass1" type="password" placeholder="Password"
                        class="form-control" autocomplete="new-password">
                    @error('password')
                        <small class="mt-2 text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>


        </form>
    </div>
    <div class="modal-footer">
        <button type="button" class="btn btn-soft-danger" data-dismiss="modal">Close</button>
        <button wire:click="save" type="submit" class="btn btn-soft-secondary">Submit</button>
    </div>
</div><!-- /.modal-content -->
