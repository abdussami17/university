@extends('user.layout')
@section('title', trans('general.Financial_Planning'))
@section('content')

    <head>
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <style>
            #financialChart {
                width: auto !important;
                height: 400px !important;
            }
        </style>
    </head>


    <div class="main-section">
        <div class="mb-4 d-flex justify-content-between align-items-center">
            <div>
                <h4 style="  color: rgb(56, 59, 66);" class="mb-1">Smarter Finanzplaner</h4>
                <p class="text-muted mb-0">Verwalte dein Budget, erhalte Spartipps, finde Studentenrabatte und nutze
                    Finanztools.</p>
            </div>
            <button class="btn btn-primary">Bankkonto verbinden (Mock)</button>
        </div>

        <div class="row g-4 align-items-stretch">
            <!-- Left Card -->
            <div class="col-lg-8 pop-up">
                <div class="card card-shadow p-4" style=" 
                border-left: 4px solid #0d6dfd9d;">
                    <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i class="bi bi-piggy-bank me-2"></i>Mein Budget &
                        Sparziele</h5>
                    <p class="text-muted">Lege dein monatliches. Budget fast, verfolge deine Ausgaben und definiere
                        Sparziele.</p>

                    <img height="300px" width="240px" src="{{ asset('new_asset/images/abcd.png') }}" class="rounded mb-4"
                        alt="Focus Image">

                    <div class="row">
                        <form id="financialForm">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <label for="income" class="form-label">Monatliches Einkommen (€)</label>
                                    <input type="number" id="income" name="income" class="form-control"
                                        placeholder="500" required>
                                </div>
                                <div class="col-md-6">
                                    <label for="expenses" class="form-label">Monatliche Ausgaben (€)</label>
                                    <input type="number" id="expenses" name="expenses" class="form-control"
                                        placeholder="400" required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="goals" class="form-label">Ausgabegewohnheiten (für KI-Tipps)</label>
                                    <input type="text" id="goals" name="goals" class="form-control"
                                        placeholder="Essen gehen, Streaming etc." required>
                                </div>
                                <div class="col-md-12 mt-2">
                                    <label for="savings" class="form-label">Sparziel (€)</label>
                                    <input type="text" id="savings" name="savings" class="form-control"
                                        placeholder="1000" required>
                                </div>

                                <div class="mt-2">
                                    <button type="submit" class="btn btn-primary">Analysieren</button>
                                    <button id="loadingBtn" class="btn btn-primary d-none" disabled>
                                        <span class="spinner-border spinner-border-sm"></span> Analysiere...
                                    </button>
                                </div>

                                <div class="mt-3" id="resultSection">
                                    <p class="small mb-1">Ausgaben: <span id="expensesValue">0</span> €</p>
                                    <div class="progress">
                                        <div class="progress-bar" id="expensesProgress" role="progressbar"
                                            style="width: 0%;" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100">
                                        </div>
                                    </div>
                                    <p class="small mb-0 mt-1 text-muted text-end">Budget: <span id="budgetValue">0</span>€
                                    </p>

                                    <p class="small mb-1 mt-3">Fortschritt Sparziel (<span id="goalLabel">-</span>):</p>
                                    <div class="progress">
                                        <div class="progress-bar" id="savingsProgress" role="progressbar" style="width: 0%;"
                                            aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                    <p class="small mb-0 mt-1 text-muted text-end"><span id="savingsCurrent">0</span> € /
                                        <span id="savingsGoal">0</span> € erreicht</p>

                                </div>
                            </div>
                        </form>


                    </div>

                </div>
            </div>

            <!-- Right XP Box -->
            <div class="col-lg-4 d-flex flex-column">
                <div class="card card-shadow  p-4 h-100">
                    <h5 class="fw-bold"><i class="fa-regular fa-lightbulb me-2"></i>KI-Spartipps</h5>
                    <p class="text-muted small">Personalisierte Tipps, die dir helfen, mehr zu sparen</p>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" height="120px" width="100px" alt="t">
                    <div class="text-center">
                        <p class="fw-semibold mt-5 mb-1">Spartipps erhalten</p>
                        <p class="small text-muted" id="financialAdvice"></p>
                    </div>
                </div>
            </div>
        </div>
        <!-- Top Quick Access -->
        <div class="tool-section card p-4 card-shadow mt-4 rounded-2 border-0">
            <div class="section-title d-flex align-items-center mb-1">
                <i class="bi bi-journal-check me-2"></i> BAföG Rechner & Checkliste
            </div>
            <div class="section-subtitle">
                Berechne deinen voraussichtlichen BAföG-Anspruch und behalte den Überblick über benötigte Dokumente.
            </div>

            <div class="row mt-3">
                <!-- Left Side -->
                <div class="col-md-6 mb-4">
                    <div class="sub-heading">BAföG-Schnellrechner (Platzhalter)</div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="placeholder-img-2" alt="Schnellrechner">
                    <p class="small-note">Gib einige Eckdaten ein, um eine grobe Schätzung deines BAföG-Anspruchs zu
                        erhalten. Dies ist keine offizielle Berechnung.</p>
                    <a href="#" class="blue-link"><i class="bi bi-bar-chart-line me-1"></i>Zum Schnellrechner (bald
                        verfügbar)</a>
                </div>

                <!-- Right Side -->
                <div class="col-md-6 checklist">
                    <div class="sub-heading"><i class="bi bi-card-checklist me-2"></i>BAföG Antrags-Checkliste</div>
                    <img src="{{ asset('new_asset/images/abcd.png') }}" class="placeholder-img-2" alt="Checkliste">
                    <ul>
                        <li>Formblatt 1 (Antrag auf Ausbildungsförderung)</li>
                        <li>Immatrikulationsbescheinigung</li>
                        <li>Nachweis Krankenversicherung</li>
                        <li>Einkommensnachweise der Eltern (falls zutreffend)</li>
                        <li>Mietvertrag (falls eigene Wohnung)</li>
                    </ul>
                    <a href="#" class="blue-link"><i class="bi bi-folder2-open me-1"></i>Vollständige Liste und
                        Formulare</a>
                </div>
            </div>
        </div>
        <div class="card mt-4 col-12 card-shadow p-4">
            <h5 style="  color: rgb(56, 59, 66);" class="mb-1"><i
                    class="bi bi-patch-check me-2"></i>Studentenrabatt-Finder & Cashback</h5>
            <p class="text-muted">Entdecke exklusive Rabatte und Cashback-Optionen für Studenten.</p>

            <img height="240px" width="200px" src="{{ asset('new_asset/images/abcd.png') }}" class="rounded mb-4"
                alt="Focus Image">
            <p class="text-muted small mt-3 mb-3">Nach Rabatten suchen (z.B. "Software", "Essen", "Reisen')</p>
            <div>
                <div class="p-2 rounded-3 mb-3 d-flex justify-content-between pop-up shadow-sm">
                    <div>
                        <h6 class="mb-0">Spotify Premium Student</h6>
                        <p class="small text-muted mb-0 ">50% Rabatt for Studenten +1 Monat gratis</p>
                    </div>
                    <div>
                        <button class="bg-light btn rounded-2 fw-medium">Angebot erhalten</button>
                    </div>
                </div>
                <div class="p-2 rounded-3 mb-3 d-flex justify-content-between pop-up shadow-sm">
                    <div>
                        <h6 class="mb-0">Adobe Creative Cloudt</h6>
                        <p class="small text-muted mb-0 ">Über 60% Rabatt für Studierende und Lehrende.</p>
                    </div>
                    <div>
                        <button class="bg-light btn rounded-2 fw-medium">Angebot erhalten</button>
                    </div>
                </div>
                <div class="p-2 rounded-3 mb-3 d-flex justify-content-between pop-up shadow-sm">
                    <div>
                        <h6 class="mb-0">UNIDAYS</h6>
                        <p class="small text-muted mb-0 ">Viele Rabatte für Mode, Technik, Essen.</p>
                    </div>
                    <div>
                        <button class="bg-light btn rounded-2 fw-medium">Zu UNIDAYS</button>
                    </div>
                </div>
            </div>

        </div>

    </div>






    {{-- <div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('general.Financial_Planning') }}</h5>
                </div>
                <div class="card-body">

                    <div class="row">
                        <div class="col-md-6">
                            <form id="financialForm">
                                <label class="form-label mt-3">{{ trans('general.Monthly_Income') }}:($)</label>
                                <input type="number" id="income" required class="form-control"><br>

                                <label class="form-label mt-3">{{ trans('general.Monthly_Expenses') }}:</label>
                                <input type="number" id="expenses" required class="form-control"><br>

                                <label class="form-label mt-3">{{ trans('general.Current_Savings') }}:</label>
                                <input type="number" id="savings" required class="form-control"><br>

                                <label class="form-label mt-3">{{ trans('general.Financial_Goal') }}:</label>
                                <input type="text" id="goals" required class="form-control"><br>

                                <button type="submit" class="btn btn-primary m-2">{{ trans('general.Analyze') }}</button>
                                <button id="loadingBtn" class="btn btn-primary d-none" disabled>
                                    <span class="spinner-border spinner-border-sm"></span> {{ trans('general.Analyzing') }}
                                </button>
                            </form>
                        </div>
                        <div class="col-md-6 text-center">
                            <h3>{{ trans('general.Financial_Overview') }}</h3>
                            <canvas id="financialChart"></canvas>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12">
                            <h3>{{ trans('general.Financial_Advice') }}:</h3>
                            <textarea id="financialAdvice" rows="6" readonly class="form-control"></textarea>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div> --}}

