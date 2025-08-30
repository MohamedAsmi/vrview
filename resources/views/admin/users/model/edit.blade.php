<div class="modal-dialog modal-md">
    <div class="modal-content">
        <div class="modal-header modal-colored-header">
            <h4 class="modal-title" id="primary-header-modalLabel">User Details</h4>
            <button type="button" class="btn-close" data-dismiss="modal" aria-hidden="true">
                <i class="fa fa-close"></i>
            </button>
        </div>
        <div class="card">
            <div class="card-body">
                <div id="message-area"></div>

                <form method="PUT" action="{{ route('users.update', ['user' => $user]) }}" enctype="multipart/form-data"
                    id="ajax-form" data-reload="true" table="users_table">
                    @csrf

                    <div class="row mb-3">
                        <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                        <div class="col-md-6">
                            <input id="name" type="text"
                                class="form-control  text-black @error('name') is-invalid @enderror" name="name"
                                value="{{ $user->name }}" required autocomplete="name" autofocus>

                            @error('name')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="email"
                            class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                        <div class="col-md-6">
                            <input id="email" type="email"
                                class="form-control  text-black @error('email') is-invalid @enderror" name="email"
                                value="{{ $user->email }}" required autocomplete="email">

                            @error('email')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="row mb-3">
                        <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                        <div class="col-md-6">
                            <input id="address" type="text"
                                class="form-control  text-black @error('address') is-invalid @enderror" name="address"
                                value="{{ $user->address }}" required autocomplete="address" autofocus>

                            @error('address')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="mobile" class="col-md-4 col-form-label text-md-end">{{ __('Mobile') }}</label>
                        <div class="col-md-6">
                            <input id="mobile" type="text"
                                class="form-control  text-black @error('mobile') is-invalid @enderror" name="mobile"
                                value="{{ $user->mobile }}" required autocomplete="mobile" autofocus>

                            @error('mobile')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="type" class="col-md-4 col-form-label text-md-end">{{ __('Type') }}</label>
                        <div class="col-md-6">
                            <select name="type" id="type" class="form-control">
                                <option value="0" @if ($user->type == 0) selected @endif>User</option>
                                <option value="1" @if ($user->type == 1) selected @endif>Agent</option>
                            </select>


                        </div>
                    </div>
                    <div class="row mb-3">
                        <label for="status" class="col-md-4 col-form-label text-md-end">{{ __('Status') }}</label>
                        <div class="col-md-6">
                            <select name="status" id="status" class="form-control">
                                <option value="1" @if ($user->status == 1) selected @endif>Active</option>
                                <option value="0" @if ($user->status == 0) selected @endif>InActive
                                </option>
                            </select>


                        </div>
                    </div>

                    <div class="row mb-0">
                        <div class="col-md-6 offset-md-4">
                            <button type="submit" class="btn btn-success px-4 py-2">
                                {{ __('update') }}
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
