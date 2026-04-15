@extends('admin.app')
@section('title',trans('general.AI_Features'))
@section('admin_content')


<head>
    <style>
        body {
            margin: 5px;
            background: #f4f4f4;
        }
        .tab {
            display: none;
            background: white;
            padding: 20px;
            border-radius: 5px;
        }
        .tab.active {
            display: block;
        }
        .tabs {
            display: flex;
            margin-bottom: 20px;
        }
        .tab-button {
            padding: 10px 15px;
            cursor: pointer;
            background: transparent;
            border-radius: 5px;
        }
        .tab-button.active {
            background: linear-gradient(135deg, rgb(42, 44, 176) 0%, rgb(71, 71, 222) 100%);
            color: white;
        }
        .card {
            border: 1px solid #ddd;
            padding: 20px;
            margin-bottom: 10px;
            border-radius: 5px;
            background: #fff;
            box-shadow: 2px 2px 10px rgba(0,0,0,0.1);
        }
        button {
            background: #287F71;
            color: white;
            border: none;
            padding: 10px;
            width: 200px;
            margin-left: 0px;
            cursor: pointer;
            border-radius: 5px;
        }
        .button-group {
            gap: 20px;
        }
        #loading, #scanLoading {
            display: none;
            color: blue;
        }
        #verificationStats, #scanStats {
            display: none;
            color: green;
        }
        #downloadBtn {
            background-color: gray;
            cursor: not-allowed;
        }
    </style>
</head>

<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
            <div class="tabs">
            <button class="tab-button active" onclick="switchTab(3)"><i class="bi bi-upc-scan me-1"></i> {{ trans('general.Document_Scanner') }}</button>

            </div>

            <div id="tab-3" class="card tab-card p-4 shadow-sm">
                <div class="">
                    <h3>{{ trans('general.AI_Powered_Document_Processing') }}</h3>
                    <label class="form-label">{{ trans('general.Upload_Document') }}</label>
                    <input type="file" class="form-control" id="docInput" accept="application/pdf">

                    <div id="previewContainer" class="mt-3 d-none">
                        <h5>{{ trans('general.Document_Preview') }}:</h5>
                        <img id="imagePreview" class="img-fluid border p-2" style="max-height: 200px; display: none;">
                        <iframe id="pdfPreview" class="w-100 border p-2" style="height: 250px; display: none;"></iframe>
                    </div>

                    <button class="btn btn-success mt-3" id="processBtn" disabled>{{ trans('general.Extract_Text') }}</button>

                    <button class="btn btn-primary w-100 d-none" type="button" disabled id="loader-button">
                        <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                        {{ trans('general.Loading') }}
                    </button>

                    <div class="mt-3">
                        <h5>{{ trans('general.Extracted_Text') }}:</h5>
                        <textarea class="form-control" id="extractedText" rows="5" readonly></textarea>
                    </div>
                </div>
            </div>

            
            
        </div>
    </div>
</div>



@endsection



@section('script')
    
<script>
        document.getElementById("docInput").addEventListener("change", function(event) {
        let file = event.target.files[0];
        let previewContainer = document.getElementById("previewContainer");
        let imagePreview = document.getElementById("imagePreview");
        let pdfPreview = document.getElementById("pdfPreview");
        let processBtn = document.getElementById("processBtn");
    
        if (!file) return;
    
        let fileType = file.type;
        previewContainer.classList.remove("d-none");
        imagePreview.style.display = "none";
        pdfPreview.style.display = "none";
    
        if (fileType.startsWith("image/")) {
            let reader = new FileReader();
            reader.onload = function(e) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block";
            };
            reader.readAsDataURL(file);
        } else if (fileType === "application/pdf") {
            pdfPreview.src = URL.createObjectURL(file);
            pdfPreview.style.display = "block";
        }
    
        processBtn.disabled = false;
    });

    document.getElementById("processBtn").addEventListener("click", function() {
    let fileInput = document.getElementById("docInput").files[0];
    let processBtn = document.getElementById("processBtn");
    let loaderBtn = document.getElementById("loader-button");

    if (!fileInput) {
        toastr.error("{{ trans('general.Upload_Document_First') }}");
        return;
    }

    processBtn.classList.add("d-none");
    loaderBtn.classList.remove("d-none");

    let formData = new FormData();
    formData.append("document", fileInput);
    formData.append("_token", "{{ csrf_token() }}");

    fetch("{{ route('admin.document.process') }}", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {

        loaderBtn.classList.add("d-none");
        processBtn.classList.remove("d-none");

        if (data.error) {
            toastr.error(data.error);
        } else {
            document.getElementById("extractedText").value = data.text;
            toastr.success("Text extracted successfully!");
        }
    })
    .catch(error => {
        console.error("Error:", error);
        toastr.error("{{ trans('general.Failed_Process_Document') }}");


        loaderBtn.classList.add("d-none");
        processBtn.classList.remove("d-none");
    });
});


    </script>
    



@endsection