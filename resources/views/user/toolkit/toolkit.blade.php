@extends('user.layout')
@section('title', trans('general.AI_Features'))

  <style>
    /* ─────────────────────────────────────────
       CSS Custom Properties
    ───────────────────────────────────────── */
    :root {
      --toolkit-font-primary: 'Lexend', sans-serif;
      --toolkit-font-secondary: 'Inter', sans-serif;
 
      --toolkit-color-page-background: #f4f5f7;
      --toolkit-color-surface-white: #ffffff;
      --toolkit-color-border-default: #e2e4e9;
      --toolkit-color-border-card-hover: #c5c8d6;
 
      --toolkit-color-accent-purple-soft: #7b6fee;
      --toolkit-color-accent-purple-medium: #6c63e0;
      --toolkit-color-accent-purple-button: #8b83ee;
      --toolkit-color-accent-purple-button-hover: #7b72e0;
 
      --toolkit-color-banner-background: #eeedf8;
      --toolkit-color-banner-border: #d4d1f0;
      --toolkit-color-banner-icon: #7b6fee;
      --toolkit-color-banner-text: #4a4770;
 
      --toolkit-color-icon-foreground: #7b6fee;
      --toolkit-color-icon-background: #eeedf8;
 
      --toolkit-color-heading-dark: #1a1a2e;
      --toolkit-color-text-muted: #6b7280;
      --toolkit-color-text-card-title: #1f1f3a;
      --toolkit-color-text-card-desc: #6b7280;
 
      --toolkit-radius-card: 12px;
      --toolkit-radius-button: 8px;
      --toolkit-radius-banner: 8px;
      --toolkit-radius-icon-wrap: 8px;
 
      --toolkit-shadow-card: 0 1px 3px rgba(0,0,0,0.06), 0 1px 2px rgba(0,0,0,0.04);
      --toolkit-shadow-card-hover: 0 4px 12px rgba(123,111,238,0.12), 0 2px 4px rgba(0,0,0,0.06);
 
      --toolkit-transition-card: all 0.22s ease;
      --toolkit-transition-button: background-color 0.18s ease, transform 0.12s ease;
    }
 
    /* ─────────────────────────────────────────
       Base Reset & Body
    ───────────────────────────────────────── */
    *,
    *::before,
    *::after {
      box-sizing: border-box;
    }
 
    body {
      font-family: var(--toolkit-font-secondary);
      background-color: var(--toolkit-color-page-background);
      color: var(--toolkit-color-heading-dark);
      margin: 0;
      padding: 0;
      min-height: 100vh;
    }
 
    /* ─────────────────────────────────────────
       Top Preview Banner
    ───────────────────────────────────────── */
    .toolkit-preview-banner-wrapper {
      width: 100%;
      background-color: var(--toolkit-color-surface-white);
      border-bottom: 1px solid var(--toolkit-color-border-default);
    }
 
    .toolkit-preview-banner-inner {
      max-width: 1200px;
      margin: 0 auto;
      padding: 14px 24px;
      display: flex;
      align-items: flex-start;
      gap: 12px;
    }
 
    .toolkit-preview-banner-icon-circle {
      flex-shrink: 0;
      width: 32px;
      height: 32px;
      background-color: var(--toolkit-color-banner-background);
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--toolkit-color-banner-icon);
      margin-top: 1px;
    }
 
    .toolkit-preview-banner-icon-circle svg {
      width: 15px;
      height: 15px;
      stroke: currentColor;
      stroke-width: 2;
      fill: none;
    }
 
    .toolkit-preview-banner-text-block {
      display: flex;
      flex-direction: column;
      gap: 2px;
    }
 
    .toolkit-preview-banner-label {
      font-family: var(--toolkit-font-secondary);
      font-size: 11px;
      font-weight: 700;
      letter-spacing: 0.08em;
      text-transform: uppercase;
      color: var(--toolkit-color-banner-text);
    }
 
    .toolkit-preview-banner-description {
      font-family: var(--toolkit-font-secondary);
      font-size: 13.5px;
      font-weight: 400;
      color: var(--toolkit-color-text-muted);
      line-height: 1.5;
      margin: 0;
    }
 
    /* ─────────────────────────────────────────
       Main Page Wrapper
    ───────────────────────────────────────── */
    .toolkit-page-main-wrapper {
      max-width: 1200px;
      margin: 0 auto;
      padding: 40px 24px 60px;
    }
 
    /* ─────────────────────────────────────────
       Page Header Section
    ───────────────────────────────────────── */
    .toolkit-page-header-section {
      margin-bottom: 32px;
    }
 
    .toolkit-page-heading-primary {
      font-family: var(--toolkit-font-primary);
      font-size: clamp(22px, 4vw, 28px);
      font-weight: 700;
      color: var(--toolkit-color-heading-dark);
      margin: 0 0 6px 0;
      line-height: 1.25;
    }
 
    .toolkit-page-heading-subtitle {
      font-family: var(--toolkit-font-secondary);
      font-size: 14px;
      font-weight: 400;
      color: var(--toolkit-color-text-muted);
      margin: 0;
      line-height: 1.5;
    }
 
    /* ─────────────────────────────────────────
       Tools Grid Layout
    ───────────────────────────────────────── */
    .toolkit-tools-grid-container {
      display: grid;
      grid-template-columns: repeat(3, 1fr);
      gap: 20px;
    }
 
    /* ─────────────────────────────────────────
       Individual Tool Card
    ───────────────────────────────────────── */
    .toolkit-individual-tool-card {
      background-color: var(--toolkit-color-surface-white);
      border: 1px solid var(--toolkit-color-border-default);
      border-radius: var(--toolkit-radius-card);
      padding: 24px 22px 20px;
      display: flex;
      flex-direction: column;
      gap: 0;
      box-shadow: var(--toolkit-shadow-card);
      transition: var(--toolkit-transition-card);
      cursor: default;
    }
 
    .toolkit-individual-tool-card:hover {
      border-color: var(--toolkit-color-border-card-hover);
      box-shadow: var(--toolkit-shadow-card-hover);
      transform: translateY(-2px);
    }
 
    /* Card top: icon + text */
    .toolkit-card-top-content-row {
      display: flex;
      align-items: flex-start;
      gap: 14px;
      margin-bottom: 20px;
    }
 
    .toolkit-card-icon-wrapper {
      flex-shrink: 0;
      width: 36px;
      height: 36px;
      background-color: var(--toolkit-color-icon-background);
      border-radius: var(--toolkit-radius-icon-wrap);
      display: flex;
      align-items: center;
      justify-content: center;
      color: var(--toolkit-color-icon-foreground);
      margin-top: 1px;
    }
 
    .toolkit-card-icon-wrapper svg {
      width: 17px;
      height: 17px;
      stroke: currentColor;
      stroke-width: 1.8;
      fill: none;
    }
 
    .toolkit-card-text-content-block {
      flex: 1;
      min-width: 0;
    }
 
    .toolkit-card-tool-name-heading {
      font-family: var(--toolkit-font-primary);
      font-size: 15px;
      font-weight: 600;
      color: var(--toolkit-color-text-card-title);
      margin: 0 0 4px 0;
      line-height: 1.3;
    }
 
    .toolkit-card-tool-description-text {
      font-family: var(--toolkit-font-secondary);
      font-size: 13px;
      font-weight: 400;
      color: var(--toolkit-color-text-card-desc);
      margin: 0;
      line-height: 1.55;
    }
 
    /* Open Tool Button */
    .toolkit-card-open-tool-button {
      display: block;
      width: 100%;
      padding: 11px 16px;
      background-color:#554cc9;
      color: #ffffff;
      font-family: var(--toolkit-font-secondary);
      font-size: 13.5px;
      font-weight: 500;
      text-align: center;
      border: none;
      border-radius: var(--toolkit-radius-button);
      cursor: pointer;
      transition: var(--toolkit-transition-button);
      letter-spacing: 0.01em;
      text-decoration: none;
      margin-top: auto;
    }
 
    .toolkit-card-open-tool-button:hover {
      background-color: var(--toolkit-color-accent-purple-button-hover);
      transform: translateY(-1px);
      color: #ffffff;
      text-decoration: none;
    }
 
    .toolkit-card-open-tool-button:active {
      transform: translateY(0);
      background-color: var(--toolkit-color-accent-purple-medium);
    }
 
    /* ─────────────────────────────────────────
       Responsive Breakpoints
    ───────────────────────────────────────── */
 
    /* Tablet: 2 columns */
    @media (max-width: 991.98px) {
      .toolkit-tools-grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 16px;
      }
 
      .toolkit-page-main-wrapper {
        padding: 32px 20px 48px;
      }
    }
 
    /* Large mobile: still 2 cols but tighter */
    @media (max-width: 767.98px) {
      .toolkit-tools-grid-container {
        grid-template-columns: repeat(2, 1fr);
        gap: 14px;
      }
 
      .toolkit-page-main-wrapper {
        padding: 24px 16px 40px;
      }
 
      .toolkit-preview-banner-inner {
        padding: 12px 16px;
      }
 
      .toolkit-page-heading-primary {
        font-size: 22px;
      }
    }
 
    /* Small mobile: 1 column */
    @media (max-width: 575.98px) {
      .toolkit-tools-grid-container {
        grid-template-columns: 1fr;
        gap: 14px;
      }
 
      .toolkit-page-main-wrapper {
        padding: 20px 14px 36px;
      }
 
      .toolkit-card-top-content-row {
        gap: 12px;
      }
    }
  </style>
