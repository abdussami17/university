
@extends('admin.app')
@section('title',trans('general.Dashboard'))


@section('admin_content')
<div class="d-flex dashboard-parent">
<div class="content" id="dashboard-content">

<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <!-- <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">Dashboard</h4>
        </div> -->
    </div>

    <!-- Start Row -->
    <div class="row">
        
        <div class="col-md-6 col-xl-6">
            <div class="card overflow-hidden">
                <div class="card-body active">
                    <div class="widget-first">
                        <a href="{{ route('admin.user-management') }}" class="text-white">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 640 512"><path fill="#963b68" d="M96 224c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m448 0c35.3 0 64-28.7 64-64s-28.7-64-64-64s-64 28.7-64 64s28.7 64 64 64m32 32h-64c-17.6 0-33.5 7.1-45.1 18.6c40.3 22.1 68.9 62 75.1 109.4h66c17.7 0 32-14.3 32-32v-32c0-35.3-28.7-64-64-64m-256 0c61.9 0 112-50.1 112-112S381.9 32 320 32S208 82.1 208 144s50.1 112 112 112m76.8 32h-8.3c-20.8 10-43.9 16-68.5 16s-47.6-6-68.5-16h-8.3C179.6 288 128 339.6 128 403.2V432c0 26.5 21.5 48 48 48h288c26.5 0 48-21.5 48-48v-28.8c0-63.6-51.6-115.2-115.2-115.2m-223.7-13.4C161.5 263.1 145.6 256 128 256H64c-35.3 0-64 28.7-64 64v32c0 17.7 14.3 32 32 32h65.9c6.3-47.4 34.9-87.3 75.2-109.4"/></svg>
                                </div>
                                <div>
                                    <p class="mb-0 fs-16">{{ trans('general.Total_Users') }}</p>
                                </div>
                            </div>
                            <h3 class="mb-0 fs-26 ">{{$users}}</h3>
                            <p class="text-white fs-14">{{ trans('general.All_Users') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <a href="{{ route('admin.travel-mobility') }}">
                            <div class="d-flex align-items-center mb-3">
                                <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#01D4FF" d="M7 20V8.975q0-.825.6-1.4T9.025 7H20q.825 0 1.413.587T22 9v8l-5 5H9q-.825 0-1.412-.587T7 20M2.025 6.25q-.15-.825.325-1.487t1.3-.813L14.5 2.025q.825-.15 1.488.325t.812 1.3L17.05 5H9Q7.35 5 6.175 6.175T5 9v9.55q-.4-.225-.687-.6t-.363-.85zM20 16h-4v4z"/></svg>
                                </div>
                                <div>
                                    <p class="mb-0 text-dark fs-16">{{ trans('general.Total_Travel_Mobility') }}</p>
                                </div>
                            </div>
                            <h3 class="mb-0 fs-26 text-dark">{{$travel}}</h3>
                            <p class="text-muted fs-14">{{ trans('general.Show_Travel_Mobility') }}</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <a href="{{ route('admin.workshops') }}">
                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 14 14"><path fill="#287F71" fill-rule="evenodd" d="M13.463 9.692C13.463 12.664 10.77 14 7 14S.537 12.664.537 9.713c0-3.231 1.616-4.868 4.847-6.505L4.24 1.077A.7.7 0 0 1 4.843 0H9.41a.7.7 0 0 1 .603 1.023L8.616 3.208c3.23 1.615 4.847 3.252 4.847 6.484M7.625 4.887a.625.625 0 1 0-1.25 0v.627a1.74 1.74 0 0 0-.298 3.44l1.473.322a.625.625 0 0 1-.133 1.236h-.834a.625.625 0 0 1-.59-.416a.625.625 0 1 0-1.178.416a1.877 1.877 0 0 0 1.56 1.239v.636a.625.625 0 1 0 1.25 0v-.636a1.876 1.876 0 0 0 .192-3.696l-1.473-.322a.49.49 0 0 1 .105-.97h.968a.622.622 0 0 1 .59.416a.625.625 0 0 0 1.178-.417a1.874 1.874 0 0 0-1.56-1.238z" clip-rule="evenodd"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 text-dark fs-16">{{ trans('general.Total_Workshop') }}</p>
                            </div>
                        </div>
                        <h3 class="mb-0 fs-26 text-dark">{{$Workshops}}</h3>
                        <p class="text-muted fs-14">{{ trans('general.Show_Workshop') }}</p>
                    </a>

                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6 col-xl-6">
            <div class="card">
                <div class="card-body">
                    <div class="widget-first">
                        <a href="{{ route('admin.affiliate-programs') }}">

                        <div class="d-flex align-items-center mb-3">
                            <div class="rounded-2 bg-white p-2 me-3 shadow-sm border">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24"><path fill="#f59440" d="M5.574 4.691c-.833.692-1.052 1.862-1.491 4.203l-.75 4c-.617 3.292-.926 4.938-.026 6.022C4.207 20 5.88 20 9.23 20h5.54c3.35 0 5.025 0 5.924-1.084c.9-1.084.591-2.73-.026-6.022l-.75-4c-.439-2.34-.658-3.511-1.491-4.203C17.593 4 16.403 4 14.02 4H9.98c-2.382 0-3.572 0-4.406.691" opacity="0.5"/><path fill="#988D4D" d="M12 9.25a2.251 2.251 0 0 1-2.122-1.5a.75.75 0 1 0-1.414.5a3.751 3.751 0 0 0 7.073 0a.75.75 0 1 0-1.414-.5A2.251 2.251 0 0 1 12 9.25"/></svg>
                            </div>
                            <div>
                                <p class="mb-0 text-dark fs-16">{{ trans('general.Total_Affiliate_Programs') }}</p>
                            </div>
                        </div>
                        <h3 class="mb-0 fs-26 text-dark">{{$Affiliate}}</h3>
                        <p class="text-muted fs-14">{{ trans('general.Affiliate_Incurred') }}</p>
                    </a>

                    </div>
                </div>
            </div>
        </div>
        
        
    </div>
    <!-- End Start -->

    <!-- Sales Chart -->
    <div class="row">
        <div class="col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">{{ trans('general.Sales_Overview') }}</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div id="performance-review" class="apex-charts"></div>
                </div>
            </div>
        </div>

        <!-- <div class="col-md-12 col-xl-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex align-items-center">
                        <h5 class="card-title mb-0">Customer Reviews</h5>
                    </div>
                </div>

                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-2"> 
                        <div class="flex-1"> 
                            <div class="d-flex align-items-baseline mb-1"> 
                                <h4 class="mb-1 text-dark fs-28">4.8</h4> 
                                <span class="ms-2"> 
                                    <i class="mdi mdi-star text-warning"></i> 
                                    <i class="mdi mdi-star text-warning"></i> 
                                    <i class="mdi mdi-star text-warning"></i> 
                                    <i class="mdi mdi-star text-warning"></i> 
                                    <i class="mdi mdi-star text-muted"></i> 
                                </span> 
                            </div> 
                            <a href="javascript:void(0);" class="fs-14 text-muted">2,878 Reviews</a> 
                        </div> 
                        <div class="min-w-fit"> 
                            <span class="fs-14">(4.3 out of 5)</span> 
                        </div> 
                    </div>

                    <div class="mt-2"> 
                        <div class="d-flex align-items-center"> 
                            <div class="flex-fill"> 
                                <div class="d-flex align-items-center justify-content-between"> 
                                    <span class="d-block ">5 Stars</span> 
                                    <span class="d-block ">80%</span> 
                                </div> 
                                <div class="progress progress-md mt-2" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar bg-primary" style="width: 80%"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div>

                    <div class="mt-2"> 
                        <div class="d-flex align-items-center"> 
                            <div class="flex-fill"> 
                                <div class="d-flex align-items-center justify-content-between"> 
                                    <span class="d-block ">4 Stars</span> 
                                    <span class="d-block ">55%</span> 
                                </div> 
                                <div class="progress progress-md mt-2" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar bg-primary" style="width: 55%"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div>

                    <div class="mt-2"> 
                        <div class="d-flex align-items-center"> 
                            <div class="flex-fill"> 
                                <div class="d-flex align-items-center justify-content-between"> 
                                    <span class="d-block ">3 Stars</span> 
                                    <span class="d-block ">45%</span> 
                                </div> 
                                <div class="progress progress-md mt-2" role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar bg-primary" style="width: 45%"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div>

                    <div class="mt-2"> 
                        <div class="d-flex align-items-center"> 
                            <div class="flex-fill"> 
                                <div class="d-flex align-items-center justify-content-between"> 
                                    <span class="d-block ">2 Stars</span> 
                                    <span class="d-block ">25%</span> 
                                </div> 
                                <div class="progress progress-md mt-2" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar bg-primary" style="width: 25%"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div>

                    <div class="mt-2"> 
                        <div class="d-flex align-items-center"> 
                            <div class="flex-fill"> 
                                <div class="d-flex align-items-center justify-content-between"> 
                                    <span class="d-block ">1 Stars</span> 
                                    <span class="d-block ">8%</span> 
                                </div> 
                                <div class="progress progress-md mt-2" role="progressbar" aria-valuenow="8" aria-valuemin="0" aria-valuemax="100"> 
                                    <div class="progress-bar bg-primary" style="width: 8%"></div> 
                                </div> 
                            </div> 
                        </div> 
                    </div>

                </div>
            </div>
        </div> -->
    </div>

    <!-- Top Selling Products -->
    
    <!-- End Top Selling Products -->

    
    

    <!-- Start Product Orders -->
 

</div> <!-- container-fluid -->
</div> <!-- content -->
<div class="appointment-section">
<div class="appointment-header">
    <h2>{{ trans('general.Upcoming_Visits') }}</h2>
    <span>9 {{ trans('general.Appointments_Left') }}</span>
    <button type="button" class="create-visit" data-bs-toggle="modal" data-bs-target="#addAppointmentModal">+ {{ trans('general.Create_Visit') }}</button>
<!-- Modal -->
<div class="modal fade" id="addAppointmentModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ trans('general.Add_Appointment') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('appointments.store') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="name" class="form-label">{{ trans('general.Appointment_Name') }}</label>
                        <input type="text" class="form-control" id="name" name="name" required>
                    </div>
                    <div class="mb-3">
                        <label for="start_time" class="form-label">{{ trans('general.Start_Time') }}</label>
                        <input type="time" class="form-control" id="start_time" name="start_time" required>
                    </div>
                    <div class="mb-3">
                        <label for="end_time" class="form-label">{{ trans('general.End_Time') }}</label>
                        <input type="time" class="form-control" id="end_time" name="end_time" required>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('general.Save_Appointment') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
</div>
<div class="date-tabs">
    <button class="active">19 Jul</button>
    <button>20 Jul</button>
    <button>21 Jul</button>
    <button>22 Jul</button>
    <button>23 Jul</button>
    <button>24 Jul</button>
    <button>25 Jul</button>
</div>
<div class="schedule">
@foreach($appointments as $appointment)
        <div class="appointment ">
            {{ $appointment->name }} 
            <span>
                {{ \Carbon\Carbon::parse($appointment->start_time)->format('h:i A') }} - 
                {{ \Carbon\Carbon::parse($appointment->end_time)->format('h:i A') }}
            </span>
        </div>
    @endforeach
</div>
</div>
</div>

@endsection
