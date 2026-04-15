<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/Images/website.png')}}">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
    <!-- Preload critical resources -->
    <!--<link rel="preload" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap" as="style">-->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@100..900&display=swap">-->
    
@yield('home_style')
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />    
  
    <!-- CSS -->
    <link rel="stylesheet" href="{{asset('assets/css/style.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
 <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
 
    <!--<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">-->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick-theme.css">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css">
    



    <!-- JS (defer loading) -->
    <script defer src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    <script defer src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
</head>
<style>
    .modal-backdrop.show {
    opacity: 0;
    z-index: -1;
}
</style>
<body class="text-center">
    <div class="wrapper">

<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight"
     aria-labelledby="offcanvasRightLabel" data-bs-scroll="true">
    
    
        <div class="offcanvas-header">
          <h5 class="offcanvas-title" id="offcanvasRightLabel"></h5>
          <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
     <div class="main-menu">
<button onclick="window.location='{{route('workshops')}}'" >
    <h3>
        {{ trans('general.Workshops') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>
<button onclick="window.location='{{route('travel-mobility')}}'" >
    <h3>
        {{ trans('general.Travel_Mobility') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>
<button onclick="window.location='{{route('affiliate-programs')}}'" >
    <h3>
        {{ trans('general.Affiliate_Offers') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>


<button onclick="window.location='{{route('forum.web')}}'" >
    <h3>
{{ trans('general.Forum') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>



<button onclick="window.location='{{route('career.web')}}'" >
    <h3>
        {{ trans('general.Career_Jobs') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>

<button onclick="window.location='{{route('account.meet')}}'" >
    <h3>
        Treffen
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>
<button onclick="window.location='/'" >
    <h3>
        {{ trans('general.AI_Integration') }}
    </h3>
    <svg aria-hidden="true" focusable="false" viewBox="0 0 24 24" role="img" width="24px" height="24px" fill="none"><path stroke="currentColor" stroke-width="1.5" d="M8.474 18.966L15.44 12 8.474 5.033"></path></svg>
</button>


     </div>
     <div class="sign-in-buttons">
        <a href="{{url('account/register')}}">{{ trans('auth.register') }}</a>
     </div>
        </div>
      </div>
@include('layout.header')
<main class="content">

@yield('content') 
</main>

@include('layout.footer')
</div>

<script src="https://unpkg.com/boxicons@2.1.4/dist/boxicons.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
  
    <!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"-->
    <!--    integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"-->
    <!--    crossorigin="anonymous"></script>-->
       
    <script src="{{asset('assets/js/script.js')}}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/wow/1.1.2/wow.min.js" integrity="sha512-Eak/29OTpb36LLo2r47IpVzPBLXnAMPAVypbSZiZ4Qkf8p/7S/XRG5xp7OKWPPYfJT6metI+IORkR5G8F900+g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script>
        new WOW().init();
        const video = document.getElementById("video-background");
  video.playbackRate = 0.8;
  function openmenu(){
    document.querySelector('.respo-header').classList.toggle('active');
  }
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).on('click', '#pagination a', function (event) {
    event.preventDefault();

    var url = $(this).attr('href');

    $.ajax({
        url: url,
        type: 'GET',
        dataType: 'json',
        success: function (data) {
            $('#posts-container').empty();
            $('#posts-container').append(data.products); 

            $('#pagination').html(data.pagination);
        },
        error: function (xhr, status, error) {
            console.error(xhr);
        },
        complete: function () {

            $('.preloaders.loader').css('display', 'none');
        }
    });
});
</script>
<script>
  (function(){
    const btn = document.getElementById('offcanvasToggle');
    const ocEl = document.getElementById('offcanvasRight');
    if (!btn || !ocEl) return;

    // get/create instance
    const oc = bootstrap.Offcanvas.getOrCreateInstance(ocEl);

    // helper cleanup
    function cleanup() {
      document.querySelectorAll('.offcanvas-backdrop, .modal-backdrop').forEach(el => el.remove());
      document.body.classList.remove('modal-open','offcanvas-open');
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
    btn.addEventListener('click', function(e){
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
    document.addEventListener('click', function(ev){
      const back = document.querySelector('.offcanvas-backdrop');
      if (back && (ev.target === back || back.contains(ev.target))) {
        ev.stopPropagation();
      }
    }, true);

  })();
</script>


@yield('script')

</body>



</html>