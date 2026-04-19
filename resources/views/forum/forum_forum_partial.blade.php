@foreach ($post as $item)
    @php
        $comments = \App\Models\Comment::where('post_id', $item->id)->count();

        $lastCommentwe = \App\Models\Comment::where('post_id', $item->id)
            ->orderBy('created_at', 'desc') // make sure it's the *latest* comment
    ->first();

$username = $lastCommentwe ? \App\Models\User::where('id', $lastCommentwe->user_id)->first() : null;
    @endphp
<article class="post-card" data-category="forum">

    <!-- HEADER -->
    <div class="post-card__header">

        <!-- AUTHOR -->
        <div class="post-card__author">

            <img class="post-card__avatar"
                 src="{{ asset('profile-placeholder.jpg') }}"
                 alt="{{ $item->name }}" />

            <div>
                <div class="post-card__author-name">
                    {{ $item->name }}
                </div>

                <div class="post-card__author-time">
                    {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}
                </div>
            </div>

        </div>

        <!-- Optional Badge -->
        <span class="post-card__badge">
            {{ trans('general.Post') }}
        </span>

    </div>


    <!-- TITLE -->
    <div class="post-card__title">
        <a href="{{ route('forum.topic.web', $item->slug) }}">
            {{ $item->title }}
        </a>
    </div>


    <!-- EXCERPT (optional fallback if you have content) -->
    <div class="post-card__excerpt">
        {!! \Illuminate\Support\Str::limit(strip_tags($item->content ?? ''), 150) !!}
    </div>


    <!-- REACTIONS / STATS -->
    <div class="post-card__reactions">

        <!-- Replies -->
        <button class="post-card__reaction">
            <i data-lucide="message-circle" style="height: 16px;width:16px"></i>
            <span>{{ $comments }}</span>
        </button>

        <!-- Views -->
        <button class="post-card__reaction">
            <i data-lucide="eye" style="height: 16px;width:16px"></i>
            <span>{{ $item->views }}</span>
        </button>

    </div>


    <!-- ACTIONS (OWNER ONLY) -->
    @if (auth()->check() && auth()->id() == $item->user_id)

        <div class="post-card__actions">

            <!-- EDIT -->
            <button class="btn btn-sm btn-warning edit-btn edit-post-btn"
                    data-id="{{ $item->id }}"
                    data-toggle="modal"
                    data-target="#editModal">
                {{ trans('general.Edit') ?? 'Edit' }}
            </button>

            <!-- DELETE -->
            <form id="delete-form-{{ $item->id }}"
                  method="POST"
                  action="{{ route('account.post.destroy', $item->id) }}"
                  style="display:inline;">

                @csrf
                @method('DELETE')

                <button type="button"
                        class="btn btn-sm btn-danger"
                        onclick="confirmDelete({{ $item->id }})">
                    {{ trans('general.Delete') ?? 'Delete' }}
                </button>

            </form>

        </div>

    @endif

</article>

    <!-- Edit Modal Container -->
    <div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-xl" role="document">
            <div class="modal-content" id="editModalContent">
                <!-- Content loaded via AJAX -->
            </div>
        </div>
    </div>
@endforeach
