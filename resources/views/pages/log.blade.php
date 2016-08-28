@extends('layouts.master')
@section('title','日誌紀錄')
@section('pagename','日誌紀錄')
@section('content')
<br><br>
<table class="tableStyle">
    <tr>
        <td>登入帳號</td>
        <td>登入時間</td>
        <td>使用IP</td>
        <td>登出時間</td>
    </tr>
    @foreach($results as $item)
    <tr class="tableContent">
        <td><?=$item->logInAC?></td>
        <td><?=$item->logInTime?></td>
        <td><?=$item->IP?></td>
        @if(empty($item->logOutTime))  {{-- or $item->logOutTime == NULL--}}
            <td>登入中....</td>
        @else
            <td><?=$item->logOutTime?></td>
        @endif
    </tr>
    @endforeach
</table>
<center><?=$results->render()?></center>
@endsection