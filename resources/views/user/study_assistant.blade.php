@extends('user.layout')
@section('title',trans('general.Study_Assistant'))
@section('content')
<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('general.Study_Assistant') }}</h5>
            </div>
            <div class="card-body">

                <div class="card p-4">
                    <h5>{{ trans('general.Enter_Text') }}</h5>
                    <form id="gemini-form">
                        <textarea name="" id="prompt" placeholder="{{ trans('general.Enter_Text') }}" name="prompt" cols="30" rows="5" class="form-control mb-3"></textarea>
                        <button type="submit" class="btn btn-primary w-100" id="generate-button">
                            {{ trans('general.Generate_Summary') }}
                        </button>
                    

                        <button class="btn btn-primary w-100 d-none" type="button" disabled id="loader-button">
                            <span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                            {{ trans('general.Loading') }}
                        </button>

                    </form>
                </div>
                <div class="card-body">
                    <div class="loader"></div>
                                
                    <div id="response-summary" class="mt-4 d-none">
                        <h4>📖 {{ trans('general.Summary') }}</h4>
                        <p></p>
    
                    </div>
    
                    <div id="response-flashcards" class="mt-4 d-none">
                        <h4>📝 {{ trans('general.Notes_Flashcards') }}</h4>
                        <p></p>
                    </div>
                
                    <!-- Mind Map Section -->
                    <div id="response-mindmap" class="mt-4 d-none">
                        <h4>🧠 {{ trans('general.Mind_Map') }}</h4>
                        <p></p>
    
                    </div>   
                </div>
            </div>

        </div>
 
    </div>
</div>
</div>
@endsection
@section('script')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<script>
$(document).ready(function() {
    $('#gemini-form').submit(function(e) {
        e.preventDefault();
        let prompt = $('#prompt').val();
        let csrfToken = $('meta[name="csrf-token"]').attr('content');

        let generateButton = $('#generate-button');
        let loaderButton = $('#loader-button');

         generateButton.addClass('d-none');
        loaderButton.removeClass('d-none');

        $.ajax({
            url: "{{ route('gemini.study') }}",
            type: "POST",
            data: { prompt: prompt, _token: csrfToken },
            beforeSend: function() {
                $('#response-summary, #response-flashcards, #response-mindmap').addClass('d-none');
                $('#response-summary p, #response-flashcards p, #response-mindmap p').text("{{ trans('general.Generating') }}");
            },
            success: function(response) {
                console.log("{{ trans('general.API_Response') }}:", response);

                if (response) {
                    $('#response-summary p').html(response.summary);
                    $('#response-flashcards p').html(response.flash_cards.replace(/\n/g, "<br>"));
                    $('#response-mindmap p').html(response.mind_map.replace(/\n/g, "<br>"));

                    $('#response-summary, #response-flashcards, #response-mindmap').removeClass('d-none');
                } else {
                    $('#response-summary p').text("{{ trans('general.No_Response_API') }}");
                }
            },
            error: function(xhr, status, error) {
                console.error("Error:", error);
                $('#response-summary p').text("Error: " + xhr.responseText);
                $('#response-summary').removeClass('d-none');
            },
            complete: function() {
    
                loaderButton.addClass('d-none');
                generateButton.removeClass('d-none');
            }
        });
    });
});

        </script>
    

@endsection