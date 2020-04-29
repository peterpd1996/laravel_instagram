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
                    <th>Tên người dùng</th>
                    <th>Hình ảnh</th>
                    <th>Nội dung</th>
                    <th>Hành động</th>
                </tr>
                </thead>
                <tbody>

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
