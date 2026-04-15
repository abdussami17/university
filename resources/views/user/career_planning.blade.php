@extends('user.layout')
@section('title',trans('general.Career_Planning'))
@section('content')

<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('general.Career_Planning') }}</h5>
            </div>
            <div class="card-body">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card p-3">
                        <h5>📝 {{ trans('general.Resume_Cover') }}</h5>
                        <label class="form-label">{{ trans('general.Skills_Experience') }}:</label>
                        <textarea id="userDetails" class="form-control" rows="4" placeholder="{{ trans('general.Skills_Experience_Placeholder') }}"></textarea>
                
                        <!-- Generate Button -->
                        <button id="generateResumeBtn" class="btn btn-primary mt-2 w-100">{{ trans('general.Generate_Resume') }}</button>
                
                        <!-- Loader (Initially Hidden) -->
                        <button class="btn btn-primary mt-2 w-100 d-none" type="button" disabled id="resumeLoaderBtn">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ trans('general.Generating') }}
                        </button>
                
                        <!-- Output Section -->
                        <div id="resumeOutput" class="mt-3 p-3 bg-light border rounded d-none">
                            <h5>📄 {{ trans('general.Generated_Resume') }}</h5>
                            <pre id="generatedResume"></pre>
                
                            <h5>✉️ {{ trans('general.Cover_Letter') }}</h5>
                            <pre id="generatedCoverLetter"></pre>
                        </div>
                    </div>
                </div>
                
            <div class="col-md-6">
                <div class="card p-3">
                    <h5>🔍 {{ trans('general.Job_Internship') }}</h5>
                    @php
                        $category_job = App\Models\CareerJobs::where('parent_id',0)->where('id',auth()->user()->job_category)->first();
                    @endphp
                    @if($category_job)
                    <h4>{{ $category_job->name ??'' }}</h4>

                        @if ($category_job->child->count()>0)
                        <ul id="jobList" class="list-group">
                            @foreach ($category_job->child as $item)
                            <li class="list-group-item">{{ $item->name }}</li>
                            @endforeach
                        </ul>
                        @endif
                    @endif
                </div>
            </div>
        </div>
                
            </div>
        </div>
    </div>
</div>
</div>

@endsection
@section('script')
    <script>
$(document).ready(function() {
    $('#generateResumeBtn').click(function() {
        let userDetails = $('#userDetails').val().trim();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        if (userDetails === '') {
            alert("{{ trans('general.Enter_Skills_Experience') }}");
            return;
        }

        // Hide Generate Button, Show Loader
        $('#generateResumeBtn').addClass('d-none');
        $('#resumeLoaderBtn').removeClass('d-none');

        $.ajax({
            url: "{{ route('career.generateResume') }}",
            type: "POST",
            data: { prompt: userDetails, _token: csrfToken },
            success: function(response) {
                if (response) {
                    $('#generatedResume').html(response.resume);
                    $('#generatedCoverLetter').html(response.coverLetter);
                    $('#resumeOutput').removeClass('d-none');
                } else {
                    alert("{{ trans('general.Failed_Resume') }}");
                }
            },
            error: function(xhr) {
                console.error("Error:", xhr.responseText);
                alert("{{ trans('general.Something_Wrong') }}");
            },
            complete: function() {
                $('#generateResumeBtn').removeClass('d-none');
                $('#resumeLoaderBtn').addClass('d-none');
            }
        });
    });
});


    </script>
@endsection