@extends('user.layout')
@section('title',trans('general.Career_Planning'))
@section('content')

<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0">{{ trans('general.Stress_Management_Mindfulness') }}</h5>
                </div>
                <div class="card-body">
                <form action="{{ route('generate.tips') }}" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <textarea id="userDetails" class="form-control" rows="4" placeholder="{{ trans('general.Describe_Stress') }}" name="prompt"></textarea>

                                <!-- Generate Button -->
                                <button id="generateTipsBtn" class="btn btn-primary mt-2 w-100">{{ trans('general.Get_Tips') }}</button>
                            </div>
                        </div>
                    </div>

                    <!-- AI Response Section -->
                    <div class="row mt-4">
                        <div class="col-md-12">
                            <div class="card p-3">
                                <h5>{{ trans('general.Stress_Management_Mindfulness_Tips') }}</h5>
                                <p id="aiResponse" class="text-muted">{{ trans('general.Show_Stress_Management') }}</p>
                            </div>
                        </div>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('script')

<script>
    $(document).ready(function(){
        $("#generateTipsBtn").click(function(){
            let userDetails = $("#userDetails").val();
            
            if(userDetails.trim() === "") {
                alert("{{ trans('general.Stress_Details') }}");
                return;
            }

            // Disable button while loading
            $("#generateTipsBtn").prop("disabled", true).text("{{ trans('general.Please_Wait') }}");

            $.ajax({
                url: "{{ route('generate.tips') }}",
                type: "POST",
                data: { prompt: userDetails, _token: "{{ csrf_token() }}" },
                success: function(response) {
                    $("#aiResponse").text(response.tips || "{{ trans('general.No_Response') }}");
                    $("#generateTipsBtn").prop("disabled", false).text("Get Tips");
                },
                error: function() {
                    $("#aiResponse").text("{{ trans('general.Error_Generating_Tips') }}");
                    $("#generateTipsBtn").prop("disabled", false).text("Get Tips");
                }
            });
        });
    });
</script>
@endsection
