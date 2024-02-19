@extends('Dashboard.layout')
@section('title')
    Show ALL disease
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
        <div class="side_list_tabledisease side_list">
            <section class="tabledisease">
                <div class="disease_menu_flex">
                    @if (session()->has("id"))
                    <?php $id=session()->get('id')?>
                    @endif
                    @foreach ($allname as $name)
                        <div class="disease1 diseasediv">
                            <div class="DiseaseNameAndDelete">
                                <div class="diseasename">{{$name->dis_name}}</div>
                                <div class="deletedisease">
                                    <form  name="form" method="POST" action="{{url("deletedis/$name->id")}}" onsubmit="Event.preventDefault()">
                                        @csrf
                                        @method("delete")
                                        <button type="submit">Delete</button> 
                                    </form>
                                </div>
                            </div>
                            <div class="Types_word">Types</div>
                            <div class="list_of_disease_types">
                                @foreach ($name->healthdatasetnameType as $types)
                                        <div class="type1_disease">
                                            <p>{{$types->dis_type}}</p>
                                        </div>
                                @endforeach
                                <div class="add_type_disease">
                                    <a href="{{url("type/$id/$name->id")}}">Add Type +</a>
                                </div>
                            </div>
                        </div>              
                    @endforeach
                </div>
            </section>
                </div>
            </section>
        </div>
    </section>

    <!-- end side list -->
    <div class="AddEmployee_flex">
        <a  href="{{url("dis/$id")}}">
        <section class="PartAddEmployee" style="margin-top: 2%;left: 68%;">
            <ul type="none">
                <li style=" float: left;"><span class="material-symbols-outlined" style=" color:#D19630;">add_box</span>
                </li>
                <li style=" float: left;"><p>Add New Disease</p></li>

            </ul>
        </section>
    </a>
    </div>
@endsection