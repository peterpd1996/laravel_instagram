{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <div class="content">
        <div class="container-fluid">
            @include('admin.statistical')
            @include('admin.chartpost')
        </div>
    </div>

@stop

@section('content')

@stop

@section('css')
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop
