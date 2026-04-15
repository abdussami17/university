@extends('layout.app')

@section('title', trans('general.Career_Jobs_Detail'))

@section('content')

    <div class="container">
        <div class="row">
            <ul class="breadcrumb wizard">
                <li class="completed"><a href="{{ route('career.web') }}">{{ trans('general.Career_Jobs_List') }}</a></li>
                @if ($job->parent_data)
                    <li><a href="{{ route('jobs.web',$job->parent_data->slug) }}">{{ $job->parent_data->name }}</a></li>
                @endif
                <li><a href="javascript:void(0);">{{ $job->name }}</a></li>

            </ul>
        </div>
    </div>

<section class="detail-section container mt-1">
    <div class="detail-upper-info">
        <div class="title-area">
            <h2>{{ trans('general.Career_Jobs_Detail') }}</h2>
        </div>
    </div>
    <div class="main-image">
        <img alt="{{ $job->name }}" class="product-card__hero-image css-1fxh5tw" height="100%" loading="eager" sizes="" src="{{ asset($job->banner) }}" width="100%">
    </div>
    <div class="detail-lower-info">
        
    <div class="reservation-container mt-5">
        <h3 class="title-header">
            {{ $job->name }}
        </h3>
        <div class="jo-detail-main">
            <div class="row">
                <div class="col-md-6">
                    @if ($job->company_name)
                    <h6>{{ trans('general.Company_Name') }} : {{ $job->company_name}}</h6>
                    @endif
                    @if ($job->job_type)
                    <h6>{{ trans('general.Job_Type') }} : {{ $job->job_type }}</h6>
                    @endif

                    @if ($job->date)
                    <h6>{{ trans('general.Job_Posted_Date') }} : {{ \Carbon\Carbon::parse($job->date)->format('F d, Y') }}</h6>

                    @endif

                </div>
                <div class="col-md-6">
                    @if ($job->company_location)
                        <h6>{{ trans('general.Company_Address') }} : {{ $job->company_location}}</h6>
                    @endif
                    @if ($job->skill)
                        <h6>{{ trans('general.Skill') }} :  {{ str_replace(',', '', $job->skill) }}</h6>
                    @endif
                    @if ($job->salary)
                        <h6>{{ trans('general.Salary') }} : {{ $job->salary }}</h6>
                    @endif
                </div>
            </div>
        </div>

    </div>
    </div>
    <div class="container detail-lower-info mt-3">
        <div class="product_description">
           {!! $job->long_desc !!}

           
           @if ($job->last_date)
           <h6 class="mt-5 fw-900-0">{{ trans('general.Job_Last_Date') }} : {{ \Carbon\Carbon::parse($job->last_date)->format('F d, Y') }}</h6>

           @endif
        </div>
    </div>
</section>

@endsection