@extends('backend.layouts.app', ['class' => 'off-canvas-sidebar', 'activePage' => 'login', 'title' => __('Admin Login')])

@section('content')
<div class="container" style="height: auto;">
    <div class="row align-items-center">
        <div class="col-lg-4 col-md-6 col-sm-8 ml-auto mr-auto">
            <form class="form" method="POST" action="{{ route('admin.create.password') }}">
                @csrf
                <input type="hidden" name="id" value="{{$user->id}}">
                <div class="card card-login card-hidden mb-3">
                    <div class="card-header card-header-primary text-center">
                        <h4 class="card-title"><strong>{{ __('Create Password') }}</strong></h4>
                        <div class="social-line">
                            Make a difference.
                        </div>
                    </div>
                    <div class="card-body">
                        <div class="bmd-form-group{{ $errors->has('email') ? ' has-danger' : '' }}">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">email</i>
                                    </span>
                                </div>
                                <input type="email" name="email" value="{{$user->email}}" class="form-control" placeholder="{{ __('Email...') }}" value="{{ old('email', '') }}" required>
                            </div>
                            @if ($errors->has('email'))
                                <div id="email-error" class="error text-danger pl-3" for="email" style="display: block;">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" name="password" id="password" class="form-control" placeholder="{{ __('Password...') }}" value="{{ !$errors->has('password') ? "" : "" }}" required>
                            </div>
                            @if ($errors->has('password'))
                                <div id="password-error" class="error text-danger pl-3" for="password" style="display: block;">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </div>
                            @endif
                        </div>
                        <div class="bmd-form-group{{ $errors->has('password') ? ' has-danger' : '' }} mt-3">
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">
                                        <i class="material-icons">lock_outline</i>
                                    </span>
                                </div>
                                <input type="password" name="password_confirmation" id="password-confirm" class="form-control" placeholder="{{ __('Confirm password') }}" value="" required>
                            </div>
                            @if ($errors->has('password_confirmation'))
                                <div id="password-error" class="error text-danger pl-3" for="password-confirm" style="display: block;">
                                    <strong>{{ $errors->first('password_confirmation') }}</strong>
                                </div>
                            @endif
                        </div>

                        <div class="form-check mr-auto ml-3 mt-3">
                            <label class="form-check-label">
                                <input class="form-check-input" type="checkbox" name="sign_in" {{ old('sign_in') ? 'checked' : '' }}> {{ __('Sign me in') }}
                                <span class="form-check-sign">
                                    <span class="check"></span>
                                </span>
                            </label>
                        </div>
                    </div>
                    <div class="card-footer justify-content-center">
                        <button type="submit" class="btn btn-primary btn-link btn-lg">{{ __('Lets Go') }}</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
