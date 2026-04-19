@extends('layout.app')

@section('title', trans('general.Career_Jobs_List'))

@section('content')
@push('styles')
    <link rel="stylesheet" href="{{ asset('assets/design/css/jobs.css') }}">
@endpush



<div class="jobs-page">
 
    <!-- ── HEADER ── -->
    <header class="jobs-page__header">
      <h1 class="jobs-page__header-title">
        <i style="height: 32px;width:32px;color:var(--color-primary)" data-lucide="briefcase"></i>
        {{ $job->name }}
      </h1>
     
    </header>
   
    <!-- ── FILTERS ── -->
    <div class="jobs-page__filters">
      <div class="jobs-filter__search">
        
        <i data-lucide="search" class="jobs-filter__search-icon"></i>
        <input type="text" class="jobs-filter__search-input" placeholder="Seek..." id="jobSearch" />
      </div>
      <select class="jobs-filter__select" id="typeFilter">
        <option value="">All types</option>
        <option value="working student">Working student</option>
        <option value="internship">Internship</option>
        <option value="temporary worker">Temporary worker</option>
      </select>
      <select class="jobs-filter__select" id="areaFilter">
        <option value="">All areas</option>
        <option value="berlin">Berlin</option>
        <option value="hamburg">Hamburg</option>
        <option value="munich">Munich</option>
        <option value="cologne">Cologne</option>
      </select>
    </div>
   
    <!-- ── GRID ── -->
    <div class="jobs-page__grid" id="jobsGrid">
        @foreach ($jobcat as $post)
      <!-- Card 1 -->
      <div class="job-card" data-type="working student" data-area="berlin">
        <div class="job-card__top">
          <img class="job-card__logo" src="{{ asset($post->thumb) }}" alt="{{ $post->name }}" />
          <div class="job-card__meta">
            <div class="job-card__title">{!!  $post->name !!}</div>
            {{-- <div class="job-card__tags">
                <span class="job-card__tag">working student</span>
                <span class="job-card__tag">Berlin</span>
              </div> --}}

          </div>
        </div>
        <div class="job-card__company">
            {!! \Illuminate\Support\Str::limit($post->short_desc, 200) !!}
    </div>
      
        <button   onclick="window.location='{{ route('jobs.detail.web',$post->slug) }}'" class="job-card__btn">Details Anzeigen</button>
      </div>
   
@endforeach
 
   
    </div><!-- /.jobs-page__grid -->
   
  </div>
@endsection