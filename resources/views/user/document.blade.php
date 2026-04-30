@extends('user.layout')
@section('title', trans('general.AI_Features'))
@section('content')

  <!-- ══════════════════════════════ MAIN ══════════════════════════════ -->
  <div class="sdapp-main-wrapper">
    <div class="sdapp-page-content">

      <!-- Page header -->
      <div class="sdapp-page-header">
        <h1 class="sdapp-page-header__title">Dokumenten-KI</h1>
        <p class="sdapp-page-header__subtitle">Lass die KI für dich arbeiten: Erstelle mühelos Bewerbungen oder erhalte Feedback für deine Hausarbeiten.</p>
      </div>

      <!-- Tabs -->
      <div class="sdapp-doc-tabs-wrapper sdapp-doc-tabs">
        <ul class="nav nav-tabs" id="docTabs" role="tablist">
          <li class="nav-item" role="presentation">
            <button class="nav-link active" id="bewerbung-tab" data-bs-toggle="tab" data-bs-target="#bewerbung" type="button" role="tab">Bewerbung</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="lebenslauf-tab" data-bs-toggle="tab" data-bs-target="#lebenslauf" type="button" role="tab">Lebenslauf</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="anschreiben-tab" data-bs-toggle="tab" data-bs-target="#anschreiben" type="button" role="tab">Anschreiben</button>
          </li>
          <li class="nav-item" role="presentation">
            <button class="nav-link" id="hausarbeit-tab" data-bs-toggle="tab" data-bs-target="#hausarbeit" type="button" role="tab">Hausarbeit</button>
          </li>
        </ul>

        <div class="tab-content" id="docTabsContent">

          <!-- ── Tab: Bewerbung ── -->
          <div class="tab-pane fade show active" id="bewerbung" role="tabpanel">

            {{-- Drop zone --}}
            <div class="sdapp-doc-dropzone" id="dropzone-bewerbung" onclick="document.getElementById('sdapp-upload-bewerbung').click();">
              <div class="sdapp-doc-dropzone__icon">
                <i data-lucide="cloud-upload" width="40" height="40"></i>
              </div>
              <div class="sdapp-doc-dropzone__title">{{ trans('general.AI_Powered_Document_Processing') }}</div>
              <div class="sdapp-doc-dropzone__subtitle">{{ trans('general.Upload_Document') }}</div>
              <button class="sdapp-btn sdapp-btn--outline" type="button">Datei auswählen</button>
              <input type="file" id="sdapp-upload-bewerbung" style="display:none;" accept="application/pdf" />
            </div>

            {{-- Preview (hidden until file chosen) --}}
            <div id="previewContainer-bewerbung" class="mt-3 mb-3 d-none">
              <h6>{{ trans('general.Document_Preview') }}:</h6>
              <img id="imagePreview-bewerbung" class="img-fluid border p-2" style="max-height:200px;display:none;" alt="preview">
              <iframe id="pdfPreview-bewerbung" class="w-100 border p-2" style="height:250px;display:none;"></iframe>
            </div>

            {{-- Extract button --}}
            <button class="sdapp-btn sdapp-btn--primary sdapp-doc-generate-btn" id="processBtn-bewerbung" disabled>
              {{ trans('general.Extract_Text') }}
            </button>

            {{-- Loader --}}
            <button class="sdapp-btn sdapp-btn--primary sdapp-doc-generate-btn d-none" id="loader-bewerbung" type="button" disabled>
              <span class="spinner-border spinner-border-sm me-2" role="status" aria-hidden="true"></span>
              {{ trans('general.Loading') }}
            </button>

            {{-- Extracted text --}}
            <div class="mt-3">
              <h6>{{ trans('general.Extracted_Text') }}:</h6>
              <textarea class="form-control" id="extractedText-bewerbung" rows="5" readonly></textarea>
            </div>

            {{-- Example output box --}}
            <div class="sdapp-doc-example-box mt-4">
              <div class="sdapp-doc-example-box__title">Beispiel-Output</div>
              <p class="sdapp-doc-example-box__text">"Die KI-Analyse ist eine simulierte Funktion. In einer echten Anwendung würde hier das Ergebnis deiner Analyse, dein generiertes Anschreiben oder dein optimierter Lebenslauf angezeigt."</p>
            </div>
          </div>

          <!-- ── Tab: Lebenslauf ── -->
          <div class="tab-pane fade" id="lebenslauf" role="tabpanel">

            <div class="sdapp-doc-dropzone" onclick="document.getElementById('sdapp-upload-lebenslauf').click();">
              <div class="sdapp-doc-dropzone__icon">
                <i data-lucide="cloud-upload" width="40" height="40"></i>
              </div>
              <div class="sdapp-doc-dropzone__title">Lebenslauf optimieren lassen</div>
              <div class="sdapp-doc-dropzone__subtitle">Lade deinen aktuellen Lebenslauf hoch und erhalte Verbesserungsvorschläge.</div>
              <button class="sdapp-btn sdapp-btn--outline" type="button">Datei auswählen</button>
              <input type="file" id="sdapp-upload-lebenslauf" style="display:none;" accept=".pdf,.doc,.docx" />
            </div>

            {{-- Inputs for resume generation --}}
            <div class="row mb-3">
              <div class="col-md-6">
                <textarea id="lebenslauf-job" style="min-height:120px;background-color:rgba(237,242,245,0.33);" class="form-control border-0" placeholder="Stellenbeschreibung hier einfügen.."></textarea>
              </div>
              <div class="col-md-6">
                <textarea id="lebenslauf-skills" style="min-height:120px;background-color:rgba(237,242,245,0.33);" class="form-control border-0" placeholder="Deine Fähigkeiten, Erfahrungen und relevante Projekte.."></textarea>
              </div>
            </div>
            <textarea id="lebenslauf-extra" style="background-color:rgba(237,242,245,0.33);" class="form-control border-0 mb-3" placeholder="Über sich selbst, Ziele, Hobbys und andere"></textarea>

            <button class="sdapp-btn sdapp-btn--primary sdapp-doc-generate-btn" id="lebenslauf-generate-btn">Lebenslauf optimieren</button>

            {{-- Result cards --}}
            <div class="d-block gap-2 mt-2" id="lebenslauf-results">
              <div class="card mt-2 p-3 col-md-6" id="lebenslauf-result-card">
                <h6 class="mb-1 fw-semibold">Erstellter Lebenslauf:</h6>
                <p class="small text-muted mb-0">Dein Lebenslauf wird hier erscheinen..</p>
              </div>
              <div class="card mt-2 p-3 col-md-6" id="cover-letter-result-card">
                <h6 class="mb-1 fw-semibold">Erstelltes Motivationsschreiben:</h6>
                <p class="small text-muted mb-0">Dein Schreiben wird hier erscheinen..</p>
              </div>
            </div>

            <div class="exports-btn mt-3">
              <button class="btn rounded-3" id="lebenslauf-pdf-export-btn">
                <i class="bi bi-file-earmark me-1"></i> Als PDF exportieren
              </button>
            </div>

            <div class="sdapp-doc-example-box mt-4">
              <div class="sdapp-doc-example-box__title">Beispiel-Output</div>
              <p class="sdapp-doc-example-box__text">"Die KI-Analyse ist eine simulierte Funktion. In einer echten Anwendung würde hier das Ergebnis deiner Analyse, dein generiertes Anschreiben oder dein optimierter Lebenslauf angezeigt."</p>
            </div>
          </div>

          <!-- ── Tab: Anschreiben (Plagiat-Checker) ── -->
          <div class="tab-pane fade" id="anschreiben" role="tabpanel">

            <div class="sdapp-doc-dropzone" onclick="document.getElementById('sdapp-upload-anschreiben').click();">
              <div class="sdapp-doc-dropzone__icon">
                <i data-lucide="cloud-upload" width="40" height="40"></i>
              </div>
              <div class="sdapp-doc-dropzone__title">Anschreiben erstellen lassen</div>
              <div class="sdapp-doc-dropzone__subtitle">Lade die Stellenausschreibung hoch und erhalte ein individuelles Anschreiben.</div>
              <button class="sdapp-btn sdapp-btn--outline" type="button">Datei auswählen</button>
              <input type="file" id="sdapp-upload-anschreiben" style="display:none;" accept=".pdf,.doc,.docx,.txt" />
            </div>

            {{-- Plagiarism check text input --}}
            <label class="form-label">Dokument für Plagiat-Check:</label>
            <textarea id="anschreiben-plagiat-text" style="background-color:rgba(237,242,245,0.33);" class="form-control border-0 mb-3" placeholder="Füge hier den Text für den Plagiat-Check ein..."></textarea>

            <button class="sdapp-btn sdapp-btn--primary sdapp-doc-generate-btn" id="anschreiben-plagiat-btn">Anschreiben generieren</button>

            <div class="card mt-3 p-3" id="anschreiben-plagiat-result">
              <h6 class="mb-1 fw-semibold">Plagiat-Scan Ergebnis:</h6>
              <p class="small text-muted mb-0">Ergebnis des Plagiat-Checks wird hier angezeigt....</p>
            </div>

            <div class="card mt-3 p-3">
              <h6 class="mb-1 fw-semibold">Exportoptionen:</h6>
              <div class="exports-btn" id="anschreiben-exports">
                <button class="btn rounded-3"><i class="bi bi-file-earmark me-1"></i> Als PDF exportieren</button>
                <button class="btn rounded-3"><i class="bi bi-file-earmark me-1"></i> Als Word-Datei exportieren</button>
                <button class="btn rounded-3"><i class="bi bi-share-fill me-1"></i> Als Word-Datei exportieren</button>
              </div>
            </div>

            <div class="sdapp-doc-example-box mt-4">
              <div class="sdapp-doc-example-box__title">Beispiel-Output</div>
              <p class="sdapp-doc-example-box__text">"Die KI-Analyse ist eine simulierte Funktion. In einer echten Anwendung würde hier das Ergebnis deiner Analyse, dein generiertes Anschreiben oder dein optimierter Lebenslauf angezeigt."</p>
            </div>
          </div>

          <!-- ── Tab: Hausarbeit (Dokument verbessern) ── -->
          <div class="tab-pane fade" id="hausarbeit" role="tabpanel">

            <div class="sdapp-doc-dropzone" onclick="document.getElementById('sdapp-upload-hausarbeit').click();">
              <div class="sdapp-doc-dropzone__icon">
                <i data-lucide="cloud-upload" width="40" height="40"></i>
              </div>
              <div class="sdapp-doc-dropzone__title">Hausarbeit prüfen lassen</div>
              <div class="sdapp-doc-dropzone__subtitle">Lade deine Hausarbeit hoch und erhalte detailliertes Feedback.</div>
              <button class="sdapp-btn sdapp-btn--outline" type="button">Datei auswählen</button>
              <input type="file" id="sdapp-upload-hausarbeit" style="display:none;" accept=".pdf,.doc,.docx,.txt" />
            </div>

            {{-- Improve text inputs --}}
            <textarea id="hausarbeit-text" style="background-color:rgba(237,242,245,0.33);" class="form-control border-0 mb-3" placeholder="Füge deinen Dokumenttext hier ein..."></textarea>

            <label for="tone1" class="form-label">Gewünschter Ton (optional):</label>
            <select class="form-select mb-3" style="width:auto;" id="tone1">
              <option>Standard verbessern</option>
              <option>Professionell &amp; Formell</option>
              <option>Freundlich &amp; Zugänglich</option>
              <option>Überzeugend &amp; Stark</option>
              <option>Kurz &amp; Prägnant</option>
              <option>Enthusiastisch &amp; Motivierend</option>
            </select>

            <button class="sdapp-btn sdapp-btn--primary sdapp-doc-generate-btn" id="hausarbeit-improve-btn">Feedback erhalten</button>

            <div class="card mt-3 p-3">
              <h6 class="mb-1 fw-semibold">Verbessertes Dokument:</h6>
              <p class="small text-muted mb-0" id="hausarbeit-result-text">Dein verbesserter Text wird hier erscheinen.</p>
            </div>

            <div class="sdapp-doc-example-box mt-4">
              <div class="sdapp-doc-example-box__title">Beispiel-Output</div>
              <p class="sdapp-doc-example-box__text">"Die KI-Analyse ist eine simulierte Funktion. In einer echten Anwendung würde hier das Ergebnis deiner Analyse, dein generiertes Anschreiben oder dein optimierter Lebenslauf angezeigt."</p>
            </div>
          </div>

        </div><!-- /tab-content -->
      </div><!-- /tabs wrapper -->

    </div><!-- /page-content -->
  </div><!-- /main-wrapper -->

