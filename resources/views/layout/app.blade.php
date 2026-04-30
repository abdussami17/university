<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/Images/website.png')}}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;800;900&family=Barlow:wght@400;500;600;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <!-- Bootstrap 5 (grid only) -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap-grid.min.css" />

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/design/css/components.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/design/css/style.css') }}" />


    @stack('styles')
</head>

<body class="text-center">
    <div class="wrapper">

        
        @include('layout.header')
        <main class="content">

            @yield('content')
        </main>

        @include('layout.footer')
    </div>
  <!-- ════════════════════════════════════════
       CHAT BUBBLE (fixed)
  ════════════════════════════════════════ -->
<!-- ProAI Coach Chat Popup -->
<style>
  .pcw-overlay {
    position: fixed;
    bottom: 24px;
    right: 24px;
    z-index: 9999;
    display: flex;
    flex-direction: column;
    align-items: flex-end;
    gap: 12px;

    pointer-events: none; /* 🔥 KEY FIX */
}

/* sirf clickable elements ko enable karo */
.pcw-bubble,
.pcw-popup {
    pointer-events: auto;
}
    .pcw-bubble{width:56px;height:56px;border-radius:50%;background:#5046e5;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#fff;transition:transform 0.2s,background 0.2s;box-shadow:0 4px 16px rgba(80,70,229,0.35);flex-shrink:0}
    .pcw-bubble:hover{background:#3d34c7;transform:scale(1.05)}
    .pcw-bubble svg{width:26px;height:26px}
    .pcw-popup{width:340px;max-width:calc(100vw - 48px);background:#fff;border-radius:16px;border:0.5px solid rgba(0,0,0,0.08);overflow:hidden;transform-origin:bottom right;transition:transform 0.25s cubic-bezier(0.34,1.56,0.64,1),opacity 0.2s;transform:scale(0.85);opacity:0;pointer-events:none;box-shadow:0 8px 32px rgba(0,0,0,0.12)}
    .pcw-popup.pcw-open{transform:scale(1);opacity:1;pointer-events:all}
    .pcw-header{background:#fff;padding:14px 16px;display:flex;align-items:center;gap:12px;border-bottom:0.5px solid rgba(0,0,0,0.08)}
    .pcw-avatar{width:40px;height:40px;border-radius:50%;background:#ededfd;display:flex;align-items:center;justify-content:center;flex-shrink:0}
    .pcw-avatar svg{width:22px;height:22px;color:#6c63e0}
    .pcw-header-info{flex:1}
    .pcw-header-name{font-size:14px;font-weight:600;color:#111;letter-spacing:0.04em;text-transform:uppercase;font-family:inherit}
    .pcw-header-status{display:flex;align-items:center;gap:5px;font-size:12px;color:#777;font-family:inherit}
    .pcw-dot{width:7px;height:7px;border-radius:50%;background:#22c55e;flex-shrink:0}
    .pcw-close-btn{background:none;border:none;cursor:pointer;color:#888;padding:4px;display:flex;border-radius:6px;transition:background 0.15s}
    .pcw-close-btn:hover{background:#f0f0f0}
    .pcw-close-btn svg{width:18px;height:18px}
    .pcw-body{padding:28px 20px 20px;background:#fff}
    .pcw-icon-wrap{text-align:center;margin-bottom:12px}
    .pcw-sparkle{width:36px;height:36px;color:#8a82e8}
    .pcw-prompt{text-align:center;font-size:13px;font-weight:600;letter-spacing:0.08em;color:#888;margin-bottom:20px;text-transform:uppercase;font-family:inherit}
    .pcw-chips{display:grid;grid-template-columns:1fr 1fr;gap:10px;margin-bottom:24px}
    .pcw-chip{background:#fff;border:1px dashed #c5c1f0;border-radius:8px;padding:14px 10px;font-size:11px;font-weight:600;letter-spacing:0.06em;text-transform:uppercase;color:#222;cursor:pointer;text-align:center;transition:background 0.15s,border-color 0.15s;line-height:1.3;font-family:inherit}
    .pcw-chip:hover{background:#f0effd;border-color:#8a82e8}
    .pcw-input-row{display:flex;align-items:center;gap:8px;border-top:0.5px solid rgba(0,0,0,0.08);padding-top:16px}
    .pcw-input{flex:1;border:none;outline:none;background:transparent;font-size:14px;color:#222;font-family:inherit}
    .pcw-input::placeholder{color:#aaa}
    .pcw-send{width:42px;height:42px;border-radius:8px;background:#5046e5;border:none;cursor:pointer;display:flex;align-items:center;justify-content:center;color:#fff;flex-shrink:0;transition:background 0.15s}
    .pcw-send:hover{background:#3d34c7}
    .pcw-send svg{width:18px;height:18px}
    
    @media(max-width:480px){
      .pcw-overlay{bottom:16px;right:16px}
      .pcw-popup{width:calc(100vw - 32px);max-width:340px}
    }
    </style>
    
    <div class="pcw-overlay">
      <!-- Popup -->
      <div class="pcw-popup" id="pcwPopup" role="dialog" aria-label="ProAI Coach Chat">
        <div class="pcw-header">
          <div class="pcw-avatar">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <rect x="3" y="8" width="18" height="11" rx="3"/>
              <path d="M8 8V6a4 4 0 0 1 8 0v2"/>
              <circle cx="9" cy="13.5" r="1" fill="currentColor"/>
              <circle cx="15" cy="13.5" r="1" fill="currentColor"/>
              <path d="M9 16.5s1 1.5 3 1.5 3-1.5 3-1.5"/>
            </svg>
          </div>
          <div class="pcw-header-info">
            <div class="pcw-header-name">ProAI Coach</div>
            <div class="pcw-header-status"><span class="pcw-dot"></span>Online</div>
          </div>
          <button class="pcw-close-btn" id="pcwClose" aria-label="Close chat">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
            </svg>
          </button>
        </div>
        <div class="pcw-body">
          <div class="pcw-icon-wrap">
            <svg class="pcw-sparkle" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5">
              <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904 9 18.75l-.813-2.846a4.5 4.5 0 0 0-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 0 0 3.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 0 0 3.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 0 0-3.09 3.09Z"/>
              <path stroke-linecap="round" stroke-linejoin="round" d="M18.259 8.715 18 9.75l-.259-1.035a3.375 3.375 0 0 0-2.455-2.456L14.25 6l1.036-.259a3.375 3.375 0 0 0 2.455-2.456L18 2.25l.259 1.035a3.375 3.375 0 0 0 2.456 2.456L21.75 6l-1.035.259a3.375 3.375 0 0 0-2.456 2.456Z"/>
            </svg>
          </div>
          <div class="pcw-prompt">Wie kann ich dir helfen?</div>
          <div class="pcw-chips">
            <button class="pcw-chip">Lernplan erstellen</button>
            <button class="pcw-chip">Karriere-Tipps</button>
            <button class="pcw-chip">Finanz-Hacks</button>
            <button class="pcw-chip">Bewerbungshilfe</button>
          </div>
          <div class="pcw-input-row">
            <input class="pcw-input" type="text" placeholder="Schreibe eine Nachricht..." id="pcwInput" />
            <button class="pcw-send" aria-label="Send message">
              <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 12 3.269 3.125A59.769 59.769 0 0 1 21.485 12 59.768 59.768 0 0 1 3.269 20.875L5.999 12Zm0 0h7.5"/>
              </svg>
            </button>
          </div>
        </div>
      </div>
    
      <!-- Chat Bubble Trigger -->
      <button class="chat-bubble pcw-bubble" id="pcwBubble" aria-label="Open live chat">
        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
          <path stroke-linecap="round" stroke-linejoin="round" d="M8.625 9.75a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H8.25m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0H12m4.125 0a.375.375 0 1 1-.75 0 .375.375 0 0 1 .75 0Zm0 0h-.375m-13.5 3.01c0 1.6 1.123 2.994 2.707 3.227 1.087.16 2.185.283 3.293.369V21l4.184-4.183a1.14 1.14 0 0 1 .778-.332 48.294 48.294 0 0 0 5.83-.498c1.585-.233 2.708-1.626 2.708-3.228V6.741c0-1.602-1.123-2.995-2.707-3.228A48.394 48.394 0 0 0 12 3c-2.392 0-4.744.175-7.043.513C3.373 3.746 2.25 5.14 2.25 6.741v6.018Z" />
        </svg>
      </button>
    </div>
    
    <script>
    (function(){
      const bubble = document.getElementById('pcwBubble');
      const popup  = document.getElementById('pcwPopup');
      const closeBtn = document.getElementById('pcwClose');
      const chips  = document.querySelectorAll('.pcw-chip');
      const input  = document.getElementById('pcwInput');
    
      function openPopup(){
        popup.classList.add('pcw-open');
        bubble.style.display = 'none';
      }
      function closePopup(){
        popup.classList.remove('pcw-open');
        bubble.style.display = 'flex';
      }
    
      bubble.addEventListener('click', openPopup);
      closeBtn.addEventListener('click', closePopup);
    
      chips.forEach(function(chip){
        chip.addEventListener('click', function(){
          input.value = chip.textContent.trim();
          input.focus();
        });
      });
    
      input.addEventListener('keydown', function(e){
        if(e.key === 'Enter' && input.value.trim()){
          // Hook your message handler here
          console.log('Send:', input.value.trim());
          input.value = '';
        }
      });
    
      document.querySelector('.pcw-send').addEventListener('click', function(){
        if(input.value.trim()){
          // Hook your message handler here
          console.log('Send:', input.value.trim());
          input.value = '';
        }
      });
    })();
    </script>
  
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" -->
        <!--    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
        -->
    <!--    crossorigin="anonymous"></script>-->

    {{-- <script src="{{ asset('assets/js/script.js') }}"></script> --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js"
        integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    {{-- <script>
        new WOW().init();
        const video = document.getElementById("video-background");
        video.playbackRate = 0.8;

        function openmenu() {
            document.querySelector('.respo-header').classList.toggle('active');
        }
    </script> --}}
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).on('click', '#pagination a', function(event) {
            event.preventDefault();

            var url = $(this).attr('href');

            $.ajax({
                url: url,
                type: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#posts-container').empty();
                    $('#posts-container').append(data.products);

                    $('#pagination').html(data.pagination);
                },
                error: function(xhr, status, error) {
                    console.error(xhr);
                },
                complete: function() {

                    $('.preloaders.loader').css('display', 'none');
                }
            });
        });
    </script>
    <script>
        (function() {
            const btn = document.getElementById('offcanvasToggle');
            const ocEl = document.getElementById('offcanvasRight');
            if (!btn || !ocEl) return;

            // get/create instance
            const oc = bootstrap.Offcanvas.getOrCreateInstance(ocEl);

            // helper cleanup
            function cleanup() {
                document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop').forEach(el => el.remove());
                document.body.classList.remove('modal-open', 'offcanvas-open');
                document.body.style.overflow = '';
                document.body.style.paddingRight = '';
            }

            // Disable button during transition to avoid race conditions
            function disableBtnShort(duration = 400) {
                btn.disabled = true;
                setTimeout(() => btn.disabled = false, duration);
            }

            // Keep track of transition state (optional but safer)
            let inTransition = false;

            ocEl.addEventListener('show.bs.offcanvas', () => {
                inTransition = true;
                disableBtnShort(500); // disable while showing
                // remove stray backdrops if any
                document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop').forEach(el => el.remove());
            });

            ocEl.addEventListener('shown.bs.offcanvas', () => {
                inTransition = false;
                // ensure body state ok
                document.body.classList.add('offcanvas-open');
            });

            ocEl.addEventListener('hide.bs.offcanvas', () => {
                inTransition = true;
                disableBtnShort(500); // disable while hiding
            });

            ocEl.addEventListener('hidden.bs.offcanvas', () => {
                inTransition = false;
                cleanup();
            });

            // Toggle logic: if visible -> hide(), else show()
            btn.addEventListener('click', function(e) {
                e.stopPropagation();

                // If in the middle of show/hide animation, ignore clicks
                if (inTransition) return;

                const isOpen = ocEl.classList.contains('show'); // Bootstrap adds 'show' class when visible

                if (isOpen) {
                    oc.hide();
                } else {
                    // cleanup any stray leftovers, then show
                    cleanup();
                    oc.show();
                }
            });

            // Prevent backdrop click from propagating to underlying elements
            document.addEventListener('click', function(ev) {
                const back = document.querySelector('.offcanvas-backdrop');
                if (back && (ev.target === back || back.contains(ev.target))) {
                    ev.stopPropagation();
                }
            }, true);

        })();
    </script>
      <script src="https://unpkg.com/lucide@latest"></script>
    <script src="{{ asset('assets/design/js/main.js') }}"></script>
@stack('script')
    @yield('script')


</body>



</html>
