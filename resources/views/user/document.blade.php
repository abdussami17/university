@extends('user.layout')
@section('title', trans('general.AI_Features'))
@section('content')
    <div class="main-section">
        <div class="mb-4">
            <h4 style="  color: rgb(56, 59, 66);" class="mb-1">KI Dokumentenassistent</h4>
            <p class="text-muted mb-0">Verbessere, erstelle und analysiere deine Dokumente mit KI-Power.</p>
        </div>

        <!-- Top Tabs -->
        <div class="top-tabs">

            <button class="tab-button active" onclick="switchTab(0)"><i class="bi bi-upc-scan me-1"></i> {{ trans('general.Document_Scanner') }}</button>

            <button class="tab-button" onclick="switchTab(1)"><i class="bi bi-file-earmark-plus me-1"></i>CV-Generator</button>
            <button class="tab-button" onclick="switchTab(2)"><i class="bi bi-upc-scan me-1"></i> Analysieren &amp;
                Exportieren</button>
            <button class="tab-button" onclick="switchTab(3)"><i class="bi bi-check2-square me-1"></i> Dokument
                verbessern</button>                

                
                
        </div>

        <!-- Dynamic Tab Content -->
        <div class="card-section">

            <div id="tab-0" class="card tab-card p-4 shadow-sm">
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
            
            
            <!-- Tab 2 -->
<div class="card tab-card p-4 shadow-sm d-none" id="tab-1">
    <h5><strong><i class="fa-brands fa-react me-2"></i> Lebenslauf/Motivationsschreiben erstellen</strong></h5>
    <p class="text-muted small">Gib Auftragdetails und deine informationen an, um mabgeschneiderte Dokumente zu erstellen.</p>
    <img src="{{ asset('new_asset/images/abcd.png') }}" height="130px" width="100px" alt="Image">

    <div class="row">
        <div class="col-md-6">
            <textarea style="min-height:120px !important;background-color: rgba(237, 242, 245, 0.331);" 
                class="form-control border-0" placeholder="Stellenbeschreibung hier einfügen.."></textarea>
        </div>
        <div class="col-md-6">
            <textarea style="min-height:120px !important;background-color: rgba(237, 242, 245, 0.331);" 
                class="form-control border-0" placeholder="Deine Fähigkeiten, Erfahrungen und relevante Projekte.."></textarea>
        </div>
    </div>

    <textarea style="background-color: rgba(237, 242, 245, 0.331);" 
        class="form-control border-0 mt-4" placeholder="Über sich selbst, Ziele, Hobbys und andere
"></textarea>

    <button class="btn btn-primary w-25 mt-3 fw-medium">Dokumente erstellen</button>

    <div class="d-block gap-2 mt-2">
        <div class="card mt-2 p-3 col-md-6">
            <h6 class="mb-1 fw-semibold">Erstellter Lebenslauf:</h6>
            <p class="small text-muted mb-0">Dein Lebenslauf wird hier erscheinen..</p>
        </div>
        <div class="card mt-2 p-3 col-md-6">
            <h6 class="mb-1 fw-semibold">Erstelltes Motivationsschreiben :</h6>
            <p class="small text-muted mb-0">Dein Schreiben wird hier erscheinen..</p>
        </div>
    </div>
    <div class="exports-btn">
                        <button class="btn rounded-3"><i class="bi bi-file-earmark me-1"></i> Als PDF exportieren</button>
                    

                    </div>
