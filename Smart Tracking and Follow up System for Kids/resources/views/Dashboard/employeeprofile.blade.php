@extends('Dashboard.layout')
@section('title')
     Employee Profile
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
        <div class="side_list_tableemployeeprofile side_list">
            <section class="tableemployeeprofile">
                <div class="employeeprofile_menu_flex">
                    

                    <div class="employeeprofilepart1 employeeprofilediv" >
                        @if ($emp->image != null)
                            <div><img src="{{asset("storage/$emp->image")}}" class="image_employee_profile"/></div>           
                        @else
                            <div><img src="{{asset("images/default.jpg")}}" class="image_employee_profile"/></div>           
                        @endif
                        <div class="employee_name">{{$emp->name}}</div>
                    </div>
                    <div class="employeeprofilepart2 employeeprofilediv">
                        <div class="title_Employeeinfo">Email</div>
                        <div class="Employeeinfo">{{$emp->email}}</div>
                        <div class="title_Employeeinfo">Address</div>
                        @if ($emp->address !=null)
                            <div class="Employeeinfo">{{ $emp->address }}</div>
                        @else
                            <div class="Employeeinfo">No Address Data</div>
                        @endif

                        <div class="title_Employeeinfo">Phone</div>
                        @if ($emp->phone !=null)
                            <div class="Employeeinfo">{{ $emp->phone }}</div>
                        @else
                            <div class="Employeeinfo">No Phone Data</div>
                        @endif
                        <div class="title_Employeeinfo">Job Title </div>
                        <div class="Employeeinfo">{{$emp->job_title}}</div>
                    </div>
                    
                </div>
               
            </section>
        </div>
    </section>
    <!-- end side list -->
@endsection
