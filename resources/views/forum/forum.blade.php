@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))

@section('content')
@push('styles')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <link rel="stylesheet" href="{{ asset('assets/design/css/trends.css') }}">
@endpush




    <!-- ══ SECTION 1: TRENDS & VIBES HERO ══ -->
<section class="trends-vibes-hero-section">
    <div class="container-lg">
  
        <span class="trends-vibes-hero-discovery-badge">Entdeckungsplattform</span>
  
      <h1 class="trends-vibes-hero-headline">{{ trans('general.Forums') }}</h1>
  
      <p class="trends-vibes-hero-subtext">
        Dein Radar für Lifestyle, Kultur und alles, was dein<br>
        Studium über die Bücher hinaus ausmacht.
      </p>
  
      <div class="trends-vibes-hero-search-wrapper">
        <div class="trends-vibes-hero-search-box">
          <svg class="trends-vibes-hero-search-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <circle cx="11" cy="11" r="8"/><line x1="21" y1="21" x2="16.65" y2="16.65"/>
          </svg>
          <input
          type="text"
          id="forumSearchInput"
          class="trends-vibes-hero-search-input"
          placeholder="Search..."
          autocomplete="off"
        />
        </div>
      </div>
  
      <div class="trends-vibes-hero-quick-links">
        <a href="#" class="trends-vibes-hero-quick-link-btn">
          <svg class="trends-vibes-hero-quick-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M9 18V5l12-2v13"/><circle cx="6" cy="18" r="3"/><circle cx="18" cy="16" r="3"/>
          </svg>
          Campus-Playlists
        </a>
      
        <a href="#" class="trends-vibes-hero-quick-link-btn">
          <svg class="trends-vibes-hero-quick-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <rect x="3" y="3" width="18" height="18" rx="2"/><circle cx="8.5" cy="8.5" r="1.5"/>
            <polyline points="21 15 16 10 5 21"/>
          </svg>
          Lookbook '26
        </a>
      
        <a href="#" class="trends-vibes-hero-quick-link-btn">
          <svg class="trends-vibes-hero-quick-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/><circle cx="12" cy="10" r="3"/>
          </svg>
          Lokale Hotspots
        </a>
      
        <a href="#" class="trends-vibes-hero-quick-link-btn">
          <svg class="trends-vibes-hero-quick-link-icon" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"/>
          </svg>
          Alltagstipps
        </a>
      </div>
  
    </div>
  </section>
  
  <!-- ══ SECTION 2: CURRENT RADAR ══ -->
  <section class="current-radar-section">
    <div class="container-xl">
  
      <div class="current-radar-section-header">
        <h2 class="current-radar-section-title">Current Radar</h2>
        <span class="current-radar-section-edition"></span>
      </div>
  
      <div class="current-radar-cards-grid">

        @foreach (App\Models\Category::where('parent_id', 0)->where('status', 1)->with('child')->get() as $category)
        
            @php
                $activeSubcategories = $category->child->where('status', 1);
            @endphp
        
            @foreach ($activeSubcategories as $subcategory)
        
                @php
                    $adminPostCount = \App\Models\Post::where('parent_id', $subcategory->id)->count();
                    $userPostCount  = \App\Models\userpost::where('parent_id', $subcategory->id)->count();
                    $totalPostCount = $adminPostCount + $userPostCount;
        
                    $postIds = \App\Models\Post::where('parent_id', $subcategory->id)->pluck('id');
                    $userPostIds = \App\Models\userpost::where('parent_id', $subcategory->id)->pluck('id');
        
                    $followerCount = \App\Models\Follower::whereIn(
                        'user_post_id',
                        $postIds->merge($userPostIds)
                    )->count();
                @endphp
        
                <div class="current-radar-article-card" data-category="{{ strtolower($category->name) }}"
                  data-subcategory="{{ strtolower($subcategory->name) }}">
        
                    <div class="current-radar-article-card-image-wrapper">
                        <img src="{{ asset($subcategory->thumb) }}" class="current-radar-article-card-image">
        
                        <span class="current-radar-article-card-category-tag">
                            {{ $category->name }}
                        </span>
                    </div>
        
                    <h3 class="current-radar-article-card-title">
                        {!! $subcategory->name !!}
                    </h3>
        
                    <p class="current-radar-article-card-excerpt">
                        {!! \Illuminate\Support\Str::limit(strip_tags($subcategory->short_desc), 100) !!}
                    </p>
        
                    <div class="current-radar-article-card-hashtags">
                        <span class="jd-benefit-tag">#{{ number_format($totalPostCount) }} {{ trans('general.Posts') }}</span>
                        <span class="jd-benefit-tag">#{{ $followerCount }} {{ trans('general.Followers') }}</span>
                    </div>
        
                    <a href="{{ route('forum.forum.web', $subcategory->slug) }}"
                       class="current-radar-article-card-learn-more">
                       Mehr erfahren
                       <i data-lucide="arrow-right"></i>
                    </a>
        
                </div>
        
            @endforeach
        
        @endforeach
        
        </div>
  </section>

@endsection


@push('script')
<script>
document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('forumSearchInput');
    const cards = document.querySelectorAll('.current-radar-article-card');

    searchInput.addEventListener('input', function () {

        const value = this.value.toLowerCase().trim();

        cards.forEach(card => {

            const category = card.dataset.category || '';
            const subcategory = card.dataset.subcategory || '';

            if (
                category.includes(value) ||
                subcategory.includes(value)
            ) {
                card.style.display = 'block';
            } else {
                card.style.display = 'none';
            }

        });

    });

});
</script>
@endpush