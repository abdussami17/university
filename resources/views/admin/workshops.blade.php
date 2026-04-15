<head> <script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script></head>
@extends('admin.app')
@section('title',trans('general.Workshops'))


@section('admin_content')
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

    <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
        <div class="flex-grow-1">
            <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Workshops') }}</h4>
        </div>

      
    </div>
      </div>
    <div class="row">
     
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">{{ trans('general.Add_New') }}</button>
                </div>
                <div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" style="display: none;">
                    <div class="modal-dialog modal-dialog-scrollable  modal-dialog-centered">
                      <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="exampleModalScrollableTitle">{{ trans('general.Add_Workshops') }}</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <div class="row ">
                                <form enctype="multipart/form-data" class="d-flex flex-wrap justify-content-between" action="{{route('admin.add-workshops')}}" method="post">
                                @csrf 
                                <div class="col-lg-6 col-12">
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ trans('general.Title') }}</label>
                                    <input required type="text" name="title" class="form-control w-100    ">
                                </div>
                                <div class="mb-3">
                                    <label for="" class="form-label">{{ trans('general.Price') }}</label>
                                    <input required name="price" type="number" class="form-control w-100    " value="200">
                                </div>
                                <div class="mb-3">
                                    <label for="texteditor3" class="form-label">{{ trans('general.Description') }}</label>
                                    <textarea  id="texteditor3" name="description"  cols="30" rows="10"></textarea>
                                </div>
                                    </div>
                                    <div class="col-lg-5 col-12">
                                        <div class="mb-3">
                                            <label for="" class="form-label">{{ trans('general.Upload_Image') }}</label>
                                            <input required type="file" name="poster" class="form-control w-100    ">
                                        </div>
                                        <!-- <div class="mb-3">
                                            <label for="" class="form-label">Add Tags</label>
                                            <div class="tag-input-container">
                                                <div class="tags" id="tags"></div>
                                                <input type="text" class="form-control" id="tagInput" placeholder="Type and press Enter...">
                                            </div>
                                        </div>                         -->
                                        <div class="mb-3">
                                    <label for="texteditor4" class="form-label">{{ trans('general.Card_Description_short') }}</label>
                                    <textarea  id="texteditor4" name="card_description" class="card_description"  cols="10" rows="10"></textarea>
                                </div>
                                            </div>
                            
                              
                              </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Close') }}</button>
                                <button type="submit" class="btn btn-primary">{{ trans('general.Save') }}</button>
                            </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table datatable" id="datatable_1">
                            <thead>
                                <tr>
                                  <th>#</th>
                                  <th>{{ trans('general.Title') }}</th>
                                  <th>{{ trans('general.Ticket_Price') }}</th>
                                  <th>{{ trans('general.Status') }}</th>
                                  <th>{{ trans('general.Action') }}</th>
                                </tr>
                              </thead>
                              
                            <tbody>
                            @if ($data->isNotEmpty())
    @foreach ($data as $index => $item)
        <tr>
            <td class="ps-0">
                {{ $loop->iteration }}
            </td>
            <td>{{ $item->title }}</td>
            <td>{{ $item->price }}</td>
            <td>
                @if($item->status == "active")
                    <span class="badge bg-success-subtle text-success">{{ $item->status }}</span>
                @else
                    <span class="badge bg-danger-subtle text-danger">{{ $item->status }}</span>
                @endif
            </td>

            <td class="text-end d-flex">
            <a href="{{ route('admin.edit-workshop', $item->id) }}" class="btn btn-sm bg-primary-subtle me-1">
            <i class="mdi mdi-pencil-outline fs-14 text-primary"></i></a>

                <a href="#" class="btn btn-sm bg-danger-subtle delete-btn" data-bs-toggle="modal"
                data-bs-target="#deleteModal" data-user-id="{{ $item->id }}">
                <i class="mdi mdi-delete fs-14 text-danger"></i>
            </a>
            </td>
        </tr>
    @endforeach
@else
<tr>
  <td></td>
</tr>
    <tr>
        <td colspan="5" class="text-center text-danger">{{ trans('general.No_Workshops_Found') }}</td>

    </tr>
@endif
<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="deleteModalLabel">{{ trans('general.Confirm_Delete', ['attribute' => trans('general.Workshop')]) }}</h1>
                <h1 class="modal-title fs-5" id="deleteModalLabel">Confirm Workshop Deletion</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>{{ trans('general.Confirm_Delete_Message', ['attribute' => trans('general.Workshop')]) }}</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Close') }}</button>
                <form id="deleteForm" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">{{ trans('general.Delete') }}</button>
                </form>

            </div>
        </div>
    </div>
</div>

                                  
                            </tbody>
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
            let actionUrl = "{{ route('admin.workshop-delete', ':id') }}".replace(':id', userId);
            form.setAttribute("action", actionUrl);
        });
    });
});
</script>

<script>


        ClassicEditor
        .create(document.querySelector('#texteditor3'))
        .catch(error => {
            console.error(error);
        });
        ClassicEditor
        .create(document.querySelector('#texteditor4'))
        .catch(error => {
            console.error(error);
        });
        const tagInput = document.getElementById('tagInput');
        const tagsContainer = document.getElementById('tags');
        const maxTags = 5;
        let tags = [];

        tagInput.addEventListener('keydown', (event) => {
            if (event.key === 'Enter') {
                event.preventDefault();
                const tagText = tagInput.value.trim();

                if (tagText && tags.length < maxTags && !tags.includes(tagText)) {
                    tags.push(tagText);
                    renderTags();
                    tagInput.value = '';
                } else if (tags.length >= maxTags) {
                  
                }
            }
        });

        function renderTags() {
            tagsContainer.innerHTML = '';
            tags.forEach((tag, index) => {
                const tagElement = document.createElement('div');
                tagElement.className = 'tag';
                tagElement.innerHTML = `${tag} <button onclick="removeTag(${index})">&times;</button>`;
                tagsContainer.appendChild(tagElement);
            });
        }

        function removeTag(index) {
            tags.splice(index, 1);
            renderTags();
        }
        
</script>
@endsection
