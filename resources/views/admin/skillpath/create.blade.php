
@extends('admin.app')
@section('title','create')
@section('admin_content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('skillpath.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">

                    
                    <div class="card">
                        <div class="card-body">
                            <h4>Skill Path Create</h4>
                            <div class="row">
                                <div class="col-md-6">
                                    <label class="col-form-label" for="title">{{ trans('general.Name') }}</label>
                                    <input type="text" placeholder="" id="title" name="name" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class="col-form-label" for="icon_class">{{ trans('general.icon_class') }}</label>
                                    <input type="text" placeholder="" id="icon_class" name="icon_class" class="form-control">
                                </div>
                                <div class="col-md-12">
                                    <label class="col-form-label" for="shortdesc">{{ trans('general.Description') }}</label>
                                    <textarea id="summernote1" cols="30" rows="10"  name="description" class="form-control"></textarea>

                                </div>


                            </div>

                            <!-- Modal Footer -->
                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                                <a href="{{ route('skillpath.index') }}">
                                    <button type="button" class="btn btn-light">{{ trans('general.Cancel') }}</button>

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