@extends('Dashboard.layout')
@section('title')
    Add New Subject
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
                <h4>Add New Subject </H4>
                <section class="newpage" style="max-height: 120px;">
                   <form action="{{url("newsub/$data->id")}}" method="POST" >
                      @csrf
                      <label class="lable_r"  style="text-align: left; color:  rgba(245, 245, 245, 1);" >Subject Name</label> 
                      <input name="newSubject" type="text"class="inpu input_r" style="width: 80%;" />
                      <button type="submit"  class="submit input_r" style= "margin-left: 68%; margin-top:10%;"> submit</button> 
                   </form>
                </section>
             </div>            
       </section>
     <!-- end side list -->
@endsection
