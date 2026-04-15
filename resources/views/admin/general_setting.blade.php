<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
@extends('admin.app')
@section('title',trans('general.General_Setting'))


@section('admin_content')
<div class="content">


@php
if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
 
        $settings = Cache::remember('Setting', 2, function () {
            return App\Models\Setting::all();
        });

        if ($lang == false) {
            $setting = $settings->where('type', $key)->first();
            
        } else {
            $setting = $settings->where('type', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
        }
        return $setting == null ? $default : $setting->value;
    }
}
@endphp
<!-- Start Content-->
<div class="container-fluid">

 <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
     <div class="flex-grow-1">
         <h4 class="fs-18 fw-semibold m-0">{{ trans('general.General_Setting') }}</h4>
     </div>

    
 </div>

 <!-- General Form -->
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <h5>{{ trans('general.Setting') }}</h5>
                        <hr>
                        <form action="{{ route('general.setting.submit') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <label class="form-label">{{ trans('general.Email') }}</label>
                            <input type="hidden" name="types[]" value="website_email">
                            <input type="text" name="website_email" value="{{ get_setting('website_email') }}" class="form-control">
                            <br>
                            <label class="form-label">{{ trans('general.Phone') }}</label>
                            <input type="hidden" name="types[]" value="website_phone">
                            <input type="text" name="website_phone" value="{{ get_setting('website_phone') }}" class="form-control">
                            <br>
                            <label class="form-label">{{ trans('general.Copyright') }}</label>
                            <input type="hidden" name="types[]" value="website_copyright">
                            <input type="text" name="website_copyright" value="{{ get_setting('website_copyright') }}" class="form-control">
                            <br>
                            <label class="form-label">{{ trans('general.Address') }}</label>
                            <input type="hidden" name="types[]" value="website_address">
                            <textarea name="website_address" id="" cols="30" rows="10" class="form-control">{{ get_setting('website_address') }}</textarea>
                            <div class="col-xs-12 col-sm-12 col-md-12">
                                <button type="submit" class="btn btn-primary" style="margin-top: 10px">Save</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
 
</div> <!-- container-fluid -->
</div>
@endsection
