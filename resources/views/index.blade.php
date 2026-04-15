@extends('layout.app')

@section('title', trans('general.University'))

@section('content')

<style>
    .card img{
    width:50%!important;
}
.home-none{
    display: none!important;
}
</style>
@php
if (!function_exists('get_setting')) {
    function get_setting($key, $default = null, $lang = false)
    {
 
        $settings = Cache::remember('Setting', 2, function () {
            return App\Models\Setting::all();
        });

        if ($lang == false) {
            $setting = $settings->where('type', $key)->first();
            
        } else {
            $setting = $settings->where('type', $key)->where('lang', $lang)->first();
            $setting = !$setting ? $settings->where('type', $key)->first() : $setting;
        }
        return $setting == null ? $default : $setting->value;
    }
}
@endphp


<style>
    .others-footer
    {
        display:none;
    }
</style>
<!-- Heading & Subtext -->
  <h1 class="main-heading">Dein smarter KI-Coach für Studium &amp;<br> Karrierme</h1>
  <p class="sub-heading">Lernen, wachsen, durchstarten – mit nur einer App, die dich versteht und<br> unterstützt.</p>

  <!-- Buttons Area -->
  <div class="d-flex justify-content-center flex-wrap mb-4">
    <a href="{{url('account/login')}}"><button class="btn btn-custom btn-primary-custom">Kostenlos starten <i class="fa-solid fa-arrow-right"></i></button></a>
    <a href="#funktionenSection"><button class="btn btn-custom btn-outline-custom"><i class="fa-brands fa-react"></i> Funktionen entdecken</button></a>
  </div>

  <div class="container">
@php
    $ext = strtolower(pathinfo($data->mainbanner, PATHINFO_EXTENSION));
@endphp

<video autoplay loop playsinline muted 
    style="max-width:100%; height:200px; display: {{ in_array($ext, ['mp4', 'webm', 'ogg']) ? 'block' : 'none' }};">
    <source src="{{ asset($data->mainbanner) }}" type="video/mp4">
    Your browser does not support the video tag.
</video>

<img src="{{ asset($data->mainbanner) }}" class="main-img"
     style="
            {{ in_array($ext, ['jpg', 'jpeg', 'png', 'webp', 'avif']) 
                ? 'display: block; margin: auto;' 
                : 'display: none;' }}">


  </div>



  <!-- Section 2: Was Proaiskill dir schenkt -->
<section class="py-5 mt-5 section-change">
    <div class="container text-center">
      <h2 class="fw-semibold mb-5" style="color: rgb(56, 59, 66); font-size:2.125rem;">
        {{$data->firstsection_title}}
      </h2>
  
      <div class="row justify-content-center">
        <!-- Card 1 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm border-0 p-4 rounded-2">
            <div class="icon">
                <i class="fa-solid fa-brain"></i>
            </div>
            <h5 class="fw-semibold">{{$data->firstsection_box1_title}}</h5>
            <p class="text-muted small">{!!$data->firstsection_box1_description!!}</p>
            <div class="img-box">
                    <img src="{{asset($data->firstsection_box1_image)}}" alt="{{$data->firstsection_title}}">
            </div>
          
          </div>
        </div>
  
        <!-- Card 2 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm border-0 p-4 rounded-2">
         <div class="icon">
            <i class="fa-regular fa-message"></i>
         </div>
            <h5 class="fw-semibold">{{$data->firstsection_box2_title}}</h5>
            <p class="text-muted small">{!!$data->firstsection_box2_description!!}</p>
            <div class="img-box">
                    <img src="{{asset($data->firstsection_box2_image)}}" alt="{{$data->firstsection_box2_title}}">
            </div>
          </div>
        </div>
  
        <!-- Card 3 -->
        <div class="col-md-4 mb-4">
          <div class="card h-100 shadow-sm border-0 p-4 rounded-2">
            <div class="icon">
                <i class="fa-solid fa-piggy-bank"></i>
            </div>
            <h5 class="fw-semibold">{{$data->firstsection_box3_title}}</h5>
            <p class="text-muted small">{!!$data->firstsection_box3_description!!}</p>
            <div class="img-box">
                    <img src="{{asset($data->firstsection_box3_image)}}" alt="{{$data->firstsection_box3_title}}">
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
  

