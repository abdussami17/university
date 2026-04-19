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

<style>
    /* ── Hide things that belong to other layouts ── */
    .others-footer { display: none; }
    .home-none     { display: none !important; }

    /* ── Override card img width from parent layout ── */
    .card img { width: 100% !important; }

    /* ══════════════════════════════════════════════════
       HERO SECTION
    ══════════════════════════════════════════════════ */
    .pai-hero {
        text-align: center;
        padding: var(--sp-16) var(--sp-6) var(--sp-12);
        background: var(--color-white);
        border-bottom: 1px solid var(--color-border);
        position: relative;
        overflow: hidden;
    }
    .pai-hero::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            0deg,
            transparent,
            transparent 39px,
            var(--color-border) 39px,
            var(--color-border) 40px
        );
        opacity: 0.35;
        pointer-events: none;
    }
    .pai-hero__eyebrow {
        display: inline-block;
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.16em;
        text-transform: uppercase;
        color: var(--color-primary);
        border: 1.5px solid var(--color-primary);
        padding: var(--sp-1) var(--sp-4);
        margin-bottom: var(--sp-6);
        position: relative;
    }
    .pai-hero__title {
        font-family: var(--font-heading);
        font-size: clamp(2.4rem, 6vw, 5rem);
        font-weight: 900;
        color: var(--color-dark);
        text-transform: uppercase;
        letter-spacing: -0.02em;
        line-height: 1;
        margin-bottom: var(--sp-6);
        position: relative;
    }
    .pai-hero__subtitle {
        font-size: var(--fs-md);
        color: var(--color-muted);
        line-height: 1.7;
        max-width: 560px;
        margin: 0 auto var(--sp-8);
        position: relative;
    }
    .pai-hero__cta-row {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: var(--sp-4);
        flex-wrap: wrap;
        margin-bottom: var(--sp-10);
        position: relative;
    }
    .pai-hero__btn-primary {
        display: inline-flex;
        align-items: center;
        gap: var(--sp-2);
        padding: var(--sp-4) var(--sp-8);
        background: var(--color-primary);
        color: var(--color-white);
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border: 2px solid var(--color-primary);
        border-radius: var(--radius-sm);
        transition: background var(--transition), transform var(--transition);
        text-decoration: none;
    }
    .pai-hero__btn-primary:hover {
        background: var(--color-primary-dark);
        border-color: var(--color-primary-dark);
        transform: translateY(-2px);
        color: var(--color-white);
        text-decoration: none;
    }
    .pai-hero__btn-outline {
        display: inline-flex;
        align-items: center;
        gap: var(--sp-2);
        padding: var(--sp-4) var(--sp-8);
        background: transparent;
        color: var(--color-dark);
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.12em;
        text-transform: uppercase;
        border: 1.5px solid var(--color-dark);
        border-radius: var(--radius-sm);
        transition: background var(--transition), color var(--transition);
        text-decoration: none;
    }
    .pai-hero__btn-outline:hover {
        background: var(--color-dark);
        color: var(--color-white);
        text-decoration: none;
    }
    /* Media inside hero */
    .pai-hero__media {
        position: relative;
        max-width: 900px;
        margin: 0 auto;
        border: 1px solid var(--color-border);
    }
    .pai-hero__media video,
    .pai-hero__media img.pai-hero__img {
        width: 100%;
        display: block;
        max-height: 400px;
        object-fit: cover;
    }

    /* ══════════════════════════════════════════════════
       SECTION TITLE (shared)
    ══════════════════════════════════════════════════ */
    .pai-section-header {
        max-width: 1400px;
        margin-inline: auto;
        padding: 0 var(--sp-6) var(--sp-6);
    }
    .pai-section-header__label {
        display: block;
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        color: var(--color-muted);
        margin-bottom: var(--sp-2);
    }
    .pai-section-header__title {
        font-family: var(--font-heading);
        font-size: clamp(1.8rem, 4vw, 2.8rem);
        font-weight: 900;
        color: var(--color-dark);
        text-transform: uppercase;
        letter-spacing: -0.01em;
        line-height: 1.05;
        padding-bottom: var(--sp-4);
        border-bottom: 3px solid var(--color-dark);
    }

    /* ══════════════════════════════════════════════════
       SECTION 1 — Feature Cards (firstsection)
    ══════════════════════════════════════════════════ */
    .pai-features {
        padding: var(--sp-16) 0;
        background: var(--color-bg);
        border-top: 1px solid var(--color-border);
    }
    .pai-features__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        max-width: 1400px;
        margin-inline: auto;
        padding-inline: var(--sp-6);
        border-top: 1px solid var(--color-border);
    }
    .pai-feature-card {
        padding: var(--sp-8) var(--sp-6);
        border-right: 1px solid var(--color-border);
        background: var(--color-white);
        display: flex;
        flex-direction: column;
        gap: var(--sp-4);
        transition: background var(--transition);
    }
    .pai-feature-card:last-child { border-right: none; }
    .pai-feature-card:hover { background: #f8f8ff; }
    .pai-feature-card__icon {
        width: 44px;
        height: 44px;
        background: var(--color-primary);
        color: var(--color-white);
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: var(--fs-lg);
        border-radius: var(--radius-sm);
        flex-shrink: 0;
    }
    .pai-feature-card__title {
        font-family: var(--font-heading);
        font-size: 1.1rem;
        font-weight: 800;
        text-transform: uppercase;
        color: var(--color-dark);
        line-height: 1.1;
        letter-spacing: -0.01em;
    }
    .pai-feature-card__desc {
        font-size: var(--fs-sm);
        color: var(--color-muted);
        line-height: 1.6;
        flex: 1;
    }
    .pai-feature-card__image {
        width: 100%;
        aspect-ratio: 4/3;
        object-fit: cover;
        display: block;
        filter: grayscale(20%) brightness(0.95);
        margin-top: var(--sp-2);
    }

    /* ══════════════════════════════════════════════════
       SECTION 2 — App Preview (secondsection)
    ══════════════════════════════════════════════════ */
    .pai-preview {
        padding: var(--sp-16) 0;
        background: var(--color-white);
        border-top: 1px solid var(--color-border);
    }
    .pai-preview__inner {
        max-width: 1200px;
        margin-inline: auto;
        padding-inline: var(--sp-6);
    }
    .pai-preview__desc {
        font-size: var(--fs-base);
        color: var(--color-muted);
        text-align: center;
        margin-bottom: var(--sp-6);
        line-height: 1.7;
    }
    .pai-preview__tabs {
        display: flex;
        flex-wrap: wrap;
        gap: var(--sp-2);
        justify-content: center;
        margin-bottom: var(--sp-8);
    }
    .pai-preview__tab {
        display: inline-flex;
        align-items: center;
        gap: var(--sp-2);
        padding: var(--sp-2) var(--sp-5);
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.1em;
        text-transform: uppercase;
        border: 1.5px solid var(--color-border);
        border-radius: var(--radius-full);
        background: var(--color-white);
        color: var(--color-dark);
        cursor: pointer;
        transition: background var(--transition), color var(--transition), border-color var(--transition);
    }
    .pai-preview__tab:hover,
    .pai-preview__tab.active {
        background: var(--color-dark);
        color: var(--color-white);
        border-color: var(--color-dark);
    }
    .pai-preview__frame {
        border: 1px solid var(--color-border);
        padding: var(--sp-2);
        background: var(--color-bg);
    }
    .pai-preview__frame img {
        width: 100%;
        display: block;
        object-fit: cover;
    }

    /* ══════════════════════════════════════════════════
       SECTION 3 — thirdsection (single featured)
    ══════════════════════════════════════════════════ */
    .pai-spotlight {
        padding: var(--sp-16) 0;
        background: var(--color-bg);
        border-top: 1px solid var(--color-border);
    }
    .pai-spotlight__inner {
        max-width: 900px;
        margin-inline: auto;
        padding-inline: var(--sp-6);
    }
    .pai-spotlight__frame {
        border: 1px solid var(--color-border);
        padding: var(--sp-2);
        background: var(--color-white);
        margin-bottom: var(--sp-6);
    }
    .pai-spotlight__frame img {
        width: 100%;
        display: block;
        object-fit: cover;
    }
    .pai-spotlight__caption {
        font-size: var(--fs-base);
        color: var(--color-muted);
        text-align: center;
        line-height: 1.7;
    }

    /* ══════════════════════════════════════════════════
       SECTION 4 — Testimonials / Power Features
    ══════════════════════════════════════════════════ */
    .pai-testimonials {
        padding: var(--sp-16) 0;
        background: var(--color-white);
        border-top: 1px solid var(--color-border);
    }
    .pai-testimonials__grid {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: var(--sp-5);
        max-width: 1400px;
        margin-inline: auto;
        padding-inline: var(--sp-6);
        margin-bottom: var(--sp-12);
    }
    .pai-testimonial-card {
        border: 1px solid var(--color-border);
        padding: var(--sp-6);
        background: var(--color-white);
        position: relative;
        transition: box-shadow var(--transition);
    }
    .pai-testimonial-card:hover { box-shadow: var(--shadow-md); }
    .pai-testimonial-card::before {
        content: '\201C';
        position: absolute;
        top: var(--sp-4);
        right: var(--sp-5);
        font-size: 4rem;
        color: var(--color-border);
        font-family: Georgia, serif;
        line-height: 1;
    }
    .pai-testimonial-card__img {
        width: 52px;
        height: 52px;
        border-radius: 50%;
        object-fit: cover;
        filter: grayscale(100%) brightness(0.85);
        margin-bottom: var(--sp-4);
        border: 2px solid var(--color-border);
    }
    .pai-testimonial-card__name {
        font-family: var(--font-heading);
        font-size: var(--fs-base);
        font-weight: 800;
        text-transform: uppercase;
        color: var(--color-dark);
        line-height: 1.1;
        margin-bottom: var(--sp-1);
    }
    .pai-testimonial-card__designation {
        font-size: var(--fs-xs);
        color: var(--color-primary);
        font-family: var(--font-label);
        font-weight: 600;
        letter-spacing: 0.08em;
        text-transform: uppercase;
        margin-bottom: var(--sp-4);
        display: block;
    }
    .pai-testimonial-card__text {
        font-size: var(--fs-sm);
        color: var(--color-text);
        line-height: 1.65;
    }

    /* CTA Box */
    .pai-cta-box {
        max-width: 860px;
        margin-inline: auto;
        padding-inline: var(--sp-6);
        background: var(--color-dark);
        color: var(--color-white);
        padding: var(--sp-12) var(--sp-10);
        text-align: center;
        position: relative;
        overflow: hidden;
    }
    .pai-cta-box::before {
        content: '';
        position: absolute;
        inset: 0;
        background: repeating-linear-gradient(
            45deg,
            transparent,
            transparent 24px,
            rgba(255,255,255,0.03) 24px,
            rgba(255,255,255,0.03) 25px
        );
        pointer-events: none;
    }
    .pai-cta-box__title {
        font-family: var(--font-heading);
        font-size: clamp(1.6rem, 4vw, 2.4rem);
        font-weight: 900;
        text-transform: uppercase;
        color: var(--color-white);
        line-height: 1.05;
        margin-bottom: var(--sp-4);
        position: relative;
    }
    .pai-cta-box__text {
        font-size: var(--fs-base);
        color: rgba(255,255,255,0.65);
        line-height: 1.7;
        margin-bottom: var(--sp-8);
        max-width: 560px;
        margin-inline: auto;
        position: relative;
    }
    .pai-cta-box__text strong { color: var(--color-white); }
    .pai-cta-box__btn {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        padding: var(--sp-4) var(--sp-10);
        background: var(--color-primary);
        color: var(--color-white);
        font-family: var(--font-label);
        font-size: var(--fs-xs);
        font-weight: 700;
        letter-spacing: 0.14em;
        text-transform: uppercase;
        border: 2px solid var(--color-primary);
        border-radius: var(--radius-sm);
        cursor: pointer;
        position: relative;
        transition: background var(--transition), transform var(--transition);
    }
    .pai-cta-box__btn:hover {
        background: var(--color-primary-dark);
        border-color: var(--color-primary-dark);
        transform: translateY(-2px);
    }

    /* ══════════════════════════════════════════════════
       NEWS LAYOUT SECTION (design version)
    ══════════════════════════════════════════════════ */
    .pai-news-wrap {
        padding-top: var(--sp-16);
        border-top: 1px solid var(--color-border);
    }

    /* ══════════════════════════════════════════════════
       RESPONSIVE
    ══════════════════════════════════════════════════ */
    @media (max-width: 1024px) {
        .pai-features__grid { grid-template-columns: repeat(3, 1fr); }
        .pai-testimonials__grid { grid-template-columns: 1fr 1fr; }
    }
    @media (max-width: 768px) {
        .pai-features__grid {
            grid-template-columns: 1fr;
            border-top: none;
        }
        .pai-feature-card {
            border-right: none;
            border-bottom: 1px solid var(--color-border);
        }
        .pai-feature-card:last-child { border-bottom: none; }
        .pai-testimonials__grid { grid-template-columns: 1fr; }
        .pai-hero { padding: var(--sp-10) var(--sp-4) var(--sp-8); }
        .pai-cta-box { padding: var(--sp-8) var(--sp-5); }
    }
    @media (max-width: 480px) {
        .pai-preview__tabs { gap: var(--sp-1); }
        .pai-preview__tab { font-size: 0.6rem; padding: var(--sp-1) var(--sp-3); }
    }
</style>
<div class="news-layout">

    <!-- ── LEFT SIDEBAR ── -->
    <aside class="sidebar-left" aria-label="Latest News">
      <h2 class="sidebar__section-title">Latest News</h2>

      <!-- Article 1 -->
      <article class="sidebar-article">
        <img
          src="https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?w=400&q=70"
          alt="Skill Gap 2026"
          class="sidebar-article__image"
          loading="lazy"
        />
        <div class="sidebar-article__category">AI Transformation</div>
        <h3 class="sidebar-article__title">The Skill Gap 2026: Why Soft Skills Are Gaining Value</h3>
        <p class="sidebar-article__excerpt">In an automated world, emotional intelligence becomes a hard currency.</p>
        <div class="sidebar-article__date">February 1, 2026</div>
      </article>

      <!-- Article 2 -->
      <article class="sidebar-article">
        <img
          src="https://images.unsplash.com/photo-1554224155-6726b3ff858f?w=400&q=70"
          alt="BAföG Reform"
          class="sidebar-article__image"
          loading="lazy"
        />
        <div class="sidebar-article__category">Finance</div>
        <h3 class="sidebar-article__title">BAföG Reform: Higher Rates for Rent and Living Expenses</h3>
        <p class="sidebar-article__excerpt">Everything students need to know about the new flat-rate fees.</p>
        <div class="sidebar-article__date">January 31, 2026</div>
      </article>

      <!-- Article 3 -->
      <article class="sidebar-article">
        <img
          src="https://images.unsplash.com/photo-1550751827-4bd374c3f58b?w=400&q=70"
          alt="Cybersecurity"
          class="sidebar-article__image"
          loading="lazy"
        />
        <div class="sidebar-article__category">Tech</div>
        <h3 class="sidebar-article__title">Top 5 Cybersecurity Skills Every Student Should Know</h3>
        <p class="sidebar-article__excerpt">Stay ahead of threats in a connected world.</p>
        <div class="sidebar-article__date">January 29, 2026</div>
      </article>
    </aside>

    <!-- ── CENTER: MAIN ARTICLE ── -->
    <section class="main-article" aria-label="Featured Article">

      <!-- Hero Image with label -->
      <div class="main-article__image-wrapper">
        <img
          src="https://images.unsplash.com/photo-1523240795612-9a054b0db644?w=900&q=80"
          alt="Students in a classroom"
          class="main-article__hero-image"
          loading="eager"
        />
        <div class="main-article__image-tag">
          <span class="label-tag">Campus Insight</span>
        </div>
      </div>

      <!-- Article content -->
      <h1 class="main-article__title">The AI Elite: How Students Are Shaping Tomorrow's Economy Today</h1>
      <p class="main-article__excerpt">
        Technological change is accelerating. ProAISkill analyzes which strategies graduates must now apply not only to keep up, but also to actively lead the transformation.
      </p>

      <div class="main-article__meta">
        <span>February 1, 2026</span>
        <span class="separator">•</span>
        <span>8-Minute Read</span>
        <a href="#" class="read-more-link" style="color: var(--color-primary); font-weight:700; margin-left: auto;">
          Read More &rsaquo;
        </a>
      </div>
    </section>

    <!-- ── RIGHT SIDEBAR ── -->
    <aside class="sidebar-right" aria-label="Promotions and Most Read">

      <!-- Promo Box -->
      <div class="promo-box">
        <h2 class="promo-box__title">Upgrade Your Future</h2>
        <p class="promo-box__subtitle">Gain exclusive industry insights and 1-to-1 mentoring.</p>
        <a href="#" class="btn btn-outline-white">Join Now</a>
      </div>

      <!-- Most Read -->
      <div class="most-read">
        <h3 class="most-read__title">Most Read</h3>

        <div class="most-read__item">
          <div class="most-read__item-number">0 1</div>
          <div class="most-read__item-info">
            <div class="most-read__item-category">Finance</div>
            <div class="most-read__item-title">Money-Saving Hacks for Students: €450 More Per Year</div>
          </div>
          <img
            src="https://images.unsplash.com/photo-1554224154-26032ffc0d07?w=120&q=60"
            alt="Finance"
            class="most-read__item-image"
            loading="lazy"
          />
        </div>

        <div class="most-read__item">
          <div class="most-read__item-number">0 2</div>
          <div class="most-read__item-info">
            <div class="most-read__item-category">AI-Tech</div>
            <div class="most-read__item-title">Gemini vs. ChatGPT: Which Tool for Which Task?</div>
          </div>
          <img
            src="https://images.unsplash.com/photo-1677442135703-1787eea5ce01?w=120&q=60"
            alt="AI Tech"
            class="most-read__item-image"
            loading="lazy"
          />
        </div>

        <div class="most-read__item">
          <div class="most-read__item-number">0 3</div>
          <div class="most-read__item-info">
            <div class="most-read__item-category">Career</div>
            <div class="most-read__item-title">The 5 Highest-Paid Student Jobs in 2026</div>
          </div>
          <img
            src="https://images.unsplash.com/photo-1486312338219-ce68d2c6f44d?w=120&q=60"
            alt="Career"
            class="most-read__item-image"
            loading="lazy"
          />
        </div>

        <div class="most-read__item">
          <div class="most-read__item-number">0 4</div>
          <div class="most-read__item-info">
            <div class="most-read__item-category">Lifestyle</div>
            <div class="most-read__item-title">Study Spaces Ranked: Where Students Are Most Productive</div>
          </div>
          <img
            src="https://images.unsplash.com/photo-1519389950473-47ba0277781c?w=120&q=60"
            alt="Lifestyle"
            class="most-read__item-image"
            loading="lazy"
          />
        </div>
      </div>

    </aside>
  </div><!-- /.news-layout -->
{{-- ══════════════════════════════════════════════════
     HERO SECTION
══════════════════════════════════════════════════ --}}
<section class="pai-hero">
    <span class="pai-hero__eyebrow">KI-gestütztes Lernen &amp; Karriere</span>
    <h1 class="pai-hero__title">Dein smarter KI-Coach<br>für Studium &amp; Karriere</h1>
    <p class="pai-hero__subtitle">Lernen, wachsen, durchstarten – mit nur einer App, die dich versteht und unterstützt.</p>

    <div class="pai-hero__cta-row">
        <a href="{{ url('account/login') }}" class="pai-hero__btn-primary">
            Kostenlos starten <i class="fa-solid fa-arrow-right"></i>
        </a>
        <a href="#funktionenSection" class="pai-hero__btn-outline">
            <i class="fa-brands fa-react"></i> Funktionen entdecken
        </a>
    </div>

    {{-- Media (video or image) from $data->mainbanner --}}
    @php
        $ext = strtolower(pathinfo($data->mainbanner, PATHINFO_EXTENSION));
    @endphp

    <div class="pai-hero__media">
        <video autoplay loop playsinline muted
            style="{{ in_array($ext, ['mp4', 'webm', 'ogg']) ? 'display:block;' : 'display:none;' }}">
            <source src="{{ asset($data->mainbanner) }}" type="video/mp4">
            Your browser does not support the video tag.
        </video>
        <img src="{{ asset($data->mainbanner) }}"
             class="pai-hero__img"
             alt="Banner"
             style="{{ in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif']) ? 'display:block;' : 'display:none;' }}">
    </div>
</section>

{{-- ══════════════════════════════════════════════════
     SECTION 1 — Was ProAISkill dir schenkt (firstsection)
══════════════════════════════════════════════════ --}}
<section class="pai-features section-change">
    <div class="pai-section-header">
        <span class="pai-section-header__label">Deine Vorteile</span>
        <h2 class="pai-section-header__title">{{ $data->firstsection_title }}</h2>
    </div>

    <div class="pai-features__grid">
        {{-- Card 1 --}}
        <div class="pai-feature-card">
            <div class="pai-feature-card__icon">
                <i class="fa-solid fa-brain"></i>
            </div>
            <h5 class="pai-feature-card__title">{{ $data->firstsection_box1_title }}</h5>
            <p class="pai-feature-card__desc">{!! $data->firstsection_box1_description !!}</p>
            <img src="{{ asset($data->firstsection_box1_image) }}"
                 alt="{{ $data->firstsection_box1_title }}"
                 class="pai-feature-card__image">
        </div>

        {{-- Card 2 --}}
        <div class="pai-feature-card">
            <div class="pai-feature-card__icon">
                <i class="fa-regular fa-message"></i>
            </div>
            <h5 class="pai-feature-card__title">{{ $data->firstsection_box2_title }}</h5>
            <p class="pai-feature-card__desc">{!! $data->firstsection_box2_description !!}</p>
            <img src="{{ asset($data->firstsection_box2_image) }}"
                 alt="{{ $data->firstsection_box2_title }}"
                 class="pai-feature-card__image">
        </div>

        {{-- Card 3 --}}
        <div class="pai-feature-card">
            <div class="pai-feature-card__icon">
                <i class="fa-solid fa-piggy-bank"></i>
            </div>
            <h5 class="pai-feature-card__title">{{ $data->firstsection_box3_title }}</h5>
            <p class="pai-feature-card__desc">{!! $data->firstsection_box3_description !!}</p>
            <img src="{{ asset($data->firstsection_box3_image) }}"
                 alt="{{ $data->firstsection_box3_title }}"
                 class="pai-feature-card__image">
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════
     SECTION 2 — App Preview (secondsection) #funktionenSection
══════════════════════════════════════════════════ --}}
<section id="funktionenSection" class="pai-preview sectionchange-3">
    <div class="pai-section-header">
        <span class="pai-section-header__label">App Vorschau</span>
        <h2 class="pai-section-header__title">{{ $data->secondsection_title }}</h2>
    </div>

    <div class="pai-preview__inner">
        <p class="pai-preview__desc">{!! $data->secondsection_box1_description !!}</p>

        <div class="pai-preview__tabs">
            <button class="pai-preview__tab active">
                <i class="fa-brands fa-react"></i> {{ $data->secondsection_box1_title }}
            </button>
            <button class="pai-preview__tab">
                <i class="fa-brands fa-react"></i> {{ $data->secondsection_box2_title }}
            </button>
            <button class="pai-preview__tab">
                <i class="fa-brands fa-react"></i> {{ $data->secondsection_box3_title }}
            </button>
            <button class="pai-preview__tab">
                <i class="fa-brands fa-react"></i> {{ $data->thirdsection_title }}
            </button>
        </div>

        <div class="pai-preview__frame">
            <img src="{{ asset($data->secondsection_box1_image) }}"
                 alt="{{ $data->secondsection_box1_title }}">
        </div>
    </div>
