@extends('user.layout')
@section('title', trans('chat assistant'))
@section('content')

<div class="main-section container py-4">
  <div class="mb-4">
    <h4 style="color: rgb(56, 59, 66);" class="mb-1">KI Chat-Assistant</h4>
    <p class="text-muted mb-0">Dein 24/7 Helfer für Studium, Formulare, Jobbewerbungen und Planung.</p>
  </div>

  <!-- Inputs -->
  <div class="form-row row g-3 mb-3">
    <div class="col-md-4">
      <label class="form-label">Wähle eine Persona:</label>
      <select id="persona" class="form-select">
        <option value="Weiser Mentor" selected>Weiser Mentor</option>
        <option value="KI-Experte">KI-Experte</option>
        <option value="Loyaler Buddy">Loyaler Buddy</option>
        <option value="Bürokratie-Held">Bürokratie-Held</option>
      </select>
    </div>

    <div class="col-md-4">
      <label class="form-label">Kursname (optional):</label>
      <input type="text" id="course_name" class="form-control" placeholder="Allgemein">
    </div>

    <div class="col-md-4">
      <label class="form-label">Relevantes Material (optional):</label>
      <input type="text" id="material" class="form-control" placeholder="z.B. Kapitel 3 Skript">
    </div>
  </div>

  <p class="text-muted" style="font-size: 14px;">Frag alles zu deinem Studium, erhalte Hilfe bei Formularen oder plane deine Zeit.</p>

  <!-- Chat Box -->
  <div class="chat-box pop-up border rounded p-3 mb-3 bg-light">
    <strong><i class="bi bi-chat me-1 text-info"></i> Chatte mit Proaiskill Bot (Persona: <span id="selected-persona-text">Weiser Mentor</span>)</strong>
    <span class="chat-description d-block mb-2">Frag alles zu deinem Studium, erhalte Hilfe bei Formularen oder plane deine Zeit.</span>

    <!-- Chat Messages -->
<div id="chat-response-area" class="chat-message-area" style="max-height: 300px; overflow-y: auto;">
  @foreach ($messages as $msg)

      <!-- User Message (right side) -->

<div class="d-flex gap-2 justify-content-end align-items-end mb-2">
        <div class="card shadow-sm p-2 w-50 border-0 bg-primary text-white">
          {{ $msg['user_message'] }}
        </div>
        <img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&pid=ImgDetMain&cb=idpwebpc2" height="30px" width="30px" style="border-radius: 50%;" alt="Bot">
      </div>      

      <!-- Bot Message (left side) -->
      <div class="d-flex gap-2 justify-content-start align-items-end mb-2">
        <img src="{{ asset('new_asset/images/abcd.png') }}" height="30px" width="30px" style="border-radius: 50%;" alt="Bot">
        <div class="card shadow-sm p-2 w-50 border-0">
          {{ $msg['ai_response'] }}
        </div>
      </div>

      
  @endforeach
</div>
<div id="chat-loader" class="text-center my-2 d-none">
  <div class="spinner-border text-primary" role="status" style="width: 1.5rem; height: 1.5rem;"></div>
</div>

    <!-- Suggested Buttons -->
    <div class="suggested-buttons mt-3 d-flex flex-wrap gap-2">
      <button class="btn btn-outline-primary btn-sm quick-btn">Hilf mir beim BAföG-Antrag</button>
      <button class="btn btn-outline-primary btn-sm quick-btn">Erkläre mir Quantenmechanik einfach</button>
      <button class="btn btn-outline-primary btn-sm quick-btn">Wie plane ich meinen Lerntag?</button>
      <button class="btn btn-outline-primary btn-sm quick-btn">Finde passende Jobs für mich</button>
    </div>

    <!-- Chat Input -->
    <div class="chat-input d-flex mt-3">
      <input type="text" id="chat-message" class="form-control border-0" placeholder="Frag mich alles… Wie kann ich dir helfen?">
      <span id="send-chat" class="send-icon ms-2" style="cursor: pointer;"><i class="fa-solid fa-paper-plane"></i></span>
    </div>
  </div>

  <!-- Quick Actions -->
  <h5 class="mt-3">Schnellaktionen:</h5>
  <div class="quick-actions mt-2 d-flex flex-wrap gap-2">
    <button class="btn btn-secondary btn-sm quick-btn">Studienhilfe</button>
    <button class="btn btn-secondary btn-sm quick-btn">Formularhilfe</button>
    <button class="btn btn-secondary btn-sm quick-btn">Zeitplanung</button>
    <button class="btn btn-secondary btn-sm quick-btn">Jobbewerbung</button>
  </div>