</div>

            <!-- Tab 3 -->
            <div class="card tab-card p-4 shadow-sm d-none" id="tab-2">
                <h5><strong><i class="bi bi-upc-scan me-2"></i>Plagiat-Checker &amp; Export</strong></h5>
                <p class="text-muted small">Uberprufe dein Dokument auf Plagiate und exportiere es in verschiedene Formate.
                </p>
                <img src="{{ asset('new_asset/images/abcd.png') }}" height="130px" width="100px" alt="Image">
                <label for="tone1" class="form-label">Dokument fur Plagiat-Check:</label>
                <textarea style="background-color: rgba(237, 242, 245, 0.331);" class="form-control border-0"
                    placeholder="Fuge hier den text fur den Plagiat-Check ein..."></textarea>


                <button class="btn btn-primary mt-3 w-25 fw-medium">Auf Plagiate prufen</button>
                <div class="card mt-3 p-3">
                    <h6 class="mb-1 fw-semibold">Plagiat-Scan Ergebnis:</h6>
                    <p class="small text-muted mb-0">Ergebnis des Plagiat-Checks wird hier angezeigt....</p>
                </div>
                <div class="card mt-3 p-3">
                    <h6 class="mb-1 fw-semibold">Exportoptionen:</h6>
                    <div class="exports-btn">
                        <button class="btn rounded-3"><i class="bi bi-file-earmark me-1"></i> Als PDF exportieren</button>
                        <button class="btn rounded-3"><i class="bi bi-file-earmark me-1"></i> Als Word-Datei exportieren
                        </button>
                        <button class="btn rounded-3"><i class="bi bi-share-fill me-1"></i> Als Word-Datei exportieren
                        </button>


                    </div>
                </div>
            </div>


            <!-- Tab 3 -->
            <div class="card tab-card p-4 shadow-sm d-none" id="tab-3">
                <h5><strong><i class="fa-brands fa-react me-2"></i> Dokument verbessern</strong></h5>
                <p class="text-muted small">Füge deinen Text unten ein, um Grammatik, Rechtschreibung und Stil zu
                    verbessern. Wähle optional einen Zielton.</p>
                <img src="{{ asset('new_asset/images/abcd.png') }}" height="130px" width="100px" alt="Image">
                <textarea style="background-color: rgba(237, 242, 245, 0.331);" class="form-control border-0"
                    placeholder="Füge deinen Dokumenttext hier ein..."></textarea>
                <label for="tone1" class="form-label">Gewünschter Ton (optional):</label>
                <select class="form-select w-25" id="tone1">
                    <option>Standard verbessern</option>
                    <option>Professionell&amp; Formell</option>
                    <option>Freundlich &amp; Zuganglich</option>
                    <option>Uberzeugend &amp; Stark</option>
                    <option>Kurz &amp; Pragnant</option>
                    <option>Enthusiastisch &amp; Motivierrend</option>



                </select>
                <button class="btn btn-primary w-25 fw-medium">Analysieren und Verbessern</button>
                <div class="card mt-3 p-3">
                    <h6 class="mb-1 fw-semibold">Verbessertes Dokument:</h6>
                    <p class="small text-muted mb-0">Dein verbessern Text wird hier erscheinen.</p>
                </div>
            </div>

        </div>

    </div>



    {{-- <head>
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

            
            
        </div>
    </div>
</div>
--}}

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

    fetch("{{ route('document.process') }}", {
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


    document.querySelectorAll(".tab-button").forEach(button => {
        button.addEventListener("click", function () {
            document.querySelectorAll(".tab-button").forEach(btn => btn.classList.remove("active"));
            this.classList.add("active");
            document.querySelectorAll(".tab").forEach(tab => tab.classList.remove("active"));
            document.getElementById(this.dataset.tab).classList.add("active");
        });
    });
    </script>
    

    <script>
document.addEventListener('DOMContentLoaded', function () {
    const btn = document.querySelector('#tab-3 .btn-primary');
    if (!btn) return; // agar button nahi mila toh kuch na karo

    btn.addEventListener('click', function () {
let textarea = document.querySelector("#tab-3 textarea");
        let tone = document.getElementById("tone1").value;
if (!textarea) {
    toastr.error("Textfeld nicht gefunden.");
    return;
}
let text = textarea.value.trim();




        this.disabled = true;
        this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Verbessern...';

        fetch("{{ route('document.improve') }}", {
                method: "POST",
                headers: {
                    "X-CSRF-TOKEN": "{{ csrf_token() }}",
                    "Accept": "application/json",
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({ text, tone })
            })
            .then(response => response.json())
            .then(data => {
                this.disabled = false;
                this.innerHTML = 'Analysieren und Verbessern';

                if (data.error) {
                    toastr.error(data.error);
                } else {
                    document.querySelector("#tab-3 .card.mt-3 p").innerText = data.improved;
                    toastr.success("Dokument erfolgreich verbessert!");
                }
            })
            .catch(err => {
                console.error(err);
                this.disabled = false;
                this.innerHTML = 'Analysieren und Verbessern';
                toastr.error("Etwas ist schief gelaufen.");
            });
    });
});

    </script>


<script>
let generatedResume = "";
let generatedCoverLetter = "";

document.querySelector('#tab-1 .btn-primary').addEventListener('click', function() {
    let textareas = document.querySelectorAll('#tab-1 textarea');
    let jobDescription = textareas[0].value.trim();
    let skills = textareas[1].value.trim();
    let experience = textareas[2].value.trim();

    if (!jobDescription || !skills) {
        toastr.error("Bitte Stellenbeschreibung und deine Fähigkeiten/Erfahrungen eingeben.");
        return;
    }

    this.disabled = true;
    this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Dokumente erstellen...';

    fetch("{{ route('career.generateResume') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/json",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            jobDescription: jobDescription,
            skills: skills,
            experience: experience
        })
    })
    .then(response => response.json())
    .then(data => {
        this.disabled = false;
        this.innerHTML = 'Dokumente erstellen';

        if (data.resume && data.coverLetter) {
            generatedResume = data.resume;
            generatedCoverLetter = data.coverLetter;

            // Replace paragraph with textarea for Resume
            let resumeContainer = document.querySelector('#tab-1 .card.mt-2.p-3:nth-child(1)');
            resumeContainer.querySelector('p').outerHTML =
                `<textarea class="form-control border-0 bg-light" style="min-height:500px;">${data.resume}</textarea>`;

            // Replace paragraph with textarea for Cover Letter
            let coverContainer = document.querySelector('#tab-1 .card.mt-2.p-3:nth-child(2)');
            coverContainer.querySelector('p').outerHTML =
                `<textarea class="form-control border-0 bg-light" style="min-height:500px;">${data.coverLetter}</textarea>`;

            toastr.success("Dokumente erfolgreich erstellt!");
        } else {
            toastr.error("Konnte Dokumente nicht erstellen.");
        }
    })
    .catch(error => {
        console.error(error);
        this.disabled = false;
        this.innerHTML = 'Dokumente erstellen';
        toastr.error("Etwas ist schief gelaufen.");
    });
});