</section>

{{-- ══════════════════════════════════════════════════
     SECTION 3 — Spotlight / thirdsection
══════════════════════════════════════════════════ --}}
<section class="pai-spotlight section-5">
    <div class="pai-section-header">
        <span class="pai-section-header__label">Im Fokus</span>
        <h2 class="pai-section-header__title">{{ $data->thirdsection_box1_title }}</h2>
    </div>

    <div class="pai-spotlight__inner">
        <div class="pai-spotlight__frame">
            <img src="{{ asset($data->thirdsection_box1_image) }}"
                 alt="{{ $data->thirdsection_box1_title }}">
        </div>
        <p class="pai-spotlight__caption">{!! $data->thirdsection_box1_description !!}</p>
    </div>
</section>

{{-- ══════════════════════════════════════════════════
     SECTION 4 — Power Features / Testimonials (section-4)
══════════════════════════════════════════════════ --}}
<section class="pai-testimonials section-4">
    <div class="pai-section-header">
        <span class="pai-section-header__label">Community &amp; Funktionen</span>
        <h2 class="pai-section-header__title">Entdecke die Power-Funktionen, die dich lieben werden</h2>
    </div>

    <div class="pai-testimonials__grid">
        @for ($i = 1; $i <= 3; $i++)
            @php
                $image       = get_setting('header_logo' . $i);
                $title       = get_setting('testimonial' . $i . '_title');
                $designation = get_setting('testimonial' . $i . '_designation');
                $description = get_setting('testimonial' . $i . '_description');
            @endphp

            @if ($title || $description)
                <div class="pai-testimonial-card">
                    <img src="{{ $image ? asset('website/websitedata/' . $image) : 'https://via.placeholder.com/100' }}"
                         alt="{{ $title }}"
                         class="pai-testimonial-card__img">
                    <div class="pai-testimonial-card__name">{{ $title }}</div>
                    <span class="pai-testimonial-card__designation">{{ $designation }}</span>
                    <p class="pai-testimonial-card__text">{{ $description }}</p>
                </div>
            @endif
        @endfor
    </div>

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
            <h2 class="marketplace-hero__title">Save Money During Your Studies, Invest in Your Skills.</h2>
            <p class="marketplace-hero__text">
              We have negotiated with over 100 partners to secure exclusive deals for hardware, software and lifestyle.
            </p>
            <a href="#" class="btn btn-primary">Discover All Deals</a>
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
    <div class="pai-cta-box">
        <h4 class="pai-cta-box__title">Bereit, dein Studium neu zu erleben?</h4>
        <p class="pai-cta-box__text">
            Registriere dich kostenlos – und sichere dir <strong>12 Monate Zugriff</strong> auf Premium-Tools,
            die dein Leben einfacher und erfolgreicher machen!
        </p>
        <button class="pai-cta-box__btn">Jetzt kostenlos durchstarten &amp; lieben lernen!</button>
    </div>
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