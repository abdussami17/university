
@extends('admin.app')
@section('title','Treffen')
@section('admin_content')
<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
    
        <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
            <div class="flex-grow-1">
                <h4 class="fs-18 fw-semibold m-0">Treffen Sie die Liste</h4>
            </div>      
        </div>
    
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header">

                            <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Neues Ereignis hinzufügen
</button>
                        
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table datatable" id="myTable">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th>{{ trans('general.Name') }}</th>
                                    <th>{{ trans('general.Category') }}</th>
                                    <th>{{ trans('general.Thumb') }}</th>
                                    <th style="text-align:end">{{ trans('general.Action') }}</th>
                                  </tr>
                                </thead>
                                <tbody>
                                    @foreach (App\Models\meet::get() as $key => $item)
                                    @php
                                    $parent= App\Models\meet::where('id',$item->parent_id)->first();
                                    @endphp
                                        <!-- Parent Category -->
                                        <tr>
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $item->name }}</td>
                                        <td>
                                            @if ($item->parent_id==0)
                                                <span class="badge bg-success">Elternteil</span>
                                            @else
                                              <span class="badge bg-primary"> ( {{ $parent->name }})</span>
                                            @endif
                                        </td>
                                        @if($item->image)
                                            <td><img src="{{ asset($item->image) }}" alt="" width="50px" height="50px"></td>
                                        @else
                                        <p>no image</p>
                                        @endif    
                                        <td class="text-end">
<a href="{{ route('admin.event.edit', $item->id) }}" class="btn btn-sm bg-primary-subtle">
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
                                                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ trans('general.Confirm_Delete', ['attribute' => trans('general.Post')]) }}</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <p>{{ trans('general.Confirm_Delete_Message', ['attribute' => trans('general.Post')]) }}</p>
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

    <!-- Modal -->
<div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('admin.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Neues Ereignis hinzufügen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Parent</label>
            <select name="parent_id" id="" class="form-control">
                <option value="0">Parent</option>
                @foreach (App\Models\meet::where('parent_id',0)->get() as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                @endforeach
            </select>
          </div>

          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
          </div>

          <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" name="time" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
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

        document.addEventListener("DOMContentLoaded", function () {
    document.querySelectorAll(".delete-btn").forEach(button => {
        button.addEventListener("click", function () {
            let userId = this.getAttribute("data-user-id");
            let form = document.getElementById("deleteForm");
            let actionUrl = "{{ route('admin.event.destroy', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});

    </script>
    
@endsection