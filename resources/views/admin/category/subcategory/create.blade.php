
@extends('admin.app')
@section('title',trans('general.Post_Sub_Category_Create'))
@section('admin_content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('category.store.subcategory') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">
                    
                    <div class="card">
                        <div class="card-body">
                            <h4>{{ trans('Sub_Category_Create_Update') }}</h4>                    

                            <input type="hidden" name="id" value="{{ $create->id }}">
                            <div class="row">
                                <div class="col-md-12">
                                    <label class="col-sm-2 col-form-label" for="name">{{ trans('general.Select_Parent') }}</label>
                                    <select name="parent_id" id="" class="form-control">
 
                                        @foreach (App\Models\Category::where('parent_id','!=', 0)->get(); as $item)
                                        <option value="{{ $item->id }}" {{ $create->id == $item->id ? 'selected' : '' }}>
                                            {{ $item->name }}
                                        </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="name">{{ trans('general.Name') }}</label>
                                    <input type="text" placeholder="" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class="col-sm-2 col-form-label" for="slug">{{ trans('general.Link') }}</label>
                                    <input type="text" placeholder="" id="slug" name="slug" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-2 col-form-label" for="">{{ trans('general.Short_Desc') }}</label>
                                    <textarea id="summernote" cols="30" rows="10"  name="short_desc" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class="col-sm-2 col-form-label" for="">{{ trans('general.Long_Desc') }}</label>
                                    <textarea id="summernote1" cols="30" rows="10"  name="long_desc" class="form-control"></textarea>

                                </div>
                                <div class="col-md-112">
                                    <label class="col-sm-2 col-form-label" for="">{{ trans('general.Thumb') }}</label>
                                    <input type="file" placeholder="" id="slug" name="thumb" class="form-control">
                                </div>
                            </div>

                                        <!-- Modal Footer -->
                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary me-2">{ trans('general.Save') }}</button>
                                <a href="{{ route('post.index') }}">
                                    <button type="button" class="btn btn-light">{ trans('general.Cancel') }}</button>

                                </a>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </form>
    </div>
</div>

@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
  <script>
    $(document).ready(function() {
        $('#summernote').summernote({
        placeholder: "{{ trans('general.Short_Description') }}",
        tabsize: 2,
        height: 150
      });
    });
    $(document).ready(function() {
        $('#summernote1').summernote({
        placeholder: "{{ trans('general.Long_Description') }}",
        tabsize: 2,
        height: 150
      });
    });
  </script>
@endsection