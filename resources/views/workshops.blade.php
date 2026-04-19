@extends('layout.app')

@section('title', trans('general.Workshops'))

@section('content')

    <div class="deals-header">
        <h1 class="deals-header__title">
            <i style="height: 32px;width:32px;color:var(--color-primary)" data-lucide="tag"></i>
            {{ trans('general.Workshops') }}
        </h1>
        <p class="deals-header__subtitle">
            Nimm an praxisnahen Workshops teil, lerne neue Fähigkeiten und sammle wertvolle Erfahrungen mit Experten.
        </p>
    </div>

    <!-- ── FILTER BAR ── -->
    {{-- <div class="deals-filters">
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
        <option value="popularity">Popularity</option>
        <option value="newest">Newest</option>
        <option value="discount">Highest Discount</option>
      </select>
    </div>
  </div> --}}

    <!-- ── GRID ── -->
    <div class="deals-grid-wrapper">
        <div class="deals-grid" id="dealsGrid">

            @foreach ($data as $item)
                <div class="deal-card">

                    <div class="deal-card__image-wrap">
                        <img class="deal-card__image" loading="eager" src="{{ asset('Images/' . $item->poster) }}"
                            alt="{{ $item->title }}" />
                        <span class="deal-card__badge">$ {{ $item->price }}</span>
                    </div>

                    <div class="deal-card__body">
                        <div class="deal-card__title">{{ $item->title }}</div>
                        <div class="deal-card__desc">
                            {!! \Illuminate\Support\Str::limit(strip_tags($item->card_description), 200) !!}
                        </div>
                    </div>

                    <div class="deal-card__footer">
                        <button class="deal-card__btn" onclick="window.location='{{ route('workshop-detail', $item->id) }}'">
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
        // ── FILTER TABS ──
        // const tabs = document.querySelectorAll('.filter-tab');
        // const cards = document.querySelectorAll('.deal-card');
        // const grid = document.getElementById('dealsGrid');

        // tabs.forEach(tab => {
        //   tab.addEventListener('click', () => {
        //     tabs.forEach(t => t.classList.remove('active'));
        //     tab.classList.add('active');

        //     const filter = tab.dataset.filter;
        //     let visibleCount = 0;

        //     cards.forEach(card => {
        //       const match = filter === 'all' || card.dataset.category === filter;
        //       card.style.display = match ? 'flex' : 'none';
        //       if (match) visibleCount++;
        //     });

        //     // Show empty state
        //     const existing = grid.querySelector('.deals-empty');
        //     if (existing) existing.remove();
        //     if (visibleCount === 0) {
        //       const empty = document.createElement('div');
        //       empty.className = 'deals-empty';
        //       empty.textContent = 'No deals found in this category.';
        //       grid.appendChild(empty);
        //     }
        //   });
        // });

        // // ── SORT ──
        // const sortSelect = document.getElementById('sortSelect');
        // sortSelect.addEventListener('change', () => {
        //   const val = sortSelect.value;
        //   const cardsArr = [...cards].filter(c => c.style.display !== 'none');
        //   // Simple visual shuffle for demo
        //   cardsArr.forEach(card => grid.appendChild(card));
        // });

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
