@extends('user.layout')
@section('title', trans('general.AI_Features'))
@section('content')
<div class="main-section">
    <div class="mb-0 d-flex justify-content-between flex-wrap align-items-center">
        <div>
            <h4 style="color: rgb(56, 59, 66);" class="mb-1">Toolkit-Zentrum</h4>
            <p class="text-muted mb-0">Greife auf KI-gestützte Werkzeuge zu, um deine Produktivität und dein Lernen zu verbessern.</p>
        </div>
        <img src="{{ asset('new_asset/images/abcd.png') }}" width="100px" height="130px" alt="not-found">
    </div>

    <img src="{{ asset('new_asset/images/abcd.png') }}" alt="" height="300px" width="220px" class="mb-5">

    <div class="row g-4">

        <!-- Card 1: Timebox Planner -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-stopwatch me-2"></span> KI Timebox-Planer
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Timebox">
                    <p class="tool-desc">Optimiere deinen Zeitplan mit KI-gesteuertem Timeboxing. Plane deine Aufgaben effektiv.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'timebox']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 2: Calendar Sync -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-calendar me-2"></span> Intelligente Kalendersynchronisierung
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Calendar">
                    <p class="tool-desc">Integriere deine akademischen und persönlichen Kalender nahtlos. Verpasse nie wieder eine Frist.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'calendar-sync']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 3: Idea Generator -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-openai me-2"></span> KI-Ideengenerator
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Idea Generator">
                    <p class="tool-desc">Steckst du bei einem Projekt fest? Hol dir kreative KI-gestützte Ideen und Gliederungen.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'idea-generator']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 4: Exam Countdown -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-calendar-date me-2"></span> Prüfungs-Countdown
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Countdown">
                    <p class="tool-desc">Behalte wichtige Prüfungstermine spielerisch im Blick und plane deine Vorbereitung.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'exam-countdown']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 5: Task Party -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-gift me-2"></span> Aufgaben-Party
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Task Party">
                    <p class="tool-desc">Mach das Erledigen von Aufgaben zu einem kleinen Fest mit spielerischen Belohnungen.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'task-party']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

        <!-- Card 6: Flashcard Magic -->
        <div class="col-md-4">
            <div class="card tool-card">
                <div class="card-body">
                    <div class="d-flex align-items-center tool-title">
                        <span class="bi bi-stack me-2"></span> Lernkarten-Magie
                    </div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="tool-img" alt="Flashcards">
                    <p class="tool-desc">Erstell digitale Lernkarten für effektives und freudvolles Lernen deiner wichtigsten Fakten.</p>
                </div>
                <div class="tool-footer">
                    <a href="{{ route('toolkit.tool', ['tool' => 'flashcard']) }}" class="stretched-link text-decoration-none">
                        Werkzeug öffnen <span class="arrow">→</span>
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

@endsection
