
                    
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <form action="{{ route('account.post.store') }}" method="POST" enctype="multipart/form-data">
                                    @csrf
                            <input type="hidden" name="parent_id" value="{{ base64_encode(session('post_cat_id')) }}">
                                <div class="col-md-12">
                                    <label class="col-form-label" for="name">{{ trans('general.Name') }}</label>
                                    <input type="text" placeholder="" id="name" name="name" class="form-control">
                                </div>
                                <div class="row">

                                <div class="col-md-6">
                                    <label class="col-form-label" for="title">{{ trans('general.Post_Title') }}</label>
                                    <input type="text" placeholder="" id="title" name="title" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="slug">{{ trans('general.Link') }}</label>
                                    <input type="text" placeholder="" id="slug" name="slug" class="form-control" required>
                                </div>
                                
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="shortdesc">{{ trans('general.Short_Desc') }}</label>
                                    <textarea id="summernote" cols="30" rows="10"  name="short_desc" class="form-control"></textarea>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="shortdesc">{{ trans('general.Thumb') }}</label>
                                    <input type="file" placeholder="" name="thumb" class="form-control">
                                </div>

                                <div class="col-md-6">
                                    <label class="col-form-label" for="shortdesc">{{ trans('general.Date') }}</label>
                                    <input type="date" placeholder="" name="date" class="form-control">
                                </div>
                            <!-- Modal Footer -->
                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                            </div>
                                </form>

                            </div>


                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>

