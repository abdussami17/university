
<!DOCTYPE html>
<html lang="en">
    
<!-- Mirrored from zoyothemes.com/hando/html/ecommerce by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2025 13:18:51 GMT -->
<!-- Added by HTTrack --><meta http-equiv="content-type" content="text/html;charset=UTF-8" /><!-- /Added by HTTrack -->
<head>

        <meta charset="utf-8" />
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="description" content="A fully featured admin theme which can be used to build CRM, CMS, etc."/>
        <meta name="author" content="Zoyothemes"/>
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>
   <!-- Plugin CSS -->
<!-- Plugin CSS -->
<link href="{{ asset('assets/admin/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />

<!-- App CSS -->
<link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />

<!-- Icons -->
<link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

<script src="{{ asset('assets/admin/js/head.js') }}"></script>

<link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">

    <link rel="icon" type="image/x-icon" href="{{asset('assets/Images/website.png')}}">
<!-- Font Awesome CDN -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


<link rel="stylesheet" type="text/css" 
     href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
<style>
    a{
        text-decoration: none!important;
    }
.post .form-check-input:not(:checked) {
    background-color: #FF0000 !important; /* Red when unchecked */
    border-color: #FF0000 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e") !important;
    background-repeat: no-repeat;
}

.post .form-check-input:checked {
    background-color: #008000 !important; /* Green when checked */
    border-color: #008000 !important;
    background-image: url("data:image/svg+xml,%3csvg xmlns='http://www.w3.org/2000/svg' viewBox='-4 -4 8 8'%3e%3ccircle r='3' fill='%23fff'/%3e%3c/svg%3e") !important;

}

    .header{
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
    .header .main-card{
        display: flex;
        justify-content: end;
        padding: 20px;
    }
    .header ul li a{
    background: none!important;
    color:#000!important;
    }
    .header ul li a i{
        font-size: 20px!important;

    }
    .notification-card {
        display: none;
        position: absolute;
        top: 40px;
        right: 0;
        width: 350px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 10px;
    }

    .notification-card ul li {
        padding: 10px;
        border-bottom: 1px solid #eee;
    }
    .notification-card ul li:last-child {
        border-bottom: none;
    }
    .notification-card ul li p{
        margin: 0;
    }
    .mt-60{
        margin-top: 60px;
    }
    .notification-card h5{
        margin-bottom:5px;
        color: #000;
        font-weight: 800;
        text-align: center;
        position: relative;
    }

    .bootstrap-tagsinput {
            width: 100%;
            min-height: 38px;
            padding: 5px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            background-color: #fff;
        }
        .bootstrap-tagsinput .tag {
            margin-right: 5px;
            color: #fff;
            background-color: #007bff;
            padding: 5px;
            border-radius: 3px;
            display: inline-flex;
        }
</style>
    </head>

    <!-- body start -->
    <body data-menu-color="light" data-sidebar="default">

        <!-- Begin page -->
        <div id="app-layout dashboard" class="mt-60">


            <div class="header">
                <ul class="main-card">
                    <li class="nav-link">
                        <a href="javascript:void(0)" id="bell-icon">
                            <i class='bx bxs-bell icon'></i>
    
                        </a>
                        {{--<div class="notification-card" id="notification-card">
                            <h5>Notification</h5>
                            <ul>
                                <li>
                                    <p><strong>Title</strong>: Project Deadline</p>
                                    <p><strong>Date</strong>: 2025-03-01</p>
                                    <p><strong>Status</strong>: <span class="badge bg-danger">Unread</span></p>
                                </li>
                                <li>
                                    <p><strong>Title</strong>: Meeting with Client</p>
                                    <p><strong>Date</strong>: 2025-03-03</p>
                                    <p><strong>Status</strong>: <span class="badge bg-danger">Unread</span></p>
                                </li>
                                <li>
                                    <p><strong>Title</strong>: Invoice Due</p>
                                    <p><strong>Date</strong>: 2025-03-05</p>
                                    <p><strong>Status</strong>: <span class="badge bg-success">Read</span></p>
                                </li>
                                <li>Notofication</li>
                            </ul>
                        </div>--}}
                    </li>
                </ul>
            </div>

            <!-- Left Sidebar Start -->
            <nav class="sidebar close">
    <header>
        <div class="image-text">
            <span class="image " style="background-color:#fff">
                <img  src="{{ asset('assets/Images/website.png') }}" alt="t">
            </span>
        </div>
        <i class='bx bx-chevron-right toggle'></i>
    </header>
    <div class="menu-bar">
        <div class="menu">
            <ul class="menu-links">
                <li class="nav-link {{ Request::is('admin/dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">{{ trans('general.Dashboard') }}</span>
                    </a>
                </li>
                <li class="nav-link {{ Request::is('skill/path') ? 'active' : '' }}">
                    <a href="{{ route('skillpath.index') }}">
                        <i class='bx bx-home-alt icon'></i>
                        <span class="text nav-text">Skill Path</span>
                    </a>
                </li>
                <li class="nav-link {{ Request::is('admin/user-management') ? 'active' : '' }}">
                    <a href="{{ route('admin.user-management') }}">
                        <i class='bx bxs-user icon'></i>
                        <span class="text nav-text">{{ trans('general.User_Management') }}</span>
                    </a>
                </li>
                <li class="nav-link {{ Request::is('admin/content-management') ? 'active' : '' }}">
                    <a href="{{ route('admin.content-management') }}">
                        <i class='bx bx-cog icon'></i>
                        <span class="text nav-text">{{ trans('general.Content_Management') }}</span>
                    </a>
                </li>



                <li class="nav-link {{ Request::is('admin/ai') ? 'active' : '' }}">
                    <a href="{{ route('admin.document') }}">
                        <i class='bx bx-file icon'></i>
                        <span class="text nav-text">{{ trans('general.Document') }}</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('category') ? 'active' : '' }}">
                    <a href="{{ route('category.index') }}">
                        <i class='bx bx-category icon'></i>
                        <span class="text nav-text">{{ trans('general.Category') }}</span>
                    </a>
                </li>
                
                
                <li class="nav-link {{ Request::is('post') ? 'active' : '' }}">
                    <a href="{{ route('post.index') }}">
                        <i class='bx bx-news icon'></i>
                        <span class="text nav-text">{{ trans('general.Post') }}</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('career') ? 'active' : '' }}">
                    <a href="{{ route('career.index') }}">
                        <i class='bx bx-briefcase icon'></i>
                        <span class="text nav-text">{{ trans('general.Career') }}</span>
                    </a>
                </li>

                <li class="nav-link {{ Request::is('events') ? 'active' : '' }}">
                    <a href="{{ route('admin.event.index') }}">
                        <i class='bx bx-plus-circle icon'></i>
                        <span class="text nav-text">Ereignisliste</span>
                    </a>
                </li>



                <div class="bottom-content">
                    <li>
                        <a href="{{ route('admin.logout') }}">
                            <i class='bx bx-exit icon'></i>
                            <span class="text nav-text">{{ trans('general.Logout') }}</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{route('admin.profile')}}">
                        <img src="{{ $User->profile ? asset('Images/' . $User->profile) : asset('assets/admin/images/person.jpg') }}" alt="">
                            <span class="text nav-text" style="margin-left: 10px;">{{ trans('general.Profile') }}</span>
                        </a>
                    </li>
                </div>  
            </ul>
        </div>
    </div>