<!-- Section 3: App Preview  -->
<section id="funktionenSection" class="py-5  sectionchange-3">
    <h2 class="fw-semibold mb-5" style="color: rgb(56, 59, 66); font-size:2.125rem;">
{{$data->secondsection_title}}
      </h2>
    <div class="container d-flex justify-content-center">

      <div style="box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;" class="bg-white rounded-2  px-4 py-5 position-relative border-box-custom" style="max-width: 100%; width: 100%;">
  
        <!-- Top Info Text -->
        <p class="text-muted text-center mb-4" style="font-size: 0.95rem;">
            {!!$data->secondsection_box1_description!!}
        </p>
  
        <!-- Button Row -->
        <div class="d-flex flex-wrap justify-content-center gap-3 mb-5">
          <button class="btn btn-light px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
            <i class="fa-brands fa-react"></i> {{$data->secondsection_box1_title}}
          </button>
          <button class="btn btn-light px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
            <i class="fa-brands fa-react"></i> {{$data->secondsection_box2_title}}
          </button>
          <button class="btn btn-light px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
            <i class="fa-brands fa-react"></i> {{$data->secondsection_box3_title}}
          </button>
          <button class="btn btn-light px-4 py-2 rounded-pill shadow-sm d-flex align-items-center gap-2">
            <i class="fa-brands fa-react"></i> {{$data->thirdsection_title}}
          </button>
        </div>
  
        <!-- Main Preview Image -->
        <div class="text-center placeholder-img ">
                    <img src="{{asset($data->secondsection_box1_image)}}" alt="{{$data->secondsection_box1_title}}">
        </div>
  
      </div>
    </div>
  </section>
  
  
  <!-- <section-5></section-5> -->
  <section class="py-5  section-5">
    <h2 class="fw-semibold mb-5" style="color: rgb(56, 59, 66); font-size:2.125rem;">
        {{$data->thirdsection_box1_title}}
      </h2>
    <div class="container d-flex justify-content-center">

      <div class="bg-white rounded-2  px-4 py-5 position-relative border-box-custom" style="max-width: 80%; width: 100%; box-shadow: rgba(0, 0, 0, 0.16) 0px 1px 4px;">
  
        <!-- Top Info Text -->
        
  
    
  
        <!-- Main Preview Image -->
        <div class="text-center placeholder-img ">
                    <img src="{{asset($data->thirdsection_box1_image)}}" alt="{{$data->secondsection_box1_title}}">
        </div>
        <p class="text-muted text-center mb-0 mt-4" style="font-size: 0.95rem;">
   {!!$data->thirdsection_box1_description!!}
          </p>
      </div>
    </div>
  </section>
<!-- <section-4></section-4> -->


<section class="section-4 py-5 bg-transparent">
    <h2 class="fw-semibold mb-5" style="color: rgb(56, 59, 66); font-size:2.125rem;">
        Entdecke die Power-Funktionen, die dich lieben werden
    </h2>
    <div class="container">
        <div class="row g-4 justify-content-center">
            @for ($i = 1; $i <= 3; $i++)
                @php
                    $image = get_setting('header_logo' . $i);
                    $title = get_setting('testimonial' . $i . '_title');
                    $designation = get_setting('testimonial' . $i . '_designation');
                    $description = get_setting('testimonial' . $i . '_description');
                @endphp

                @if ($title || $description)
                    <div class="col-md-4 col-sm-6">
                        <div class="testimonial-box">
                            <img src="{{ $image ? asset('website/websitedata/' . $image) : 'https://via.placeholder.com/100' }}" alt="{{ $title }}" class="testimonial-img">
                            <div class="testimonial-content">
                                <h6>{{ $title }}</h6>
                                <small>{{ $designation }}</small>
                                <p>{{ $description }}</p>
                            </div>
                        </div>
                    </div>
                @endif
            @endfor
        </div>

        <div class="cta-box mt-5 text-center">
            <h4>Bereit, dein Studium neu zu erleben?</h4>
            <p>Registriere dich kostenlos – und sichere dir <strong>12 Monate Zugriff</strong> auf Premium-Tools,<br>die dein Leben einfacher und erfolgreicher machen!</p>
            <button class="cta-btn">Jetzt kostenlos durchstarten & lieben lernen!</button>
        </div>
    </div>
