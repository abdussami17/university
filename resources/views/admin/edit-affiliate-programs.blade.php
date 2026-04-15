<head>
<style>
    #drop-area {
      border: 2px dashed #ccc;
      border-radius: 5px;
      padding: 20px;
      text-align: center;
      cursor: pointer;
      transition: background-color 0.3s ease;
    }
    #drop-area:hover {
      background-color: #f9f9f9;
    }
    #drop-area.drag-over {
      border-color: #007bff;
      background-color: #f1faff;
    }
    .drop-icon {
      font-size: 24px;
      color: #888;
      margin-bottom: 10px;
    }
    .drop-text {
      font-size: 16px;
      color: #555;
    }
    .preview-container img {
      max-height: 200px;
    }
</style>    
<script src="https://cdn.ckeditor.com/ckeditor5/39.0.0/classic/ckeditor.js"></script></head>
@extends('admin.app')
@section('title',trans('general.Edit_Affiliate_Program'))


@section('admin_content')
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

 <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
     <div class="flex-grow-1">
         <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Edit_Affiliate_Program') }}</h4>
     </div>

    
 </div>

 <!-- General Form -->
 <div class="row">
     <div class="col-12">
         <div class="card">

         

             <div class="card-body">
                 <div class="row">
                     <div class="col-lg-6">
                         <form enctype="multipart/form-data" method="post" action="{{route('admin.affiliate-update',$item->id)}}">
                         @csrf
                            <div class="mb-3">
                               <label for="fullName" class="form-label">{{ trans('general.Title') }}</label>
                               <input name="title" type="text" value="{{$item->title}}"  class="form-control">
                             </div>
                           
                             <div class="mb-3">
                                <label for="status" class="form-label">{{ trans('general.Status') }}</label>
                                <select id="status" class="form-control" name="status">
                                    <option value="active" {{ $item->status == 'active' ? 'selected' : '' }}>{{ trans('general.Active') }}</option>
                                    <option value="pending" {{ $item->status == 'pending' ? 'selected' : '' }}>{{ trans('general.Pending') }}</option>
                                </select>
                            </div>

                           
                             
                           
                             <div class="mb-3">
                                 <label for="email" class="form-label">{{ trans('general.Ticket_Price') }}</label>
                                <input type="number" name="price"  class="form-control"  value="{{$item->price}}">
                               </div>
                               <div class="mb-3">
                                 <label for="texteditor3" class="form-label">{{ trans('general.Description') }}</label>
                                 <textarea id="texteditor3" name="description"  cols="30" rows="10">{{$item->description}}</textarea>
                             </div>
                             <div class="mb-3">
                                 <label for="texteditor4" class="form-label">{{ trans('general.Card_Description_short') }}</label>
                                 <textarea id="texteditor4" name="card_description"  cols="30" rows="10">{{$item->card_description}}</textarea>
                             </div>
                             <div class="mb-3">
                                 <label for="email" class="form-label">{{ trans('general.Upload_Image') }}</label>
                                
                                    <div id="drop-area">
                                        @if(!empty($item->poster))
                                        <div class="preview-container">
                                            <img id="preview-image" src="{{ asset('Images/' . $item->poster) }}" alt="Preview" style="max-width: 100%; height: auto; display: block; margin: auto;" />
                                        </div>
                                        @else
                                        <div class="preview-container" style="display: none;">
                                            <img id="preview-image" src="#" alt="Preview" style="max-width: 100%; height: auto; display: block; margin: auto;" />
                                        </div>
                                        @endif
                                        <div class="upload-instructions">
                                            <div class="drop-icon">
                                                <i class="fa fa-upload" aria-hidden="true"></i>
                                            </div>
                                            <div class="drop-text">{{ trans('general.Drag_Drop') }}</div>
                                        </div>
                                    </div>
                                    <input type="file" id="file-input" name="poster" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
                                </div>
                             <div class="d-flex justify-content-end">
                               <button type="submit"  class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                               <button type="button" onclick="window.location='{{route('admin.affiliate-programs')}}'"  class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                             </div>
                           </form>
                           
                     </div>

                 
                 </div>
             </div>

         </div>
     </div>
 </div>

 
</div> <!-- container-fluid -->
</div>

<script>
       const dropArea = document.getElementById("drop-area");
  const fileInput = document.getElementById("file-input");
  const previewContainer = document.querySelector(".preview-container");
  const previewImage = document.getElementById("preview-image");
  const uploadInstructions = document.querySelector(".upload-instructions");


  dropArea.addEventListener("click", () => fileInput.click());


  dropArea.addEventListener("dragover", (e) => {
    e.preventDefault();
    dropArea.classList.add("drag-over");
  });

  dropArea.addEventListener("dragleave", () => dropArea.classList.remove("drag-over"));

  dropArea.addEventListener("drop", (e) => {
    e.preventDefault();
    dropArea.classList.remove("drag-over");

    const file = e.dataTransfer.files[0];
    if (validateFile(file)) {
      fileInput.files = e.dataTransfer.files;
      displayImagePreview(file);
    } else {
      alert("{{ trans('general.invalid_file_type') }}");
    }
  });

  // Handle file selection through input
  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (validateFile(file)) {
      displayImagePreview(file);
    } else {
      alert("{{ trans('general.invalid_file_type') }}");
      fileInput.value = ""; 
    }
  });


  function validateFile(file) {
    const allowedTypes = ["image/jpeg", "image/jpg", "image/png", "image/webp"];
    return file && allowedTypes.includes(file.type);
  }

  function displayImagePreview(file) {
    const reader = new FileReader();
    reader.onload = (e) => {
      previewImage.src = e.target.result;
      previewContainer.style.display = "block";
      uploadInstructions.style.display = "none";
    };
    reader.readAsDataURL(file);
  }
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
   
        
</script>
@endsection