</nav>

            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            
            <div class="content-page " >
             @yield('admin_content')


             
                <!-- end Footer -->

            </div>
           
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

<!-- Vendor -->
<script src="{{ asset('assets/admin/libs/jquery/jquery.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/simplebar/simplebar.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/node-waves/waves.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/waypoints/lib/jquery.waypoints.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/jquery.counterup/jquery.counterup.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/feather-icons/feather.min.js') }}"></script>
<!-- Bootstrap CSS -->

<!-- Bootstrap JavaScript (with Popper) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.8.0/bootstrap-tagsinput.min.js"></script>


<!-- Apexcharts JS -->
{{-- <script src="{{ asset('assets/admin/libs/apexcharts/apexcharts.min.js') }}"></script> --}}

<!-- For basic area chart -->
<script src="https://apexcharts.com/samples/assets/stock-prices.js"></script>

<!-- Vector map -->
<script src="{{ asset('assets/admin/libs/jsvectormap/js/jsvectormap.min.js') }}"></script>
<script src="{{ asset('assets/admin/libs/jsvectormap/maps/world-merc.js') }}"></script>

<!-- Widgets Init Js -->
<script src="{{ asset('assets/admin/js/pages/ecommerce-dashboard.init.js') }}"></script>

<!-- App JS -->
<script src="{{ asset('assets/admin/js/app.js') }}"></script>
<script>
    document.getElementById("bell-icon").addEventListener("click", function() {
        var card = document.getElementById("notification-card");
        card.style.display = card.style.display === "block" ? "none" : "block";
    });
</script>
<script>
$(document).ready(function() {a
    $('.open-modal').on('click', function() {
        var url = $(this).data('url');
        $.ajax({
            url: url,
            method: "GET",
            success: function(response) {
                $('#modal-content').html(response);
                $('#add_currency_modal').modal('show');

                $('#add_currency_modal').on('shown.bs.modal', function () {
                    $('#summernote').summernote();
                    $('#summernote1').summernote();
                });

                $('.clse').on('click', function () {
        $('#add_currency_modal').modal('hide');
    });

            },
            error: function() {
                alert('Failed to load content');
            }
        });
    });
});

</script>

	
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script>
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('success') }}");
        @endif

        @if(Session::has('message'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('message') }}");
        @endif
      
        @if(Session::has('error'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.error("{{ session('error') }}");
        @endif
      
        @if(Session::has('info'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.info("{{ session('info') }}");
        @endif
      
        @if(Session::has('warning'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.warning("{{ session('warning') }}");
        @endif
      </script>

        <script>
        $(document).ready(function() {
            $('#title').on('input', function() {
                let nameValue = $(this).val();
        

                let slug = nameValue.toLowerCase()
                                    .replace(/\s+/g, '-')
                                    .replace(/[^\w-]+/g, '');
        
                $('#slug').val(slug);
            });
        });

        $(document).ready(function() {
            $('#name').on('input', function() {
                let nameValue = $(this).val();
        

                let slug = nameValue.toLowerCase()
                                    .replace(/\s+/g, '-')
                                    .replace(/[^\w-]+/g, '');
        
                $('#slug').val(slug);
            });
        });
        </script>
<script>
    $(document).ready(function() {
        $('#tags').tagsinput({
            maxTags: 10,
            trimValue: true,
            allowDuplicates: false
        });
    });
</script>
@yield('script')
    </body>

<!-- Mirrored from zoyothemes.com/hando/html/ecommerce by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2025 13:18:58 GMT -->
</html>
