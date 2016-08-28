@extends('layouts.master')
@section('title','投票區')
@section('pagename','投票區')
@section('content')
<script language="javascript">
var number = 0;
var datus = new Object();
var optionNumber = 10;
datus = <?=$obtainArr?>;

function getForm(arrIndex, trueId){
    $('#EdItems').val($('#item_'+arrIndex).children().html());
    $('#index').attr('action','{{route('vote.update')}}/'+trueId);
    for(var i = 1 ; i <= optionNumber ; i++){
        if(datus[arrIndex]['optionName'+i]){
            $("#optionEditForm").append("<div class='form-group'><label for='optionName"+i+"' class='col-sm-2 control-label'>項目 "+i+"</label><div class='col-sm-10'><input type='text' id='optionName"+i+"' class='form-control' name ='optionName"+i+"' value ="+datus[arrIndex]['optionName'+i]+"></input></div><div class='col-sm-10 col-sm-offset-2'><input type='file' name='fileName"+i+"'></div></div>");
        }else return;
    }
}

function delIndex(trueID){
    $('#delIndex').attr('action','{{route('vote.delete')}}/'+trueID);
}

function insertItem(){
    if(number < 10){
        number++;
        $("#optionAddForm").append("<div class='form-horizontal' id='item"+number+"'><label for='optionName"+number+"' class='col-sm-2 control-label'>項目 "+number+"</label><div class='col-sm-10'><input type='text' id='optionName"+number+"' class='form-control' name ='optionName"+number+"' placeholder = '項目名稱請慎寫，萬一打錯可是很麻煩的~'></input></div><div class='col-sm-10 col-sm-offset-2'><input type='file' name='fileName"+number+"'></div></div>");
    }
}   

function removeItem(){
    if(number > 0){
        $("#item"+number).remove(); 
        number--;
    }
}   
</script>
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>
<table class="tableStyle">
    <tr>
    <td class="col-sm-4">投票主題</td>
    <td class="col-sm-4">總投票人次</td>
    <td class="col-sm-2" style="text-align: left">附件名稱</td>    
    <td class="col-sm-2"></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">

        <td >{{$item->item}}</td>
        <td >{{$item->votes}}</td>
        <td style="font-size: 13px; text-align: left">          
            @for($i = 1; $i <= 10 ; $i++)
                @if(!empty($item['fileName'.$i]))
                    <a href="{{route('getFile').'/'.$item['fileName'.$i]}}" ><i class="fa fa-download" aria-hidden="true"></i> {{$item['fileName'.$i]}}</a> <項目{{$i}}><br>                
                @endif
            @endfor       
        </td>
        <td>
            <a role="button" class="button" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</a>
            <a role="button" class="button  button-secondary" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</a>
        </td>
    </tr>
    @endforeach
</table>
<center><?=$results->render()?></center>
@endsection
@section('AddForm')
    {!!Form::open(['class' => 'form-horizontal', 'role' => 'form' ,'method' => 'post' , 'route' => 'vote.store','files' => 'true'])!!}  {{--html is  enctype='multipart/form-data'--}}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('AddItems','投票名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('item',null,['id' => 'AddItems', 'class' => 'form-control' , 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div id="optionAddForm"></div>
                <div class="form-group">
                    <div class="col-sm-12">
                        <i class="fa fa-plus-square-o fa-2x" style="cursor: pointer" role="button" onclick="insertItem()" aria-hidden="true"></i>
                        <i class='fa fa-minus-square-o fa-2x' style="cursor: pointer" role="button" onclick="removeItem()" aria-hidden='true'></i>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default', 'onclick' => '$("#optionAddForm").empty();$("#AddItems").val("");number=0' ,'data-dismiss' => 'modal'])!!}
            {!!Form::submit('儲存',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class' => 'form-horizontal','role' => 'form' ,'id' => 'index', 'method' => 'patch' ,'files' => 'true'])!!}
    <div class="modal-body">
                <div class="form-group">
                {!!Form::label('EdItems','投票項目',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('item',null,['class' => 'form-control', 'id' => 'EdItems'])!!}
                    </div>
                </div>        
        </div>
        <div id="optionEditForm"></div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default', 'onclick' => '$("#optionEditForm").empty()' ,'data-dismiss' =>'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class' => 'form-horizontal','role' => 'form','id' => 'delIndex' , 'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning' ,'data-dismiss' => 'modal' ])!!}          
            </center>
        </div>
    {!!Form::close()!!}
@endsection
