@extends('user.layout')
@section('title', trans('general.User_Dashboard'))
@section('content')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <style>
        #addTaskModal {
            --bs-modal-width: 1100px;
        }

        .calendar-container {
            background: #fff;
            width: 100%;
            border-radius: 10px;
            /* box-shadow: 0 15px 40px rgba(0, 0, 0, 0.12); */
        }

        .calendar-container header {
            display: flex;
            align-items: center;
            padding: 0px 0px 20px;
            justify-content: space-between;
        }

        header .calendar-navigation {
            display: flex;
        }

        header .calendar-navigation span {
            height: 38px;
            width: 38px;
            margin: 0 1px;
            cursor: pointer;
            text-align: center;
            line-height: 38px;
            border-radius: 50%;
            user-select: none;
            color: #aeabab;
            font-size: 1.9rem;
        }

        .calendar-navigation span:last-child {
            margin-right: -10px;
        }

        header .calendar-navigation span:hover {
            background: #f2f2f2;
        }

        header .calendar-current-date {
            font-weight: 500;
            font-size: 18px;
            margin-bottom: 0px
        }

        header i {
            font-size: 18px;
        }

        .calendar-body {
            /* padding: 20px; */
        }

        .calendar-body ul {
            list-style: none;
            flex-wrap: wrap;
            display: flex;
            padding: 0px;
            text-align: center;
        }

        .calendar-body .calendar-dates {
            margin-bottom: 20px;
        }

        .calendar-body li {
            width: calc(100% / 7);
            font-size: 14px;
            color: #414141;
        }

        .calendar-body .calendar-weekdays li {
            cursor: default;
            font-weight: 500;
            border: 1px solid #ccc;
        }

        .calendar-body .calendar-dates li {
            margin-top: 30px;
            position: relative;
            z-index: 1;
            border-right: 1px solid #ccc;
            cursor: pointer;
        }

        .calendar-dates li.inactive {
            color: #aaa;
        }

        .calendar-dates li.active {
            color: #fff;
        }

        .calendar-dates li::before {
            position: absolute;
            content: "";
            z-index: -1;
            top: 50%;
            left: 50%;
            width: 40px;
            height: 40px;
            border-radius: 50%;
            transform: translate(-50%, -50%);
        }

        .calendar-dates li.active::before {
            background: linear-gradient(135deg, rgb(42, 44, 176) 0%, rgb(71, 71, 222) 100%);
        }

        .calendar-dates li:not(.active):hover::before {
            background: #e4e1e1;
        }

        .add-task-btn {
            background: linear-gradient(135deg, rgb(42, 44, 176) 0%, rgb(71, 71, 222) 100%);
            /* width: 200px; */
            border: none;
            outline: none;
            /* text-align: end;     */
            margin-bottom: 10px;
        }
    </style>
    </head>

    <div class="d-flex dashboard-parent">
        <div class="content" id="dashboard-content">

  <!-- ══════════════════════════════
       MAIN
  ══════════════════════════════ -->
  <div class="sdapp-main-wrapper">
    <div class="sdapp-page-content">
 
      <!-- Page header -->
      <div class="sdapp-page-header">
        <h1 class="sdapp-page-header__title">Willkommen zurück, Student 👋</h1>
        <p class="sdapp-page-header__subtitle">Dein Cockpit für einen erfolgreichen Tag.</p>
      </div>
 
      <!-- Semester Fortschritt -->
      @php
      $currentXP = auth()->user()->total_xp ?? 0;
      $maxXP = 1000; // change as per your system
      $progressPercent = $maxXP > 0 ? ($currentXP / $maxXP) * 100 : 0;
    
      // Optional: convert XP → week system (if needed)
      $totalWeeks = 16;
      $currentWeek = round(($progressPercent / 100) * $totalWeeks);
    @endphp
    
    <div class="sdapp-card sdapp-dash-progress-card">
      
      <div class="sdapp-dash-progress-card__title">
        Dein Fortschritt
      </div>
    
      <div class="sdapp-dash-progress-card__subtitle">
        {{ number_format($progressPercent, 1) }}% Complete • 
        {{ $currentXP }} XP earned
      </div>
    
      <div class="sdapp-progress-bar-track">
        <div 
          class="sdapp-progress-bar-fill" 
          style="width: {{ $progressPercent }}%;">
        </div>
      </div>
    
      <div class="sdapp-progress-labels">
        <span>Start</span>
        <span>Max XP</span>
      </div>
    
    </div>
 
      <!-- Dein Fokus für heute -->
      <div class="sdapp-section-title">Dein Fokus für heute</div>
      <div class="sdapp-dash-focus-grid">
 
        <!-- Card 1 -->
        <div class="sdapp-card sdapp-dash-focus-card">
          <div class="sdapp-dash-focus-card__icon-wrap">
            <i data-lucide="book-open" width="16" height="16"></i>
          </div>
          <div class="sdapp-dash-focus-card__label">Skill-Ziel: Rhetorik</div>
          <div class="sdapp-dash-focus-card__desc">Verbessere heute deine Kommunikation.</div>
          <a href="{{ route('skill.coach') }}" class="sdapp-btn sdapp-btn--primary" style="margin-top:4px;">
            Skill-Coach <i data-lucide="arrow-right" width="14" height="14"></i>
          </a>
        </div>
 
        <!-- Card 2 -->
        <div class="sdapp-card sdapp-dash-focus-card">
          <div class="sdapp-dash-focus-card__icon-wrap">
            <i data-lucide="briefcase" width="16" height="16"></i>
          </div>
          <div class="sdapp-dash-focus-card__label">Job-Vorschlag</div>
          <div class="sdapp-dash-focus-card__desc">'Werkstudent Data &amp; KI (m/w/d)' passt zu dir.</div>
          <a href="{{ route('career.web') }}" class="sdapp-btn sdapp-btn--primary" style="margin-top:4px;">
            Stelle ansehen <i data-lucide="arrow-right" width="14" height="14"></i>
          </a>
        </div>
 
        <!-- Card 3 -->
        <div class="sdapp-card sdapp-dash-focus-card">
          <div class="sdapp-dash-focus-card__icon-wrap">
            <i data-lucide="send" width="16" height="16"></i>
          </div>
          <div class="sdapp-dash-focus-card__label">Bewerbung</div>
          <div class="sdapp-dash-focus-card__desc">Optimierung für gemerkte Stelle.</div>
          <a href="{{ route('document') }}" class="sdapp-btn sdapp-btn--primary" style="margin-top:4px;">
            KI nutzen <i data-lucide="arrow-right" width="14" height="14"></i>
          </a>
        </div>
 
      </div>
 
      <!-- Schnellzugriff -->
      <div class="sdapp-section-title">Schnellzugriff</div>
      <div class="sdapp-dash-quick-grid">
 
        <a href="{{ route('account.financial') }}" class="sdapp-dash-quick-item">
          <i data-lucide="wallet" width="16" height="16"></i>
          Finanzplaner
          <i data-lucide="arrow-right" width="14" height="14" class="sdapp-dash-quick-item__arrow"></i>
        </a>
 
        <a href="{{ route('document') }}" class="sdapp-dash-quick-item">
          <i data-lucide="file-text" width="16" height="16"></i>
          Dokumenten-KI
          <i data-lucide="arrow-right" width="14" height="14" class="sdapp-dash-quick-item__arrow"></i>
        </a>
 
        <a href="{{ route('account.community') }}" class="sdapp-dash-quick-item">
          <i data-lucide="users" width="16" height="16"></i>
          Community
          <i data-lucide="arrow-right" width="14" height="14" class="sdapp-dash-quick-item__arrow"></i>
        </a>
 
        <a href="{{ route('toolkit.all') }}" class="sdapp-dash-quick-item">
          <i data-lucide="wrench" width="16" height="16"></i>
          Toolkit
          <i data-lucide="arrow-right" width="14" height="14" class="sdapp-dash-quick-item__arrow"></i>
        </a>
 
        <a href="{{ route('marketplace.index') }}" class="sdapp-dash-quick-item">
          <i data-lucide="tag" width="16" height="16"></i>
          Deals &amp; Benefits
          <i data-lucide="arrow-right" width="14" height="14" class="sdapp-dash-quick-item__arrow"></i>
        </a>
 
      </div>
    </div><!-- /sdapp-page-content -->
  </div><!-- /sdapp-main-wrapper -->
 



            <!-- Start Content-->
            {{-- <div class="container-fluid">

                <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column"> --}}

{{-- 
                    <div class="main-section">
                        <div class="mb-4">
                            <h4 style="  color: rgb(56, 59, 66);" class="mb-1">Guten Nachmittag, Alex! Schön, dass du da
                                bist.
                            </h4>
                            <p class="text-muted mb-0">Bereit, heute etwas Großartiges zu erreichen? Ich helfe dir dabei!
                            </p>
                        </div>

                        <div class="row g-4 align-items-stretch">
                            <!-- Left Card -->
                            <div class="col-lg-8 pop-up">
                                <div class="card card-shadow p-4"
                                    style=" 
                border-left: 4px solid 
#4f46e5;">
                                    <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i
                                            class="fa-regular me-2 fa-lightbulb"></i> Dein Fokus für heute</h5>
                                    <p class="text-muted">Hier sind ein paar Vorschläge von dem K-Coach</p>

                                    <img height="300px" width="200px" src="{{ asset('new_asset/images/abcd.png') }}"
                                        class="rounded mb-4" alt="Focus Image">
                                    @php
                                        use Illuminate\Support\Str;
                                        $messages = App\Models\AiChatHistory::where('user_id', auth()->user()->id)
                                            ->latest()
                                            ->limit(3)
                                            ->get();
                                    @endphp
                                    @foreach ($messages as $msg)
                                        <a href="{{ url('account/career/assiatant') }}" style="text-decoration: none;">
                                            <div class="alert alert-info shadow-sm">
                                                <div>
                                                    <i class="fa-brands fa-react"></i>
                                                </div>
                                                <p class="mb-0"> {{ Str::limit($msg->ai_response, 100) }}</p>
                                            </div>
                                        </a>
                                    @endforeach
                                    <div class="card green-shadow rounded-3 shadow-sm mb-4 p-4">
                                        <h5><i class="fa-regular fa-lightbulb me-2"></i>
                                            Meine Gedanken dazu (dein KI-Coach):
                                        </h5>
                                        <p class="mb-0">Da du die Grundlagen von Python abgeschlossen hast und ein neues
                                            Projekt starten möchtest, ist es wichtig, die gelernten Konzepte durch
                                            praktische
                                            Anwendung zu festigen. Die Arbeit an einem Projekt hilft dir, dein Wissen zu
                                            vertiefen und neue Fähigkeiten zu erlernen. Das Verständnis von Datenstrukturen
                                            und
                                            Algorithmen ist entscheidend für die Entwicklung effizienter Programme. Die
                                            Verwendung von Git ist unerlässlich für die Zusammenarbeit und die Verwaltung
                                            von
                                            Codeänderungen.</p>
                                    </div>
                                    <div class="card shadow-sm p-4 mb-4">
                                        <h5><i class="fa-brands fa-react me-2"></i>
                                            Ein kleiner Motivations-Boost fur dich!
                                        </h5>
                                        <p class="mb-0 fst-italic text-muted">"Jeder Tag ist eine neue Chance, das zu
                                            lerner,
                                            was du gestern noch nicht wusstest. Nutze sie!"</p>
                                    </div>
                                    <div class="card p-4" style="background-color: #f0f8ff6b;">
                                        <h5 class="mb-4">Passe die Basis fur deinen Fokus an (optional):</h5>
                                        <p class="mb-2"><strong>Deine Ziele</strong></p>
                                        <p class="text-muted">{{ auth()->user()->goals }}</p>
                                        <p class="mb-2"><strong>Dein aktueller Fortschritt</strong></p>
                                        <p class="text-muted">{{ auth()->user()->current_priogress }}</p>
                                        <p class="mb-2"><strong>Dein Studienfach/Inberessengebiet</strong></p>
                                        <p class="text-muted">{{ auth()->user()->subject }}</p>
                                    </div>

                                </div>
                            </div>

                            <!-- Right XP Box -->
                            <div class="col-lg-4 d-flex flex-column">
                                <div class="card card-shadow xp-box p-4 h-100">
                                    <h5 class="fw-bold">Dein wöchentlicher XP-Boost!</h5>
                                    <p>Sammle Punkte und feiere deine Erfolge.</p>
                                    <h2 class="display-5 fw-bold">{{ auth()->user()->total_xp }}</h2>
                                    <p>XP diese Woche</p>
                                    <p class="fw-semibold">Klasse gemacht! Du bist auf einem super Weg, deine Ziele zu
                                        rocken.
                                    </p>
                                    <a href="{{ route('skill.coach') }}"
                                        class=" mt-2 text-black text-decoration-none text-center">Alle Erfolge ansehen <i
                                            class="fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>
                        <!-- Top Quick Access -->
                        <h4 style="  color: rgb(56, 59, 66);" class="mb-0 mt-5">Deine Schnellzugriffe</h4>

                        <div class="row g-4 mb-4 mt-1">
                            <div class="col-md-6 col-lg-3">
                                <div class="quick-card ">
                                    <h6><i class="fa-solid fa-rocket me-2"></i>Dein Skill-Pfad</h6>
                                    <p>Setze deine Lernreise fort und entdecke Neues.</p>
                                    <a href="{{ route('skill.coach') }}" class="btn  w-100">Zum Skill Coach <i
                                            class="ms-2 fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="quick-card">
                                    <h6><i class="fa-regular fa-face-smile me-2"></i>Chatte mit deinem KI-Coach</h6>
                                    <p>Erhalte sofortige Hilfe und inspirierende Antworten.</p>
                                    <a href="{{ route('skill.coach') }}" class="btn  w-100">Chat starten <i
                                            class="ms-2 fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="quick-card">
                                    <h6><i class="fa-solid fa-dollar-sign me-2"></i>Dein Budget-Check</h6>
                                    <p>Behalte deine Finanzen im Griff und entdecke Sparpotenziale.</p>
                                    <a href="{{ route('account.financial') }}" class="btn  w-100">Finanzen prüfen<i
                                            class="ms-2 fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3">
                                <div class="quick-card ">
                                    <h6><i class="fa-solid fa-pen-to-square me-2"></i>Lebenslauf-Booster</h6>
                                    <p>Optimiere deinen CV mit KI-Power für den nächsten Karrieresprung.</p>
                                    <a href="{{ url('account/document') }}" class="btn  w-100">Dokumente optimieren<i
                                            class="ms-2 fa-solid fa-arrow-right"></i></a>
                                </div>
                            </div>
                        </div>

                        <!-- Community Highlights -->
                        <div class="community-box">
                            <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i
                                    class="fa-solid me-2 fa-users"></i>Community
                                Highlights</h5>
                            <p class="text-muted small">Verpasse keine wichtigen Diskussionen oder anstehende Treffen.</p>
                            <div class="row align-items-center">
                                <div class="col-md-12 ">
                                    <img src="{{ asset('new_asset/images/abcd.png') }}" height="300px" width="200px"
                                        class="mb-3 mt-3" alt="Community Highlights">
                                </div>
                                <div class="col-md-12">

                                    <p class="text-muted small">Hier würden die neuesten Forum-Posts oder anstehende Meetups
                                        angezeigt, um dich zu inspirieren und zu vernetzen!</p>
                                    <a href="{{ url('account/community') }} " class="btn fw-medium text-black">Zum
                                        Community
                                        Hub <i class="ms-2 fa-solid fa-up-right-from-square"></i></a>
                                </div>
                            </div>
                        </div>
                    </div> --}}



                    <!-- Start Product Orders -->


                {{-- </div> <!-- container-fluid -->
            </div> <!-- content --> --}}

        </div>
    </div>




    <script>
        let date = new Date();
        let year = date.getFullYear();
        let month = date.getMonth();

        const day = document.querySelector(".calendar-dates");

        const currdate = document
            .querySelector(".calendar-current-date");

        const prenexIcons = document
            .querySelectorAll(".calendar-navigation span");


        const months = [
            "January",
            "February",
            "March",
            "April",
            "May",
            "June",
            "July",
            "August",
            "September",
            "October",
            "November",
            "December"
        ];


        const manipulate = () => {


            let dayone = new Date(year, month, 1).getDay();


            let lastdate = new Date(year, month + 1, 0).getDate();


            let dayend = new Date(year, month, lastdate).getDay();


            let monthlastdate = new Date(year, month, 0).getDate();


            let lit = "";


            for (let i = dayone; i > 0; i--) {
                lit +=
                    `<li class="inactive">${monthlastdate - i + 1}</li>`;
            }


            for (let i = 1; i <= lastdate; i++) {


                let isToday = i === date.getDate() &&
                    month === new Date().getMonth() &&
                    year === new Date().getFullYear() ?
                    "active" :
                    "";
                lit += `<li class="${isToday}">${i}</li>`;
            }


            for (let i = dayend; i < 6; i++) {
                lit += `<li class="inactive">${i - dayend + 1}</li>`
            }


            currdate.innerText = `${months[month]} ${year}`;


            day.innerHTML = lit;
        }

        manipulate();

        prenexIcons.forEach(icon => {


            icon.addEventListener("click", () => {



                month = icon.id === "calendar-prev" ? month - 1 : month + 1;


                if (month < 0 || month > 11) {


                    date = new Date(year, month, new Date().getDate());


                    year = date.getFullYear();


                    month = date.getMonth();
                } else {


                    date = new Date();
                }

                manipulate();
            });
        });

        document.getElementById('recurring').addEventListener('change', function() {
            document.getElementById('recurring_type').disabled = !this.checked;
        });
    </script>
@endsection
