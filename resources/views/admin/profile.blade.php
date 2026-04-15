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
@section('title',trans('general.Profile'))


@section('admin_content')
<div class="content">

<!-- Start Content-->
<div class="container-fluid">

 <div class="py-3 d-flex align-items-sm-center flex-sm-row flex-column">
     <div class="flex-grow-1">
         <h4 class="fs-18 fw-semibold m-0">{{ trans('general.Profile') }}</h4>
     </div>

    
 </div>

 <!-- General Form -->
 <div class="row">
     <div class="col-12">
         <div class="card">

         

             <div class="card-body">
                 <div class="row">
                     <div class="col-lg-6">
                         <form enctype="multipart/form-data" method="post" action="{{route('admin.update-profile',$item->id)}}">
                         @csrf
                         <div class="mb-3">
                               <label for="fullName" class="form-label">{{ trans('general.First_Name') }}</label>
                               <input name="firstName" type="text" value="{{$item->firstName}}"  class="form-control">
                             </div>
                             <div class="mb-3">
                               <label for="fullName" class="form-label">{{ trans('general.Last_Name')}}</label>
                               <input name="lastName" type="text" value="{{$item->lastName}}"  class="form-control">
                             </div>

                             <div class="mb-3">
                               <label for="fullName" class="form-label">{{ trans('general.Email_Address') }}</label>
                               <input name="email" type="text" value="{{$item->email}}"  class="form-control">
                             </div>
                              
                             <div class="mb-3">
                                 <label for="email" class="form-label">{{ trans('general.Upload_Image') }}</label>
                                
                                    <div id="drop-area">
                                        @if(!empty($item->profile))
                                        <div class="preview-container">
                                            <img id="preview-image" src="{{ asset('public/Images/' . $item->profile) }}" alt="Preview" style="max-width: 100%; height: auto; display: block; margin: auto;" />
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
                                    <input type="file" id="file-input" name="profile" accept=".jpeg,.jpg,.png,.webp" style="display: none;" />
                            </div>
                             <div class="d-flex justify-content-end">
                               <button type="submit"  class="btn btn-primary me-2">{{ trans('general.Save') }}</button>
                               <button type="button" onclick="window.location='{{route('admin.dashboard')}}'"  class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
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
      alert("Invalid file type. Please upload a JPEG, JPG, PNG, or WEBP image.");
    }
  });

  // Handle file selection through input
  fileInput.addEventListener("change", () => {
    const file = fileInput.files[0];
    if (validateFile(file)) {
      displayImagePreview(file);
    } else {
      alert("Invalid file type. Please upload a JPEG, JPG, PNG, or WEBP image.");
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