@endsection

@section('script')
<script>
document.getElementById("financialForm").addEventListener("submit", function(event) {
    event.preventDefault();

    let income = parseFloat(document.getElementById("income").value);
    let expenses = parseFloat(document.getElementById("expenses").value);
    let savingsInput = document.getElementById("savings").value.trim();
    let goals = document.getElementById("goals").value;

    if (!income || !expenses || !savingsInput || !goals) {
        toastr.error("Bitte alle Felder ausfüllen!");
        return;
    }

    // Extract numeric goal from savings input
    let currentSavings = parseFloat(savingsInput.replace(/[^\d.]/g, '')) || 0;
    if (currentSavings <= 0) {
        toastr.error("Bitte gültigen Betrag im Sparziel eingeben (z.B. Laptop 1000).");
        return;
    }

    let formData = new FormData(this);
    formData.set('savings', currentSavings); // numeric value sent to backend

    document.getElementById("loadingBtn").classList.remove("d-none");
    document.querySelector("button[type='submit']").classList.add("d-none");

    fetch("{{ route('finan') }}", {
        method: "POST",
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        document.getElementById("loadingBtn").classList.add("d-none");
        document.querySelector("button[type='submit']").classList.remove("d-none");

        if (data.error) {
            toastr.error(data.error);
        } else {
            toastr.success("Analyse abgeschlossen!");
            document.getElementById("financialAdvice").innerText = data.analysis; // ✅ show AI response
            document.getElementById("resultSection").style.display = "block";

            // Call progress bar update
            updateProgressBars(income, expenses, currentSavings, savingsInput);
        }
    })
    .catch(error => {
        console.error("Error:", error);
        toastr.error("Analyse fehlgeschlagen.");
        document.getElementById("loadingBtn").classList.add("d-none");
        document.querySelector("button[type='submit']").classList.remove("d-none");
    });
});

