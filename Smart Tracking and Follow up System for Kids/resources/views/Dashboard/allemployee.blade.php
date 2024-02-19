@extends('Dashboard.layout')
@section('title')
    All Employees
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
            <section class="table" style="left: 243px;top: 42px;">

                <div class="table_section" style="max-width: 865px; max-height: 309px;">
                    <table>
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th colspan="2">Name</th>
                                <th>Email</th>
                                <th>Job Title</th>
                                <th></th>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($allemp as $emp)                              
                               
                                    <tr onclick='window.location.href="{{url("showoneemp/$emp->id")}}"'>
                                        <td class="border_id">{{$loop->iteration}}</td>
                                        <td class="image_border">

                                            @if ($emp->image != null)
                                            <img src="{{asset("storage/$emp->image")}}"/>          
                                            @else
                                            <img src="{{asset("images/default.jpg")}}"/>          
                                            @endif

                                        </td>
                                        <td><p>{{$emp->name}}</p></td>
                                        <td><p>{{$emp->email}}</p></td>
                                        <td class="border_access"><p>{{$emp->job_title}}</p></td>
                                        <td style="border: none;margin: 0px;padding: 0px;">
                                            <form method="POST" name="form" action="{{url("deleteemp/$emp->id")}}" onsubmit="Event.preventDefault()">
                                                @csrf
                                                @method("delete")
                                                <button  class="delete_employee" type="submit">Delete</button> 
                                            </form>
                                        </td>
                                    </tr>
                                
                            @endforeach
                        </tbody>
                    </table>
            </section>
        </div>
    </section>
    @if (session()->has("id"))
        <?php $id=session()->get('id')?>
    @endif
    <div class="AddEmployee_flex">
        <a  href="{{url("newemp/$id")}}">
            <section class="PartAddEmployee">
                <ul type="none">
                    <li style=" float: left;"><span class="material-symbols-outlined" style=" color:#D19630;">add_box</span>
                    </li>
                    <li style=" float: left;"><p>Add Employee</p></li>
                </ul>
            </section>
        </a>
    </div>



    <!-- end side list -->
@endsection