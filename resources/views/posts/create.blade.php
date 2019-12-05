@extends('layouts.app')
@section('content')
<form action="/p" enctype="multipart/form-data" method="POST">
    @csrf
    <div class="container">
        <div class="row">
            <div class="col-10">
                <div class="form-group row pb-1">
                    <label for="caption" class="col-md-4 col-form-label text-md-right">Post Caption</label>
                    <div class="col-md-8">
                        <textarea class="form-control" rows="5" id="caption"  class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>
                        </textarea>
                        @error('caption')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="form-group row pb-2">
                    <label for="image" class="col-md-4 col-form-label text-md-right ">Post Image</label>
                    <div class="col-md-8" style="position: relative">
                        <div id="iconUpload"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo</div>
                        <input id="uploadNewPost" type="file"  name="image" id="image" class=" @error('image') is-invalid @enderror" autocomplete="image" autofocus>
                        @error('image')
                        <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </div>
                <div class="col-md-8 offset-md-4">
                    <img id="img_output" src="" alt="" width="400px" height="400px">
                </div>
                <div class="row pl-3 mt-2">
                    <button class="btn btn-primary col-md-3 offset-md-4 ">Add New Post</button>
                </div>
            </div>
        </div>
    </div>
</form>
@endsection
@section('js')
<script>
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