function updateProgressBars(income, expenses, savings, savingsLabelRaw) {
    // EXPENSES BAR
    let expensesPercent = (expenses / income) * 100;
    expensesPercent = Math.min(100, expensesPercent);
    document.getElementById("expensesProgress").style.width = expensesPercent + "%";
    document.getElementById("expensesProgress").setAttribute("aria-valuenow", expensesPercent);
    document.getElementById("expensesValue").innerText = expenses.toFixed(0);
    document.getElementById("budgetValue").innerText = income.toFixed(0);

    // SAVINGS BAR
    let savingsGoal = extractNumericGoal(savingsLabelRaw);
    let savingsPercent = (savings / savingsGoal) * 100;
    savingsPercent = Math.min(100, savingsPercent);
    document.getElementById("savingsProgress").style.width = savingsPercent + "%";
    document.getElementById("savingsProgress").setAttribute("aria-valuenow", savingsPercent);
    document.getElementById("savingsCurrent").innerText = savings.toFixed(0);
    document.getElementById("savingsGoal").innerText = savingsGoal.toFixed(0);
    document.getElementById("goalLabel").innerText = savingsLabelRaw;
}

// Helper: Extract numeric goal amount from user text like "Laptop 1000"
function extractNumericGoal(input) {
    const match = input.match(/(\d+(\.\d+)?)/);
    return match ? parseFloat(match[0]) : 1000; // fallback default
}
</script>

@endsection