</section>

  
{!!get_setting('frontend_footer')!!}


{{--<section class="main-section">
            <video autoplay loop playsinline muted >
                             <source src="{{$data->mainbanner}}" type="video/mp4">
           
               
                {{ trans('general.not_supported') }}
              </video>
        </section>

        <section class="heading-container">
            <h2 class="professional-heading main-heading">{{$data->firstsection_title}}</h2>
          </section>
          <style>
   /* Container for heading */
.heading-container {
  display: flex;
  justify-content: center; /* Center horizontally */
  align-items: center; /* Center vertically */
  height: 150px; /* Adjust the height */
  background-color: #f5f5f5; /* Light background for contrast */
}

/* Professional heading styling */
.professional-heading {
  font-size: 32px; /* Adjust the font size */
  font-weight: bolder; /* Make it even bolder */
  color: #212121; /* Professional dark gray color */
  text-transform: none; /* Remove uppercase transformation */
  letter-spacing: 2px; /* Add spacing between letters */
  text-align: center; /* Center align the text */
  position: relative; /* Enable pseudo-element positioning */
  margin: 0; /* Remove default margins */
}

/* Decorative underline */




</style>
<section class="image-slider-container">
            <div class="cards-container">
                <div class="card">
                    <img src="{{asset($data->firstsection_box1_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->firstsection_box1_title}}</h2>
                        <p>{!!$data->firstsection_box1_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->firstsection_box2_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->firstsection_box2_title}}</h2>
                        <p>{!!$data->firstsection_box2_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->firstsection_box3_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->firstsection_box3_title}}</h2>
                        <p>{!!$data->firstsection_box3_description!!}</p>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            /* General styles */
            .image-slider-container {
                padding: 20px;
                background-color: #f9f9f9;
            }
        
            /* Cards container */
            .cards-container {
                display: flex !important;
              justify-content: space-between !important;
                flex-wrap: wrap !important; /* Responsive behavior */
            }
        
  
        
            /* Content below the image */
            .card-content {
                padding: 20px;
                background-color: #fff; /* Background for the content */
                border-radius: 0 0 15px 15px; /* Rounded corners at the bottom */
            }
        
            .card-content h2 {
                font-size: 20px;
                margin: 10px 0;
            }
        
            .card-content p {
                font-size: 16px;
            }
        
            /* Hover effect removal */
            .card:hover {
                transform: none; /* Remove the lift effect */
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1); /* Maintain default shadow */
            }
        
            /* No overlay effect */
            .card-overlay {
                display: none; /* Hide the overlay */
            }
        </style>
                <section class="heading-container">
            <h2 class="professional-heading main-heading">{{$data->secondsection_title}}</h2>
          </section>
          <section class="image-slider-container">
          <div class="cards-container">
                <div class="card">
                    <img src="{{asset($data->secondsection_box1_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->secondsection_box1_title}}</h2>
                        <p>{!!$data->secondsection_box1_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->secondsection_box2_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->secondsection_box2_title}}</h2>
                        <p>{!!$data->secondsection_box2_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->secondsection_box3_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->secondsection_box3_title}}</h2>
                        <p>{!!$data->secondsection_box3_description!!}</p>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            /* General styles */
            .image-slider-container {
                padding: 20px;
                background-color: #f9f9f9;
            }
        
        
        </style>
                <section class="heading-container">
            <h2 class="professional-heading main-heading">{{$data->thirdsection_title}}</h2>
          </section>
          <section class="image-slider-container">
          <div class="cards-container">
                <div class="card">
                    <img src="{{asset($data->thirdsection_box1_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->thirdsection_box1_title}}</h2>
                        <p>{!!$data->thirdsection_box1_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->thirdsection_box2_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->thirdsection_box2_title}}</h2>
                        <p>{!!$data->thirdsection_box2_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->thirdsection_box3_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->thirdsection_box3_title}}</h2>
                        <p>{!!$data->thirdsection_box3_description!!}</p>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            /* General styles */
            .image-slider-container {
                padding: 20px;
                background-color: #f9f9f9;
            }
        
           
        </style>    