</div>
        
@endsection
@section('script')
{{--<script>
document.getElementById('send-chat').addEventListener('click', function () {
  const message = document.getElementById('chat-message').value.trim();
  const persona = document.getElementById('persona').value;
  const course = document.getElementById('course_name').value;
  const material = document.getElementById('material').value;

  if (!message) return;

  const responseArea = document.getElementById('chat-response-area');
  responseArea.innerHTML += `<div class="text-end mb-2"><div class="badge bg-primary">${message}</div></div>`;
  document.getElementById('chat-message').value = '';

  fetch("{{ route('chat.assistant.ask') }}", {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    body: JSON.stringify({ message, persona, course, material })
  })
  .then(res => {
    if (!res.ok) {
      return res.json().then(err => { throw new Error(err.error || 'Server error') });
    }
    return res.json();
  })
  .then(data => {
    responseArea.innerHTML += `<div class="d-flex gap-2 align-items-end mb-2">
      <img src="{{ asset('new_asset/images/abcd.png') }}" width="30" height="30" style="border-radius: 50%;">
      <div class="card shadow-sm p-2 w-50 border-0">${data.response}</div>
    </div>`;
    responseArea.scrollTop = responseArea.scrollHeight;
  })
  .catch(error => {
    console.error("Fetch error:", error.message);
    responseArea.innerHTML += `<div class="text-danger mb-2">⚠️ Error: ${error}</div>`;
  });
});
</script>--}}
<script>
document.getElementById('send-chat').addEventListener('click', function () {
  sendChatMessage();
});

// Handle quick buttons
document.querySelectorAll('.quick-btn').forEach(button => {
  button.addEventListener('click', function () {
    const message = this.textContent.trim();
    sendChatMessage(message);
  });
});

document.getElementById('chat-message').addEventListener('keydown', function (e) {
  if (e.key === 'Enter' && !e.shiftKey) {
    e.preventDefault(); // Prevent new line
    sendChatMessage();
  }
});


function sendChatMessage(customMessage = null) {
  const inputField = document.getElementById('chat-message');
  const message = customMessage || inputField.value.trim();
  const persona = document.getElementById('persona').value;
  const course = document.getElementById('course_name').value;
  const material = document.getElementById('material').value;

  if (!message) return;

  const responseArea = document.getElementById('chat-response-area');
  const loader = document.getElementById('chat-loader');

  // User message
  responseArea.innerHTML += `
    <div class="d-flex gap-2 justify-content-end align-items-end mb-2">
      <div class="card shadow-sm p-2 w-50 border-0 bg-primary text-white">${message}</div>
      <img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&pid=ImgDetMain&cb=idpwebpc2" height="30px" width="30px" style="border-radius: 50%;">
    </div>
  `;
  inputField.value = '';

  // Show loading spinner
  loader.classList.remove('d-none');

  // Scroll to bottom
  setTimeout(() => {
    responseArea.scrollTop = responseArea.scrollHeight;
  }, 100);

  fetch("{{ route('chat.assistant.ask') }}", {
    method: "POST",
    headers: {
      'Content-Type': 'application/json',
      'X-CSRF-TOKEN': "{{ csrf_token() }}"
    },
    body: JSON.stringify({ message, persona, course, material })
  })
  .then(res => {
    if (!res.ok) {
      return res.json().then(err => { throw new Error(err.error || 'Server error') });
    }
    return res.json();
  })
  .then(data => {
    responseArea.innerHTML += `
      <div class="d-flex gap-2 justify-content-start align-items-end mb-2">
        <img src="{{ asset('new_asset/images/abcd.png') }}" width="30" height="30" style="border-radius: 50%;">
        <div class="card shadow-sm p-2 w-50 border-0">${data.response}</div>
      </div>
    `;
  })
  .catch(error => {
    console.error("Fetch error:", error.message);
    responseArea.innerHTML += `<div class="text-danger mb-2">⚠️ Error: ${error}</div>`;
  })
  .finally(() => {
    loader.classList.add('d-none'); // Hide loading spinner
    responseArea.scrollTop = responseArea.scrollHeight; // Scroll to bottom
  });
}
</script>

@endsection