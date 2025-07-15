@extends('layouts.app')

@section('content')

<!-- Particles Background -->
<div id="particles-js" style="position: fixed; width: 100%; height: 100%; z-index: 0;"></div>

<!-- Page Content -->
<div class="container position-relative" style="z-index: 1;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card text-black mt-4">
                <div class="card-header bg-transparent border-bottom border-secondary fw-bold fs-4">
                    {{ __('Register') }}
                </div>

                <div class="card-body">
                    <form method="POST" action="{{ route('register') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="row mb-3">
                            <label for="name" class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                            <div class="col-md-6">
                                <input id="name" type="text"
                                    class="form-control  text-black @error('name') is-invalid @enderror"
                                    name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                                @error('name')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="email" class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                            <div class="col-md-6">
                                <input id="email" type="email"
                                    class="form-control  text-black @error('email') is-invalid @enderror"
                                    name="email" value="{{ old('email') }}" required autocomplete="email">

                                @error('email')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password" class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                            <div class="col-md-6">
                                <input id="password" type="password"
                                    class="form-control  text-black @error('password') is-invalid @enderror"
                                    name="password" required autocomplete="new-password">

                                @error('password')
                                <span class="invalid-feedback d-block text-danger mt-1" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    class="form-control  text-black"
                                    name="password_confirmation" required autocomplete="new-password">
                            </div>
                        </div>

                        <div class="row mb-3">
                            <label for="address" class="col-md-4 col-form-label text-md-end">{{ __('Address') }}</label>
                            <div class="col-md-6">
                                <input id="address" type="text"
                                    class="form-control  text-black @error('address') is-invalid @enderror"
                                    name="address" value="{{ old('address') }}" required autocomplete="address" autofocus>

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
                                    class="form-control  text-black @error('mobile') is-invalid @enderror"
                                    name="mobile" value="{{ old('mobile') }}" required autocomplete="mobile" autofocus>

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
                                    <option value="1">User</option>
                                    <option value="2">Agent</option>
                                </select>


                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="nic" class="col-md-4 col-form-label text-md-end">{{ __('Nic') }}</label>
                            <div class="col-md-6">

                                <div class="mb-3">
                                    <label for="nic_front" class="form-label">NIC Front</label>
                                    <input id="nic_front" type="file"
                                        class="form-control @error('nic_front') is-invalid @enderror"
                                        name="nic_front" required>
                                    @error('nic_front') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="nic_back" class="form-label">NIC Back</label>
                                    <input id="nic_back" type="file"
                                        class="form-control @error('nic_back') is-invalid @enderror"
                                        name="nic_back" required>
                                    @error('nic_back') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-success px-4 py-2">
                                    {{ __('Register') }}
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>





@endsection