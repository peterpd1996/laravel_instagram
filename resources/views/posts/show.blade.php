 @extends('layouts.app')
 @section('content')
    <div class="container">
    <div class="row  offset-md-2"  style="height: 622px">
        <div class="col-sm-8 p-0 ">
            <img src="/uploads/{{$post->image}}" alt="" class="w-100">
        </div>
        <div class="p-0 border_ col-sm-4  h-100 " style="background: #fff;position: relative">
            <div class="name d-flex p-3 align-items-center border_b">
                <div>
                    <img src="/profiles/{{$post->user->profile->profileImage()}}" width="40px" height="40px" alt="" class="rounded-circle mr-2">
                </div>
                <div class="font-weight-bold">
                    <a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none" >
                    {{$post->user->username}}
                    </a>
                </div>
            </div>
            <div class="cmt">
                <p class="p-3 m-0">
                    <span class="font-weight-bold">
                    <a class="text-dark text-decoration-none" href="/profile/{{$post->user->id}}" >
                    {{$post->user->username}}
                    </a>
                    </span>  
                    {{$post->caption}}
                </p>
                <div class="comment pl-3">
                    <ul style="list-style: none" id="userComment">
                        @php
                        $comments = $post->comment;
                        @endphp
                        @foreach($comments as $comment)
                        <li><b><a href="" class="text-dark">{{$comment->user->username}}</a></b> {{$comment->comment}}</li>
                        @endforeach
                        <div id="comment_before"></div>
                    </ul>
                </div>
            </div>
            <div style="position: absolute;width: 100%;top: 200px">
                    <div class="icon p-3 border_b border_t w-100" style="margin-top: 260px">
                            <i data-like_post="{{$post->id}}" id="like" class=" pr-2 fa fa-heart like_heart @if(auth()->user()->like->contains($post->id)) liked @endif"  aria-hidden="true"></i>
                            <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                            <b>
                                <div class="like pl-1" id="many_like" style="cursor: pointer"> 
                                    @php
                                    $like = $post->liked->count();
                                    if( $like == 0) {
                                    $like ='' ;
                                    }   
                                    else if($like  == 1){
                                    $like .=' like';
                                    }     
                                    else {
                                    $like .= ' likes';
                                    }
                                    echo $like;
                                    @endphp
                                </div>
                            </b>
                        </div>
                        <div class=" p-2 d-flex w-100">
                            <input id="comment"   type="text" class="w-100" style="border: none" placeholder="Add a comment.." height="30px" autofocus
                                >
                            <div id="postComment"   style="color:#3897f0;font-weight: bold;cursor: pointer" data-post={{$post->id}} >Post</div>
                        </div>
            </div>
        </div>
    </div>
    @endsection
    @section('js')
    <script>
        $(document).ready(function(){
            $("#postComment").click(function(){
                var post_id =  $(this).data('post');
                        var comment = $("#comment").val();
                        if(comment.length > 0)
                        {
                            $.ajax({
                            url:"/comment",
                            method:"POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                post_id:post_id,comment:comment
                            },
                            success:function(data){
                                $("#comment").val('');
                                $("#comment_before").before(data);
                            }
                        })
                        }
                });
        
                    // $(document).on('click','#postComment',function(){
                    //     var post_id =  $(this).data('post');
                    //     var comment = $("#comment").val();
                    //     if(comment.length > 0)
                    //     {
                    //         $.ajax({
                    //         url:"/comment",
                    //         method:"POST",
                    //         data:{
                    //             "_token": "{{ csrf_token() }}",
                    //             post_id:post_id,comment:comment
                    //         },
                    //         success:function(data){
                    //             $("#comment").val('');
                    //             $("#comment_before").before(data);
                    //         }
                    //     })
                    //     }
                    // // });
                
        
                    $(document).on('click','.like_heart',function(){
                        var post_id  = $(this).data('like_post'); 
                        $('#like').toggleClass("liked");
                        $.ajax({
                            url:"/like",
                            method:"POST",
                            data:{
                                "_token": "{{ csrf_token() }}",
                                post_id:post_id,
                            },
                            success:function(data){
                                if(data == 0)
                                {
                                    data = '';
                                }
                                else if(data == 1)
                                {
                                    data+= ' like'
                                }
                                else
                                {
                                    data += ' likes'
                                }
                                $('#many_like').text(data);
                            }
                        
                        })
                });
            $(document).on('keypress', '#comment ', function(e){
                var key = e.which;
                if(key == 13)  // the enter key code
                {
                    
                    var empty =  $('#comment').val();
                    if (empty.trim() != '') {
                    $('#postComment').click();
                    return false;
                    }
                    
                }
                }); 
        
                
            // function fetch_comment()
            //     {
            //         var post_id = {{$post->id}} 
            //         $.ajax({
        
            //                     url:"/fetch",
            //                     method:"POST",
            //                     data:{
            //                         "_token": "{{ csrf_token() }}",
            //                         post_id:post_id,
            //                     },
            //                     success:function(data){
            //                         $('#userComment').html(data)
            //                     }
                            
            //                 })
            //     }
            // setInterval(function(){
            //     fetch_comment();
            //     },3000)
        });
    </script>
    @endsection