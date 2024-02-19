@extends('Dashboard.layout')
@section('title')
    Show all father
@endsection
@section('contant')
    @include('Dashboard.error')
       <!-- start of navbar -->
       @include('Dashboard.navbar')
       <!-- end of navbar -->
    <!-- stare side list -->
    <section class="side_list_flex">
        @include('Dashboard.sidelink')
        <!------------------------------- end side list item------------------------>
        <div class="side_list_table side_list">
            <section class="table" style="left: 243px;top: 42px;">
                <div class="table_section" style="max-width: 1100px; max-height: 400px;" >
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th colspan="2">Name</th>
                                <th>Email</th>
                                <th>Address</th>
                                <th>Access</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody >
                            @foreach ($allfather as $father)
                                <tr>
                                    <td class="border_id">{{$loop->iteration}}</td>
                                    <td class="image_border">
                                        @if ($father->image != null)
                                        <img src="{{asset("storage/$father->image")}}"/>
                                        @else
                                        <img src="{{asset("images/default.jpg")}}"/>
                                        @endif
                                    </td>
                                    <td style="border-left:1px solid transparent"> <p>{{$father->name}}</p></td>
                                    <td><p>{{$father->email}}</p></td>
                                    <td><p >{{$father->address}}</p></td>
                                    <td class="border_access" >
                                        <div class="access_btn_flex" style="display: inline-flex;"> 
                                            <form method="POST" name="form" action="{{url("handlefatherstatus/$father->id")}}">
                                                @csrf

                                                <div class="radio-inputs">
                                                    <label class="radio">
                                                    <input value="accepted" class="Admitbtn" type="radio" name="radio">
                                                    <span class="name">Allowed</span>
                                                    </label>
                                                    <label class="radio">
                                                    <input value="rejected" class="Denybtn" type="radio" name="radio" >
                                                    <span class="name">Rejected</span>
                                                    </label>
                                                    <button class="lolbtn" type="submit"><img  class="btnimgsize" src="{{asset("images/checked.png")}}" alt=""></button>
                                                </div>
                                            </form>

                                            <form method="POST"  action="{{url("deletefather/$father->id")}}">
                                                @csrf
                                                @method("DELETE")
                                                <button type="submit" class="Deletebtn">Delete</button>
                                            </form>

                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
            </section>
        </div>
    </section>
    <!-- end side list -->
@endsection

