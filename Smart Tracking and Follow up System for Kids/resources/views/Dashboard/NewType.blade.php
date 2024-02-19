@extends('Dashboard.layout')
@section('title')
New Type
@endsection
    @section('contant')
        @include('Dashboard.error')
        @include('Dashboard.navbar')
        <!-- start of navbar -->
        <!-- end of navbar -->
        <!-- stare side list -->
        <section class="side_list_flex">
        @include('Dashboard.sidelink')
        <!------------------------------- start side list item---------------------- -->
        <!------------------------------- end side list item---------------------- -->
        <div class="side_list_table side_list">
            <section  style="max-height: 120px;">
                <h2>{{"Insert type to ". $health->dis_name}}</h2>
                <form action="{{url("newtype/$admin->id/$health->id")}}" method="POST">
                    @csrf
                    <label class="Disease lable_r"style=" color:  rgba(245, 245, 245, 1);text-align: left; "  >Disease Type</label>
                    <input name="newtype" type="text" class="newtype input_r" style="width: 60%; margin-left: 20%; margin-bottom: 5px;"/>
                    <button type="submit"  class="submit input_r"  style=" margin-left: 80%; margin-top:8%;"> submit</button>
                </form>
            </section>
        </div>
        </section>
    <!-- end side list -->
    @endsection