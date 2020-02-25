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
                    if(key == 13) {  // the enter key code
                        var empty =  $(this).val();
                        if (empty.trim() != '') {
                        $(this).next().click();
                        return false;
                        }
                      }
                    });
    function preview_image(input,output) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            reader.onload = function (e) {
                $(output).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
    }
    function preview_video(input,output)
    {
        let URL = window.URL || window.webkitURL;
        let file = input.files[0];
        let type = file.type;
        let videoNode = document.querySelector(output);
        let fileURL = URL.createObjectURL(file);
        videoNode.src = fileURL;
    }
    // create new post
    $(document).on('change', '#uploadNewPost', function () {
        let fname =  $(this).val();
        let img_output = $('#img_output');
        let video_output = $('#video_output');
        let extension =  fname.split('.').pop(); // get extends file if has many "."
            if(extension === 'mp4'){
                video_output.removeClass("none");
                preview_video(this,'#video_output');
                img_output.addClass('none');
            }else{
                 img_output.removeClass("none");
                 preview_image(this,"#img_output");
                 video_output.addClass('none');
            }
    });
    // preview edit image when change file
    $(document).on('change', '#updatePost', function () {
        let file = $(this).val();
        let extension = file.split('.').pop();
        console.log(extension);
        if(extension !='mp4'){
            preview_image(this,"#oldImage");
            $('#oldImage').removeClass('none');
            $('#edit-video').addClass('none'); 
        }else{
             preview_video(this,"#edit-video");
             $('#edit-video').removeClass('none'); 
             $('#oldImage').addClass('none');
        }
    })
    $('.post-action').click(function(){
        $(this).next().toggleClass('none');
    })
    // edit form
    $('.edit-post').click(function(){
        $('.action_').addClass('none');
        let id = $(this).attr('data-postId');
             $.ajax({
                url: "/p/edit/"+id,
                method: "GET",
                success: function (data) {
                    $('#edit-post-id').val(data.id);
                    $('#oldCaption').val(data.caption);
                    let filename = data.image;
                    let extension =  filename.split('.').pop(); 
                    if(extension != 'mp4'){
                        $('#oldImage').attr("src", "/uploads/"+filename);
                        $('#oldImage').removeClass('none');
                        $('#edit-video').addClass('none');
                    }else{
                         let editVideo = $('#edit-video');
                         editVideo.removeClass('none');
                         let source = document.createElement('source');
                         source.setAttribute('src',"/videos/"+filename);
                         editVideo.append(source);
                         $('#oldImage').addClass('none');
                    }
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
                    if(data.image.split('.').pop() != 'mp4'){
                        let img = "<img src='/uploads/"+data.image+"' class='img-fluid' id='image-post-"+data.id+"'>";
                        $('#post-'+data.id).html(img);
                        $('#caption-post-'+data.id).html(data.caption);
                    }else{
                        let video = "<video width='100%' height='600' controls> <source src='/videos/"+data.image+"' type='video/mp4'> </video>";
                        $('#post-'+data.id).html(video);
                        $('#caption-post-'+data.id).html(data.caption);
                    }
                    
                } else{
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