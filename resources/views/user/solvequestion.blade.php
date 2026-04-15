@extends('user.layout')
@section('title', 'skill coach')
@section('content')

    <div class="main-section">

<div class="container">
    <h3>{{ $quiz->topic }} ({{ $quiz->level ?? 'Any' }})</h3>
    <small>Estimated Time: {{ $quiz->time }} (min)</small>

    <div class="mt-4">
        <div class="card">
            <div class="card-body">

                @if($attempt)
                    {{-- ✅ Quiz Already Attempted --}}
                    <h5>Your Submitted Answers</h5>
                    @php
                        $lines = explode("\n", $quiz->questions);
                        $qnum = 1;
                    @endphp

                    @foreach($lines as $line)
                        @if(Str::startsWith(trim($line), "Q"))
                            <div class="mb-3">
                                <label><strong>{{ $line }}</strong></label>
                                <input type="text" class="form-control" value="{{ $userAnswers[$qnum] ?? '-' }}" readonly>
                                @php $qnum++; @endphp
                            </div>
                        @endif
                    @endforeach

                    {{-- ✅ XP and Score Result --}}
                    <div class="mt-3 alert alert-info">
                        <p><strong>Erhaltene XRP:</strong> {{ $attempt->xp_earned }}</p>
                        <p><strong>Zeit genommen:</strong> {{ $attempt->time_taken }}</p>
                    </div>
                @else
                    {{-- 📝 Quiz Form (Not Attempted Yet) --}}
                    <h5>Quiz Questions</h5>
                    <form id="quizForm">
                        @csrf
                        <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">
                        <input type="hidden" name="time_taken" id="time_taken">

                        @php
                            $lines = explode("\n", $quiz->questions);
                            $qnum = 1;
                        @endphp
                        @foreach($lines as $line)
                            @if(Str::startsWith(trim($line), "Q"))
                                <div class="mb-3">
                                    <label><strong>{{ $line }}</strong></label>
                                    <input type="text" name="answers[{{ $qnum }}]" class="form-control" readonly>
                                    @php $qnum++; @endphp
                                </div>
                            @endif
                        @endforeach

                        <div class="mt-3">
                            <h4 id="timer">00:00</h4>
                            <button type="button" id="startBtn" class="btn btn-success" onclick="startTimer()">Start</button>
                            <button type="button" id="pauseBtn" class="btn btn-warning" onclick="pauseTimer()">Pause</button>
                            <button type="submit" id="submitBtn" class="btn btn-primary">Submit Answers</button>
                        </div>
                    </form>

                    <div class="mt-4" id="resultBox" style="display:none;">
                        <h5>Result:</h5>
                        <div id="resultContent"></div>
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>

@endsection

@section('script')
<script>
let seconds = 0;
let timer = null;
let maxSeconds = 600; // default 10 min

// Disable inputs on page load
window.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('#quizForm input[type="text"]').forEach(el => el.setAttribute('readonly', true));
});

// Extract time (e.g. "10 min") from Blade
(function(){
    let timeStr = "{{ $quiz->time }}";
    let matches = timeStr.match(/(\d+)\s*min/);
    if(matches){
        maxSeconds = parseInt(matches[1]) * 60;
    }
})();

function updateTimer() {
    const min = String(Math.floor(seconds / 60)).padStart(2, '0');
    const sec = String(seconds % 60).padStart(2, '0');
    document.getElementById('timer').innerText = `${min}:${sec}`;
    document.getElementById('time_taken').value = `${min}:${sec}`;
}

function startTimer() {
    if (!timer) {
        // Enable inputs
        document.querySelectorAll('#quizForm input[type="text"]').forEach(el => el.removeAttribute('readonly'));

        timer = setInterval(() => {
            seconds++;
            updateTimer();

            if (seconds >= maxSeconds) {
                clearInterval(timer);
                timer = null;
                document.getElementById('submitBtn').style.display = 'block';

                // Disable again
                document.querySelectorAll('#quizForm input[type="text"]').forEach(el => el.setAttribute('readonly', true));
            }
        }, 1000);
    }
}

function pauseTimer() {
    clearInterval(timer);
    timer = null;

    // Disable inputs on pause
    document.querySelectorAll('#quizForm input[type="text"]').forEach(el => el.setAttribute('readonly', true));
}
document.getElementById("quizForm").addEventListener("submit", function (e) {
    e.preventDefault();

    // 🛑 Stop timer on submit
    clearInterval(timer);
    timer = null;

    // ❌ Hide Start and Pause buttons
    document.getElementById('startBtn')?.style?.setProperty('display', 'none');
    document.getElementById('pauseBtn')?.style?.setProperty('display', 'none');

    let formData = new FormData(this);
    let submitBtn = document.getElementById('submitBtn');
    submitBtn.disabled = true;
    submitBtn.innerText = 'Bewertung läuft...';

    fetch("{{ route('quiz.submitAttempt') }}", {
        method: "POST",
        headers: {
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: formData
    })
    .then(async res => {
        if (!res.ok) {
            const text = await res.text();
            throw new Error(`Server Error (${res.status}):\n${text}`);
        }
        return res.json();
    })
    .then(data => {
        submitBtn.innerText = 'Fertig';

        if (data.error) {
            alert("Fehler: " + data.error);
            console.error("Server returned error:", data);
            return;
        }

        document.getElementById("resultBox").style.display = "block";
        document.getElementById("resultContent").innerHTML = `
            <p><strong>Bewertung:</strong> ${data.evaluation}</p>
            <p><strong>Punkte:</strong> ${data.score}/100</p>

        `;

        document.querySelectorAll('#quizForm input[type="text"]').forEach(el => el.setAttribute('readonly', true));
        submitBtn.style.display = 'none';

        // ✅ Redirect after delay
        setTimeout(() => {
            window.location.href = "{{ route('skill.coach') }}";
        }, 5000);
    })
    .catch(err => {
        alert("Ein Fehler ist aufgetreten:\n" + err.message);
        console.error("Catch block error:", err);
        submitBtn.disabled = false;
        submitBtn.innerText = 'Antworten senden';
    });
});


</script>
@endsection
