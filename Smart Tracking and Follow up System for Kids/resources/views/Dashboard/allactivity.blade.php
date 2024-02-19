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
        <!------------------------------- start side list item---------------------- -->
        <!------------------------------- end side list item---------------------- -->        
        <!-------------------------------________________________________________________________---------------------- -->
        @foreach ($allact as $act)
            <div class="side_list_tablesubject side_list">
                <section class="tabledsubject">
                    <div class="subject_menu_flex">
                        <div class="subjectdiv">
                            <div class="subjectNameAndDelete">
                                <div class="subjectname">{{$act->name}}</div>
                                <div class="deletesubject">
                                    <form method="POST" action="{{url("deleteact/$act->id")}}">
                                        @csrf
                                        @method("delete")
                                        <button  type="submit">Delete</button> 
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        @endforeach
    </section>
    <!-- end side list -->
    @if (session()->has("id"))
        <?php $id=session()->get('id')?>
    @endif
    <div class="AddEmployee_flex">
        <a  href="{{url("act/$id")}}">
            <section class="PartAddEmployee" style="margin-top: 3%;left: 68%;">
                <ul type="none">
                    <li style=" float: left;"><span class="material-symbols-outlined" style=" color:#D19630;">add_box</span></li>
                    <li style=" float: left;"><p>Add New Activity</p></li>
                </ul>
            </section>
        </a>
    </div>

        <!-------------------------------________________________________________________________---------------------- -->

@endsection