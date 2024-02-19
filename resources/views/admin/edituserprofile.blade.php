@extends('layouts.master')

@section('title', 'Dashboard')

@section('content')
    <div class="container" style="margin-top: 140px; text-align: center;">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header" style="font-size: 24px; color: orange; font-weight: bold; margin-left:45px;">
                        {{ __('Admin Profile') }}
                    </div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <form method="POST" action="{{ route('edituserprofile.submit') }}">
                            @csrf
                            <input type="hidden" name="userId" value="{{ $userDetails['userId'] }}">

                            <div class="form-group row">
                                <label for="userName" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('User Name') }}</label>

                                <div class="col-md-6">
                                    <input id="userName" type="text" class="form-control @error('userName') is-invalid @enderror" name="userName" value="{{ old('name', $userDetails['name'] ?? '') }}" required autocomplete="userName" autofocus>
                                    @error('userName')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="email" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('Email') }}</label>

                                <div class="col-md-6">
                                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email', $userDetails['email'] ?? '') }}" required autocomplete="email">
                                    @error('email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="password" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('Password') }}</label>

                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" value="{{ old('password', $userDetails['password'] ?? '') }}" autocomplete="new-password">
                                    @error('password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row">
                                <label for="genderId" class="col-md-4 col-form-label text-md-right" style="font-weight: bold;">{{ __('Gender ID') }}</label>

                                <div class="col-md-6">
                                    <select id="genderId" class="form-control @error('genderId') is-invalid @enderror" name="genderId" value="{{ old('genderId', $userDetails['genderId'] ?? '') }}" required>
                                        <option value="0" {{ old('genderId', $userDetails['genderId'] ?? '') == '0' ? 'selected' : '' }}>0</option>
                                        <option value="1" {{ old('genderId', $userDetails['genderId'] ?? '') == '1' ? 'selected' : '' }}>1</option>
                                    </select>
                                    @error('genderId')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="form-group row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary" style="margin-top: 10px;">
                                        {{ __('Update Profile') }}
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
