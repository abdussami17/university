<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from zoyothemes.com/hando/html/ecommerce by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2025 13:18:51 GMT -->
<!-- Added by HTTrack -->
<meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->

<head>

    <meta charset="utf-8" />
    <title>@yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc." />
    <meta name="author" content="Zoyothemes" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Lexend:wght@400;500;600;700&family=Inter:wght@400;500;600&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap"
        rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('new_asset/style/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css"
        integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="icon" type="image/x-icon" href="{{ asset('assets/Images/website.png') }}">

    <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

    <!-- Plugin CSS -->
    <link href="{{ asset('assets/admin/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
    <!-- App CSS -->
    <!--<link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />-->

    <!-- Icons -->
    <!--<link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />-->

    <script src="{{ asset('assets/admin/js/head.js') }}"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" />
    <link rel="stylesheet" href="{{ asset('assets/user/style.css') }}">
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">



    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
    <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
    <style>
        .header {
            background: #ffffff;
            border-bottom: 1px solid #E6EAED;
            height: 65px;
            z-index: 999;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            -webkit-transition: all 0.5s ease;
            -ms-transition: all 0.5s ease;
            transition: all 0.5s ease;
        }

        .header .nav-link {
            position: relative;
            margin-right: 20px;
        }

        .header .main-card {
            display: flex;
            justify-content: end;
            padding: 20px;
        }

        .header ul li a {
            background: none !important;
            color: #000 !important;
        }

        .header ul li a i {
            font-size: 20px !important;

        }

        .notification-card {
            display: none;
            position: absolute;
            top: 40px;
            height: 300px;
            right: 0;
            width: 356px;
            background: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            border-radius: 5px;
            padding: 10px;
            overflow: auto;
        }

        .notification-card ul {
            padding: 0;
        }

        .notification-card ul li {
            padding: 10px;
            border-bottom: 1px solid #eee;
            list-style: none;
        }

        .notification-card ul li:last-child {
            border-bottom: none;
        }

        .notification-card ul li p {
            margin: 0;
        }

        .mt-60 {
            margin-top: 60px;
        }

        .notification-card h5 {
            margin-bottom: 5px;
            color: #000;
            font-weight: 800;
            text-align: center;
            position: relative;
        }

        #notification-count {
            position: absolute;
            top: -7px;
            right: 0px;
            font-size: 10px;
            padding: 2px 3px;
            border-radius: 50%;
            background-color: red;
            color: white;
        }

        #dt-length-0 {
            margin-right: 13px !important;
        }
    </style>

</head>

<!-- body start -->
{{-- <body class="dashboard"> --}}

