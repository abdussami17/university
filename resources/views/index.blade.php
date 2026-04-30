@extends('layout.app')

@section('title', trans('general.University'))

@section('content')

{{-- ══════════════════════════════════════════════════════
     ORIGINAL PHP HELPER + INLINE OVERRIDES
══════════════════════════════════════════════════════ --}}
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


<div class="news-layout">

    <!-- ── LEFT SIDEBAR ── -->
    <aside class="sidebar-left" aria-label="Latest News">
      <h2 class="sidebar__section-title">NEUESTE NACHRICHTEN</h2>
      @foreach($latestPosts as $post)
      <!-- Article 1 -->
      <article class="sidebar-article">
        <img
          src="{{ asset($post->thumb) }}"
          alt="Skill Gap 2026"
          class="sidebar-article__image"
          loading="lazy"
        />
        <div class="sidebar-article__category">  {{ $post->parent_data->name ?? 'General' }}</div>
        <h3 class="sidebar-article__title" onclick="window.location='{{ route('forum.topic.web', $post->slug) }}'">      {{ $post->title }}</h3>
        <p class="sidebar-article__excerpt">      {!! Str::limit($post->short_desc, 80) !!}</p>
        <div class="sidebar-article__date">       {{ \Carbon\Carbon::parse($post->date)->format('F d, Y') }}</div>
      </article>
@endforeach
    </aside>

    <!-- ── CENTER: MAIN ARTICLE ── -->
    <section class="main-article" aria-label="Featured Article">

      <!-- Hero Image with label -->
      <div class="main-article__image-wrapper">
        <img
          src="{{ asset($featuredPost->thumb) }}"
          alt="Students in a classroom"
          class="main-article__hero-image"
          loading="eager"
        />
        <div class="main-article__image-tag">
          <span class="label-tag">   {{ $featuredPost->parent_data->name ?? 'Featured' }}</span>
        </div>
      </div>

      <!-- Article content -->
      <h1 class="main-article__title">   {{ $featuredPost->title }}</h1>
      <p class="main-article__excerpt">
        {{ Str::limit($featuredPost->short_desc, 150) }}
      </p>

      <div class="main-article__meta">
        <span>{{ \Carbon\Carbon::parse($featuredPost->date)->format('F d, Y') }}</span>
        <span class="separator">•</span>
        <span>{{ $featuredPost->views }} Read</span>
        <a href="{{ route('forum.topic.web', $post->slug) }}"  class="read-more-link" style="color: var(--color-primary); font-weight:700; margin-left: auto;">
          Read More &rsaquo;
        </a>
      </div>
    </section>

    <!-- ── RIGHT SIDEBAR ── -->
    <aside class="sidebar-right" aria-label="Promotions and Most Read">

      <!-- Promo Box -->
      <div class="promo-box">
        <h2 class="promo-box__title">Upgrade Your Future</h2>
        <p class="promo-box__subtitle">Sichere dir exklusive Branchen-Insights und 1-zu-1 Mentoring.</p>
        <a href="{{ route('premium') }}" class="btn btn-outline-white">JETZT BEITRETEN</a>
      </div>

      <!-- Most Read -->
      <div class="most-read">
        <h3 class="most-read__title">MEISTGELESEN</h3>
        @foreach($mostReadPosts as $index => $post)
        <div class="most-read__item">
          <div class="most-read__item-number">{{ str_pad($index+1, 2, '0', STR_PAD_LEFT) }}</div>
          <div class="most-read__item-info">
            <div class="most-read__item-category">         {{ $post->parent_data->name ?? 'General' }}</div>
            <div class="most-read__item-title" onclick="window.location='{{ route('forum.topic.web', $post->slug) }}'">     {{ $post->title }}</div>
          </div>
          <img
            src="{{ asset($post->thumb) }}"
            alt="{{ asset($post->title) }}"
            class="most-read__item-image"
            loading="lazy"
          />
        </div>
        @endforeach


      </div>

    </aside>
  </div><!-- /.news-layout -->
{{-- ══════════════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════════════ --}}


{{-- ══════════════════════════════════════════════════
     SECTION 1 — Was ProAISkill dir schenkt (firstsection)
══════════════════════════════════════════════════ --}}

{{-- ══════════════════════════════════════════════════
     SECTION 2 — App Preview (secondsection) #funktionenSection
══════════════════════════════════════════════════ --}}


{{-- ══════════════════════════════════════════════════
     SECTION 3 — Spotlight / thirdsection
══════════════════════════════════════════════════ --}}

{{-- ══════════════════════════════════════════════════
     SECTION 4 — Power Features / Testimonials (section-4)
══════════════════════════════════════════════════ --}}


    <!-- ════════════════════════════════════════
         JOB RADAR SECTION
    ════════════════════════════════════════ -->
    <section class="job-radar" id="job-offers" aria-label="Job Radar">
        <div class="job-radar__header">
          <div class="job-radar__left">
            <span class="label-tag">Career Intelligence</span>
            <h2 class="job-radar__title">Job Radar</h2>
            <p class="job-radar__subtitle">Exclusive Entry Opportunities for Members</p>
          </div>
          <a href="{{ route('career.web')   }}" class="btn btn-outline">
            View All Vacancies &nbsp;&rsaquo;
          </a>
        </div>
  
        <!-- Job Cards -->
        <div class="job-cards-grid">
  @foreach ($jobs as $j )
            <!-- Card 1 -->
            <article class="job-card" role="article">
                <div class="job-card__category">{{ $j->job_type }}</div>
                <h3 class="job-card__title">{{ $j->name }}</h3>
                <div class="job-card__company">{{ $j->company_name }}</div>
                <div class="mt-2">
                    <span class="d-flex justify-content-normal align-items-center gap-2">
                        <i data-lucide="map-pin" height="15" width="15"></i>
                       {{ $j->company_location }}
                    </span>
                </div>
              </article>
  @endforeach
    

  
        </div>
      </section>


    <!-- ════════════════════════════════════════
         MARKETPLACE HERO SECTION
    ════════════════════════════════════════ -->
    <section class="marketplace-hero" id="marketplace" aria-label="Marketplace">
        <div class="marketplace-hero__inner">
  
          <!-- Left: Text -->
          <div class="marketplace-hero__content">
            <span class="marketplace-hero__label">Marketplace</span>
            <h2 class="marketplace-hero__title">Spare im Studium, investiere in deine Skills.</h2>
            <p class="marketplace-hero__text">
                Wir haben mit über 100 Partnern verhandelt, um dir exklusive Deals für Hardware, Software und Lifestyle zu sichern.
            </p>
            <a href="#" class="btn btn-primary">ALLE DEALS ENTDECKEN</a>
          </div>
  
          <!-- Right: Image -->
          <div class="marketplace-hero__image-wrapper">
            <img
              src="https://images.unsplash.com/photo-1506794778202-cad84cf45f1d?w=800&q=75"
              alt="Students walking on campus"
              class="marketplace-hero__image"
              loading="lazy"
            />
          </div>
  
        </div>
      </section>
    {{-- CTA Box --}}

</section>

{{-- ══════════════════════════════════════════════════
     NEWS + JOB RADAR + MARKETPLACE  (design system sections)
══════════════════════════════════════════════════ --}}


{{-- ══════════════════════════════════════════════════
     FRONTEND FOOTER (original logic preserved)
══════════════════════════════════════════════════ --}}
{{-- {!! get_setting('frontend_footer') !!} --}}

@endsection

@section('home_style')
    <link rel="stylesheet" href="{{ asset('new_asset/style/style.css') }}">
@endsection