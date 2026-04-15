@extends('layout.app')

@section('title', trans('general.Career_Jobs'))

@section('content')
<style>

    .change-accordin{
        background: #fff;
        padding: 21px;
    }
</style>
<div class="container career-jobs">
    <h1 class="title">{{ trans('general.Career_Jobs') }}</h1>
    <h2 class="accordion-header">
        <button class="accordion-button " type="button" data-bs-toggle="collapse" data-bs-target="#collapse1">
            {{ trans('general.Career_Category') }}
        </button>
    </h2>
    <div class="accordion mt-4 change-accordin" id="mainAccordion">
        <div class="group-card">  
            @foreach (App\Models\CareerJobs::where('parent_id', 0)->where('status',1)->get() as $post)
                <div class="card">
                    <img src="{{ asset($post->thumb) }}" alt="{{ $post->name }}">
                    <div class="card-content">
                        <div class="card-title" onclick="window.location='{{ route('jobs.web',$post->slug) }}'">{!! $post->name !!}</div>
                        <div class="description">
                            {!! $post->short_desc !!}
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    
    </div>
</div>

@endsection