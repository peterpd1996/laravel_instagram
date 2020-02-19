$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });


    $(window).scroll(function(){
            var scrollTop = $(window).scrollTop();
            if(scrollTop >=50)
            {
                $('.navigation').removeClass('padding');
            }
            else
            {

                $('.navigation').addClass('padding');
            }
        });

    $(document).on('click', '.post_comment', function () {
        var post_id = $(this).data('post');
        var comment = $("#comment_" + post_id).val();
        if (comment.length > 0) {
            $.ajax({
                url: "/comment",
                method: "POST",
                data: {
                    post_id: post_id,
                    comment: comment
                },
                success: function (data) {
                    $("#comment_" + post_id).val('');
                }
            })
        }
    });

    $(document).on('click', '.like_heart', function () {
        var post_id = $(this).data('like_post');
        $('#like_' + post_id).toggleClass("liked");
        $.ajax({
            url: "/like",
            method: "POST",
            data: {
                post_id: post_id,
            },
            success: function (data) {
                if (data == 0) {
                    data = '';
                } else if (data == 1) {
                    data += ' like'
                } else {
                    data += ' likes'
                }
                $('#many_like_' + post_id).text(data);
            }

        })
    });

    $(document).on('keypress', '.comment ', function(e){

                    var key = e.which;
                    var id = $(this).attr("data-id");
                    if(key == 13)  // the enter key code
                    {
                        var empty =  $(this).val();
                        if (empty.trim() != '') {
                        $(this).next().click();
                        return false;
                        }
                    }
                    });
    function readURL(input,output) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(output).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    $(document).on('change', '#uploadNewPost', function () {
        $("#img_output").removeClass("none");
        readURL(this,"#img_output");
    })
    $(document).on('change', '#updatePost', function () {
        readURL(this,"#oldImage");
    })
    $('.post-action').click(function(){
        // $('.action_').each(function(){
        //     $(this).addClass('none');
        // })
        $(this).next().toggleClass('none');
    })
    $('.edit-post').click(function(){
        $('.action_').addClass('none');
        let id = $(this).attr('data-postId');
             $.ajax({
                url: "/p/edit/"+id,
                method: "GET",
                success: function (data) {
                    $('#edit-post-id').val(data.id);
                    $('#oldCaption').val(data.caption);
                    $('#oldImage').attr("src", "/uploads/"+data.image);
                }
            })

    });
    $('#form-update').on('submit', function(event){
        event.preventDefault();
        $.ajax({
            url: '/p/update',
            method: 'post',
            dataType: 'JSON',
            data:new FormData(this),
            contentType: false,
            processData: false,
            success:function(data){
                $('#editPost').modal('hide');
                if(data.isChangeImage === 1){
                    $('#image-post-'+data.id).attr("src", "/uploads/"+data.image);
                    $('#caption-post-'+data.id).html(data.caption);
                }else{
                     $('#caption-post-'+data.id).html(data.caption);
                }
         }
        });
    });
    //delete post
    var post;
    var post_id;
    let modalConfirm = function(callback){
      
      $(".delete-post").on("click", function(){
        post = $(this).parents()[6];
        post_id = $(this).attr('data-post-delete');
        $('.action_').addClass('none');
        $("#delete-modal").modal('show');
      });

      $("#modal-btn-yes").on("click", function(){
        callback(true);
        $("#delete-modal").modal('hide');
      });
      
      $("#modal-btn-no").on("click", function(){
        callback(false);
        $("#delete-modal").modal('hide');
      });
    };

    modalConfirm(function(confirm){
      if(confirm){
         post.remove();
          $.ajax({
                url: "/p/delete",
                method: "POST",
                data:{post_id:post_id},
            });
      }
    });
});