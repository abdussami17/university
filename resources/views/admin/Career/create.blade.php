
@extends('admin.app')
@section('title',trans('general.Career_Create'))
@section('admin_content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
        <form action="{{ route('career.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row d-flex justify-content-center">
                <div class="col-md-8">

                    
                    <div class="card">
                        <div class="card-body">

                            <div class="row">
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="name">{{ trans('general.Select_Parent') }}</label>
                                    <select name="parent_id" id="" class="form-control">
                                        <option value="0">{{ trans('general.Root') }}</option>
                                        @foreach (App\Models\CareerJobs::where('status',1)->where('parent_id',0)->get(); as $item)
                                            <option value="{{ $item->id }}">{{ $item->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="name">{{ trans('general.Job_Title') }}</label>
                                    <input type="text" placeholder="{{ trans('general.Job_Title') }}" id="name" name="name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="slug">{{ trans('general.Link') }}</label>
                                    <input type="text" placeholder="{{ trans('general.Link') }}" id="slug" name="slug" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="Company">{{ trans('general.Company_Name') }}</label>
                                    <input type="text" placeholder="{{ trans('general.Company_Name') }}" id="Company" name="company_name" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="Location">{{ trans('general.Company_Location') }}</label>
                                    <input type="text" placeholder="{{ trans('general.Company_Location') }}" id="Location" name="company_location" class="form-control" required>
                                </div>
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="">{{ trans('general.Short_Desc') }}</label>
                                    <textarea id="summernote" cols="30" rows="10"  name="short_desc" class="form-control"></textarea>
                                </div>
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="">{{ trans('general.Long_Desc') }}</label>
                                    <textarea id="summernote1" cols="30" rows="10"  name="long_desc" class="form-control"></textarea>

                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="">{{ trans('general.Job_Posted_Date') }}</label>
                                    <input type="date" placeholder="" id="slug" name="date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="">{{ trans('general.Job_Last_Date') }}</label>
                                    <input type="date" placeholder="" id="slug" name="last_date" class="form-control">
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="banner">{{ trans('general.Salary') }}</label>
                                    <input type="text" name="salary" class="form-control" required>
                                </div>
                                <div class="col-md-6">
                                    <label class=" col-form-label" for="">{{ trans('general.Skill') }}</label>
                                    <input type="text" name="skill" class="form-control w-100" required id="tags" data-role="tagsinput">
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="banner">{{ trans('general.Banner') }}</label>
                                    <input type="file" name="banner" class="form-control" required>
                                </div>

                                <div class="col-md-6">
                                    <label class=" col-form-label" for="">{{ trans('general.Thumb') }}</label>
                                    <input type="file" name="thumb" class="form-control" required>
                                </div>

                                
                                <div class="col-md-12">
                                    <label class=" col-form-label" for="shortdesc">{{ trans('general.Job_Type') }}</label>
                                    <select name="job_type" id=""  class="form-control" required>
                                        <option value="full time">{{ trans('general.Full_Time') }}</option>
                                        <option value="part time">{{ trans('general.Part_Time') }}</option>
                                        <option value="remote">{{ trans('general.Remote') }}</option>
                                        <option value="contract">{{ trans('general.Contract') }}</option>
                                    </select>
                                </div>

                            </div>

                                        <!-- Modal Footer -->
                            <div class="modal-footer mt-4">
                                <button type="submit" class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                                <a href="{{ route('career.index') }}">
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