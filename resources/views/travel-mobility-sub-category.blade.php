@extends('layout.app')

@section('title', trans('general.Travel_Mobility'))

@section('content')
<div class="product-section container">
            <div class="wall-header">
                <h1>
                    {{ trans('general.Travel_Mobility') }}
                </h1>
                <div class="wall-filters">
            <select>
                <option value="" hidden>{{ trans('general.Sort_By') }}</option>
                <option value="">{{ trans('general.Newest') }}</option>
                <option value="">{{ trans('general.Featured') }}</option>
             <option value="">{{ trans('general.Best_Match') }}</option>

            </select>
                </div>
            </div>
             <div class="products-grid">
            @foreach($data as $item)
                <div class="product-card" onclick="window.location='{{route('travel-mobility-details',$item->id)}}'">
                    <div class="product_card_body">
                        <figure>
                            <img alt="Workshop Image" class="product-card__hero-image" height="100%" loading="eager"
                                src="{{asset('Images/'.$item->poster)}}"
                                width="100%">

                            <div class="product_info">
                                <div class="product_msg-info">
                                    <div class="product_card_message">{{$item->title}}</div>
                                    <div class="product-card_titles">
                                        <div class="product_card-title"><div class="product_card-title"> {!! $item->card_description !!}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product_price">
                                    ${{$item->price}}
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            @endforeach

           
         
            </div>
        </div>
@endsection