@section('content')

<!-- ───────── Banner ───────── -->
<div class="toolkit-preview-banner-wrapper">
  <div class="toolkit-preview-banner-inner">
    <div class="toolkit-preview-banner-icon-circle">
      <i data-lucide="key-round"></i>
    </div>
    <div class="toolkit-preview-banner-text-block">
      <span class="toolkit-preview-banner-label">Tool-Vorschau</span>
      <p class="toolkit-preview-banner-description">
        Dies sind unsere Kern-Tools für ein effizientes Studium. Schalte die volle Funktionalität als Mitglied frei.
      </p>
    </div>
  </div>
</div>

<!-- ───────── MAIN ───────── -->
<main class="toolkit-page-main-wrapper">

<!-- Header -->
<div class="toolkit-page-header-section">
  <h1 class="toolkit-page-heading-primary">Toolkit</h1>
  <p class="toolkit-page-heading-subtitle">
    Greife auf KI-gestützte Werkzeuge zu, um deine Produktivität und dein Lernen zu verbessern.
  </p>
</div>

<!-- Grid -->
<div class="toolkit-tools-grid-container">

<!-- 1 TIMEBOX -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="brain"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">KI Timebox-Planer</h2>
      <p class="toolkit-card-tool-description-text">
        Optimiere deinen Zeitplan mit KI-gesteuertem Timeboxing.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'timebox']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

