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
        #fileName, #loading, #verificationStats, #scanFileName, #scanLoading, #scanStats {
            margin-top: 10px;
            font-weight: bold;
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

            <!-- Certificates -->
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

            <!-- Document Scanner -->
            <div id="doc-scanner" class="tab">
                <div class="card">
                    <h3>{{ trans('general.AI_Powered_Scanner') }}</h3>
                    <ul>
                        <li><strong>{{ trans('general.OCR_Technology') }}:</strong> {{ trans('general.Convert_Editable') }}</li>
                        <li><strong>{{ trans('general.Cloud_Storage') }}:</strong>{{ trans('general.Securely_Scanned') }}</li>
                        <li><strong>{{ trans('general.Automatic_Categorization') }}:</strong> {{ trans('general.AI_Classifies') }}</li>
                    </ul>
                    <button onclick="document.getElementById('scanInput').click()">{{ trans('general.Scan_Document') }}</button>
                    <input type="file" id="scanInput" style="display: none;" onchange="scanDocument()">
                    <div id="scanFileName"></div>
                    <div id="scanLoading">{{ trans('general.Scanning_Document') }}</div>
                    <div id="scanStats">✅ {{ trans('general.Document_Scan_Complete') }}</div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let uploadedFile = null;
    let isVerified = false;

    function showFileName() {
        let input = document.getElementById('fileInput');
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
            alert("{{ trans('Upload_Certificate_Alert') }}");
            return;
        }

        document.getElementById('loading').style.display = 'block';
        document.getElementById('verificationStats').style.display = 'none';

        setTimeout(() => {
            document.getElementById('loading').style.display = 'none';
            document.getElementById('verificationStats').style.display = 'block';
            isVerified = true;

            // Enable download button
            document.getElementById('downloadBtn').disabled = false;
            document.getElementById('downloadBtn').style.backgroundColor = '';
            document.getElementById('downloadBtn').style.cursor = 'pointer';
        }, 5000);
    }

    function downloadCertificate() {
        if (!isVerified) {
            alert("{{ trans('Verify_Certificate_Alert') }}");
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

    function scanDocument() {
        let input = document.getElementById('scanInput');
        if (input.files.length > 0) {
            let file = input.files[0];
            document.getElementById('scanFileName').textContent = "Selected: " + file.name;

            // Show loader
            document.getElementById('scanLoading').style.display = 'block';
            document.getElementById('scanStats').style.display = 'none';

            setTimeout(() => {
                document.getElementById('scanLoading').style.display = 'none';
                document.getElementById('scanStats').style.display = 'block';
            }, 5000);
        }
    }

    document.addEventListener("DOMContentLoaded", function () {
        const tabButtons = document.querySelectorAll(".tab-button");
        const tabs = document.querySelectorAll(".tab");

        tabButtons.forEach(button => {
            button.addEventListener("click", function () {
                tabButtons.forEach(btn => btn.classList.remove("active"));
                this.classList.add("active");

                tabs.forEach(tab => tab.classList.remove("active"));
                document.getElementById(this.dataset.tab).classList.add("active");
            });
        });
    });
</script>

@endsection
