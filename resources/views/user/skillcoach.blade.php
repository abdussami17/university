@extends('user.layout')
@section('title', 'skill coach')
@section('content')

<div class="main-section">
            <div class="mb-4 d-flex justify-content-between flex-wrap align-items-center">
                <div>
                    <h4 class="main-heading mb-0">Dein Kl Skill Coach</h4>
                    <p class="text-muted mb-0">Wahle deinen Plad, meistere Quizze und wachse mit KI-gestutzter Anleitung.</p>
                </div>
              <img src="{{asset('new_asset/images/abcd.png')}}" width="100px" height="100px" alt="not-found">
            </div>


            <div class="skill-path">
                <h4>Wähle deinen Skill-Pfad</h4>
            
                <div class="row g-3">
                    @foreach (App\Models\SkillPath::get() as $item)
                        @php
                            $isActive = App\Models\UserSkillProgress::where('user_id', auth()->id())
                                        ->where('skill_path_id', $item->id)
                                        ->exists();
                        @endphp
                        <div class="col-md-4">
                            <div class="skill-box {{ $isActive ? 'active' : '' }}" style="cursor: pointer;">
                                <strong><i class="{{ $item->icon_class }} me-2"></i>{{ $item->title }}</strong><br>
                                <small>{!! $item->description !!}</small><br>
                    
                                @if(auth()->check())
                                    <form class="skillPathForm" data-skill-path-id="{{ $item->id }}">
                                        <button type="submit" class="d-none"></button> <!-- hidden -->
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endforeach



                </div>
              </div>
            
              <div class="row mt-4 quiz-section g-3">
            <div class="col-md-6">
                <div class="card pop-up p-3 green-shadow">
                    <div class="d-flex align-items-center mb-2">
                        <i class="fa-brands fa-react"></i>
                        <h6 class="ms-2 mb-0">KI-gestütztes Quiz</h6>
                    </div>
                    <p class="mb-1 text-muted small">Teste und erweitere dein Wissen mit personalisierten Quizfragen.</p>
                    <img height="200px" width="150px" class="mt-2 mb-3" src="{{ asset('new_asset/images/abcd.png') }}"
                        alt="not">

                    <small>Thema des Quiz: Grundlagen der KI</small>

                    <div class="mt-4">
                        <div>
                            <label for="">Thema des Quiz</label>
                            <input type="text" class="form-control w-100" name="topic" id="">
                        </div>
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <label for="">Level</label>
                                <select id="" class="form-select" name="level">
                                    <option value="Low">Low</option>
                                    <option value="Medium">Medium</option>
                                    <option value="High">High</option>
                                </select>
                            </div>
                            <div class="col-md-6">
                                <label for="">Anzahl Fragen</label>
                                <input type="number" value="3" class="form-control w-100" name="num_questions"
                                    id="">
                            </div>
                        </div>

                    </div>

                      <button onclick="generateQuiz()" id="generateBtn" type="button" class="mt-4 mb-4 btn shadow-lg">
                          <i class="fa-brands fa-react me-2"></i> Quiz mit KI generieren
                      </button>
                </div>
            </div>
            
                <div class="col-md-6">

                  <div class="card p-3">
                    <div class="d-flex align-items-center justify-content-between mb-2">
                      <div class="d-flex align-items-center">
                        <i class="fa-solid fa-stopwatch"></i>

                        <h6 class="ms-2 mb-0">Mini-Herausforderungen (5-15 Min.)</h6>
                      </div>
                      <span class="xp-badge">+50 XP</span>
                    </div>
                    <p class="mb-1 small text-muted">Kurze Aufgaben, um Wissen praktisch anzuwenden.</p>
                    <img height="200px" width="150px" class="mt-2 mb-3" src="{{asset('new_asset/images/abcd.png')}}" alt="not">
                    
                    <small>Elevator Pitch (5 Min.)</small>
                       @foreach(App\Models\QuizQuestion::where('user_id',auth()->user()->id)->get() as $show)
                       
                       @php
                                                   $xrp = App\Models\QuizAttempt::where('user_id', auth()->id())
                                        ->where('quiz_question_id', $show->id)
                                        ->first();
                                     
                       @endphp
                                        
                        <div class="card h-auto p-3 shadow-sm mt-3">
                            <div class="d-flex justify-content-between align-items-start">
                                <div>
                                    <h6 class="fw-medium">
                                        <i class="{{ $show->font_awesome }} me-2"></i> 
                                        {{ ucfirst($show->topic) }} ({{ $show->time }} min)
                                    </h6>
                                    
                                    <ul class="small text-muted">
                    
                                        <li>{{ \Illuminate\Support\Str::words($show->questions, 10, '...') }}</li>
                    
                                    </ul>
                                </div>
                                <div>
                                    <span class="xp-badge">+{{$xrp->xp_earned ?? '0'}} XP</span>
                                </div>
                            </div>
                            <a href="{{ route('quiz.question.solve',$show->id) }}">
                                <button class="btn radius-3 bg-light border-1 border w-100">Starten</button>
                            </a>
                        </div>
                    @endforeach

                  </div>

                </div>
              </div>
              <div class="card p-3 rounded-3 shadow-sm mt-4">
                <h6><i class="fa-regular fa-lightbulb me-2"></i>Deine wochentliche KI-Empfehlung</h6>
