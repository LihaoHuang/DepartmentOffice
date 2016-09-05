@extends('layouts.master')
@section('title','失物招領')
@section('pagename','失物招領')
@section('content')
<style>
    .tableStyle > td {
        width: 20%;
    }
    textarea {
        border: #cff09e 6px double;
        border-radius: 9px;
        background:transparent;
        resize: none;
    }
</style>
<script language="javascript">
    var number = 0;
    function getForm(arrIndex,trueID){
        var wrapItem = $('#item_'+arrIndex);
        $('#EditName').val(wrapItem.children().html());
        $('#EditIntro').val(wrapItem.children().next().html());
        $('#EditStart').val(wrapItem.children().next().next().html());
        $('#EditEnd').val(wrapItem.children().next().next().next().html());
        $('#index').attr('action','{{route('lost.update')}}/'+trueID);
    }
        function delIndex(trueID){
        $('#delIndex').attr('action','{{route('lost.delete')}}/'+trueID);
    }
</script>
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>

    <table class="tableStyle">
    <tr>    
        <td>活動名稱</td>
        <td>活動簡介</td>
        <td>報名開始日期</td>
        <td>報名結束日期</td>
        <td></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">
        <td>{{$item->name}}</td>
        <td>{{str_limit($item->intro,15)}}</td>
        <td>{{$item->start_at}}</td>
        <td>{{$item->end_at}}</td>
        <td>
           <a role="button" class="button" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</a>
            <a role="button" class="button  button-secondary" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</a>
        </td>
    </tr>
    @endforeach
    </table>
    <center>{{$results->render()}}</center>
@endsection
@section('AddForm')
    {!!Form::open([ 'class'=>'form-horizontal', 'method' => 'post', 'route' => 'lost.store'])!!}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('AcuivityName','活動名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control', 'id' => 'AcuivityName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('introField','活動簡介',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::textarea('intro',null,['class' => 'form-control', 'id' => 'introField', 'placeholder' => '簡單介紹活動'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('AcuivityNameStart','開始日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::date('start_at',\Carbon\Carbon::now())!!}
                    </div>
                </div>      
                <div class="form-group">
                {!!Form::label('AcuivityNameEnd','結束日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                    {!!Form::date('end_at',\Carbon\Carbon::tomorrow())!!}
                    </div>
                </div>              
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('儲存',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class'=> 'form-horizontal', 'id' => 'index', 'role'=> 'form', 'method' => 'patch'])!!}
        <div class="modal-body">
                <div class="form-group">
                {!!Form::label('EditName','活動名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control' , 'id' => 'EditName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                {!!Form::label('EditIntro','活動簡介',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::textarea('intro',null,['class' => 'form-control' , 'id' => 'EditIntro', 'placeholder' => '簡單介紹活動'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('EditStart','開始日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('start_at',null,['class' => 'form-control' , 'id' => 'EditStart', 'placeholder' => 'yyyy-MM-dd HH:mm:ss'])!!}
                    </div>
                </div>      
                <div class="form-group">
                    {!!Form::label('EditEnd','結束日期',['class' => 'col-sm-2 control-label'])!!}                    
                    <div class="col-sm-10">
                        {!!Form::text('end_at',null,['class' => 'form-control' , 'id' => 'EditEnd', 'placeholder' => 'yyyy-MM-dd HH:mm:ss'])!!}
                    </div>
                </div>         
        </div>
        <div class="modal-footer">
            {!!Form::button('取消',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class'=> 'form-horizontal', 'id' => 'delIndex', 'role'=> 'form', 'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning', 'data-dismiss' => 'modal' ])!!}             
            </center>
        </div>
    {!!Form::close()!!}
@endsection