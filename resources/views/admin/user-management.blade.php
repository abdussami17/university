
@extends('admin.app')
@section('title',trans('general.User_Management'))


@section('admin_content')
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">{{ trans('general.User_Management') }}</h4>
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
    <input type="search" placeholder="{{ trans('general.Search_User') }}" class="form-control w-25">
</div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable" id="datatable_1">
                            <thead>
                              <tr>
                                <th>{{ trans('general.First_Name') }}</th>
                                <th>{{ trans('general.Last_Name') }}</th>
                                <th>{{ trans('general.Student_ID') }}</th>
                                <th>{{ trans('general.Student_Card_Info') }}</th>
                                <th>{{ trans('general.Email') }}</th>
                            
                    
                                <th style="text-align:end">{{ trans('general.Registration_Date') }}</th>
                                <th style="text-align:end">{{ trans('general.Action') }}</th>
                              </tr>
                            </thead>
                            <tbody>
                                @foreach ($data as $item)
                                <tr>
                                    <td class="ps-0">
                                        <p class="d-inline-block align-middle mb-0">
                                            <span>{{ $item->firstName }}</span>
                                        </p>
                                    </td>
                                    <td>{{ $item->lastName }}</td>
                                    <td>{{ $item->std_id }}</td>
                                    <td><img src="{{ asset($item->student_card) }}" alt="" width="100px" height="100px"></td>
                                    <td>{{ $item->email }}</td>
                                    <td>{{ $item->created_at }}</td>
                                    <td class="text-end">
                                        @if($item->role != "admin")
                                        <a href="{{route('admin.edit-user' , $item->id) }}" class="btn btn-sm bg-primary-subtle edit-btn" >
                                            <i class="mdi mdi-pencil fs-14 text-primary"></i>
                                        </a>
                                        <a href="#" class="btn btn-sm bg-danger-subtle delete-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal" data-user-id="{{ $item->id }}">
                                            <i class="mdi mdi-delete fs-14 text-danger"></i>
                                        </a>
                                        @else
                                    
                                        @endif
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ trans('general.Confirm_Delete', ['attribute' => trans('general.User')]) }}</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ trans('general.Confirm_Delete_Message', ['attribute' => trans('general.User')]) }}</p>
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
<script>
document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-user-id");
            let form = document.getElementById("deleteForm");
            let actionUrl = "{{ route('admin.user-delete', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});

</script>
@endsection