<img src="{{asset('new_asset/images/abcd.png')}}" class="mt-3 mb-3" height="150px" width="130px" alt="not-found">
@php
    use Illuminate\Support\Facades\Auth;
    use Carbon\Carbon;
    use App\Models\QuizQuestion;

    $userId = Auth::id();

    // Get latest 7-day topics, shuffle and limit 3
    $lastWeekTopics = QuizQuestion::where('user_id', $userId)
        ->where('created_at', '>=', Carbon::now()->subDays(7))
        ->pluck('topic')             // get only topics
        ->unique()                   // ensure uniqueness
        ->shuffle()                  // randomize
        ->take(3);                   // limit to 3
@endphp

@if($lastWeekTopics->count())
    <p class="text-muted small">
        Basierend auf deinem Fortschritt und deinen letzten Quiz-Ergebnissen schlägt dir dein KI-Coach vor, diese Woche folgende Themen zu vertiefen:
    </p>

    <ul style="color: #0dadfdf5;">
        @foreach($lastWeekTopics as $topic)
            <li class="mb-2">{{ $topic }}</li>
        @endforeach
    </ul>
@else
    <p class="text-muted small">
        Keine Themenvorschläge gefunden. Bitte mache ein Quiz, um Empfehlungen zu erhalten.
    </p>
@endif

<strong>Mehr Details &amp; Ressourcen</strong>
              </div>
   
     <div class="card p-3 rounded-3 shadow-sm mt-4">
    <h6>
        <i class="fa-solid fa-trophy me-2"></i>
        Deine Erfolge &amp; Gamification
    </h6>
    <p class="small text-muted">
        Verfolge deine Fortschritte, sammle XP und schalte Belohnungen frei! So macht Lernen Spaß.
    </p>

    <div class="card p-3 rounded-2 shadow-sm">
        <h6 class="mb-0">
            Aktuelles Level
            <span class="badge small fw-medium ms-1 rounded-pill bg-warning">
                {{ $currentLevelName ?? 'Unbekannt' }}
            </span>
        </h6>
        <p class="small text-muted mt-1 mb-0">
            Gesammelte XP: {{ $xp }}/{{ $nextLevelXP }} bis zum nächsten Level
        </p>
    </div>

    <div class="progress mt-3">
        <div class="progress-bar bg-warning" role="progressbar"
             style="width: {{ $progress }}%;"
             aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100">
        </div>
    </div>

    <h6 class="mt-3 mb-3">Verdiente Badges:</h6>

    <div class="d-flex gap-2">
        @foreach($badges as $badgeName => $icon)
   
            <div class="card pop-up-badges text-center flex-column d-flex p-2 w-auto h-auto">
                <i class="bi fs-4 {{ $icon }}"></i>
                <p class="small mb-0">{{ $badgeName }}</p>
            </div>
        @endforeach

        {{-- View all badge card --}}
        <div class="card pop-up-badges text-center flex-column d-flex border-0 p-2 w-auto h-auto">
            <i class="bi bi-file-earmark-text fs-4 opacity-0"></i>
            <p class="small mb-0 fw-semibold">Alle Badges</p>
        </div>
    </div>
</div>

          </div>

@endsection
@section('script')
<script>
document.addEventListener('DOMContentLoaded', function() {

    // skill-box click triggers form submit
    document.querySelectorAll('.skill-box').forEach(box => {
        box.addEventListener('click', function() {
            let form = this.querySelector('.skillPathForm');
            if(form) {
                form.dispatchEvent(new Event('submit', {cancelable: true}));
            }
        });
    });

    // handle AJAX submit
    document.querySelectorAll('.skillPathForm').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            let skillPathId = this.getAttribute('data-skill-path-id');

            fetch("{{ route('user.selectSkillPath') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ skill_path_id: skillPathId })
            })
            .then(res => res.json())
            .then(data => {
                console.log(data);
                alert("Skill path gespeichert!");
                location.reload(); // refresh active class
            })
            .catch(err => console.error(err));
        });
    });
});


function generateQuiz() {
    let topicInput = document.querySelector('input[name="topic"]');
    let difficultySelect = document.querySelector('select[name="level"]');
    let numQuestionsInput = document.querySelector('input[name="num_questions"]');
    let generateBtn = document.getElementById('generateBtn');

    console.log("generateBtn:", generateBtn); // debug

    if (!topicInput || !difficultySelect || !numQuestionsInput || !generateBtn) {
        alert("Error: Some elements not found!");
        return;
    }

    let topic = topicInput.value;
    let level = difficultySelect.value;
    let numQuestions = numQuestionsInput.value;

    if (!topic) {
        alert("Please enter a topic.");
        return;
    }

    $('#quizOutput').html('Generating quiz...');

    generateBtn.disabled = true;
    let originalText = generateBtn.innerHTML;
    generateBtn.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Loading...';

    $.ajax({
        url: '{{ route('generate.quiz') }}',
        type: 'POST',
        data: {
            _token: '{{ csrf_token() }}',
            topic: topic,
            level: level,
            num_questions: numQuestions
        },
        success: function(res) {
            toastr.success(res.message);
            $('#quizOutput').html(res);
                location.reload(); // refresh active class

        },
        error: function(err) {
            console.log(err);
            toastr.error('Something went wrong.');
        },
        complete: function() {
            generateBtn.disabled = false;
            generateBtn.innerHTML = originalText;
        }
    });
}

</script>


</script>
@endsection

