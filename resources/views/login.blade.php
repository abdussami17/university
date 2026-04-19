<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Images/website.png') }}">
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@700;800;900&family=Barlow:wght@600;700&family=Inter:wght@400;500;600;700;800&display=swap"
        rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@100..900&display=swap" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Bootstrap Grid only -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('assets/design/css/components.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/design/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/design/css/login.css') }}">


    <title>{{ trans('general.University') }}</title>
</head>

<body>
    @if (Session::has('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
      {{ Session::get('success') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif
  
  @if (Session::has('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
      {{ Session::get('error') }}
      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
  @endif


    <div class="login-page">

     


        <!-- ── LEFT PANEL ── -->
        <div class="login-left">
            <!-- Logo -->
            <div class="login-left__logo">
                <i data-lucide="graduation-cap" style="height: 22px;width: 22px;"></i>
                ProAISkill
            </div>

            <!-- Content -->
            <div class="login-left__content">
                <span class="label-tag">Member Access</span>
                <h1 class="login-left__headline">Unlock Your Full Potential.</h1>
                <p class="login-left__sub">
                    Join the ProAISkill elite and get tools that will radically accelerate your studies and career.
                </p>

                <div class="login-left__features">
                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <i data-lucide="check" style="width:14px;height:14px;"></i>
                        </div>
                        AI Skill Coach (Personalized)
                    </div>

                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <i data-lucide="check" style="width:14px;height:14px;"></i>
                        </div>
                        100+ Partner Deals & Benefits
                    </div>

                    <div class="feature-item">
                        <div class="feature-item__icon">
                            <i data-lucide="check" style="width:14px;height:14px;"></i>
                        </div>
                        Exclusive Lookbook & Community
                    </div>
                </div>
            </div>
        </div>

        <!-- ── RIGHT PANEL ── -->
        <div class="login-right">
            <div class="login-form-container">

                <h1>Login</h1>
                <p class="form-subtitle">Enter your details or use the demo access.</p>

                <form id="loginForm" action="{{ route('account.authenticate') }}" method="post">
                    @csrf
                    <!-- Email -->
                    <div class="form-group">
                        <label class="form-label" for="email">{{ trans('auth.email') }}</label>
                        <input type="text" id="email" name="email" value="{{ old('email') }}"
                            class="form-control @error('email') is-invalid  @enderror"
                            placeholder="{{ trans('auth.enter_email') }}" autocomplete="email" />
                        @error('email')
                            <div class="error" id="emailError">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div class="form-group">
                        <label class="form-label" for="password">{{ trans('auth.password') }}</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid  @enderror"
                            placeholder="{{ trans('auth.enter_password') }}" autocomplete="current-password" />
                        @error('password')
                            <div class="error" id="passwordError">{{ $message }}</div>
                        @enderror
                    </div>
                    <!-- Checkbox -->
                    <div class="form-check ps-0">
                        <input type="checkbox" id="remember" />
                        <label for="remember">{{ trans('auth.remember_me') }}</label>
                    </div>

                    <!-- Login Button -->
                    <button type="submit" class="btn btn-primary">{{ trans('auth.sign_in') }}</button>


                    <div class="divider"></div>

                    <!-- Learning Style Section -->
                    <span class="section-label-text">Personalization</span>
                    <div class="section-heading">Your preferred learning style</div>

                    <div class="row g-2" style="margin-bottom: 8px;">

                        <div class="col-6">
                            <div class="learning-box active" onclick="selectBox(this)">
                                <div class="icon">
                                    <i data-lucide="video" style="width:30px;height:30px;"></i>
                                </div>
                                <div class="title">Visual (videos)</div>
                                <div class="text-muted small">Learning through dynamic explanations</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="learning-box" onclick="selectBox(this)">
                                <div class="icon">
                                    <i data-lucide="book-open" style="width:30px;height:30px;"></i>
                                </div>
                                <div class="title">Text-based</div>
                                <div class="text-muted small">Learning through reading and understanding</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="learning-box" onclick="selectBox(this)">
                                <div class="icon">
                                    <i data-lucide="brain" style="width:30px;height:30px;"></i>
                                </div>
                                <div class="title">Interactive<br>(exercises)</div>
                                <div class="text-muted small">Learning through active<br>application</div>
                            </div>
                        </div>

                        <div class="col-6">
                            <div class="learning-box" onclick="selectBox(this)">
                                <div class="icon">
                                    <i data-lucide="rocket" style="width:30px;height:30px;"></i>
                                </div>
                                <div class="title">Fast Track<br>(Efficiency)</div>
                                <div class="text-muted small">Learning for the<br>turbo boost</div>
                            </div>
                        </div>

                    </div>

                    <div class="divider"></div>

                    <!-- Social Login -->
                    <div style="display:flex; flex-direction:column; gap:var(--sp-3); margin-bottom: var(--sp-4);">
                        <div style="display:flex; gap: var(--sp-3);">
                            <a href="{{ route('register.google') }}" style="flex:1;">
                                <button class="social-btn" type="button">
                                    <i class="fa-brands fa-google"></i> Google
                                </button>
                            </a>
                            <a href="{{ route('register.facebook') }}" style="flex:1;">
                                <button class="social-btn" type="button">
                                    <i class="fa-brands fa-facebook"></i> Facebook
                                </button>
                            </a>
                        </div>
                        <a href="{{ route('github.login') }}">
                            <button type="button" class="social-btn">
                                <i class="fa-brands fa-github"></i> GitHub
                            </button>
                        </a>
                    </div>

                </form>
                <!-- Notice -->
                <div class="notice-box">
                    🌟 <strong>Great! Almost there!</strong> Just this one more step and your personal learning path is
                    ready to go! You can adjust these settings later at any time in your profile.
                </div>

                <!-- Footer -->
                <div class="login-footer">
                    <p><a href="{{ route('account.register') }}">{{ trans('auth.no_account') }}?</a></p>
                </div>
                <a href="{{ url('/') }}" class="skip-link">
                    <i data-lucide="arrow-left" style="width:14px;height:14px;"></i>
                    <span>Zurück zur Startseite (Überspringen)</span>
                </a>

            </div>
        </div>

    </div>





    <script src="https://unpkg.com/lucide@latest"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('assets/design/js/main.js') }}"></script>
</body>

</html>
