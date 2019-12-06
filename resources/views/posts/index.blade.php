@extends('layouts.app')
@section('content')
  <div class="container">
      {{-- post --}}
        <div class="row post" >
                <div class="col-md-7  border_ mb-5" style="background: #fff">
                    <form action="/p" enctype="multipart/form-data" method="POST">
                            @csrf
                        <div class="form-group d-flex pt-2">
                                <label for="caption" class=" col-form-label text-md-right"><img src="/profiles/{{Auth::user()->profile->profileImage()}}" alt="" class="rounded"></label>
                                <div class="col-md-10">
                                    <textarea class="form-control w-100" rows="3" id="caption"  class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus placeholder="What's on your mind ???">
                                    </textarea>
                                    @error('caption')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                        </div>
                        <div class="form-group d-flex ">
                                
                                <div style="position: relative" class="ml-5">
                                    <div id="iconUpload"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo</div>
                                   
                                    <input id="uploadNewPost" type="file"  name="image" id="image" class=" @error('image') is-invalid @enderror" autocomplete="image" autofocus>
                                    @error('image')
                                    <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </div>
                                <input type="submit" class="ml-2 btn btn-default" value="Post">
                        </div>
                            <div class="col-md-8 ml-5">
                                <img id="img_output" src="" alt="" width="100px" height="100px">
                            </div>
                        </form>
                </div>
        </div>
        {{-- end post --}}
    @foreach($posts as $post)
      <div class="row ">
                
                <div class="col-md-7 mb-5 p-0 border_">
                        <div>
                                <div class="name d-flex align-items-center pt-2 pb-2 "  style="background-color: #fff">
                                    <div>
                                        <img src="/profiles/{{$post->user->profile->profileImage()}}" width="40px" height="40px" alt="" class="rounded-circle mr-2">
                                    </div>
                                    <div class="font-weight-bold">
                                        <a href="/profile/{{$post->user->id}}" class="text-dark text-decoration-none" >
                                            {{$post->user->username}}
                                        </a>
                                       
            
                                    </div>
                                </div>
                                
                         </div>
                        <a href="/p/{{$post->id}}"><img src="/uploads/{{$post->image}}" class="img-fluid" ></a>
                    {{--  like --}}
                    <div class="pt-3" style="background-color: #fff" style="overflow: auto">
                            <div class="icon pl-2">
                            <i data-like_post="{{$post->id}}" id="like_{{$post->id}}" class="fa fa-heart like_heart @if(auth()->user()->like->contains($post->id)) liked @endif"  aria-hidden="true"></i>
                                    <a href=""><i class="fa fa-comment-o" aria-hidden="true"></i></a>
                            </div>
                        {{-- show like --}}
                        <b><div class="like pl-2" id="many_like_{{$post->id}}"> 
                            
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
                        </div> </b>
                        {{-- end show like --}}
                            <span class=" pl-2">
                                <a class="text-dark text-decoration-none" href="/profile/{{$post->user->id}}" >
                                  <b>  {{$post->user->username}} </b>
                                </a>
                                {{$post->caption}}
                            </span>  
                            <div class="comment pl-2"  >
                                    <ul style="list-style: none">
                                       
                                        @php
                                           $comments = $post->comment;
                                        @endphp
                                        
                                            @foreach($comments as $comment)
                                                <li><b><a href="" class="text-dark">{{$comment->user->username}}</a></b> {{$comment->comment}}</li>
                                            @endforeach
                                       
                                     
                                    <div id="comment{{$post->id}}"></div>
                                    </ul>
                                </div>
                            <div class=" p-2 d-flex" id="comment">
                                    <input  id="comment_{{$post->id}}"  type="text" class="w-100 postCmt" style="border: none" placeholder="Add a comment.." height="30px">
                            <a  style="color:#3897f0;font-weight: bold;cursor: pointer" data-post={{$post->id}} class='comment' id="post_{{$post->id}}" >Post</a>
                            </div>
                    </div>
              </div>
                
         </div>
     @endforeach
        </div>
        
@endsection
@section('js')

<script>
   
                $(document).on('click','.comment',function(){
                    var post_id = $(this).data('post');
                    var comment = $("#comment_"+post_id).val();
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
                            $("#comment_"+post_id).val('');
                            $("#comment"+post_id).before(data);
                        }
                    })
                    }
                });
          
                $(document).on('click','.like_heart',function(){
                    var post_id  = $(this).data('like_post'); 
                    $('#like_'+post_id).toggleClass("liked");
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
                            $('#many_like_'+post_id).text(data);
                        }
                    
                })
            });
            function readURL(input) {
                if (input.files && input.files[0]) {
                console.log(input.files[0]);
                console.log(input.files);
                var reader = new FileReader();
                
                reader.onload = function(e) {
                $('#img_output').attr('src', e.target.result);
                }
                
                reader.readAsDataURL(input.files[0]);
            }
    }
       
     $(document).on('change','#uploadNewPost',function(){
            readURL(this);
        })
    
      
</script>
@endsection