// 📄 PDF export button click
document.querySelector('#tab-1 .exports-btn button').addEventListener('click', function() {
    if (!generatedResume || !generatedCoverLetter) {
        toastr.error("Bitte erst Dokumente erstellen, bevor du exportierst.");
        return;
    }

    fetch("{{ route('career.downloadPdf') }}", {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": "{{ csrf_token() }}",
            "Accept": "application/pdf",
            "Content-Type": "application/json"
        },
        body: JSON.stringify({
            resume: generatedResume,
            coverLetter: generatedCoverLetter
        })
    })
    .then(response => response.blob())
    .then(blob => {
        let link = document.createElement('a');
        link.href = URL.createObjectURL(blob);
        link.download = "resume_and_cover_letter.pdf";
        link.click();
    })
    .catch(err => console.error(err));
});

</script>


    <script>
        document.querySelector('#tab-2 .btn-primary').addEventListener('click', function() {
            let textarea = document.querySelector('#tab-2 textarea').value.trim();

            if (!textarea) {
                toastr.error("Bitte gebe einen Text für den Plagiat-Check ein.");
                return;
            }

            this.disabled = true;
            this.innerHTML = '<span class="spinner-border spinner-border-sm"></span> Prüfen...';

            fetch("{{ route('plagiarism.check') }}", {
                    method: "POST",
                    headers: {
                        "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        "Accept": "application/json",
                        "Content-Type": "application/json"
                    },
                    body: JSON.stringify({
                        text: textarea
                    })
                })
                .then(response => response.json())
                .then(data => {
                    this.disabled = false;
                    this.innerHTML = 'Auf Plagiate prüfen';

                    if (data.result) {
                        document.querySelector('#tab-2 .card.mt-3.p-3 p').innerHTML = data.result;
                        toastr.success("Plagiat-Check abgeschlossen!");
                    } else {
                        toastr.error("Keine Ergebnisse erhalten.");
                    }
                })
                .catch(error => {
                    console.error(error);
                    this.disabled = false;
                    this.innerHTML = 'Auf Plagiate prüfen';
                    toastr.error("Etwas ist schief gelaufen.");
                });
        });
    </script>




    <script>
        function switchTab(index) {
            // Switch active tab button
            document.querySelectorAll('.tab-button').forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            // Switch card content
            document.querySelectorAll('.tab-card').forEach((card, i) => {
                card.classList.toggle('d-none', i !== index);
            });
        }
    </script>

<script>
document.querySelectorAll('#tab-2 .exports-btn .btn').forEach(function(btn, index) {
    btn.addEventListener('click', function() {
        let content = document.querySelector('#tab-2 .card.mt-3.p-3 p').innerText;

        if (!content || content.includes('wird hier angezeigt')) {
            toastr.error("Bitte zuerst den Plagiat-Check durchführen.");
            return;
        }

        let route = index === 0 ?
            "{{ route('export.pdf') }}" :
            "{{ route('export.word') }}";

        fetch(route, {
            method: "POST",
            headers: {
                "X-CSRF-TOKEN": "{{ csrf_token() }}",
                "Accept": "application/json",
                "Content-Type": "application/json"
            },
            body: JSON.stringify({ content })
        })
        .then(async response => {
            if (!response.ok) {
                // Read once as text
                const text = await response.text();
                // Try to parse JSON from it
                try {
                    const json = JSON.parse(text);
                    throw new Error("Server error: " + JSON.stringify(json));
                } catch (e) {
                    // If not JSON, show raw text
                    throw new Error("Server error: " + text);
                }
            }
            return response.blob();
        })
        .then(blob => {
            let fileType = index === 0 ? "application/pdf" :
                "application/vnd.openxmlformats-officedocument.wordprocessingml.document";
            let fileName = index === 0 ? "document.pdf" : "document.docx";

            let link = document.createElement('a');
            link.href = window.URL.createObjectURL(new Blob([blob], { type: fileType }));
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            link.remove();
        })
        .catch(error => {
            console.error(error);
            toastr.error("Export fehlgeschlagen: " + error.message);
        });
    });
});
</script>

@endsection
