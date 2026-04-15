
@extends('admin.app')
@section('title',trans('general.Sub_Category_Post'))
@section('admin_content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
    
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Sub_Category_Post') }}</h4>
            </div>
    
         
    
          
        </div>
    
        <div class="row">
        <div>
          @if(Session::has('success'))
          <div class="alert alert-success w-100 alert-dismissible fade show" role="alert">
        <b>{{ trans('general.Success') }}</b> {{ Session::get('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    
            
    
            @endif
          </div>
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('post.create.subcategory',$subcat->id) }}">
                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">{{ trans('general.Add_New') }}</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="myTable">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>{{ trans('general.Name') }}</th>
                                    <th>{{ trans('general.Category') }}</th>
                                    <th>{{ trans('general.Status') }}</th>
                                    <th>{{ trans('general.Thumb') }}</th>
                                    <th style="text-align:end">{{ trans('general.Action') }}</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach ($subcat->child  as $key=>$item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                                {{ $item->name }}
                                        </td>
                                        <td>
                                            @if ($item->parent_id==0)
                                                <span class="badge bg-success">{{ trans('general.Category') }}</span>
                                            @else
                                              <span class="badge bg-primary"> {{ trans('general.Sub_Category') }} ( {{ $item->parent_data->name ?? trans('general.No_Category') }})</span>
                                            @endif
                                        </td>
                                        <td>
                                            <div class="form-switch post">
                                                <input type="checkbox" class="form-check-input toggle-class-post" role="switch" id="flexSwitchCheckDefault" data-id="{{ $item->id }}"
                                                       {{ $item->status ? 'checked' : '' }} />
                                            </div>
                                        </td>
                                        <td><img src="{{ asset($item->thumb) }}" alt="" width="50px" height="50px"></td>
                                        <td class="text-end">
                                            <a href="{{route('post.edit' , $item->id) }}" class="btn btn-sm bg-primary-subtle edit-btn" >
                                                <i class="mdi mdi-pencil fs-14 text-primary"></i>
                                            </a>
                                            <a href="#" class="btn btn-sm bg-danger-subtle delete-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-user-id="{{ $item->id }}">
                                                <i class="mdi mdi-delete fs-14 text-danger"></i>
                                            </a>

                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
    
                                <!-- Delete Confirmation Modal -->
                                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ trans('general.Confirm_Delete', ['attribute' => trans('general.Sub_Category')]) }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ trans('general.Confirm_Delete_Message', ['attribute' => trans('general.Sub_Category')]) }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                                                <form id="deleteForm" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger">{{ trans('general.Delete') }}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                
                            </table>
                        </div>
    
                    </div>  
                </div>
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
        $(document).on('change', '.toggle-class-post', function() {

            var status = $(this).prop('checked') == true ? 1 : 0; 
            var user_id = $(this).data('id'); 
            console.log(status);
            $.ajax({
                type: "GET",
                dataType: "json",
                url: "{{route('post.status')}}",
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
            let actionUrl = "{{ route('post.destroy', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});

    </script>
    
@endsection