<body class="sidebar-is-compact">

    <!-- Mobile overlay -->
    <div class="sb-overlay" id="sbOverlay"></div>

    <!-- ═══════════════════ SIDEBAR ═══════════════════ -->
    <aside class="sb" id="sidebar">

        <!-- Logo row -->
        <div class="sb__logo">
            <!-- Compact: icon only -->
            <div onclick="window.location='{{ route('account.dashboard') }}'" class="sb__logo-mark">
                <i class="bi bi-mortarboard-fill" style="color:#4f46e5"></i>
            </div>
            <!-- Full: wordmark -->
            <span class="sb__logo-name">ProAISkill</span>
            <!-- Mobile close -->
            <button class="sb__close" id="sbClose" aria-label="Sidebar schließen">
                <i class="bi bi-x-lg"></i>
            </button>
        </div>

        <!-- Toggle button — sits BELOW logo, full-width -->
        <div class="sb__toggle-row">
            <button class="sb__toggle" id="sbToggle" aria-label="Sidebar umschalten">
                <i class="bi bi-chevron-right sb__toggle-icon" id="sbToggleIcon"></i>
                <span class="sb__toggle-label">Einklappen</span>
            </button>
        </div>

        <!-- Scrollable navigation -->
        <nav class="sb__nav" id="sbNav" aria-label="Hauptnavigation">

            <div class="sb__group">
                <span class="sb__group-label">Hauptmenü</span>

                <!-- Dashboard -->
                <a href="{{ route('account.dashboard') }}"  data-tip="Dashboard" class="sb__link">
                    <span class="sb__link-ic" ><i class="bi bi-house-door"></i></span>
                    <span class="sb__link-tx">Dashboard</span>
                </a>

                <!-- KI Skill Coach -->
                <a href="{{ route('skill.coach') }}" data-tip="KI Skill Coach" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-mortarboard"></i></span>
                    <span class="sb__link-tx">KI Skill Coach</span>
                </a>

                <!-- Dokumenten KI -->
                <a href="{{ route('document') }}" data-tip="Dokumenten-KI" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-file-earmark-text"></i></span>
                    <span class="sb__link-tx">Dokumenten-KI</span>
                </a>

                <!-- Financial Planning -->
                <a href="{{ route('account.financial') }}" data-tip="{{ trans('general.Financial_Planning') }}" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-cash-stack"></i></span>
                    <span class="sb__link-tx">{{ trans('general.Financial_Planning') }}</span>
                </a>

                <!-- Chat Assistant -->
                <a href="{{ route('career.assistant') }}" data-tip="Chat-Assistent" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-robot"></i></span>
                    <span class="sb__link-tx">Chat-Assistent</span>
                </a>

                <!-- Community -->
                <a href="{{ route('account.community') }}" data-tip="Community" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-people"></i></span>
                    <span class="sb__link-tx">Community</span>
                </a>

                <!-- Toolkit -->
                <a href="{{ route('toolkit.all') }}" class="sb__link" data-tip="Toolkit">
                    <span class="sb__link-ic"><i class="bi bi-tools"></i></span>
                    <span class="sb__link-tx">Toolkit</span>
                </a>

                <!-- Calendar -->
                @if (!auth()->user()->google_token)
                    <a href="{{ route('account.task.google') }}" class="sb__link" data-tip="{{ trans('general.Calendar') }}">
                        <span class="sb__link-ic"><i class="bi bi-calendar-event"></i></span>
                        <span class="sb__link-tx">{{ trans('general.Calendar') }}</span>
                    </a>
                @else
                    <a href="{{ route('account.user.calender') }}" data-tip="{{ trans('general.Calendar') }}" class="sb__link">
                        <span class="sb__link-ic"><i class="bi bi-calendar-check"></i></span>
                        <span class="sb__link-tx">{{ trans('general.Calendar') }}</span>
                    </a>
                @endif

                <!-- Profile -->
                <a href="{{ route('account.profile') }}" data-tip="Dein Profil" class="sb__link">
                    <span class="sb__link-ic"><i class="bi bi-person-circle"></i></span>
                    <span class="sb__link-tx">Dein Profil</span>
                </a>

                <!-- Logout -->
                <a href="{{ route('account.logout') }}" data-tip="Abmelden" class="sb__link bg-danger logoutLink">
                    <span class="sb__link-ic"><i class="bi bi-box-arrow-right"></i></span>
                    <span class="sb__link-tx">Abmelden</span>
                </a>

            </div>

        </nav>

        <!-- User footer -->
        <div class="sb__foot">
            <div class="sb__user">
                <div class="avatar">
         <img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&pid=ImgDetMain&cb=idpwebpc2" alt="not-found">
                </div>
                <div class="sb__user-info">
                    <span class="sb__user-name">{{ auth()->user()->firstName }}</span>
                    <span class="sb__user-role">{{ auth()->user()->email }}</span>
                </div>
            </div>
        </div>

    </aside>
    <!-- ═══════════════════ /SIDEBAR ═══════════════════ -->

    <div class="container-fluid g-0">
        <div class="row g-0">




            <!-- Main Content Area -->
            <div class="page-wrap" id="pageWrap">
              <!-- Mobile / Tablet topbar -->
    <header class="topbar_new" id="topbar">
        <button class="topbar__ham" id="hamBtn" aria-label="Menü öffnen">
          <span></span><span></span><span></span>
        </button>
        <span class="topbar__brand">ProAISkill</span>
        <div class="topbar__right">
         
          <div class="avatar">
            <img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&amp;pid=ImgDetMain&amp;cb=idpwebpc2" alt="">
          </div>
        </div>
      </header>
                

                @yield('content')

            </div>
        </div>
    </div>




    <script src="{{ asset('assets/admin/libs/jquery/jquery.min.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/feather-icons/feather.min.js') }}"></script>

    <!-- Apexcharts JS -->
    <script src="{{ asset('assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script>

    <!-- For basic area chart -->
    <script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

    <!-- Vector map -->
    <script src="{{ asset('assets/admin/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/admin/libs/jsvectormap/maps/world-merc.js') }}"></script>

    <!-- Widgets Init Js -->
    <script src="{{ asset('assets/admin/js/pages/ecommerce-dashboard.init.js') }}"></script>

    <!-- App JS -->
    <script src="{{ asset('assets/admin/js/app.js') }}"></script>
    <script src="{{ asset('assets/user/script.js') }}"></script>

    <script>
        document.getElementById("bell-icon").addEventListener("click", function() {
            var card = document.getElementById("notification-card");
            card.style.display = card.style.display === "block" ? "none" : "block";
        });
    </script>
    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>


    <script>
        @if ($errors->any())
            @foreach ($errors->all() as $error)
                toastr.error("{{ $error }}");
            @endforeach
        @endif


        @if (Session::has('success'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('success') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
    <script>
        $(document).ready(function() {
            $("#bell-icon").click(function() {
                $.ajax({
                    url: "{{ route('notifications.markRead') }}",
                    type: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    },
                    success: function(response) {

                        $("#notification-count").fadeOut(); // Hide notification count
                    },
                    error: function(xhr, status, error) {
                        console.error("Error:", error);
                    }
                });
            });
        });
    </script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#jobCategory').change(function() {
                var categoryId = $(this).val();
                $('#jobs').html('<option value="">Select Job</option>').prop('disabled', true);

                if (categoryId) {
                    $.ajax({
                        url: '{{ route('account.getjobs') }}',
                        type: 'GET',
                        data: {
                            category_id: categoryId
                        },
                        success: function(response) {
                            if (response.length > 0) {
                                $.each(response, function(index, job) {
                                    $('#jobs').append('<option value="' + job.id +
                                        '">' + job.name + '</option>');
                                });
                                $('#jobs').prop('disabled', false);
                            }
                        }
                    });
                }
            });
        });
    </script>

    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <!-- Select2 JS -->
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#interest').select2({
                placeholder: "{{ trans('general.Select_Option') }}",
                allowClear: true,
                multiple: true
            });
        });
        $(document).ready(function() {
            $('#interest1').select2({
                placeholder: "{{ trans('general.Select_Option') }}",
                allowClear: true,
                multiple: true
            });
        });
        $(document).ready(function() {
            $('#interest2').select2({
                placeholder: "{{ trans('general.Select_Option') }}",
                allowClear: true,
                multiple: true
            });
        });
    </script>
    <script>
        let table = new DataTable('#myTableunique');
    </script>
    <script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>

    <!-- FullCalendar JS -->

    @yield('script')

</body>

<!-- Mirrored from zoyothemes.com/hando/html/ecommerce by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2025 13:18:58 GMT -->

</html>
