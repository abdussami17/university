<head>
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>
@extends('admin.app')
@section('title',trans('general.Content_Management'))


@section('admin_content')
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

 <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
     <div class="flex-grow-1">
         <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Content_Management') }}</h4>
     </div>

    
 </div>

 <!-- General Form -->
 <div class="row">
     <div class="col-12">
         <div class="card">

         

             <div class="card-body">
                 <div class="row">
                   
                     <div class="frontend-section-card-group">
                         <div class="frontend-section-card ">
                             <h6>{{ trans('general.Home_Page') }}</h6>
                             <a href="{{route('content.home')}}"><i class="bi bi-gear"></i></a>
                         </div>

                         <div class="frontend-section-card ">
                             <h6>{{ trans('general.Travel_Mobility') }}</h6>
                             <a href="{{route('admin.travel-mobility')}}"><i class="bi bi-gear"></i></a>
                         </div>
                         <div class="frontend-section-card ">
                             <h6>{{ trans('general.Affiliate_Programs') }}</h6>
                             <a href="{{route('admin.affiliate-programs')}}"><i class="bi bi-gear"></i></a>
                         </div>
                         <div class="frontend-section-card ">
                             <h6>{{ trans('general.Workshops_Events') }}</h6>
                             <a href="{{route('admin.workshops')}}"><i class="bi bi-gear"></i></a>
                         </div>
                         
                         <div class="frontend-section-card ">
                             <h6>{{ trans('general.General_Setting') }}</h6>
                             <a href="{{route('general.setting')}}"><i class="bi bi-gear"></i></a>
                         </div>
                       
                         
                     </div>
                 
                 </div>
             </div>

         </div>
     </div>
 </div>

 
</div> <!-- container-fluid -->
</div>
@endsection
