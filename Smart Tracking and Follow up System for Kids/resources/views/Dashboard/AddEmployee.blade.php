@extends('Dashboard.layout')
@section('title')
    Add Employee
@endsection
@section('contant')
    @include('Dashboard.error')

    <!-- start of navbar -->
    @include('Dashboard.navbar')
    <!-- end of navbar -->

    <!-- stare side list -->
    <section class="side_list_flex">
        <!------------------------------- start side list item---------------------- -->
        @include('Dashboard.sidelink')
        <!------------------------------- end side list item---------------------- -->
        <div class="side_list_table side_list">
            <H2>Add new Employee  </H2>
            @if (session()->has("id"))
            <?php $id=session()->get('id')?>
        @endif
        <form class="inputs" method="POST" action="{{url("handleemp/$id")}}">
            @csrf

                <label class="lable_r">Name</label>
                <input value="{{old("name")}}" name="name" class="input_r" type="text"/>
                <label class="lable_r">Email</label>
                <input value="{{old("email")}}" class="input_r" type="email"  name="email"  />
            <label class="lable_r">Password</label>
            <input class="input_r" type="password"  name="password"/>
            <label class="lable_r">Password Confirmation</label>
            <input class="input_r" type="password"  name="password_confirmation"/>

                <label  class="Job lable_r" style="text-align: left; color:  rgba(245, 245, 245, 1); font-weight: bold;margin-left: 3px;margin-top: 55px;" >Job Title</label>
                <select name="job_title">
                <option value="" selected>Select an option</option>
                <option value="Doctor">Doctor</option>
                <option value="Teacher ">Teacher</option>
                <option value="Manager" >Manager</option>
                <option value="Seller" >Seller</option>
                <option value="Specialist" >Specialist</option>
                </select>

                <label class="lable_r" style="text-align: left; color:  rgba(245, 245, 245, 1); font-weight: bold; margin-left: 3px;margin-top: 55px;">Subject</label>
                <select name="subject">
                <option value="" selected>Select an option</option>
                @foreach ($subs as $sub)
                    <option value="{{$sub->id}}">{{$sub->name}}</option>
                @endforeach
                </select>

                <label class="lable_r" style="text-align: left; color:  rgba(245, 245, 245, 1); font-weight: bold; margin-left: 3px;margin-top: 55px;">Activity</label>
                <select name="activity">
                <option value="" selected>Select an option</option>
                @foreach ($acts as $act)
                    <option value="{{$act->id}}">{{$act->name}}</option>
                @endforeach
                </select>

                <button type="submit"  class="submit input_r"  style=" margin-left: 90%;  "> submit</button>
            </form>
        </div>
    </section>
    <!-- end side list -->

@endsection
