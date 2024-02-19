@extends('Dashboard.layout')
@section('title')
    Add New Activity
@endsection
@section('contant')
    @include('Dashboard.error')
    <!-- start of navbar -->
    @include('Dashboard.navbar')
    <!-- end of navbar -->
    <!-- stare side list -->

    <section class="side_list_flex">
        @include('Dashboard.sidelink')
        <!------------------------------- end side list item---------------------- -->
        <div class="side_list_tablefood side_list">
            <section class="tablefood">
                <div class="foods_menu_flex">
                    @foreach ($allfood as $food)
                        <div class="food1 fooddiv">
                            <div class="foodname">{{$food->name}}</div>
                            <div class="foodcalories">{{$food->calories."cal"}}</div>
                            <div class="deletefood">
                                <form method="POST" action="{{url("deletefood/$food->id")}}" name="form" onsubmit="Event.preventDefault()">
                                    @csrf
                                    @method("delete")
                                    <button type="submit">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </section>
        </div>
    </section>
    <!-- end side list -->
    @if (session()->has("id"))
    <?php $id=session()->get('id')?>
    @endif
    <div class="AddEmployee_flex">
        <a  href="{{url("newfood/$id")}}">
        <section class="PartAddEmployee" style="margin-top: 1%;">
            <ul type="none">
                <li style=" float: left;"><span class="material-symbols-outlined" style=" color:#D19630;">add_box</span>
                </li>
                <li style=" float: left;"><p>Add New Food</p></li>
            </ul>
        </section>
    </a>
    </div>
@endsection
