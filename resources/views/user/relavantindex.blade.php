@extends('user.layout')
@section('title',trans('Career_Planning'))
@section('content')

<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('general.Ai_Generate_Relavant_Workshop') }}</h5>
                </div>
                <div class="card-body">


                    <div class="row">
                        <div class="col-md-6">
                            <div class="card p-3">
                                <h5>{{ trans('general.Relavant_Workshop') }}</h5>

                                <textarea name="interest" id="interested" class="form-control" placeholder="{{ trans('general.Enter_Interest_1') }}" cols="30" rows="4"></textarea>
                                <!--<button id="getRecommendations" class="btn btn-primary mt-2 w-100">Get Recommendations</button>-->
                            </div>
                            @php
                            $ar=  auth()->user()->interest_workshop;
                          @endphp
                          @if ($ar)

                                <ul id="studyGroups" class="list-group">
                                    <h4>{{ trans('general.Workshop') }}</h4>
                                    @foreach (App\Models\Workshops::where('status','active')->get() as $item)
                                    <li class="list-group-item topic-item d-flex justify-content-between align-items-center">
                                        {{ $item->title}}
                                    </li>    
                                    @endforeach
    
                                </ul>
                        </div>
                        <div class="col-md-6">
                            <div class="container">
                                <h5>{{ trans('general.AI_Based_Recommendations') }}</h5>
                                <div class="mb-3">
                                    <input type="text" id="eventInterest" class="form-control" placeholder="{{ trans('general.Enter_Interest_2') }}">
                                    <button id="getEventRecommendations" class="btn btn-primary mt-2 w-100">{{ trans('general.Get_Recommendations') }}</button>
                                </div>
                            
                                <div id="eventRecommendations" class="mt-3"></div>
                            
                                <h2 class="mt-5">{{ trans('general.Register_for_Event') }}</h2>
                                <div class="mb-3">
                                    <input type="text" id="eventId" class="form-control" placeholder="{{ trans('general.Enter_Event_ID') }}">
                                    <button id="registerEvent" class="btn btn-success mt-2">{{ trans('auth.register') }}</button>
                                </div>
                                <div id="registerEventResponse" class="mt-3"></div>
                            </div>
                        </div>
                            
                        @endif


                    </div>

                    <!-- AI Response Section -->
                    <div class="row mt-4">
                        <div class="col-md-6">
                            <div class="card p-3">
                                <h5>{{ trans('general.Relavant_Workshop') }}</h5>
                                <p id="aiResponse" class="text-muted">{{ trans('general.Show_Relavant_Workshop') }}</p>
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
    $(".topic-item").click(function() {
        var workshopTitle = $(this).text().trim(); 
        
        $("#interested").val(workshopTitle); 
        $("#aiResponse").html("<p class='text-info'>Fetching recommendations...</p>"); 

        $.ajax({
            url: "{{ url('account/recommend-workshops') }}",
            type: "POST",
            data: { 
                interest: workshopTitle, 
                _token: "{{ csrf_token() }}" 
            },
            success: function(response) {
                $("#aiResponse").html("<h4>{{ trans('general.Recommended_Workshops') }}:</h4><p>" + response.workshops + "</p>");
            },
            error: function(xhr) {
                $("#aiResponse").html("<p class='text-danger'>{{ trans('general.Error_Recommendations') }}</p>");
            }
        });
    });
});


$(document).ready(function() {
    // Fetch AI-Based Event Recommendations
    $("#getEventRecommendations").click(function() {
        var interest = $("#eventInterest").val();
        if (interest.trim() === "") {
            alert("Please enter an interest!");
            return;
        }
        $("#eventRecommendations").html("<p class='text-info'>{{ trans('general.Fetching_Recommendations') }}</p>");

        $.ajax({
            url: "{{ url('account/recommend-events') }}",
            type: "POST",
            data: { 
                interest: interest,
                _token: "{{ csrf_token() }}" 
            },
            success: function(data) {
                console.log("Fetched Events:", data);
                $("#eventRecommendations").empty();

                if (Array.isArray(data.events)) {
                    let eventHTML = "";
                    data.events.forEach((event, index) => {
                        eventHTML += `<p>${event}</p>`;

                        // Add a register button after every 2 events
                        if ((index + 1) % 2 === 0 || index === data.events.length - 1) {
                            eventHTML += `
                                <button class="btn btn-primary register-btn" data-desc="${event}">{{ trans('auth.register') }}</button>
                                <hr>
                            `;
                        }
                    });

                    $("#eventRecommendations").html(eventHTML);
                } else {
                    $("#eventRecommendations").html("<p class='text-danger'>{{ trans('general.No_Events_Found') }}</p>");
                }
            },

            error: function() {
                alert("{{ trans('general.Error_Fetching_Recommendations') }}");
            }
        });
    });

    // Register for Event
    $(document).on("click", ".register-btn", function() {
        var eventDesc = $(this).data("desc");

        $.ajax({
            url: "{{ url('account/register-event') }}",
            type: "POST",
            data: { 
                user_id: "{{ auth()->id() }}", 
                event_desc: eventDesc,
                _token: "{{ csrf_token() }}" 
            },
            success: function(response) {
                alert("{{ trans('general.Registered_Successfully') }}");
            },
            error: function() {
                alert("{{ trans('general.Error_Registering') }}.");
            }
        });
    });
});


    </script>
@endsection
