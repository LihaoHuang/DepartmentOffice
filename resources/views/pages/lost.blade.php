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
        $('#EditNumber').val(wrapItem.children().next().html());
        $('#EditFindTime').val(wrapItem.children().next().next().html());
        $('#EditSituation').val(wrapItem.children().next().next().next().html());
        $('#index').attr('action','{{route('lost.update')}}/'+trueID);
    }
    function delIndex(trueID){
        $('#delIndex').attr('action','{{route('lost.delete')}}/'+trueID);
    }
</script>
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>

    <table class="tableStyle">
    <tr>    
        <td>失物名稱</td>
        <td>失物編號</td>
        <td>發現日期</td>
        <td>失物狀況</td>
        <td></td>
    </tr>
    @foreach($results as $key => $item)
    <tr class="tableContent" id= "item_{{$key}}">
        <td>{{$item->name}}</td>
        <td>{{$item->number}}</td>
        <td>{{$item->findTime}}</td>
        @if( $item->situation == '已領回')
            <td><font color="green">已領回</font></td>
        @else
            <td><font color="red">未領回</font></td>
        @endif
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
                    {!!Form::label('AcuivityName','失物名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control', 'id' => 'AcuivityName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('numberField','失物編號',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('number',null,['class' => 'form-control', 'id' => 'numberField', 'placeholder' => '輸入失物編號(方便遺失者依編號詢問失物)'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('findTimeField','發現日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::date('findTime',\Carbon\Carbon::now(),['id' => 'findTimeField'])!!}
                    </div>
                </div>      
                <div class="form-group">
                {!!Form::label('situationField','失物狀況',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        <select id="situationField" name="situation" onChange="selectFun()">
                            <option value="未領回">未領回</option>
                            <option value="已領回">已領回</option>
                        </select>
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
                {!!Form::label('EditName','失物名稱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('name',null,['class' => 'form-control' , 'id' => 'EditName', 'placeholder' => '輸入名稱'])!!}
                    </div>
                </div>
                <div class="form-group">
                {!!Form::label('EditNumber','失物編號',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('number',null,['class' => 'form-control' , 'id' => 'EditNumber', 'placeholder' => '輸入失物編號(方便遺失者依編號詢問失物)'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('EditFindTime','發現日期',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('findTime',null,['class' => 'form-control' , 'id' => 'EditFindTime', 'placeholder' => 'yyyy-MM-dd HH:mm:ss'])!!}
                    </div>
                </div>      
                <div class="form-group">
                    {!!Form::label('EditSituation','失物狀況',['class' => 'col-sm-2 control-label'])!!}                    
                    <div class="col-sm-10">
                        <select id="EditSituation" name="situation" onChange="selectFun()">
                            <option value="未領回">未領回</option>
                            <option value="已領回">已領回</option>
                        </select>
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