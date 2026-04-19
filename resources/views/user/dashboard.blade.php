@extends('user.layout')
@section('title',trans('general.User_Dashboard'))
@section('content')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
<style>
    #addTaskModal{
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
        font-size:18px;
        margin-bottom: 0px
    }
    header i{
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
    .add-task-btn{
        background:linear-gradient(135deg, rgb(42, 44, 176) 0%, rgb(71, 71, 222) 100%) ;
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

<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <!-- <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div> -->
    </div>

    <!-- Start Row -->
    {{--<div class="row">
        
    <div class="col-md-6 col-xl-6">
        <a href="{{route('user.workshop.show')}}">
            <div class="card overflow-hidden">
                <div class="card-body active">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#963b68" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 fs-16">{{ trans('general.Workshops') }}</p>
                            </div>
                        </div>
                        @php
                            $userIds = auth()->id();
                            $workshops=App\Models\Enroll::where('module_type','course')->where('user_id',$userIds)->count();
                        @endphp
                        <h3 class="mb-0 fs-26 ">{{ $workshops }}</h3>
                        <p class="text-white fs-14">{{ trans('general.All_Workshops_Data') }}</p>
                    </div>
                </div>
            </div>
        </a>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <a href="{{route('user.ticketbook.show')}}">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#01D4FF" d="M7 20V8.975q0-.825.6-1.4T9.025 7H20q.825 0 1.413.587T22 9v8l-5 5H9q-.825 0-1.412-.587T7 20M2.025 6.25q-.15-.825.325-1.487t1.3-.813L14.5 2.025q.825-.15 1.488.325t.812 1.3L17.05 5H9Q7.35 5 6.175 6.175T5 9v9.55q-.4-.225-.687-.6t-.363-.85zM20 16h-4v4z"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 text-dark fs-16">{{ trans('general.Tickets_Booked') }}</p>
                            </div>
                        </div>
                        @php
                            $userIds = auth()->id();
                            $travel=App\Models\Enroll::where('module_type','travel')->where('user_id',$userIds)->count();
                        @endphp
                        <h3 class="mb-0 fs-26 text-dark">{{ $travel }}</h3>
                        <p class="text-muted fs-14">{{ trans('general.Total_Ticket') }}</p>
                    </div>
                </div>
            </div>
            </a>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><path fill="#287F71" fill-rule="evenodd" d="M13.463 9.692C13.463 12.664 10.77 14 7 14S.537 12.664.537 9.713c0-3.231 1.616-4.868 4.847-6.505L4.24 1.077A.7.7 0 0 1 4.843 0H9.41a.7.7 0 0 1 .603 1.023L8.616 3.208c3.23 1.615 4.847 3.252 4.847 6.484M7.625 4.887a.625.625 0 1 0-1.25 0v.627a1.74 1.74 0 0 0-.298 3.44l1.473.322a.625.625 0 0 1-.133 1.236h-.834a.625.625 0 0 1-.59-.416a.625.625 0 1 0-1.178.416a1.877 1.877 0 0 0 1.56 1.239v.636a.625.625 0 1 0 1.25 0v-.636a1.876 1.876 0 0 0 .192-3.696l-1.473-.322a.49.49 0 0 1 .105-.97h.968a.622.622 0 0 1 .59.416a.625.625 0 0 0 1.178-.417a1.874 1.874 0 0 0-1.56-1.238z" clip-rule="evenodd"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 text-dark fs-16">{{ trans('general.New_Offers') }}</p>
                            </div>
                        </div>
      
                        <h3 class="mb-0 fs-26 text-dark">1</h3>
                        <p class="text-muted fs-14">{{ trans('general.New_Offers_Show') }}</p>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <a href="{{route('user.affiliate_programs.show')}}">
                <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f59440" d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691" opacity="0.5"/><path fill="#988D4D" d="M12 9.25a2.251 2.251 0 0 1-2.122-1.5a.75.75 0 1 0-1.414.5a3.751 3.751 0 0 0 7.073 0a.75.75 0 1 0-1.414-.5A2.251 2.251 0 0 1 12 9.25"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 text-dark fs-16">{{ trans('general.Affiliate_Programs') }}</p>
                            </div>
                        </div>
                        @php
                        $userIds = auth()->id();
                    $travel=App\Models\Enroll::where('module_type','affiliate-program')->where('user_id',$userIds)->count();
                @endphp
                        <h3 class="mb-0 fs-26 text-dark">{{ $travel }}</h3>
                        <p class="text-muted fs-14">{{ trans('general.Total_Affiliate_Incurred') }}</p>
                    </div>
                </div>
            </div>
            </a>
        </div>
        
    </div>--}}
    <!-- End Start -->

    <!-- Sales Chart -->
  {{--  <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">{{ trans('general.Student_Performance') }}</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="performance-review" class="apex-charts"></div>
                </div>
            </div>
        </div>

       
     
    </div>--}}

    <!-- Top Selling Products -->
    
    <!-- End Top Selling Products -->

          <div class="main-section">
            <div class="mb-4">
              <h4 style="  color: rgb(56, 59, 66);" class="mb-1">Guten Nachmittag, Alex! Schön, dass du da bist.</h4>
              <p class="text-muted mb-0">Bereit, heute etwas Großartiges zu erreichen? Ich helfe dir dabei!</p>
            </div>
  
            <div class="row g-4 align-items-stretch">
              <!-- Left Card -->
              <div class="col-lg-8 pop-up">
                <div class="card card-shadow p-4" style=" 
                border-left: 4px solid 
#4f46e5;">
                  <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i class="fa-regular me-2 fa-lightbulb"></i> Dein Fokus für heute</h5>
                  <p class="text-muted">Hier sind ein paar Vorschläge von dem K-Coach</p>

                  <img height="300px" width="200px" src="{{asset('new_asset/images/abcd.png')}}" class="rounded mb-4" alt="Focus Image">
@php
    use Illuminate\Support\Str;
    $messages = App\Models\AiChatHistory::where('user_id', auth()->user()->id)->latest()->limit(3)->get();
@endphp
                @foreach ($messages as $msg)
                  <a href="{{url('account/career/assiatant')}}" style="text-decoration: none;">
                  <div class="alert alert-info shadow-sm">
                    <div>
                      <i class="fa-brands fa-react"></i>
                    </div>
                     <p class="mb-0">        {{ Str::limit($msg->ai_response, 100) }}</p>
                  </div>
                  </a>
                  @endforeach
                  <div class="card green-shadow rounded-3 shadow-sm mb-4 p-4">
                    <h5><i class="fa-regular fa-lightbulb me-2"></i>
                      Meine Gedanken dazu (dein KI-Coach):
                    </h5>
                    <p class="mb-0">Da du die Grundlagen von Python abgeschlossen hast und ein neues Projekt starten möchtest, ist es wichtig, die gelernten Konzepte durch praktische Anwendung zu festigen. Die Arbeit an einem Projekt hilft dir, dein Wissen zu vertiefen und neue Fähigkeiten zu erlernen. Das Verständnis von Datenstrukturen und Algorithmen ist entscheidend für die Entwicklung effizienter Programme. Die Verwendung von Git ist unerlässlich für die Zusammenarbeit und die Verwaltung von Codeänderungen.</p>
                  </div>
                  <div class="card shadow-sm p-4 mb-4">
                    <h5><i class="fa-brands fa-react me-2"></i>
                      Ein kleiner Motivations-Boost fur dich!
                    </h5>
                    <p class="mb-0 fst-italic text-muted">"Jeder Tag ist eine neue Chance, das zu lerner, was du gestern noch nicht wusstest. Nutze sie!"</p>
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
                  <p >Sammle Punkte und feiere deine Erfolge.</p>
                  <h2 class="display-5 fw-bold">{{ auth()->user()->total_xp }}</h2>
                  <p>XP diese Woche</p>
                  <p class="fw-semibold">Klasse gemacht! Du bist auf einem super Weg, deine Ziele zu rocken.</p>
                  <a href="{{ route('skill.coach') }}" class=" mt-2 text-black text-decoration-none text-center">Alle Erfolge ansehen <i class="fa-solid fa-arrow-right"></i></a>
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
        <a href="{{ route('skill.coach') }}" class="btn  w-100">Zum Skill Coach <i class="ms-2 fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="quick-card">
        <h6><i class="fa-regular fa-face-smile me-2"></i>Chatte mit deinem KI-Coach</h6>
        <p>Erhalte sofortige Hilfe und inspirierende Antworten.</p>
        <a href="{{ route('skill.coach') }}" class="btn  w-100">Chat starten <i class="ms-2 fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="quick-card">
        <h6><i class="fa-solid fa-dollar-sign me-2"></i>Dein Budget-Check</h6>
        <p>Behalte deine Finanzen im Griff und entdecke Sparpotenziale.</p>
        <a href="{{ route('account.financial') }}" class="btn  w-100">Finanzen prüfen<i class="ms-2 fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
    <div class="col-md-6 col-lg-3">
      <div class="quick-card ">
        <h6><i class="fa-solid fa-pen-to-square me-2"></i>Lebenslauf-Booster</h6>
        <p>Optimiere deinen CV mit KI-Power für den nächsten Karrieresprung.</p>
        <a href="{{ url('account/document') }}" class="btn  w-100">Dokumente optimieren<i class="ms-2 fa-solid fa-arrow-right"></i></a>
      </div>
    </div>
  </div>

  <!-- Community Highlights -->
  <div class="community-box">
    <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i class="fa-solid me-2 fa-users"></i>Community Highlights</h5>
    <p class="text-muted small">Verpasse keine wichtigen Diskussionen oder anstehende Treffen.</p>
    <div class="row align-items-center">
      <div class="col-md-12 ">
        <img src="{{asset('new_asset/images/abcd.png')}}" height="300px" width="200px" class="mb-3 mt-3" alt="Community Highlights">
      </div>
      <div class="col-md-12">
    
        <p class="text-muted small">Hier würden die neuesten Forum-Posts oder anstehende Meetups angezeigt, um dich zu inspirieren und zu vernetzen!</p>
        <a href="{{ url('account/community') }} " class="btn fw-medium text-black">Zum Community Hub <i class="ms-2 fa-solid fa-up-right-from-square"></i></a>
      </div>
    </div>
  </div>
          </div>
  
    

    <!-- Start Product Orders -->
 

</div> <!-- container-fluid -->
</div> <!-- content -->
{{--<div class="appointment-section">
<div class="appointment-header">
    <h2>{{ trans('general.Task_Management') }}</h2>
     <button type="button" class="create-visit" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ {{ trans('general.Create_Task') }}</button>
    @if(!auth()->user()->google_token)
       <a href="{{route('account.task.google')}}" class="create-visit" >{{ trans('general.Check_Event') }}</a>
        @else
           <a href="{{ route('account.user.calender') }}" class="create-visit">{{ trans('general.Event_Show') }}</a>
    @endif

<!-- Modal -->
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog" style="width: 700px;">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ trans('general.Create_Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.task.store')}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="task_title" class="form-label">{{ trans('general.Task_Title') }}</label>
                            <input type="text" class="form-control" id="task_title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">{{ trans('general.Due_Date') }}</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Time') }}</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="time"
                                                            value="" required value="">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="attachment" class="form-label">{{ trans('general.Attachment') }}</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('general.Save_Task') }}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

</div>
@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\Auth;

    $userId = Auth::id();
    $startDate = Carbon::today();
    $endDate = Carbon::today()->addDays(6);


    $tasks = App\Models\Task::where('user_id', $userId)
                ->whereBetween('due_date', [$startDate, $endDate])
                ->orderBy('due_date', 'asc')
                ->get();


    $taskDates = $tasks->pluck('due_date')->unique()->map(fn($date) => Carbon::parse($date)->toDateString());


    $tomorrow = Carbon::tomorrow()->toDateString();
    $defaultActiveDate = $taskDates->contains($tomorrow) ? $tomorrow : ''; 
@endphp

<div class="date-tabs">
    @foreach($taskDates as $date)
        <button class="{{ $date === $defaultActiveDate ? 'active' : '' }}" onclick="filterTasks('{{ $date }}')">
            {{ \Carbon\Carbon::parse($date)->format('d M') }}
        </button>
    @endforeach
</div>

<div class="schedule">
<div class="calendar-container">
        <header class="calendar-header">
            <p class="calendar-current-date"></p>
            <div class="calendar-navigation">
                <span id="calendar-prev" 
                     >
                     <i class="fa-solid fa-chevron-left"></i>
                </span>
                <span id="calendar-next" 
                      >
                      <i class="fa-solid fa-chevron-right"></i>
                </span>
            </div>
        </header>

        <div class="calendar-body">
            <ul class="calendar-weekdays">
                <li>Sun</li>
                <li>Mon</li>
                <li>Tue</li>
                <li>Wed</li>
                <li>Thu</li>
                <li>Fri</li>
                <li>Sat</li>
            </ul>
            <ul class="calendar-dates"></ul>
        </div>
    </div>
</div>
</div>
</div>--}}
    <!-- Sales Chart -->
 <!-- content -->

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

  
        let isToday = i === date.getDate()
            && month === new Date().getMonth()
            && year === new Date().getFullYear()
            ? "active"
            : "";
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
        }

        else {

            
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