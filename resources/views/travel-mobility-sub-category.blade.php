@extends('layout.app')

@section('title', trans('general.Travel_Mobility'))

@section('content')
<div class="deals-header">
    <h1 class="deals-header__title">
        <i style="height: 32px;width:32px;color:var(--color-primary)" data-lucide="tag"></i>
        {{ trans('general.Travel_Mobility') }}
    </h1>
    <p class="deals-header__subtitle">
        <p class="deals-header__subtitle">
            Finde die besten Angebote für Reisen und Mobilität und bleibe flexibel unterwegs.
          </p>
      </p>
</div>
<div class="deals-filters">
    <div class="deals-filters__tabs" id="filterTabs">
      <button class="filter-tab active" data-filter="all">All</button>
      <button class="filter-tab" data-filter="technology">Technology</button>
      <button class="filter-tab" data-filter="travel">Travel</button>
      <button class="filter-tab" data-filter="learn">Learn</button>
      <button class="filter-tab" data-filter="lifestyle">Lifestyle</button>
      <button class="filter-tab" data-filter="food">Food &amp; Drink</button>
      <button class="filter-tab" data-filter="finances">Finances</button>
    </div>
  
    <div class="deals-filters__sort">
      <i data-lucide="filter"></i>
      <select class="sort-select" id="sortSelect">
        <option value="" hidden>{{ trans('general.Sort_By') }}</option>
        <option value="">{{ trans('general.Newest') }}</option>
        <option value="">{{ trans('general.Featured') }}</option>
     <option value="">{{ trans('general.Best_Match') }}</option>
      </select>
    </div>
  </div>

<div class="deals-grid-wrapper">
    <div class="deals-grid" id="dealsGrid">

        @foreach ($data as $item)
            <div class="deal-card">

                <div class="deal-card__image-wrap">
                    <img class="deal-card__image" loading="eager" src="{{asset('Images/'.$item->poster)}}"
                        alt="{{$item->title}}" />
                    <span class="deal-card__badge">$ {{$item->price}}</span>
                </div>

                <div class="deal-card__body">
                    <div class="deal-card__title">{{$item->title}}</div>
                    <div class="deal-card__desc">
                        {!! \Illuminate\Support\Str::limit(strip_tags($item->card_description), 200) !!}
                    </div>
                </div>

                <div class="deal-card__footer">
                    <button class="deal-card__btn" onclick="window.location='{{route('travel-mobility-details',$item->id)}}'">
                        Angebot
                    </button>

                </div>

            </div>
        @endforeach

    </div>
</div>

@endsection