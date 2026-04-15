@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))

@section('content')
    <style>
        body {
            background: #f8f9fa;
        }
    </style>
    <style>
        main {
            margin-top: 0 !important;
        }
    </style>
    <div class="container">
        <h1 class="title">{{ trans('general.Forums') }}</h1>
        <div class="accordion" id="mainAccordion">
            @foreach (App\Models\Category::where('parent_id', 0)->where('status', 1)->with('child')->get() as $category)
                @php
                    $activeSubcategories = $category->child->where('status', 1);
                @endphp
                @if ($activeSubcategories)
                    <div class="accordion-item">
                        <h2 class="accordion-header">
                            <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                data-bs-toggle="collapse" data-bs-target="#collapse{{ $category->id }}">
                                {{ $category->name }}
                            </button>
                        </h2>
                        <div id="collapse{{ $category->id }}"
                            class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                            data-bs-parent="#mainAccordion">
                            <div class="accordion-body">
                                <div class="group-card">

                                    @if ($activeSubcategories->count() > 0)
                                        @foreach ($activeSubcategories as $subcategory)
                                            @if ($subcategory->status == 1)
                                                @php
                                                    // Get IDs of posts and userposts under this subcategory
                                                    $postIds = \App\Models\Post::where('parent_id', $subcategory->id)
                                                        ->pluck('id')
                                                        ->toArray();
                                                    $userPostIds = \App\Models\userpost::where(
                                                        'parent_id',
                                                        $subcategory->id,
                                                    )
                                                        ->pluck('id')
                                                        ->toArray();

                                                    $allPostIds = array_merge($postIds, $userPostIds);

                                                    // Count followers for these posts/user_posts
                                                    $followerCount = \App\Models\Follower::whereIn(
                                                        'user_post_id',
                                                        $allPostIds,
                                                    )->count();

                                                    $adminPostCount = count($postIds);
                                                    $userPostCount = count($userPostIds);

                                                    $totalcountnew = $adminPostCount + $userPostCount;
                                                    $totalPostCount = $adminPostCount + $userPostCount;
                                                @endphp



                                                <div class="card">
                                                    <img src="{{ asset($subcategory->thumb) }}"
                                                        alt="{{ $subcategory->name }}">
                                                    <div class="card-content">
                                                        <div class="card-title"
                                                            onclick="window.location='{{ route('forum.forum.web', $subcategory->slug) }}'">
                                                            {!! $subcategory->name !!}</div>
                                                        <div class="stats">{{ number_format($totalPostCount) }}
                                                            {{ trans('general.Posts') }} / {{ $followerCount }}
                                                            {{ trans('general.Followers') }}</div>
                                                        <div class="description">
                                                            {!! $subcategory->short_desc !!}
                                                        </div>
                                                        <div class="highlight">
                                                            <span>{{ trans('general.Highlight') }}?</span><br>
                                                            {{ trans('general.Last_Reply') }}
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    @else
                                        <p>{{ trans('general.No_Subcategories_Available') }}</p>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach

        </div>
    </div>


@endsection
