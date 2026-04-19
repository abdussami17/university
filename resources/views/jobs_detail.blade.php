@extends('layout.app')

@section('title', trans('general.Career_Jobs_Detail'))

@section('content')





<div class="jd-page">
    <div class="container-lg">
  
      <a href="{{ route('career.web') }}" class="jd-back-link">
        <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><polyline points="15 18 9 12 15 6"/></svg>
        Show all vacancies
      </a>
  
      <div class="jd-layout">
  
        <!-- LEFT: Main Content -->
        <div class="jd-main">
  
          <!-- Header -->
          <div class="jd-header">
            <div class="jd-company-logo">
                <img style="height: 100%;width:100%;border-radius:50%" src="{{ asset($job->banner) }}" alt="{ $job->name }}">
            </div>
            <div class="jd-title-block">
              <h1>{{ $job->name }}</h1>
              @if ($job->company_name)
              
              <span class="jd-company-name">{{ trans('general.Company_Name') }} : {{ $job->company_name}}</span>
              @endif
            
            </div>
          </div>
  
          <!-- Meta tags -->
          {{-- <div class="jd-meta-tags">
            <span class="jd-meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="7" width="20" height="14" rx="2"/><path d="M16 7V5a2 2 0 0 0-2-2h-4a2 2 0 0 0-2 2v2"/></svg>
              working student
            </span>
            <span class="jd-meta-sep">|</span>
            <span class="jd-meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><rect x="2" y="3" width="20" height="14" rx="2"/><line x1="8" y1="21" x2="16" y2="21"/><line x1="12" y1="17" x2="12" y2="21"/></svg>
              IT
            </span>
            <span class="jd-meta-sep">|</span>
            <span class="jd-meta-item">
              <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/></svg>
              Berlin
            </span>
          </div> --}}
  
          <!-- About -->
          <div class="jd-section">
            <h2 class="jd-section-title">About the position</h2>
            <p class="jd-intro-text"> {!! $job->long_desc !!}</p>
          </div>
  
          <!-- Tasks & Profile -->
          <div class="jd-two-col jd-section">
            <div>
              <h3 class="jd-section-title">Jobanforderungen</h3>
              <ul class="jd-list">
                @if ($job->last_date)
                <li class="jd-list-item">
                    <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                    {{ trans('general.Job_Last_Date') }} : {{ \Carbon\Carbon::parse($job->last_date)->format('F d, Y') }}
                  </li> 
                @endif
                @if ($job->job_type)
             
                <li class="jd-list-item">
                    <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                    {{ trans('general.Job_Type') }} : {{ $job->job_type }}
                  </li>                
                @endif
                @if ($job->date)
                
                <li class="jd-list-item">
                    <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                    {{ trans('general.Job_Posted_Date') }} : {{ \Carbon\Carbon::parse($job->date)->format('F d, Y') }}
                  </li>
                @endif
                
              </ul>
            </div>
            <div>
              <h3 style="visibility:hidden"class="jd-section-title">
                Lorem ipsum dolor sit amet.
              </h3>
              <ul class="jd-list">
                @if ($job->company_location)
                <li class="jd-list-item">
                  <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                  {{ trans('general.Company_Address') }} : {{ $job->company_location}}
                </li>
                @endif
               @if ($job->skill)
               <li class="jd-list-item">
                <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                {{ trans('general.Skill') }} :  {{ str_replace(',', '', $job->skill) }}
              </li>
               @endif
               @if ($job->salary)
                <li class="jd-list-item">
                  <svg class="jd-check-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2.5"><circle cx="12" cy="12" r="10"/><path d="M9 12l2 2 4-4"/></svg>
                  {{ trans('general.Salary') }} : {{ $job->salary }}
                </li>
                @endif
              </ul>
            </div>
          </div>
  
          <!-- Benefits -->
          <div class="jd-section">
            <h3 class="jd-section-title">Our benefits</h3>
            <div class="jd-benefits-tags">
              <span class="jd-benefit-tag">Flexible working hours</span>
              <span class="jd-benefit-tag">Insight into a growing tech company</span>
              <span class="jd-benefit-tag">Fair compensation</span>
              <span class="jd-benefit-tag">Option to acquire</span>
            </div>
          </div>
  
        
  
        </div><!-- end jd-main -->
  
        <!-- RIGHT: Sidebar -->
        <aside class="jd-sidebar">
  
            <!-- Apply Card -->
            <div class="jd-sidebar-card">
              <a href="#" class="jd-apply-btn">Jetzt bewerben</a>
              <div class="jd-action-row">
                <button class="jd-remember-btn">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"/>
                  </svg>
                  Merken
                </button>
                <button class="jd-share-btn">
                  <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="18" cy="5" r="3"/>
                    <circle cx="6" cy="12" r="3"/>
                    <circle cx="18" cy="19" r="3"/>
                    <line x1="8.59" y1="13.51" x2="15.42" y2="17.49"/>
                    <line x1="15.41" y1="6.51" x2="8.59" y2="10.49"/>
                  </svg>
                </button>
              </div>
            </div>
          
            <!-- Recommended Skills Card -->
            <div class="jd-sidebar-card">
              <h3 class="jd-sidebar-card-title">Empfohlene Fähigkeiten</h3>
              <p class="jd-sidebar-card-sub">Diese Fähigkeiten sind besonders relevant für die Stelle.</p>
              <div class="jd-skill-badge">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M21 15a2 2 0 0 1-2 2H7l-4 4V5a2 2 0 0 1 2-2h14a2 2 0 0 1 2 2z"/>
                </svg>
                {{ trans('general.Skill') }} : {{ str_replace(',', '', $job->skill) }}
              </div>
              {{-- <button class="jd-view-skills-btn">Fähigkeiten im Coach anzeigen</button> --}}
            </div>
          
            <!-- Application Made Easy Card -->
            <div class="jd-sidebar-card">
              <h3 class="jd-sidebar-card-title">Bewerbung leicht gemacht</h3>
              <p class="jd-sidebar-card-sub">Nutze unsere KI-Tools, um dich für diese Stelle zu bewerben.</p>
              <button class="jd-ai-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                  <polyline points="14 2 14 8 20 8"/>
                </svg>
                Anschreiben erstellen
              </button>
              <button class="jd-adapt-btn">
                <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                  <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"/>
                  <polyline points="14 2 14 8 20 8"/>
                </svg>
                Lebenslauf anpassen
              </button>
            </div>
          
          </aside>
  
      </div><!-- end jd-layout -->
    </div><!-- end container-lg -->
  </div>
@endsection