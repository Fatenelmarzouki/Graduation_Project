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
        <div class="side_list_table side_list">
            <h2>Add new Disease </H2>
            <section class="newpage" style="max-height: 120px;">
                <form method="POST" action="{{url("newdis/$admin->id")}}">
                    @csrf
                    <label class="lable_r" style="text-align: left; color:  rgba(245, 245, 245, 1);"  >Disease Name</label> 
                    <input name="newname" type="text" class="inpu input_r" />
                    <button type="submit"  class="submit input_r"  style=" margin-left: 80%; margin-top:10%;"> submit</button> 
               </form>  
            </section>
        </div>
    </section>  
    <!-- end side list -->
@endsection