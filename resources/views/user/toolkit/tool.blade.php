@extends('user.layout')
@section('title', trans('general.AI_Features'))
@section('content')

<div class="main-section">
    <div class="mb-0 d-flex justify-content-between flex-wrap align-items-center">
        <div>
            <h4 style="color: rgb(56, 59, 66);" class="mb-1">Toolkit-Zentrum</h4>
            <p class="text-muted mb-0">Greife auf KI-gestützte Werkzeuge zu, um deine Produktivität und dein Lernen zu verbessern.</p>
        </div>
        <img src="https://university.voags.com/new_asset/images/abcd.png" width="100px" height="130px" alt="not-found">
    </div>

    <img src="https://university.voags.com/new_asset/images/abcd.png" alt="" height="300px" width="220px" class="mb-5">
    
    <div class="card">
        <div class="card-body">
                <div class="container">
                    <h2>{{ $title }}</h2>
                    <form id="aiToolForm">
                        @csrf
                        <input type="hidden" name="tool" value="{{ $tool }}">
                        <div class="mb-3">
                            <label for="input" class="form-label">Enter input for {{ $title }}</label>
                            <textarea name="input" id="input" rows="5" class="form-control" required></textarea>
                        </div>
                        <button class="btn btn-primary" id="submitBtn">Run Tool</button>
                    </form>
                </div>
        </div>
    </div>
    
    <div class="card">
        <div class="card-body">
            <div id="aiResult" class="mt-4"></div>

        </div>
    </div>
</div>


@endsection
@section('script')
<script>
document.getElementById('aiToolForm').addEventListener('submit', function(e) {
    e.preventDefault();

    let form = this;
    let formData = new FormData(form);
    let tool = formData.get('tool');
    let input = formData.get('input');

    let submitBtn = document.getElementById('submitBtn');
    let originalBtnText = submitBtn.innerHTML;

    // Show loader
    submitBtn.disabled = true;
    submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Loading...`;

    fetch(`{{ url('/account/toolkit/run') }}/${tool}`, {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': form.querySelector('[name="_token"]').value,
            'Accept': 'application/json',
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ input })
    })
    .then(res => res.json())
    .then(data => {
        console.log(data);
        if (data.result) {
            document.getElementById('aiResult').innerHTML = `<div class="alert alert-success">${data.result}</div>`;
        } else {
            document.getElementById('aiResult').innerHTML = `<div class="alert alert-danger">${data.error}</div>`;
        }
    })
    .catch(err => {
        console.error("Fetch error:", err);
        document.getElementById('aiResult').innerHTML = `<div class="alert alert-danger">Unexpected error occurred.</div>`;
    })
    .finally(() => {
        // Restore button
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnText;
    });
});
</script>
@endsection