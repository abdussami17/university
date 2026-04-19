@extends('layout.app')

@section('title', trans('Affiliate_Programs_Detail'))

@section('content')


  <!-- ── BACK NAV ── -->
  <nav class="deal-detail__back">
    <a href="{{route('workshops')}}" class="deal-detail__back-link">
      <i style="height: 16px;width:16px" data-lucide="arrow-left"></i>
      Back to overview
    </a>
  </nav>
 
  <!-- ── MAIN BODY ── -->
  <main class="deal-detail__body">
 
    <!-- two-column layout -->
    <div class="deal-detail__layout">
 
      <!-- LEFT: image + actions -->
      <div class="deal-detail__media">
        <img
          class="deal-detail__media-img"
          src="{{ asset('Images/'.$data->poster) }}"
          alt="{{$data->title}}"
          loading="eager"
        />
        <div class="deal-detail__actions">
          <div class="deal-detail__action-group">
            <button class="deal-detail__action-btn" title="Save" onclick="this.classList.toggle('active')">
                <i style="height: 16px;width:16px" data-lucide="heart"></i>
              </button>
              
              <button class="deal-detail__action-btn" title="Share">
                <i style="height: 16px;width:16px" data-lucide="share-2"></i>
              </button>
              
              <button class="deal-detail__action-btn" title="Notify me" onclick="this.classList.toggle('active')">
                <i style="height: 16px;width:16px" data-lucide="bell"></i>
              </button>
          </div>
          {{-- <span class="deal-detail__partner-note">Offer from a partner</span> --}}
        </div>
      </div>
 
      <!-- RIGHT: deal info -->
      <div class="deal-detail__info">
        {{-- <span class="deal-detail__category">Travel</span> --}}
        <h1 class="deal-detail__title">{{$data->title}}</h1>
       
 
    <!-- offer box -->
<div class="deal-detail__offer">
  
    <!-- Price -->
    <div class="deal-detail__offer-price">
      {{ trans('general.Currency') }} {{$data->price}}
      <small style="font-size: 10px" class="text-muted d-block">+{{ trans('general.Currency') }} 100.00 {{ trans('general.Taxes_Fees') }}</small>
    </div>
  
    <!-- Title / Heading -->
    <h6 class="mt-2 mb-1">{{ trans('general.Complete_Program') }}</h6>
    <p class="mb-2"><b>{{ trans('general.Each_unit_has') }}:</b></p>
    <p class="mb-2">{{ trans('general.Lifetime_Access') }}</p>
  
    <!-- Features -->
    <ul class="deal-detail__offer-features">
      <li class="deal-detail__offer-feature">
        <i data-lucide="check-circle"></i>
        {{ trans('general.Money_Back_Guarantee') }}
      </li>
      <li class="deal-detail__offer-feature">
        <i data-lucide="check-circle"></i>
        {{ trans('general.Free_Certification') }}
      </li>
      <li class="deal-detail__offer-feature">
        <i data-lucide="check-circle"></i>
        {{ trans('general.Online_Community') }}
      </li>
    </ul>
  
    <!-- CTA Button -->
    <a href="{{ route('account.enroll', ['module_type' => 'course', 'module_id' => $data->id]) }}">
      <button class="deal-detail__offer-cta">
        {{ trans('general.Enroll_Now') }}
      </button>
    </a>
  
   <div class="d-flex justify-content-center mt-2">
    {{ trans('general.Dont_Worry') }}
   </div>
  
  </div>
      </div>
 
    </div><!-- /.deal-detail__layout -->
 
    <!-- disclaimer -->
    <div class="deal-detail__disclaimer">
      <p class="deal-detail__disclaimer-title">BESCHREIBUNG</p>
      <p class="deal-detail__disclaimer-text">
        {!! $data->description !!}
      </p>
    </div>
 
  </main>

@endsection