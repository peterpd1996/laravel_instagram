{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Quản lý  tải khoản</h1>
@stop

@section('content')
    <div class="card-body">
        <form method="POST" action="">
            @csrf
            @method('PUT')
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th style="width: 10px">#</th>
                    <th>Họ và tên</th>
                    <th>Tên người dùng</th>
                    <th>Hình ảnh</th>
                    <th>Url</th>
                    <th>Mô tả</th>
                    <th>Ngày tạo</th>
                    <th>Khóa</th>
                </tr>
                </thead>
                <tbody>
                @if(isset($users))
                    @foreach($users as $index =>$user)
                        <tr>
                            <td>{{$index+1}}</td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->username}}</td>
                            <td>
                                <img src="/profiles/{{$user->profileImage}}" width="100px" height="100px" >
                               </td>
                            <td>{{$user->url}}</td>
                            <td>{{$user->description}}</td>
                            <td>{{$user->created_at}}</td>
                            <td width="230px">
                                <div class="row">
                                    <div class="col-md-6">
                                        <a href="{{}}" class="btn btn-danger" > Band</a>
                                    </div>
                                    <div class="col-md-6">
                                        <select class="custom-select">
                                            <option>3 ngày</option>
                                            <option>1 tuần</option>
                                            <option>1 tháng</option>
                                        </select>
                                    </div>
                                </div>
                            </td>

                        </tr>
                    @endforeach
                 @endif
                </tbody>
            </table>
        </form>

    </div>
    <div class="pagination">

    </div>
@stop

@section('css')
    {{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script>

    </script>
@stop
