@extends('layout.app')

@section('title','MarketPlace')

@section('content')

<!-- ── PAGE HEADER ── -->
<div class="deals-header">
    <h1 class="deals-header__title">
        <i data-lucide="tag" style="color: var(--color-primary)"></i>
        Exklusive Deals & Benefits
    </h1>
    <p class="deals-header__subtitle">
        Spare im Studium mit exklusiven Angeboten für ProAISkill-Nutzer.
    </p>
</div>

<!-- ── FILTER BAR ── -->
<div class="deals-filters">
    <div class="deals-filters__tabs" id="filterTabs">
        <button class="filter-tab active" data-filter="all">All</button>
        <button class="filter-tab" data-filter="travel">Travel</button>
        <button class="filter-tab" data-filter="workshop">Learn</button>
        <button class="filter-tab" data-filter="affiliate">Finances</button>
    </div>

    <div class="deals-filters__sort">
        <i data-lucide="filter"></i>
        <select class="sort-select" id="sortSelect">
            <option value="popularity">popularity</option>
            <option value="newest">newest</option>
            <option value="discount">highest discount</option>
        </select>
    </div>
</div>

<!-- ── DEALS GRID ── -->
<div class="deals-grid-wrapper">
    <div class="deals-grid" id="dealsGrid">

        {{-- ================= TRAVEL ================= --}}
        @foreach ($travel as $item)
        <div class="deal-card"
            data-type="travel"
            data-date="{{ $item->created_at ? $item->created_at->toISOString() : now()->toISOString() }}"
            data-discount="{{ preg_replace('/[^0-9]/','',$item->cat_prices) }}"
            data-id="travel-{{$item->id}}">

            <div class="deal-card__image-wrap">
                <img class="deal-card__image" src="{{$item->cat_poster}}">
                <span class="deal-card__badge">{{$item->cat_prices}}</span>
            </div>

            <div class="deal-card__body">
                <div class="deal-card__title">{{$item->cat_title}}</div>
                <div class="deal-card__desc">
                    {!! \Illuminate\Support\Str::limit(strip_tags($item->cat_description),120) !!}
                </div>
            </div>

            <div class="deal-card__footer">
                <button class="deal-card__btn"
                    onclick="window.location='{{route('travel-mobility-subcategory',$item->id)}}'">
                    Angebot
                </button>

                <button class="deal-card__save" onclick="toggleSave(this)">
                    <i data-lucide="bookmark"></i>
                </button>
            </div>
        </div>
        @endforeach


        {{-- ================= WORKSHOP ================= --}}
        @foreach ($workshops as $item)
        <div class="deal-card"
            data-type="workshop"
            data-date="{{ $item->created_at ? $item->created_at->toISOString() : now()->toISOString() }}"
            data-discount="{{ $item->price }}"
            data-id="workshop-{{$item->id}}">

            <div class="deal-card__image-wrap">
                <img class="deal-card__image" src="{{ asset('Images/'.$item->poster) }}">
                <span class="deal-card__badge">$ {{$item->price}}</span>
            </div>

            <div class="deal-card__body">
                <div class="deal-card__title">{{$item->title}}</div>
                <div class="deal-card__desc">
                    {!! \Illuminate\Support\Str::limit(strip_tags($item->card_description),120) !!}
                </div>
            </div>

            <div class="deal-card__footer">
                <button class="deal-card__btn"
                    onclick="window.location='{{route('workshop-detail',$item->id)}}'">
                    Angebot
                </button>

                <button class="deal-card__save" onclick="toggleSave(this)">
                    <i data-lucide="bookmark"></i>
                </button>
            </div>
        </div>
        @endforeach


        {{-- ================= AFFILIATE ================= --}}
        @foreach ($affiliate as $item)
        <div class="deal-card"
            data-type="affiliate"
            data-date="{{ $item->created_at ? $item->created_at->toISOString() : now()->toISOString() }}"
            data-discount="{{ $item->price }}"
            data-id="affiliate-{{$item->id}}">

            <div class="deal-card__image-wrap">
                <img class="deal-card__image" src="{{ 'Images/'.$item->poster }}">
                <span class="deal-card__badge">$ {{$item->price}}</span>
            </div>

            <div class="deal-card__body">
                <div class="deal-card__title">{{$item->title}}</div>
                <div class="deal-card__desc">
                    {!! \Illuminate\Support\Str::limit(strip_tags($item->card_description),120) !!}
                </div>
            </div>

            <div class="deal-card__footer">
                <button class="deal-card__btn"
                    onclick="window.location='{{route('affiliate-programs-detail',$item->id)}}'">
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

@endsection


@push('script')
<script>

document.addEventListener('DOMContentLoaded', function(){

    const tabs = document.querySelectorAll('.filter-tab');
    const grid = document.getElementById('dealsGrid');
    const sortSelect = document.getElementById('sortSelect');

    /* ================= FILTER ================= */
    tabs.forEach(tab => {
        tab.addEventListener('click', () => {

            tabs.forEach(t => t.classList.remove('active'));
            tab.classList.add('active');

            const filter = tab.dataset.filter;

            document.querySelectorAll('.deal-card').forEach(card => {
                if(filter === 'all' || card.dataset.type === filter){
                    card.style.display = 'block';
                } else {
                    card.style.display = 'none';
                }
            });
        });
    });

    /* ================= SORT ================= */
    sortSelect.addEventListener('change', () => {

        const value = sortSelect.value;
        let cards = Array.from(document.querySelectorAll('.deal-card'));

        cards.sort((a,b) => {

            
            if(value === 'newest'){
    return new Date(b.dataset.date).getTime() - new Date(a.dataset.date).getTime();
}

            if(value === 'discount'){
                return (b.dataset.discount || 0) - (a.dataset.discount || 0);
            }

            return 0; // popularity default
        });

        cards.forEach(card => grid.appendChild(card));
    });

    /* ================= LOAD SAVED ================= */
    loadSaved();

});


/* ================= BOOKMARK ================= */
function toggleSave(btn){

    const card = btn.closest('.deal-card');
    const id = card.dataset.id;

    let saved = JSON.parse(localStorage.getItem('savedDeals')) || [];

    if(saved.includes(id)){
        saved = saved.filter(i => i !== id);
        btn.classList.remove('saved');
    } else {
        saved.push(id);
        btn.classList.add('saved');
    }

    localStorage.setItem('savedDeals', JSON.stringify(saved));
}


/* ================= LOAD SAVED STATE ================= */
function loadSaved(){

    let saved = JSON.parse(localStorage.getItem('savedDeals')) || [];

    document.querySelectorAll('.deal-card').forEach(card => {
        const id = card.dataset.id;

        if(saved.includes(id)){
            card.querySelector('.deal-card__save').classList.add('saved');
        }
    });
}

</script>
@endpush