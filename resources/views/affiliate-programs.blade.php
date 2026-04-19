@extends('layout.app')

@section('title', trans('general.Affiliate_Programs'))

@section('content')
<div class="deals-header">
    <h1 class="deals-header__title">
        <i style="height: 32px;width:32px;color:var(--color-primary)" data-lucide="tag"></i>
        {{ trans('general.Affiliate_Programs') }}
    </h1>
    <p class="deals-header__subtitle">
        Verdiene Geld mit Empfehlungen durch attraktive Partnerprogramme.
      </p>
</div>
<div class="deals-grid-wrapper">
    <div class="deals-grid" id="dealsGrid">

        @foreach ($data as $item)
            <div class="deal-card">

                <div class="deal-card__image-wrap">
                    <img class="deal-card__image" loading="eager" src="{{'Images/'.$item->poster}}"
                        alt="{{$item->title}}" />
                    <span class="deal-card__badge">$ {{ $item->price }}</span>
                </div>

                <div class="deal-card__body">
                    <div class="deal-card__title">{{$item->title}}</div>
                    <div class="deal-card__desc">
                        {!! \Illuminate\Support\Str::limit(strip_tags($item->card_description), 200) !!}
                    </div>
                </div>

                <div class="deal-card__footer">
                    <button class="deal-card__btn" onclick="window.location='{{route('affiliate-programs-detail',$item->id)}}'">
                        Angebot
                    </button>

                    <button class="deal-card__save" onclick="toggleSave(this)">
                        <i data-lucide="bookmark"></i>
                    </button>
                </div>

            </div>
        @endforeach

    </div>
</div>


@push('script')
    <script>
 

        // ── SAVE / BOOKMARK ──
        function toggleSave(btn) {
            btn.classList.toggle('saved');
            const icon = btn.querySelector('i');
            if (btn.classList.contains('saved')) {
                icon.classList.replace('fa-regular', 'fa-solid');
            } else {
                icon.classList.replace('fa-solid', 'fa-regular');
            }
        }
    </script>
@endpush
@endsection
