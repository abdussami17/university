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
          <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.13.1/font/bootstrap-icons.min.css">
        
      <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
      <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" />
      <link rel="stylesheet" href="{{asset('new_asset/style/style.css')}}">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" integrity="sha512-Evv84Mr4kqVGRNSgIGL/F/aIDqQb7xQ2vcrdIwxfjThSH8CSR7PBEakCr51Ck+w+/U6swU2Im1vVX0SVk9ABhg==" crossorigin="anonymous" referrerpolicy="no-referrer" />
  
  
  
        <script src="https://cdn.ckeditor.com/ckeditor5/39.0.1/classic/ckeditor.js"></script>

        <!-- Plugin CSS -->
        <link href="{{ asset('assets/admin/libs/jsvectormap/css/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet" type="text/css" />
        <!-- App CSS -->
        <!--<link href="{{ asset('assets/admin/css/app.min.css') }}" rel="stylesheet" type="text/css" id="app-style" />-->
        
        <!-- Icons -->
        <!--<link href="{{ asset('assets/admin/css/icons.min.css') }}" rel="stylesheet" type="text/css" />-->
        
        <script src="{{ asset('assets/admin/js/head.js') }}"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/fullcalendar/5.11.3/main.min.css" />
        
        <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
        
        <link rel="shortcut icon" href="{{ asset('assets/admin/images/logo.webp') }}">
        
        <!-- Select2 CSS -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
                <link href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css" rel="stylesheet">
<style>
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
        height: 300px;
        right: 0;
        width: 356px;
        background: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 5px;
        padding: 10px;
        overflow: auto;
    }

    .notification-card ul{
        padding:0;
    }
        .notification-card ul li {
        padding: 10px;
        border-bottom: 1px solid #eee;
        list-style: none;
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
    #dt-length-0{
        margin-right: 13px!important;
    }

</style>

    </head>
    <!-- body start -->
<body class="dashboard">
    <div class="container-fluid g-0">
      <div class="row g-0">
  
        <!-- Sidebar -->
        <nav class="col-md-2 sidebar">
          <div>
            <h5 style="cursor: pointer;" class="ms-3 mb-4">Proaiskill</h5>
            <a href="{{ route('logout.session') }}" class="text-danger"><i class="fa-solid fa-right-from-bracket"></i>Abmelden</a>
 
          </div>
        </nav>
  
        <!-- Main Content Area -->
        <div class="main-content">
          <!-- Top Header -->
          <div class="top-header">
            <h5><img src="{{asset('new_asset/images/React-Logo-PNG-Images.png')}}" height="30px" width="auto" alt="nt"></h5>
            <div class="avatar"><img src="https://th.bing.com/th/id/OIP.l0zv54-6oV4i-tcUSpmkAQHaHa?rs=1&pid=ImgDetMain&cb=idpwebpc2" alt=""></div>
          </div>
  
                <div class="main-section">
                         <div class="card-body">                
                            <div class="container">
                                <div class="alert alert-warning text-center">
                                    
                                    <h2>{{ trasn('auth.verify_email') }}</h2>
                                    <p>{!! trans('authverification_email', ['email' => $email]) !!}</p>
                                    <p>
                                        {{ trans('auth.didnt_receive_email') }}
                                        <form id="resendForm" action="{{ route('resend.verification') }}" method="POST">
                                            @csrf
                                            <input type="hidden" name="email" value="{{ $email }}">
                                        </form>
                                        
                                        <button id="resendBtn" class="btn btn-primary">
                                            {{ trans('auth.resend_email') }}
                                        </button>




                                    </p>
                                </div>
                            </div>
                        </div>
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
    
    
        @if(Session::has('success'))
        toastr.options =
        {
            "closeButton" : true,
            "progressBar" : true
        }
                toastr.success("{{ session('success') }}");
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
    $(document).ready(function () {
        $("#bell-icon").click(function () {
            $.ajax({
                url: "{{ route('notifications.markRead') }}",
                type: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}"
                },
                success: function (response) {

                    $("#notification-count").fadeOut(); // Hide notification count
                },
                error: function (xhr, status, error) {
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
                    data: { category_id: categoryId },
                    success: function(response) {
                        if (response.length > 0) {
                            $.each(response, function(index, job) {
                                $('#jobs').append('<option value="' + job.id + '">' + job.name + '</option>');
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
            placeholder: "Select an option",
            allowClear: true,
            multiple: true
        });
    });
    $(document).ready(function() {
        $('#interest1').select2({
            placeholder: "Select an option",
            allowClear: true,
            multiple: true
        });
    });
    $(document).ready(function() {
        $('#interest2').select2({
            placeholder: "Select an option",
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
<script>
    function previewImage(event) {
        const input = event.target;
        const preview = document.getElementById('image-preview');
        const previewImg = document.getElementById('preview-img');

        if (input.files && input.files[0]) {
            const reader = new FileReader();

            reader.onload = function (e) {
                previewImg.src = e.target.result;
                preview.style.display = "block";
            };

            reader.readAsDataURL(input.files[0]);
        }
    }
</script>
@yield('script')

  </body>

    <!-- b
    <!-- body start -->

<!-- Mirrored from zoyothemes.com/hando/html/ecommerce by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 27 Jan 2025 13:18:58 GMT -->
</html>
