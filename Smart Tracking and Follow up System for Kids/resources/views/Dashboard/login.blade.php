@extends('Dashboard.layout')
@section('title')
    Login
@endsection
@section('contant')
    @include('Dashboard.error')
        <style>
            body {
                background-image: url("{{asset('images/bac.jpg')}}");
                background-repeat: no-repeat;
                background-attachment: fixed;
                background-size: 100% 100%;
            }
        </style>
        <div class="side_list_login">
            <h5>login</h5>
            <form action="{{url('access')}}" method="POST" class = "login" style = "max-height: 120px;">
                @csrf
                <label class="lablogin" >Email</label>
                <input name="email" value="{{old("email")}}" type="email" class="inputlogin input_r"/>
                <label class="lablogin" >Password</label>
                <input name="password" type="password"class="inputlogin input_r"/>
                <button type="submit" class= loginbutton >Login</button>
            </form>
        </div>
@endsection
