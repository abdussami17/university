@extends('user.layout')
@section('title',trans('general.AI_Features'))
@section('content')

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
                <div class="tab-button active" data-tab="certificates">{{ trans('general.Certificates') }}</div>
                <div class="tab-button" data-tab="doc-scanner">{{ trans('general.Document_Scanner') }}</div>
            </div>
            <!-- Certificates Tab -->
            <div id="certificates" class="tab active">
                <div class="card">
                    <h3>{{ trans('general.Certificates_Management') }}</h3>
                    <p>{{ trans('general.Upload_Verify') }}</p>
                    <div class="button-group">
                        <button onclick="document.getElementById('fileInput').click()">{{ trans('general.Upload_Certificate') }}</button>
                        <button onclick="verifyCertificate()">{{ trans('general.Verify_Certificate') }}</button>
                        <button id="downloadBtn" onclick="downloadCertificate()" disabled>{{ trans('general.Download_Certificate') }}</button>
                    </div>
                    <input type="file" id="fileInput" style="display: none;" onchange="showFileName()">
                    <div id="fileName"></div>
                    <div id="loading">{{ trans('general.Scanning_Certificate') }}</div>
                    <div id="verificationStats">✅ {{ trans('general.Valid_Certificate') }}</div>
                </div>
            </div>

            <!-- Document Scanner Tab -->
            <div id="doc-scanner" class="tab">
                <div class="card">
                    <h3>{{ trans('general.AI_Powered_Scanner') }}</h3>
                    <label class="form-label">{{ trans('general.Upload_Document') }}</label>
                    <input type="file" class="form-control" id="docInput" accept="image/*,application/pdf">

                    <div id="previewContainer" class="mt-3 d-none">
                        <h5>{{ trans('general.Document_Preview') }}:</h5>
                        <img id="imagePreview" class="img-fluid border p-2" style="max-height: 200px; display: none;">
                        <iframe id="pdfPreview" class="w-100 border p-2" style="height: 250px; display: none;"></iframe>
                    </div>

                    <button class="btn btn-success mt-3" id="processBtn" disabled>{{ trans('general.Extract_Text') }}</button>

                    <div class="mt-3">
                        <h5>{{ trans('general.Extracted_Text') }}:</h5>
                        <textarea class="form-control" id="extractedText" rows="5" readonly></textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let uploadedFile = null;
    let isVerified = false;

    function showFileName(inputId) {
        let input = document.getElementById(inputId);
        if (input.files.length > 0) {
            uploadedFile = input.files[0];
            isVerified = false;
            document.getElementById('fileName').textContent = "Selected: " + uploadedFile.name;
            document.getElementById('verificationStats').style.display = 'none';
            document.getElementById('downloadBtn').disabled = true;
            document.getElementById('downloadBtn').style.backgroundColor = 'gray';
            document.getElementById('downloadBtn').style.cursor = 'not-allowed';
        }
    }

    function verifyCertificate() {
        if (!uploadedFile) {
            alert("{{ trans('general.Upload_Certificate_Alert') }}");
            return;
        }

        document.getElementById('loading').style.display = 'block';
        document.getElementById('verificationStats').style.display = 'none';

        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('verificationStats').style.display = 'block';
            isVerified = true;

            document.getElementById('downloadBtn').disabled = false;
            document.getElementById('downloadBtn').style.backgroundColor = '';
            document.getElementById('downloadBtn').style.cursor = 'pointer';
        }, 5000);
    }

    function downloadCertificate() {
        if (!isVerified) {
            alert("{{ trans('general.Verify_Certificate_Alert') }}");            
            return;
        }

        let originalName = uploadedFile.name;
        let fileExtension = originalName.substring(originalName.lastIndexOf('.')) || '.pdf';
        let fileNameWithoutExt = originalName.substring(0, originalName.lastIndexOf('.')) || 'certificate';

        let verifiedFileName = fileNameWithoutExt + "_verified" + fileExtension;

        let link = document.createElement('a');
        link.href = 'example.pdf'; 
        link.download = verifiedFileName;
        document.body.appendChild(link);
        link.click();
        document.body.removeChild(link);
    }

    document.getElementById("docInput").addEventListener("change", function (event) {
        let file = event.target.files[0];
        if (!file) return;

        let previewContainer = document.getElementById("previewContainer");
        let imagePreview = document.getElementById("imagePreview");
        let pdfPreview = document.getElementById("pdfPreview");
        let processBtn = document.getElementById("processBtn");

        previewContainer.classList.remove("d-none");
        imagePreview.style.display = "none";
        pdfPreview.style.display = "none";

        let fileType = file.type;
        let reader = new FileReader();

        reader.onload = function (e) {
            if (fileType.startsWith("image/")) {
                imagePreview.src = e.target.result;
                imagePreview.style.display = "block";
            } else if (fileType === "application/pdf") {
                pdfPreview.src = e.target.result;
                pdfPreview.style.display = "block";
            }
        };
        reader.readAsDataURL(file);

        processBtn.disabled = false;
    });

    document.getElementById("processBtn").addEventListener("click", function () {
        let extractedText = document.getElementById("extractedText");
        extractedText.value = "{{ trans('general.Processing_Document') }}";
        setTimeout(() => {
            extractedText.value = "{{ trans('general.Sample_Text') }}";
        }, 2000);
    });

    document.querySelectorAll(".tab-button").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".tab-button").forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            document.querySelectorAll(".tab").forEach(tab => tab.classList.remove("active"));
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
</script>

@endsection
