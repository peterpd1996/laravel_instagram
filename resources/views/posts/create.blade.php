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
                            <input id="caption" type="text" class="form-control @error('caption') is-invalid @enderror" name="caption" value="{{ old('caption') }}"  autocomplete="caption" autofocus>
            
                            @error('caption')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    <div class="form-group row pb-2">
                        <label for="image" class="col-md-4 col-form-label text-md-right ">Post Image</label>
                        <div class="col-md-8">
                                <input type="file"  name="image" id="image" class="form-control  @error('image') is-invalid @enderror" autocomplete="image" autofocus>
                                @error('image')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                        </div>
                    </div>
                    <div class="row pl-3">
                    <button class="btn btn-primary col-md-3 offset-md-4 ">Add New Post</button>
                    </div>
                </div>
            
        </div>
    </div>
</form>
@endsection