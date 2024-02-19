@extends('Dashboard.layout')
@section('title')
New Food
@endsection
    @section('contant')
        @include('Dashboard.error')
        @include('Dashboard.navbar')

        <!-- end of navbar -->
        <!-- stare side list -->
        <section class="side_list_flex">
        @include('Dashboard.sidelink')
        <!------------------------------- start side list item---------------------- -->
        <!------------------------------- end side list item---------------------- -->
        <div class="side_list_table side_list">
            <h6>Add New Food </h6>
            <section class="newpage" style="max-height: 120px;">
               <form method="POST" action="{{url("handlefood/$admin->id")}}" >
                  @csrf
                  <label class="lable_r" style="text-align: left; color:  rgba(245, 245, 245, 1);font-family: 'Laila'; " > Name</label>
                <input name="name" type="text"class="inpu input_r"/>
                <label class="lable_r" style=" text-align: left;color:  rgba(245, 245, 245, 1); font-family: 'Laila';" >Calories</label>
                <input name="calories" type="text"class="inpu input_r" />
                <button type="submit"  class="submit input_r"  style=" margin-left: 86%; margin-top:10%;"> submit</button>
               </form>

              <!-- <div class="subnewdisease" ><button type="submit">submit</button></div>-->

       </section>
        </div>
    <!-- end side list -->
    @endsection