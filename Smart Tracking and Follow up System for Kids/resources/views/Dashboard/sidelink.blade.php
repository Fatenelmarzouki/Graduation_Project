@if (session()->has("id"))
    <?php $id=session()->get('id')?>
    <div class="side_list_item side_list">
        <a href ="{{url("showallemp")}}"  style="margin-top: 20%;">Employee</a>
        <a href="{{url("showallfather")}}"  >Father</a>
        <a href="{{url("showalldis")}}" >Disease</a>
        <a href="{{url("showallsubject")}}">Subject</a>
        <a href="{{url("showallactivity")}}" >Activity</a>
        <a href="{{url("showallfood")}}" >Food</a>
    </div>
@endif