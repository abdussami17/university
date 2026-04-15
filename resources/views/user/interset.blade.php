
@extends('user.layout')
@section('title',trans('general.Interest'))
@section('content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
    
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Interest') }}</h4>
            </div>          
        </div>
            
          </div>
            <div class="col-12">
                @if (auth()->user()->interest_workshop=='workshop')

                <div class="card">
                    <div class="card-body">
                        <h5>{{ trans('general.Travel_Mobility') }}</h5>
                        <div class="table-responsive">

                            <table class="table datatable" id="myTable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>{{ trans('general.Course_Title') }}</th>
                                   
                                      <th>{{ trans('general.Ticket_Price') }}</th>
                                      <th>{{ trans('general.Category') }}</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                        
                                    @foreach (App\Models\TravelMobility::where('status','active')->get() as $index => $item)
                                        <tr>
                                            <td class="ps-0">
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->price }}</td>
                                            @php
                                                $cat_ids=App\Models\TravelMobilityCategories::where('id',$item->category_id)->first();
                                            @endphp
                                            <td>{{$cat_ids->cat_title ?? ''}}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                
                            </table>

                        </div>
    
                    </div>  
                </div>
                @endif

                @if (auth()->user()->interest_travel=='travel')

                <div class="card">
                    <div class="card-body">
                        <h5>{{ trans('general.Workshop') }}</h5>

                        <div class="table-responsive">

                            <table class="table datatable" id="myTable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>{{ trans('general.Course_Title') }}</th>
                                   
                                      <th>{{ trans('general.Ticket_Price') }}</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                        
                                    @foreach (App\Models\Workshops::where('status','active')->get() as $index => $item)
                                        <tr>
                                            <td class="ps-0">
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                
                            </table>

                        </div>
    
                    </div>  
                </div>
                @endif


                @if (auth()->user()->interest_affilate=='affilate')

                <div class="card">
                    <div class="card-body">
                        <h5>{{ trans('general.Affiliate_Programs') }}</h5>

                        <div class="table-responsive">

                            <table class="table datatable" id="myTable">
                                <thead>
                                    <tr>
                                      <th>#</th>
                                      <th>{{ trans('general.Course_Title') }}</th>
                                   
                                      <th>{{ trans('general.Ticket_Price') }}</th>
                                    </tr>
                                  </thead>
                                <tbody>
                                        
                                    @foreach (App\Models\AffliatePrograms::where('status','active')->get() as $index => $item)
                                        <tr>
                                            <td class="ps-0">
                                                {{ $loop->iteration }}
                                            </td> 
                                            <td>{{ $item->title }}</td>
                                            <td>{{ $item->price }}</td>
                                        </tr>
                                    @endforeach

                                </tbody>
                                
                            </table>

                        </div>
    
                    </div>  
                </div>
                @endif
            </div>
        </div>
    
    </div>
    </div>
    <div class="modal fade" id="add_currency_modal">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>
    

    <div class="modal fade" id="currency_modal_edit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>
@endsection

@section('script')
<link rel="stylesheet" href="//cdn.datatables.net/2.2.2/css/dataTables.dataTables.min.css">
<script src="//cdn.datatables.net/2.2.2/js/dataTables.min.js"></script>
<script>
    let table = new DataTable('#myTable');
</script>
<script>
        $(document).on('change', '.toggle-class-career', function() {

            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
            console.log(status);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('career.status')}}",
                data: {'status': status, 'user_id': user_id},

                success: function(data){
                if(data.success == true){
                        toastr.success(data.message);

                } else {
                        toastr.error(data.message);
                }
                    
                }

            });
        })
        document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-user-id");
            let form = document.getElementById("deleteForm");
            let actionUrl = "{{ route('career.destroy', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});

    </script>
    
@endsection