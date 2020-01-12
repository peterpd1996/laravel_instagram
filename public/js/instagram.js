$(document).ready(function(){
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

   // Pusher.logToConsole = true;

    // var pusher = new Pusher('2c01659086f9827ec1c1', {
    // cluster: 'ap1',
    // forceTLS: true
    // });

    // var channel = pusher.subscribe('posts');
    // channel.bind('newcomment', function(comment) {
    //     $("#comment" + comment.post_id).before(comment.comment);
    // });
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
function readURL(input) {
    if (input.files && input.files[0]) {
        console.log(input.files[0]);
        console.log(input.files);
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#img_output').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$(document).on('change', '#uploadNewPost', function () {
    $("#img_output").toggleClass("none");
    readURL(this);
})


});
