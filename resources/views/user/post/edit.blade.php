

        <form action="{{ route('account.post.update') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="id" value="{{ $edit->id }}">
            <div class="row d-flex justify-content-center mt-150-card">
                <div class="col-md-12">                    
                    <div class="m-5">
                        <div class="card-body">
                            <h4>{{ trans('Post Update') }}</h4>

                            <div class="row">
                             <input type="hidden" name="parent_id" value="{{ encrypt($edit->parent_id) }}">
                                <div class="col-md-12">
                                    <label class="col-sm-2 col-form-label" for="name">{{ trans('general.Name') }}</label>
                                    <input type="text" placeholder="" id="name" name="name" class="form-control" value="{{ $edit->name }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="title">{{ trans('general.Post_Title') }}</label>
                                    <input type="text" placeholder="" id="title" name="title" class="form-control" required value="{{ $edit->title }}">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ trans('general.Link') }}</label>
                                    <input type="text" placeholder="" id="slug" name="slug" class="form-control" value="{{ $edit->slug }}" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-2 col-form-label" for="shortdesc">{{ trans('general.Short_Desc') }}</label>
                                    <textarea id="summernote" cols="30" rows="10"  name="short_desc" class="form-control">{{ $edit->short_desc }}</textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="shortdesc">{{ trans('general.Thumb') }}</label>
                                    <input type="file" placeholder="" id="" name="thumb" class="form-control">
                                    <img src="{{ asset($edit->thumb) }}" alt="" width="100px" height="100px" class="mt-2">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="date">{{ trans('general.Date') }}</label>
                                    <input type="date" placeholder="" id="" name="date" class="form-control" value="{{ $edit->date }}">
                                </div>
                            </div>

                                <!-- Modal Footer -->
                                <div class="modal-footer mt-4">
                                    <button type="submit" class="btn btn-primary me-2">Save</button>
                                    <a href="{{ route('post.index') }}">
                                        <button type="button" class="btn btn-light">Cancel</button>
    
                                    </a>
                                </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
    </div>
</div>
