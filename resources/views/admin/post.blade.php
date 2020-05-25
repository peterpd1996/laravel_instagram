{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')
@section('content_header')
    <h1>Quản lý  bài viết</h1>
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
                @foreach($posts as $index => $post)
                    <tr class="post_{{$post->id}}">
                        <td>{{$index+1}}</td>
                        <td>{{$post->user->name}}</td>
                        <td>
                            <img src="/uploads/{{$post->image}}" width="150px" height="150px" >
                        </td>
                        <td>{{$post->caption}}</td>
                        <td>
                            <button  class="btn btn-danger btn-xs btnDeletePost"
                                    data-id="{{$post->id}}"><i
                                    class=" fa fa-trash-o"></i> Xóa </button>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </form>

    </div>
    <div class="pagination">
        {{ $posts->links() }}
    </div>
@stop
@section('js')
   <script>
       $(function () {
        $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
           let body = $('body');
           body.on('click', '.btnDeletePost', function (event) {
               event.preventDefault();
               let id = $(this).attr('data-id');
               let url = '/admin/delete/' + id;
               let type = 'delete';
               destroyResource(url, type, 'Bạn có muốn xóa bài viết này không ?');
           });
       });
   </script>
@stop
