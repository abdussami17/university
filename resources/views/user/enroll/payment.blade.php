@extends('layout.app')

@section('title', trans('general.Payment_Method'))

@section('content')
<br>
<br>
<br>
<div class="row d-flex justify-content-center">
    <div class="col-md-12 d-flex justify-content-center">
        <h4>{{ trans('general.Stripe_Payment') }}</h4>
</div>
</div>
<div class="row d-flex justify-content-center">
    <div class="col-md-12 d-flex justify-content-center">
        <div class="card">
            <div class="card-body">
                <form id="payment-form" action="{{route('payment.process')}}" method="POST" class="p-4 border rounded">
                    @csrf
                    <input type="hidden" name="module_type" value="{{ encrypt($module_type) }}">
                    <input type="hidden" name="module_id" value="{{ encrypt($module_id) }}">

                    <div class="mb-3">
                        <label for="cardholder-name" class="form-label fw-bold">{{ trans('general.Cardholder_Name') }}</label>
                        <input type="text" name="person_card_name" class="form-control" id="cardholder-name" placeholder="{{ trans('general.Enter_Cardholder_Name') }}" required>
                    </div>
                
                    <div class="mb-3">
                        <label for="card-element" class="form-label fw-bold">{{ trans('general.Card_Number') }}</label>
                        <input type="text" name="card_number" class="form-control" id="cardholder-name" placeholder="{{ trans('general.Enter_Card_Number') }}" required>

                    </div>
                
                    <button id="submit-button" class="btn btn-primary w-100 mt-3">{{ trans('general.Pay_with_Card') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection