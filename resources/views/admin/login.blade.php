<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

{{--    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="assets/account/fonts/icomoon/style.css">
    <link rel="stylesheet" href="assets/account/css/owl.carousel.min.css">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/account/css/bootstrap.min.css">
    <!-- Style -->
    <link rel="stylesheet" href="assets/account/css/style.css">
    <link rel="icon" type="image/x-icon" href="assets/account/images/logo23.png">--}}
    
    <link rel="icon" type="image/x-icon" href="{{asset('assets/Images/website.png')}}">
    
          <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600;700&display=swap" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="{{asset('new_asset/style/style.css')}}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


    <title>{{ trans('general.University') }}</title>
  </head>
   <body class="pt-4 pb-4">

    <div class="onboarding-wrapper bg-white p-4 rounded shadow-sm">
        <div class="text-center mb-3">
          <img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&pid=ImgDetMain&cb=idpwebpc2" class="rounded-img mb-2 border-1 border text-center" alt="Profile">
          <h5 >Willkommen bei Proaiskill!</h5>
          <p class=" mb-4" >
            Erzähl uns ein wenig über dich, damit die KI dir ein Starter-Paket mit Inhalten,<br>
            Finanztipps und Mentoring-Vorschlägen zusammenstellen kann.
          </p>
        </div>
    
        @if(Session::has('success'))
        <div class="alert alert-success">{{Session::get('success')}}</div>
        @endif
        @if(Session::has('error'))
        <div class="alert alert-danger">{{Session::get('error')}}</div>
        @endif
        <form id="loginForm"  action="{{route('admin.authenticate')}}" method="post">
          @csrf
          <div class="row g-3 mb-3">
            <div class="col-md-6">
                <div class="form-group">
                    <label for="email">{{ trans('auth.email') }}</label>
                    <input 
                        type="text" 
                        id="email" 
                        name="email"  value="{{old('email')}}" class="form-control @error('email') is-invalid  @enderror"
                        placeholder="{{ trans('auth.enter_email') }}"
                        autocomplete="email"
                    >
                    @error('email')
                    <div class="error" id="emailError">{{$message}}</div>
                    @enderror
                   
                </div>
                
            </div>
            <div class="col-md-6">


            <div class="form-group">
                <label for="password">{{ trans('auth.password') }}</label>
                <input 
                    type="password" 
                    id="password" 
                    name="password" 
                    class="form-control @error('password') is-invalid  @enderror"
                    placeholder="{{ trans('auth.enter_password') }}"
                    autocomplete="current-password"
                >
                @error('password')
                <div class="error" id="passwordError">{{$message}}</div>
                @enderror
            </div>
            
            </div>
            
            
                          <div class="mb-4">
            <label class="form-label">Dein bevorzugter Lernstil</label>
            <div class="row g-2">
              <div class="col-6 col-md-3">
                <div class="learning-box active" onclick="selectBox(this)">
                  <div class="icon">
                    <i class="fa-solid fa-camera"></i>
                  </div>
                  <div class="title">Visuell (Videos)</div>
                  <div class="text-muted small">Lernen durch dynamische Erklärungen</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="learning-box" onclick="selectBox(this)">
                  <div class="icon">
                    <i class="fa-solid fa-book-open"></i>

                  </div>
                  <div class="title">Textbasiert</div>
                  <div class="text-muted small">Lernen durch Lesen und Verstehen</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="learning-box" onclick="selectBox(this)">
                  <div class="icon">
                    <i class="fa-solid fa-brain"></i>
                  </div>
                  <div class=" title">Interaktiv<br>
                    (Übungen)</div>
                  <div class="text-muted small"> Lernen durch aktives<br>
                    Anwenden</div>
                </div>
              </div>
              <div class="col-6 col-md-3">
                <div class="learning-box" onclick="selectBox(this)">
                  <div class="icon">
                    <i class="fa-solid fa-rocket"></i>
                  </div>
                  <div class=" title">Fast Track<br> (Effizienz) </div>
                  <div class="text-muted small">Lernen für den<br>
                    Turbo-Boost</div>
                </div>
              </div>
            </div>
          </div>
          
            <button type="submit" class="btn onboard-button w-100 mb-0" id="loginButton">
                Onboarding abschließen & Starter-Paket erhalten
            </button>

        <a href="{{route('home')}}">
        <button class="btn Zurück-btn hover-greeen w-100 mb-0">← Zurück zur Startseite (Überspringen)</button>            
        </a>
        
        </form>

        
      </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
