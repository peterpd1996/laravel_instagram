{{-- resources/views/admin/dashboard.blade.php --}}

@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Quản lý  tải khoản</h1>
@stop

@section('content')
    <div class="card-body" id="tableAcount">
        @include('admin.tableAcount');
    </div>
    <div class="pagination">

    </div>
@stop

@section('css')
    {{--    <link rel="stylesheet" href="/css/admin_custom.css">--}}
@stop

@section('js')
    <script>
         $.ajaxSetup({
              headers: {
                  'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
              }
          });
        function notification(notification){
            return swal({
                title: notification,
                icon: "warning",
                buttons: true,
                dangerMode: true,
            })
        }
        function alertSuccess(message) {
             return swal({
                icon: "success",
                title: message,
        });
        }
        $('body').on('click', '.block', function () {
          let timeBlock = $(this).next().children("option:selected").val();
          let userId =  $(this).attr('data-id');
          let isBlock = $(this).attr('data-block');
          if(isBlock == 1) {
            notification("Tài khoản này đã bị khóa");
            return;
          }
          
          if(timeBlock == 0 ){
            notification("Bạn chưa chọn thời gian khóa !")
            return
          }
          notification("Bạn có muốn block user này không?")
          .then((willBlock) => {
            if (willBlock) {
                let data = {userId:userId,timeBlock:timeBlock};
                callApi(data, "/admin/block", "post", "html")
                    .done(responve => {
                        $('#tableAcount').html(responve);                     
                        alertSuccess("Khóa tài khoản thành công");
                    });
            }
            });
        });

        $('body').on('click', '.unblock', function(){
            let userId =  $(this).attr('data-id');
            notification("Bạn có muốn mở tài khoản này không?")
             .then((unBlock ) => {
            if (unBlock) {
                let data = {userId:userId};
                callApi(data, "/admin/un-block", "post", "html")
                    .done(responve => {    
                         $('#tableAcount').html(responve);
                          alertSuccess("Mở khóa tài khoản thành công");
                         
                    });
            }
            });
        })
    </script>
@stop
