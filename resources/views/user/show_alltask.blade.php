@extends('user.layout')

@section('title',trans('general.Task_List'))

@section('content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
    
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Task_List') }}</h4>
            </div>
    
         
    
          
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                            <button type="button" class=" btn btn-success" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ {{ trans('general.Create_Task') }}</button>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="myTableunique">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>{{ trans('general.Title') }}</th>
                                    <th>{{ trans('general.Date_time') }}</th>
                                    <th style="text-align:end">{{ trans('general.Action') }}</th>
                                  </tr>
                                </thead>
                                <tbody>

                                    @foreach (App\Models\Task::where('user_id',auth()->user()->id)->get(); as $key=>$item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <td>
                                                {{ $item->title }}
                                        </td>
                                        <td>
                                             {{ $item->time }}
                                        </td>
                                        <td class="text-end">
                                            <a class="btn btn-sm bg-primary-subtle edit-btn" 
                                            onclick="edit_modal('{{$item->id}}');" title="Edit" >
                                                <i class="fa-solid fa-pencil fs-14 text-primary"></i>
                                            </a>

                                            <a href="#" class="btn btn-sm bg-danger-subtle delete-btn" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal" data-user-id="{{ $item->id }}">
                                                <i class="fa-solid fa-trash fs-14 text-danger"></i>
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
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ trans('general.Confirm_Delete', ['attribute' => trans('general.Task')]) }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                 <p>{{ trans('general.Confirm_Delete_Message', ['attribute' => trans('general.Task')]) }}</p>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                                                <form id="deleteForm" method="Post">
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
    
    <div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ trans('general.Create_Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.task.store')}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="task_title" class="form-label">{{ trans('general.Task_Title') }}</label>
                            <input type="text" class="form-control" id="task_title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">{{ trans('general.Due_Date') }}</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Time') }}</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="time"
                                                            value="" required value="">
                        </div>
                        <div class="col-md-12 mb-3">
                            <label for="attachment" class="form-label">{{ trans('general.Attachment') }}</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">Save Task</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                </form>
            </div>
        </div>
    </div>
</div>

    <div class="modal fade" id="add_modal_task">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content" id="modal-content">

            </div>
        </div>
    </div>
    

    <div class="modal fade" id="task_modal_edit">
        <div class="modal-dialog">
            <div class="modal-content" id="modal-content">

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
            let actionUrl = "{{ route('account.show.allTask.destroy', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});
      function edit_modal(id){
            $.post('{{ route('account.task.edit') }}',{_token:'{{ @csrf_token() }}', id:id}, function(data){
                $('#task_modal_edit .modal-content').html(data);
                $('#task_modal_edit').modal('show', {backdrop: 'static'});
            });
        }

    </script>
    
@endsection