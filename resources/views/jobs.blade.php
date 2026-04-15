@extends('layout.app')

@section('title', trans('general.Career_Jobs_List'))

@section('content')

{{-- 
<div class="container mt-120 career-jobs">
    <h1 class="title">{{ $job->name }}</h1>
    <div class="accordion" id="mainAccordion">
        <div class="group-card">  
            @foreach ($jobcat as $post)
                <div class="card">
                    <img src="{{ asset($post->thumb) }}" alt="{{ $post->name }}">
                    <div class="card-content">
                        <div class="card-title" onclick="window.location='{{ route('jobs.detail.web',$post->slug) }}'">{!! $post->name !!}</div>
                        <div class="description">
                            {!! $post->short_desc !!}
                        </div>
                    </div>
                </div>

            @endforeach
        </div>
    
    </div>
</div> --}}
<div class="main-feedback-heading-breadcrumb">
    <div class="container">
        <div class="row">
            <ul class="breadcrumb wizard">
                <li class="completed"><a href="{{ route('career.web') }}">{{ trans('general.Career_Job') }}</a></li>
                <li><a href="javascript:void(0);">{{ $job->name }}</a></li>
            </ul>
        </div>
    </div>
</div>

<section class="main-feedback-heading career-job-ct">
    <div class="container" style=" border-top: 3px solid rgb(1, 56, 18);">
        <div class="header" style="border:0">
            <h1>{{ $job->name }}</h1>
        </div>
        
    </div>
    <div class="container" style="padding-top: 0px;">
        <div class="forum-list">

                @foreach ($jobcat as $item)
                <a href="{{ route('jobs.detail.web',$item->slug) }}" class="main-job">
                <div class="forum-item">
                    <div class="forum-item-left">
                        <h2>{{ $item->name }}</h2>
                        <p>{{ trans('general.Job_Posted_Date') }}: {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</p>
                    </div>
                </div>
            </a>
                @endforeach
                


        </div>
    </div>
</section>
@endsection