<br>
<section class="heading-container">
    <h2 class="professional-heading main-heading">{{ trans('general.Events') }}</h2>
  </section>
  <br>
<!-- Bootstrap CDN -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

<section class="outter hero-video">
    <section class="video-container">
        <video src="./assets/Workshop Render0001-0266.mp4" autoplay loop playsinline muted></video>

        <!-- Bootstrap Container for Centering -->
        <div class="container" style="padding-top: 25px;">
            <div class="row justify-content-center">
                <div class="col-6 col-md-6 col-lg-6 mb-4"> <!-- 2 columns per row on mobile and desktop -->
                    <div class="box">
                        <h5 class="professional-heading1">{{ trans('general.Career_Development') }}</h5>
                        <p>{{ trans('general.Boost_Career') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-6 mb-4"> <!-- 2 columns per row on mobile and desktop -->
                    <div class="box">
                        <h5 class="professional-heading1">{{ trans('general.Mindset_Stress_Management') }}</h5>
                        <p>{{ trans('general.Master_Challenges') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-6 mb-4"> <!-- 2 columns per row on mobile and desktop -->
                    <div class="box">
                        <h5 class="professional-heading1">{{ trans('general.Financial_Education') }}</h5>
                        <p>{{ trans('general.Become_Finance') }}</p>
                    </div>
                </div>
                <div class="col-6 col-md-6 col-lg-6 mb-4"> <!-- 2 columns per row on mobile and desktop -->
                    <div class="box">
                        <h5 class="professional-heading1">{{ trans('general.Networking_Events') }}</h5>
                        <p>{{ trans('general.Make_Valuable') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<!-- Bootstrap JS and dependencies -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<style>
/* Hero Video Section */
.outter.hero-video {
    width: 100%;
    height: 100%;
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.video-container {
    height: 550px;
    width: 100%;
    position: relative;
    overflow: hidden;
}

video {
    object-fit: cover;
    position: absolute;
    height: 100%;
    width: 100%;
    top: 0;
    left: 0;
}

/* Boxes Section */
.box {
    background-color: rgba(255, 255, 255, 0.7);  /* Semi-transparent background */
    padding: 20px;
    border-radius: 10px;
    text-align: center;
    color: #333;
    box-shadow: 0 4px 6px rgba(0, 0, 0, 0.2);
    height: 220px; /* Fixed height for uniform box height */
    display: flex;
    flex-direction: column;
    justify-content: space-between; /* Ensures text remains spaced evenly */
}

h3 {
    margin-bottom: 10px;
    color: #333;
}

p {
    font-size: 14px;
    color: #555;
    flex-grow: 1; /* Allow text to take available space */
    display: flex;
    justify-content: center;
    align-items: center;
}

/* Mobile responsiveness */
@media (max-width: 768px) {
    .box {
        padding: 15px;
        height: auto; /* Adjust height based on content */
    }
}

/* Extra small screen responsiveness (max-width: 480px) */
@media (max-width: 480px) {
    .box {
        padding: 11px;
        height: auto; /* Auto height to adjust based on content */
    }

    .video-container {
        height: 700px; /* Increased the video height for small screens */
    }

    .button {
        font-size: 14px; /* Adjust button font size for small screens */
        padding: 12px 24px;
    }

    h3 {
        font-size: 16px;
    }

    p {
        font-size: 12px;
    }
}
</style>


<br>
        <section class="heading-container">
            <h2 class="professional-heading main-heading">{{$data->lastsection_title}}</h2>
          </section>
<style>
   /* Container for heading */
.heading-container {
  display: flex;
  justify-content: center; /* Center horizontally */
  align-items: center; /* Center vertically */
  height: 150px; /* Adjust the height */
  background-color: #f5f5f5; /* Light background for contrast */
}

/* Professional heading styling */
.professional-heading {
  font-size: 32px; /* Adjust the font size */
  font-weight: 900; /* Maximum boldness (Roboto's boldest weight) */
  font-family: 'Roboto', sans-serif; /* Roboto font family */
  color: #212121; /* Professional dark gray color */
  text-transform: none; /* Remove uppercase transformation */
  letter-spacing: 2px; /* Add spacing between letters */
  text-align: center; /* Center align the text */
  position: relative; /* Enable pseudo-element positioning */
  margin: 0; /* Remove default margins */
}


/* Decorative underline */



.professional-heading1 {
 
  font-family: 'Roboto', sans-serif; /* Roboto font family */

  text-align: center; /* Center align the text */
  position: relative; /* Enable pseudo-element positioning */
  margin: 0; /* Remove default margins */
}


/* Decorative underline */



</style>
<section class="image-slider-container">
<div class="cards-container">
                <div class="card">
                    <img src="{{asset($data->lastsection_box1_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->lastsection_box1_title}}</h2>
                        <p>{!!$data->lastsection_box1_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->lastsection_box2_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->lastsection_box2_title}}</h2>
                        <p>{!!$data->lastsection_box2_description!!}</p>
                    </div>
                </div>
                <div class="card">
                    <img src="{{asset($data->lastsection_box3_image)}}" alt="Movie 1">
                    <div class="card-content">
                        <h2 class="professional-heading">{{$data->lastsection_box3_title}}</h2>
                        <p>{!!$data->lastsection_box3_description!!}</p>
                    </div>
                </div>
            </div>
        </section>
        
        <style>
            /* General styles */
            .image-slider-container {
                padding: 20px;
                background-color: #f9f9f9;
            }
        
          
        </style>
        

        <section class="container-fluid section-8">
    <div class="container">
        <h2 class="text-center text-white wow animate__animated animate__fadeInUp">{{ trans('general.Success_Path') }}</h2>
        <div class="middle-box">
            <table>
                <thead>
                    <th>{{ trans('general.Simplicity') }}</th>
                    <th>{{ trans('general.Flexibility') }}</th>
                    <th>{{ trans('general.Transparency') }}</th>

                </thead>
                <tbody>
                    <tr>
                        <td>{{ trans('general.Central_Dashboard') }}</td>
                        <td>{{ trans('general.Offers_Workshops') }}</td>
                        <td>{{ trans('general.Clear_Presentation') }}</td>
                    </tr>
                    <tr>
                        <td>{{ trans('general.Intuitive_Navigation') }}</td>
                        <td>{{ trans('general.Access_Resources') }}</td>
                        <td>{{ trans('general.Detailed_Explanations') }}</td>
                    </tr>
                    <tr>
                        <td>{!! trans('general.Quick_Access') !!}</td>
                        <td>{{ trans('general.Mobile_Optimisation') }}</td>
                        <td>{{ trans('general.Regular_Oupdates') }}</td>
                    </tr>
                </tbody>
            </table>
        </div>

    </div>
</section>--}}
@endsection

@section('home_style')
      <link rel="stylesheet" href="{{asset('new_asset/style/style.css')}}">
@endsection