@endsection

@section('script')

  {{-- ══════════════════════════════════════════════════
       1. BEWERBUNG TAB — File upload preview + PDF text extraction
  ══════════════════════════════════════════════════ --}}
  <script>
    document.getElementById('sdapp-upload-bewerbung').addEventListener('change', function (event) {
      const file = event.target.files[0];
      if (!file) return;

      const previewContainer = document.getElementById('previewContainer-bewerbung');
      const imagePreview     = document.getElementById('imagePreview-bewerbung');
      const pdfPreview       = document.getElementById('pdfPreview-bewerbung');
      const processBtn       = document.getElementById('processBtn-bewerbung');

      previewContainer.classList.remove('d-none');
      imagePreview.style.display = 'none';
      pdfPreview.style.display   = 'none';

      if (file.type.startsWith('image/')) {
        const reader = new FileReader();
        reader.onload = e => { imagePreview.src = e.target.result; imagePreview.style.display = 'block'; };
        reader.readAsDataURL(file);
      } else if (file.type === 'application/pdf') {
        pdfPreview.src = URL.createObjectURL(file);
        pdfPreview.style.display = 'block';
      }

      processBtn.disabled = false;
    });

    document.getElementById('processBtn-bewerbung').addEventListener('click', function () {
      const fileInput  = document.getElementById('sdapp-upload-bewerbung').files[0];
      const processBtn = document.getElementById('processBtn-bewerbung');
      const loaderBtn  = document.getElementById('loader-bewerbung');

      if (!fileInput) {
        toastr.error("{{ trans('general.Upload_Document_First') }}");
        return;
      }

      processBtn.classList.add('d-none');
      loaderBtn.classList.remove('d-none');

      const formData = new FormData();
      formData.append('document', fileInput);
      formData.append('_token', '{{ csrf_token() }}');

      fetch("{{ route('document.process') }}", { method: 'POST', body: formData })
        .then(r => r.json())
        .then(data => {
          loaderBtn.classList.add('d-none');
          processBtn.classList.remove('d-none');
          if (data.error) {
            toastr.error(data.error);
          } else {
            document.getElementById('extractedText-bewerbung').value = data.text;
            toastr.success('Text extracted successfully!');
          }
        })
        .catch(() => {
          loaderBtn.classList.add('d-none');
          processBtn.classList.remove('d-none');
          toastr.error("{{ trans('general.Failed_Process_Document') }}");
        });
    });
  </script>

  {{-- ══════════════════════════════════════════════════
       2. LEBENSLAUF TAB — Generate resume + cover letter + PDF export
  ══════════════════════════════════════════════════ --}}
  <script>
    let generatedResume      = '';
    let generatedCoverLetter = '';

    document.getElementById('lebenslauf-generate-btn').addEventListener('click', function () {
      const jobDescription = document.getElementById('lebenslauf-job').value.trim();
      const skills         = document.getElementById('lebenslauf-skills').value.trim();
      const experience     = document.getElementById('lebenslauf-extra').value.trim();

      if (!jobDescription || !skills) {
        toastr.error('Bitte Stellenbeschreibung und deine Fähigkeiten/Erfahrungen eingeben.');
        return;
      }

      this.disabled   = true;
      this.innerHTML  = '<span class="spinner-border spinner-border-sm me-2"></span> Dokumente erstellen...';

      fetch("{{ route('career.generateResume') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ jobDescription, skills, experience })
      })
        .then(r => r.json())
        .then(data => {
          this.disabled  = false;
          this.innerHTML = 'Lebenslauf optimieren';

          if (data.resume && data.coverLetter) {
            generatedResume      = data.resume;
            generatedCoverLetter = data.coverLetter;

            document.querySelector('#lebenslauf-result-card p').outerHTML =
              `<textarea class="form-control border-0 bg-light" style="min-height:300px;">${data.resume}</textarea>`;

            document.querySelector('#cover-letter-result-card p').outerHTML =
              `<textarea class="form-control border-0 bg-light" style="min-height:300px;">${data.coverLetter}</textarea>`;

            toastr.success('Dokumente erfolgreich erstellt!');
          } else {
            toastr.error('Konnte Dokumente nicht erstellen.');
          }
        })
        .catch(() => {
          this.disabled  = false;
          this.innerHTML = 'Lebenslauf optimieren';
          toastr.error('Etwas ist schief gelaufen.');
        });
    });

    document.getElementById('lebenslauf-pdf-export-btn').addEventListener('click', function () {
      if (!generatedResume || !generatedCoverLetter) {
        toastr.error('Bitte erst Dokumente erstellen, bevor du exportierst.');
        return;
      }

      fetch("{{ route('career.downloadPdf') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/pdf',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ resume: generatedResume, coverLetter: generatedCoverLetter })
      })
        .then(r => r.blob())
        .then(blob => {
          const link  = document.createElement('a');
          link.href   = URL.createObjectURL(blob);
          link.download = 'resume_and_cover_letter.pdf';
          link.click();
        })
        .catch(err => console.error(err));
    });
  </script>

  {{-- ══════════════════════════════════════════════════
       3. ANSCHREIBEN TAB — Plagiarism check + export
  ══════════════════════════════════════════════════ --}}
  <script>
    document.getElementById('anschreiben-plagiat-btn').addEventListener('click', function () {
      const text = document.getElementById('anschreiben-plagiat-text').value.trim();

      if (!text) {
        toastr.error('Bitte gebe einen Text für den Plagiat-Check ein.');
        return;
      }

      this.disabled  = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Prüfen...';

      fetch("{{ route('plagiarism.check') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ text })
      })
        .then(r => r.json())
        .then(data => {
          this.disabled  = false;
          this.innerHTML = 'Anschreiben generieren';

          if (data.result) {
            document.querySelector('#anschreiben-plagiat-result p').innerHTML = data.result;
            toastr.success('Plagiat-Check abgeschlossen!');
          } else {
            toastr.error('Keine Ergebnisse erhalten.');
          }
        })
        .catch(() => {
          this.disabled  = false;
          this.innerHTML = 'Anschreiben generieren';
          toastr.error('Etwas ist schief gelaufen.');
        });
    });

    // Export buttons (PDF = index 0, Word = index 1)
    document.querySelectorAll('#anschreiben-exports .btn').forEach(function (btn, index) {
      btn.addEventListener('click', function () {
        const content = document.querySelector('#anschreiben-plagiat-result p').innerText;

        if (!content || content.includes('wird hier angezeigt')) {
          toastr.error('Bitte zuerst den Plagiat-Check durchführen.');
          return;
        }

        const route = index === 0 ? "{{ route('export.pdf') }}" : "{{ route('export.word') }}";

        fetch(route, {
          method: 'POST',
          headers: {
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json',
            'Content-Type': 'application/json'
          },
          body: JSON.stringify({ content })
        })
          .then(async response => {
            if (!response.ok) {
              const text = await response.text();
              try { throw new Error('Server error: ' + JSON.stringify(JSON.parse(text))); }
              catch { throw new Error('Server error: ' + text); }
            }
            return response.blob();
          })
          .then(blob => {
            const fileType = index === 0 ? 'application/pdf'
              : 'application/vnd.openxmlformats-officedocument.wordprocessingml.document';
            const fileName = index === 0 ? 'document.pdf' : 'document.docx';
            const link = document.createElement('a');
            link.href = window.URL.createObjectURL(new Blob([blob], { type: fileType }));
            link.download = fileName;
            document.body.appendChild(link);
            link.click();
            link.remove();
          })
          .catch(error => toastr.error('Export fehlgeschlagen: ' + error.message));
      });
    });
  </script>

  {{-- ══════════════════════════════════════════════════
       4. HAUSARBEIT TAB — Document improve / feedback
  ══════════════════════════════════════════════════ --}}
  <script>
    document.getElementById('hausarbeit-improve-btn').addEventListener('click', function () {
      const text = document.getElementById('hausarbeit-text').value.trim();
      const tone = document.getElementById('tone1').value;

      this.disabled  = true;
      this.innerHTML = '<span class="spinner-border spinner-border-sm me-2"></span> Verbessern...';

      fetch("{{ route('document.improve') }}", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': '{{ csrf_token() }}',
          'Accept': 'application/json',
          'Content-Type': 'application/json'
        },
        body: JSON.stringify({ text, tone })
      })
        .then(r => r.json())
        .then(data => {
          this.disabled  = false;
          this.innerHTML = 'Feedback erhalten';

          if (data.error) {
            toastr.error(data.error);
          } else {
            document.getElementById('hausarbeit-result-text').innerText = data.improved;
            toastr.success('Dokument erfolgreich verbessert!');
          }
        })
        .catch(() => {
          this.disabled  = false;
          this.innerHTML = 'Feedback erhalten';
          toastr.error('Etwas ist schief gelaufen.');
        });
    });
  </script>

@endsection