<!-- 2 CALENDAR -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="calendar"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">Kalendersynchronisierung</h2>
      <p class="toolkit-card-tool-description-text">
        Integriere deine akademischen und persönlichen Kalender.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'calendar-sync']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

<!-- 3 IDEA -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="lightbulb"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">KI Ideengenerator</h2>
      <p class="toolkit-card-tool-description-text">
        Hol dir kreative KI-gestützte Ideen.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'idea-generator']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

<!-- 4 COUNTDOWN -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="clock"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">Prüfungs-Countdown</h2>
      <p class="toolkit-card-tool-description-text">
        Behalte wichtige Termine im Blick.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'exam-countdown']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

<!-- 5 TASK PARTY -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="gift"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">Aufgaben-Party</h2>
      <p class="toolkit-card-tool-description-text">
        Mach Aufgaben spielerisch mit Belohnungen.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'task-party']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

<!-- 6 FLASHCARD -->
<div class="toolkit-individual-tool-card">
  <div class="toolkit-card-top-content-row">
    <div class="toolkit-card-icon-wrapper">
      <i data-lucide="layers"></i>
    </div>
    <div>
      <h2 class="toolkit-card-tool-name-heading">Lernkarten-Magie</h2>
      <p class="toolkit-card-tool-description-text">
        Erstelle digitale Lernkarten effektiv.
      </p>
    </div>
  </div>
  <a href="{{ route('toolkit.tool',['tool'=>'flashcard']) }}" class="toolkit-card-open-tool-button">
    Tool öffnen
  </a>
</div>

</div>
</main>

@endsection