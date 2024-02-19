@extends('layouts.log')
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

@section('title')
    Login 2
@endsection

@section('content')
    <div class="container" style="color: black; display: flex; justify-content: center; align-items: center; height: 100vh;">
        <form method="post" action="{{ route('login2.submit') }}" style="text-align: center;">
            @csrf
            <div class="main-login">
                <div class="left-login">
                    <h1>ADMIN PANEL<br>DOOR CUT</h1>
                    <img src="{{ asset('images/person-working.png') }}" class="left-login-image" alt="Pessoa trabalhando">
                </div>
                <div class="right-login">
            <div class="card-login">
                <h1>LOGIN</h1>
                @if ($errors->has('error'))
                    <div class="alert alert-danger" style="color:green;">
                        {{ $errors->first('error') }}
                    </div>
                @endif
                        <div class="textfield">
                            <label for="email">Email</label>
                            <input type="email" name="email" placeholder="Email" required style="color: black;">
                        </div>
                        <div class="textfield">
                            <label for="password">Password</label>
                            <input type="password" name="password" placeholder="Password" required style="color: black;">
                        </div>
                        <button type="submit" class="btn-login" style="background-color: black; color: white;">Login</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection
