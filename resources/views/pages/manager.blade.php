@extends('layouts.master')
@section('title','人員管理')
@section('pagename','人員管理')
@section('content')
<script language="javascript">

    function getForm(arrIndex,trueID){
        var firstTd = $('#item_'+arrIndex).children();
        $('#EditEmail').val(firstTd.children().val());
        $('#EditPhone').val(firstTd.next().html());
        $('#EditRight').val((firstTd.next().next().html().match('管理者')) ? 'manager':'member');
        $('#index').attr('action','{{route('manager.update')}}/'+trueID);
    }

    function delIndex(trueID){
        $('#delIndex').attr('action','{{route('manager.delete')}}/'+trueID);    
    }
    
</script>
 @if(session()->has('errMail'))
<script language="javascript">
    alertify.set({
        'delay' : 2000,
        'labels': {
            ok        : "確認"
        },
        'buttonFocus' : "ok"
    });  
    alertify.alert('{{session('errMail')}}');
    </script>
    @endif
<a role="button" class="button button-thirdary" style="position: relative;font-size: 20px;left: 87%" data-toggle="modal" data-target="#AddForm">新增</a>

<table class="tableStyle">
    <tr>
        <td>人員姓名</td>
        <td>聯絡電話</td>
        <td>權限</td>    
        <td></td>
    </tr> 
    @foreach($results as $key => $item)  
    @if(!empty($item->super_user))
         <tr class="tableContent" id="item_{{$key}}">
        <td>@if(empty($item->name)){{$item->email."<未曾登入本系統>"}}@else{{$item->name}}@endif<input type="hidden" value="{{$item->email}}"/></td>
        <td>{{$item->phone}}</td>
        <td>@if(str_contains($item->super_user, 'manager'))管理者@else 成員@endif</td>
        <td>
            <a role="button" class="button" style="font-size: 20px;" onclick = "delIndex({{$item->id}})" data-toggle="modal" data-target="#DelForm">刪除</a>
            <a role="button" class="button  button-secondary" style="font-size: 20px;" onclick = "getForm({{$key}},{{$item->id}})" data-toggle="modal" data-target="#EditForm">編輯</a>
        </td>
    </tr>
    @else {{--不顯示--}}
    @endif
    @endforeach
</table>
<center><?=$results->render()?></center> 
@endsection
@section('AddForm')
    {!!Form::open([ 'class'=>'form-horizontal', 'method' => 'post', 'route' => 'manager.store'])!!}
        <div class="modal-body">
                <div class="form-group">
                    {!!Form::label('MemberAccount','校務信箱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('email',"@gm.nfu.edu.tw",['class' => 'form-control', 'id' => 'MemberAccount', 'placeholder' => '虎科大信箱'])!!}
                    </div>
                </div>
                <div class="form-group">
                    {!!Form::label('MemberPhone','聯絡電話',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('phone',null,['class' => 'form-control', 'id' => 'MemberPhone', 'placeholder' => '手機'])!!}
                    </div>
                </div>   
                <div class="form-group">
                    {!!Form::label('MemberRight','權限',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::select('super_user',['member' => '成員' , 'manager' => '管理者'], 'member', ['id' => 'MemberRight'])!!}
                    </div>
                </div>           
        </div>
        <div class="modal-footer">
            {!!Form::button('關閉',['class' => 'btn btn-default', 'data-dismiss' => 'modal' ])!!}
            {!!Form::submit('儲存',['class' => 'btn btn-primary'])!!}
        </div>
    {!!Form::close()!!}
@endsection
@section('EditForm')
    {!!Form::open(['class'=>'form-horizontal', 'id' => 'index' ,'method' => 'patch'])!!}
        <div class="modal-body">
                 <div class="form-group">
                    {!!Form::label('EditEmail','校務信箱',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('email',null,['class' => 'form-control', 'id' => 'EditEmail', 'placeholder' => '虎科大信箱'])!!}
                    </div>  
                </div>
                <div class="form-group">
                    {!!Form::label('EditPhone','聯絡電話',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::text('phone',null,['class' => 'form-control', 'id' => 'EditPhone', 'placeholder' => '填手機，請確認是10碼'])!!}
                    </div>
                </div>   
                <div class="form-group">
                    {!!Form::label('EditRight','權限',['class' => 'col-sm-2 control-label'])!!}
                    <div class="col-sm-10">
                        {!!Form::select('super_user',['member' => '成員' , 'manager' => '管理者'],null,['id' => 'EditRight'])!!}
                    </div>
                </div>         
        </div>
        <div class="modal-footer">  
            {!!Form::button('取消',['class' => 'btn btn-default','data-dismiss' => 'modal'])!!}
            {!!Form::submit('更新',['class' => 'btn btn-primary'])!!}
        </div>
    </form>
    {!!Form::close()!!}
@endsection
@section('DelForm')
    {!!Form::open(['class'=>'form-horizontal', 'id' => 'delIndex' ,'method' => 'delete'])!!}
        <div class="modal-body">
            <center>          
                {!!Form::submit('確定',['class' => 'btn btn-primary'])!!}   
                {!!Form::button('取消',['class' => 'btn btn-warning', 'data-dismiss' => 'modal' ])!!}           
            </center>
        </div>
    {!!Form::close()!!}
@endsection
