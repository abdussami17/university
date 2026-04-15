@extends('layout.app')

@section('title', trans('general.Travel_Mobility'))

@section('content')
<div class="product-section container">
            <div class="wall-header">
                <h1>
                    {{ trans('general.Travel_Mobility') }}
                </h1>
                <div class="wall-filters">
                </div>
            </div>
             <div class="products-grid">
            @foreach($data as $item)
                <div class="product-card" onclick="window.location='{{route('travel-mobility-subcategory',$item->id)}}'">
                    <div class="product_card_body">
                        <figure>
                            <img alt="Workshop Image" class="product-card__hero-image" height="100%" loading="eager"
                                src="{{$item->cat_poster}}"
                                width="100%">

                            <div class="product_info">
                                <div class="product_msg-info">
                                    <div class="product_card_message">{{$item->cat_title}}</div>
                                    <div class="product-card_titles">
                                        <div class="product_card-title"><div class="product_card-title"> {!! $item->cat_description !!}</div>
                                            </div>
                                    </div>
                                </div>
                                <div class="product_price">
                                    {{$item->cat_prices}}
                                </div>
                            </div>
                        </figure>
                    </div>
                </div>
            @endforeach

           
         
            </div>
        </div>
@endsection