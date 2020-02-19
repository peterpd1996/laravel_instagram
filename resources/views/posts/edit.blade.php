<div id="editPost" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header" style="padding: 6px !important;background: #f5f6f7 !important;">
        <h4 class="modal-title">Edit post</h4>
        <span class="close" data-dismiss="modal" style="padding: 25px !important;cursor: pointer;">&times;</span>
      </div>
      <form  enctype="multipart/form-data" id="form-update">
      <div class="modal-body">
                <input type="hidden" name="post_id" id="edit-post-id">
                @csrf
                <div class="form-group d-flex pt-2">
                    <label for="caption" class=" col-form-label text-md-right"><img
                            src="/profiles/{{Auth::user()->profile->profileImage()}}" alt="" class="rounded"></label>
                    <div class="col-md-10">
                        <textarea class="form-control w-100" rows="3" id="oldCaption"
                            class="form-control @error('caption') is-invalid @enderror" name="caption" autocomplete="caption" autofocus></textarea>       
                    </div>
                </div>
                <div class="form-group d-flex ">
                    <div style="position: relative" class="ml-5">
                        <div class="iconUpload"> <i class="fa fa-picture-o" aria-hidden="true"></i> Photo</div>
                        <input id="updatePost" type="file" name="image" id="image"
                            class="uploadNewPost"> 
                    </div>
                </div>
                <div class="col-md-8 ml-5">
                   <img id="oldImage" src="" alt="" width="100px" height="100px" class="border_" style="margin-bottom: 9px;">
                </div>
        </div>
      <div class="modal-footer">
         <button type="submit" class="btn btn-primary ml-2" id="saveEdit">Edit</button>
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </form>
      </div>
    </div>

  </div>
</div>