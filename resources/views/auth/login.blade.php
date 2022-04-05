@extends('layouts.frontend', ['class' => 'bg-default'])

@section('content')
    @include('layouts.headers.guest')

    <div class="container mt--8 pb-5">
        <div class="row justify-content-center">
            <div class="col-lg-5 col-md-7">
                <div class="card bg-secondary shadow border-0">
                    <div class="card-body px-lg-5 py-lg-5">
                        @if (session('message'))
                            <div class="alert alert-danger text-center">{{ session('message') }}</div>
                        @endif
                        @if(count($errors))
                            @if(count($errors) == 1 && in_array(__('auth.throttle'), $errors->get('email')))
                                <div class="alert alert-danger text-center">@lang('auth.throttle')</div>
                            @endif
                        @endif 
                        <div class="text-muted text-center mt-2 mb-3"><h2>{{ __('Login Sistem SSS') }}</h2></div>
                        <div class="text-center text-muted mb-4">
                            <small>
                                {{ __('Silahkan Masukkan Email / SSS ID dan Password Anda untuk masuk') }}
                            </small>
                        </div>
                        <form role="form" method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="form-group{{ $errors->has('email') ? ' has-danger' : '' }} mb-3">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('nip') || $errors->has('email') ? ' is-invalid' : '' }}" placeholder="{{ __('Login dengan email atau SSS ID') }}" type="text" name="login" value="{{ old('nip') ?: old('email') }}" required autofocus>
                                </div>
                                @if ($errors->has('nip') || $errors->has('email'))
                                    <span class="invalid-feedback">
                                        <strong>{{ __('Email/NIP tidak ditemukan atau salah') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="form-group{{ $errors->has('password') ? ' has-danger' : '' }}">
                                <div class="input-group input-group-alternative">
                                    <div class="input-group-prepend">
                                        <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                                    </div>
                                    <input class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" placeholder="{{ __('Password') }}" type="password" required>
                                </div>
                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" style="display: block;" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                            <div class="custom-control custom-control-alternative custom-checkbox">
                                <input class="custom-control-input" name="remember" id="customCheckLogin" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                                <label class="custom-control-label" for="customCheckLogin">
                                    <span class="text-muted">{{ __('Remember me') }}</span>
                                </label>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn btn-primary my-4 default-button">{{ __('Masuk') }}</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
