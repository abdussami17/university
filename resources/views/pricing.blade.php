@extends('layout.app')

@section('title', 'Premium')

@section('content')


     
<style>
    /* ─── CSS Variables ──────────────────────────────────────────────── */
    :root {
      --proaiskill-primary-blue:   #3b5bdb;
      --proaiskill-light-blue:     #748ffc;
      --proaiskill-dark-text:      #1a1a2e;
      --proaiskill-body-text:      #444455;
      --proaiskill-muted-text:     #888899;
      --proaiskill-icon-soft:      #a5b4fc;
      --proaiskill-bg-white:       #ffffff;
      --proaiskill-bg-light:       #f5f6fa;
      --proaiskill-border-color:   #e2e4ef;
      --proaiskill-green-check:    #34d399;
      --proaiskill-red-cross:      #f87171;
      --proaiskill-stat-blue:      #3b5bdb;
      --proaiskill-font-heading:   'Lexend';
      --proaiskill-font-body:      'Inter';
      --proaiskill-radius-card:    14px;
      --proaiskill-shadow-soft:    0 4px 24px rgba(59,91,219,.08);
      --proaiskill-shadow-btn:     0 6px 22px rgba(59,91,219,.35);
      --proaiskill-transition:     0.22s ease;
    }
 
    /* ─── Reset & Base ───────────────────────────────────────────────── */
    *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }
 
    html { scroll-behavior: smooth; }
 
    body {
      font-family: var(--proaiskill-font-body);
      background: var(--proaiskill-bg-white);
      color: var(--proaiskill-dark-text);
      -webkit-font-smoothing: antialiased;
    }
 
    img { max-width: 100%; display: block; }
    a  { text-decoration: none; color: inherit; }
 
    /* ─── Utility ────────────────────────────────────────────────────── */
    .proaiskill-section-wrapper {
      width: 100%;
      max-width: 860px;
      margin-inline: auto;
      padding-inline: 20px;
    }
 
    .proaiskill-text-center { text-align: center; }
 
    /* ─── Hero / Stats Section ───────────────────────────────────────── */
    .proaiskill-hero-section {
      background: var(--proaiskill-bg-white);
      padding: 72px 20px 56px;
      text-align: center;
    }
 
    .proaiskill-hero-eyebrow {
      font-family: var(--proaiskill-font-body);
      font-size: 13px;
      font-weight: 600;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--proaiskill-muted-text);
      margin-bottom: 12px;
    }
 
    .proaiskill-hero-headline {
      font-family: var(--proaiskill-font-heading);
      font-size: clamp(32px, 6vw, 52px);
      font-weight: 700;
      letter-spacing: -0.01em;
      line-height: 1.1;
      color: var(--proaiskill-dark-text);
      text-transform: uppercase;
      margin-bottom: 18px;
    }
 
    .proaiskill-hero-subtext {
      font-size: 15px;
      color: var(--proaiskill-body-text);
      max-width: 520px;
      margin-inline: auto;
      line-height: 1.65;
    }
 
    /* ─── Stats Row ──────────────────────────────────────────────────── */
    .proaiskill-stats-row {
      display: flex;
      justify-content: center;
      gap: 0;
      margin-top: 52px;
      flex-wrap: wrap;
      border-top: 1px solid var(--proaiskill-border-color);
      border-bottom: 1px solid var(--proaiskill-border-color);
    }
 
    .proaiskill-stat-item {
      flex: 1 1 200px;
      padding: 36px 24px;
      text-align: center;
      position: relative;
    }
 
    .proaiskill-stat-item + .proaiskill-stat-item::before {
      content: '';
      position: absolute;
      left: 0; top: 20%; bottom: 20%;
      width: 1px;
      background: var(--proaiskill-border-color);
    }
 
    .proaiskill-stat-number {
      font-family: var(--proaiskill-font-heading);
      font-size: clamp(36px, 6vw, 56px);
      font-weight: 700;
      color: var(--proaiskill-stat-blue);
      line-height: 1;
      margin-bottom: 10px;
    }
 
    .proaiskill-stat-label {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--proaiskill-body-text);
      line-height: 1.5;
    }
 
    /* ─── Comparison Table Section ───────────────────────────────────── */
    .proaiskill-table-section {
      background: var(--proaiskill-bg-white);
      padding: 72px 20px 64px;
    }
 
    .proaiskill-section-title {
      font-family: var(--proaiskill-font-heading);
      font-size: clamp(22px, 4vw, 30px);
      font-weight: 700;
      text-transform: uppercase;
      letter-spacing: 0.04em;
      text-align: center;
      color: var(--proaiskill-dark-text);
      margin-bottom: 40px;
    }
 
    .proaiskill-comparison-table-container {
      overflow-x: auto;
      border-radius: var(--proaiskill-radius-card);
      border: 1px solid var(--proaiskill-border-color);
      box-shadow: var(--proaiskill-shadow-soft);
    }
 
    .proaiskill-comparison-table {
      width: 100%;
      border-collapse: collapse;
      min-width: 520px;
      background: var(--proaiskill-bg-white);
    }
 
    /* Table header row */
    .proaiskill-table-header-row th {
      padding: 16px 24px;
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.12em;
      text-transform: uppercase;
      color: var(--proaiskill-muted-text);
      background: var(--proaiskill-bg-light);
      border-bottom: 1px solid var(--proaiskill-border-color);
      text-align: left;
    }
 
    .proaiskill-table-header-row th:not(:first-child) {
      text-align: center;
      min-width: 160px;
    }
 
    .proaiskill-table-col-premium {
      color: var(--proaiskill-primary-blue) !important;
    }
 
    /* Table body rows */
    .proaiskill-comparison-table tbody tr {
      border-bottom: 1px solid var(--proaiskill-border-color);
      transition: background var(--proaiskill-transition);
    }
 
    .proaiskill-comparison-table tbody tr:last-child {
      border-bottom: none;
    }
 
    .proaiskill-comparison-table tbody tr:hover {
      background: #f8f9ff;
    }
 
    .proaiskill-table-cell-function {
      padding: 18px 24px;
      font-size: 13.5px;
      font-weight: 500;
      color: var(--proaiskill-dark-text);
      width: 36%;
    }
 
    .proaiskill-table-cell-base,
    .proaiskill-table-cell-premium {
      padding: 18px 24px;
      font-size: 13px;
      color: var(--proaiskill-body-text);
      text-align: center;
      line-height: 1.45;
    }
 
    .proaiskill-table-cell-premium {
      color: var(--proaiskill-primary-blue);
    }
 
    .proaiskill-check-icon  { color: var(--proaiskill-green-check); display: inline-flex; }
    .proaiskill-cross-icon  { color: var(--proaiskill-red-cross);   display: inline-flex; }
 
    /* ─── Benefits Section ───────────────────────────────────────────── */
    .proaiskill-benefits-section {
      background: var(--proaiskill-bg-white);
      padding: 72px 20px 64px;
      text-align: center;
    }
 
    .proaiskill-benefits-subtitle {
      font-size: 12px;
      font-weight: 600;
      letter-spacing: 0.14em;
      text-transform: uppercase;
      color: var(--proaiskill-muted-text);
      margin-top: 8px;
      margin-bottom: 52px;
    }
 
    .proaiskill-benefits-grid {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 40px 32px;
      max-width: 820px;
      margin-inline: auto;
    }
 
    .proaiskill-benefit-card {
      display: flex;
      flex-direction: column;
      align-items: center;
      text-align: center;
      gap: 14px;
    }
 
    .proaiskill-benefit-icon-wrapper {
      width: 54px;
      height: 54px;
      border-radius: 50%;
      background: var(--proaiskill-bg-light);
      border: 1.5px solid var(--proaiskill-border-color);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--proaiskill-primary-blue);
      flex-shrink: 0;
    }
 
    .proaiskill-benefit-title {
      font-family: var(--proaiskill-font-heading);
      font-size: 13.5px;
      font-weight: 700;
      letter-spacing: 0.06em;
      text-transform: uppercase;
      color: var(--proaiskill-dark-text);
      line-height: 1.3;
    }
 
    .proaiskill-benefit-desc {
      font-size: 13px;
      color: var(--proaiskill-body-text);
      line-height: 1.65;
      max-width: 220px;
      margin-inline: auto;
    }
 
    /* ─── CTA Section ────────────────────────────────────────────────── */
    .proaiskill-cta-section {
      padding: 60px 20px 80px;
      display: flex;
      justify-content: center;
    }
 
    .proaiskill-cta-card {
      background: var(--proaiskill-bg-white);
      border: 1.5px solid var(--proaiskill-border-color);
      border-radius: var(--proaiskill-radius-card);
      box-shadow: var(--proaiskill-shadow-soft);
      padding: 48px 40px 36px;
      text-align: center;
      max-width: 380px;
      width: 100%;
    }
 
    .proaiskill-cta-headline {
      font-family: var(--proaiskill-font-heading);
      font-size: clamp(22px, 4vw, 28px);
      font-weight: 700;
      letter-spacing: 0.04em;
      text-transform: uppercase;
      color: var(--proaiskill-dark-text);
      margin-bottom: 8px;
    }
 
    .proaiskill-cta-subtext {
      font-size: 12.5px;
      font-weight: 600;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      color: var(--proaiskill-muted-text);
      margin-bottom: 28px;
    }
 
    .proaiskill-cta-btn {
      display: inline-block;
      background: var(--proaiskill-primary-blue);
      color: #fff;
      font-family: var(--proaiskill-font-body);
      font-size: 13px;
      font-weight: 700;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 14px 32px;
      border-radius: 6px;
      border: none;
      cursor: pointer;
      box-shadow: var(--proaiskill-shadow-btn);
      transition: background var(--proaiskill-transition), transform var(--proaiskill-transition), box-shadow var(--proaiskill-transition);
      width: 100%;
    }
 
    .proaiskill-cta-btn:hover {
      background: #2f4cc0;
      transform: translateY(-2px);
      box-shadow: 0 10px 28px rgba(59,91,219,.42);
    }
 
    .proaiskill-cta-btn:active {
      transform: translateY(0);
      box-shadow: var(--proaiskill-shadow-btn);
    }
 
    .proaiskill-cta-disclaimer {
      font-size: 11px;
      color: var(--proaiskill-muted-text);
      margin-top: 14px;
      font-style: italic;
    }
 
    /* ─── Responsive ─────────────────────────────────────────────────── */
    @media (max-width: 720px) {
      .proaiskill-benefits-grid {
        grid-template-columns: repeat(2, 1fr);
        gap: 32px 20px;
      }
    }
 
    @media (max-width: 480px) {
      .proaiskill-benefits-grid {
        grid-template-columns: 1fr;
      }
 
      .proaiskill-stats-row {
        flex-direction: column;
      }
 
      .proaiskill-stat-item + .proaiskill-stat-item::before {
        display: none;
      }
 
      .proaiskill-stat-item {
        border-bottom: 1px solid var(--proaiskill-border-color);
        padding: 28px 20px;
      }
 
      .proaiskill-stat-item:last-child {
        border-bottom: none;
      }
 
      .proaiskill-cta-card {
        padding: 36px 24px 28px;
      }
    }
 
    @media (max-width: 380px) {
      .proaiskill-hero-section {
        padding: 52px 16px 40px;
      }
 
      .proaiskill-table-section,
      .proaiskill-benefits-section {
        padding-inline: 12px;
      }
    }
  </style>
 
  <!-- ═══════════════════════════════════════════════════════
       HERO / STATS SECTION
  ═══════════════════════════════════════════════════════ -->
  <section class="proaiskill-hero-section">
    <div class="proaiskill-section-wrapper">
      <p class="proaiskill-hero-eyebrow">ProAISkill Premium</p>
      <h1 class="proaiskill-hero-headline">Upgrade for Your Future</h1>
      <p class="proaiskill-hero-subtext">
        Invest in your career. Unlock the full potential of the ProAISkill platform and be
        among the top 10% of graduates.
      </p>
 
      <!-- Stats Row -->
      <div class="proaiskill-stats-row">
 
        <div class="proaiskill-stat-item">
          <div class="proaiskill-stat-number">450€+</div>
          <div class="proaiskill-stat-label">Annual savings through<br>exclusive deals</div>
        </div>
 
        <div class="proaiskill-stat-item">
          <div class="proaiskill-stat-number">82%</div>
          <div class="proaiskill-stat-label">Our premium members find a job<br>within 3 months.</div>
        </div>
 
        <div class="proaiskill-stat-item">
          <div class="proaiskill-stat-number">4 hours</div>
          <div class="proaiskill-stat-label">Average time savings per week<br>through AI automation</div>
        </div>
 
      </div>
    </div>
  </section>
 
  <!-- ═══════════════════════════════════════════════════════
       BASIC VS. PREMIUM TABLE
  ═══════════════════════════════════════════════════════ -->
  <section class="proaiskill-table-section">
    <div class="proaiskill-section-wrapper">
      <h2 class="proaiskill-section-title">Basic vs. Premium</h2>
 
      <div class="proaiskill-comparison-table-container">
        <table class="proaiskill-comparison-table" role="table" aria-label="Basic vs Premium comparison">
 
          <!-- Header -->
          <thead>
            <tr class="proaiskill-table-header-row">
              <th scope="col">Function</th>
              <th scope="col">Base</th>
              <th scope="col" class="proaiskill-table-col-premium">Premium</th>
            </tr>
          </thead>
 
          <!-- Body -->
          <tbody>
 
            <tr>
              <td class="proaiskill-table-cell-function">AI Skill Coach</td>
              <td class="proaiskill-table-cell-base">Basic analysis</td>
              <td class="proaiskill-table-cell-premium">Personalized learning path &amp; career suggestions</td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Document AI</td>
              <td class="proaiskill-table-cell-base">3 analyses per month</td>
              <td class="proaiskill-table-cell-premium">Unlimited analysis &amp; creation</td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Exclusive Deals</td>
              <td class="proaiskill-table-cell-base">Access to public deals</td>
              <td class="proaiskill-table-cell-premium">Access to all 100+ partner deals</td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Financial planner</td>
              <td class="proaiskill-table-cell-base">Basic budget tracking</td>
              <td class="proaiskill-table-cell-premium">Advanced analyses &amp; money-saving tips</td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Career Services</td>
              <td class="proaiskill-table-cell-base">Community tips</td>
              <td class="proaiskill-table-cell-premium">Exclusive workshops &amp; coaching</td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Community access</td>
              <td class="proaiskill-table-cell-base">
                <span class="proaiskill-check-icon" aria-label="Included">
                  <i data-lucide="check" style="width:18px;height:18px;stroke-width:2.5"></i>
                </span>
              </td>
              <td class="proaiskill-table-cell-premium">
                <span class="proaiskill-check-icon" aria-label="Included">
                  <i data-lucide="check" style="width:18px;height:18px;stroke-width:2.5"></i>
                </span>
              </td>
            </tr>
 
            <tr>
              <td class="proaiskill-table-cell-function">Premium Support</td>
              <td class="proaiskill-table-cell-base">
                <span class="proaiskill-cross-icon" aria-label="Not included">
                  <i data-lucide="x" style="width:18px;height:18px;stroke-width:2.5"></i>
                </span>
              </td>
              <td class="proaiskill-table-cell-premium">
                <span class="proaiskill-check-icon" aria-label="Included">
                  <i data-lucide="check" style="width:18px;height:18px;stroke-width:2.5"></i>
                </span>
              </td>
            </tr>
 
          </tbody>
        </table>
      </div>
    </div>
  </section>
 
  <!-- ═══════════════════════════════════════════════════════
       YOUR BENEFITS SECTION
  ═══════════════════════════════════════════════════════ -->
  <section class="proaiskill-benefits-section">
    <div class="proaiskill-section-wrapper">
      <h2 class="proaiskill-section-title">Your Benefits</h2>
      <p class="proaiskill-benefits-subtitle">Maximum support for your studies.</p>
 
      <div class="proaiskill-benefits-grid">
 
        <!-- Card 1: Student Current Accounts -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="landmark" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Student Current<br>Accounts</div>
          <p class="proaiskill-benefit-desc">
            Benefit from free accounts with exclusive starting credits and
            advantages at our partner banks.
          </p>
        </div>
 
        <!-- Card 2: Insurance at Bargain Prices -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="shield-check" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Insurance at Bargain<br>Prices</div>
          <p class="proaiskill-benefit-desc">
            Whether it's liability, international or disability insurance – we have the best
            rates for you.
          </p>
        </div>
 
        <!-- Card 3: Career Services -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="briefcase" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Career Services</div>
          <p class="proaiskill-benefit-desc">
            Gain access to exclusive workshops, personal career coaching, and direct
            contact with top employers.
          </p>
        </div>
 
        <!-- Card 4: Student Financing & Loans -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="graduation-cap" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Student Financing<br>&amp; Loans</div>
          <p class="proaiskill-benefit-desc">
            Find fair and transparent financing options for your studies, from KfW loans
            to education funds.
          </p>
        </div>
 
        <!-- Card 5: Premium Software Deals -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="code-2" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Premium Software<br>Deals</div>
          <p class="proaiskill-benefit-desc">
            Even higher discounts on professional software for your field, from CAD to
            statistical tools.
          </p>
        </div>
 
        <!-- Card 6: Exclusive Events & Webinars -->
        <div class="proaiskill-benefit-card">
          <div class="proaiskill-benefit-icon-wrapper" aria-hidden="true">
            <i data-lucide="star" style="width:22px;height:22px;stroke-width:1.8"></i>
          </div>
          <div class="proaiskill-benefit-title">Exclusive Events<br>&amp; Webinars</div>
          <p class="proaiskill-benefit-desc">
            Participate in closed webinars with industry experts and networking events.
          </p>
        </div>
 
      </div>
    </div>
  </section>
 
  <!-- ═══════════════════════════════════════════════════════
       CTA SECTION
  ═══════════════════════════════════════════════════════ -->
  <section class="proaiskill-cta-section">
    <div class="proaiskill-cta-card">
      <h2 class="proaiskill-cta-headline">Ready?</h2>
      <p class="proaiskill-cta-subtext">Start your career today.</p>
      <button
        class="proaiskill-cta-btn"
        type="button"
        onclick="window.location='{{ route('account.dashboard') }}'"
      >
        Become Premium Now
      </button>
      <p class="proaiskill-cta-disclaimer">*This is a simulation. No actual payment will be processed.</p>
    </div>
  </section>
@endsection

@section('home_style')
    <link rel="stylesheet" href="{{ asset('new_asset/style/style.css') }}">

@endsection