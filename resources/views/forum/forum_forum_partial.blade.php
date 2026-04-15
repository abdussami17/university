@foreach ($post as $item)
@php
    $comments = \App\Models\Comment::where('post_id', $item->id)->count();

    $lastCommentwe = \App\Models\Comment::where('post_id', $item->id)
                        ->orderBy('created_at', 'desc') // make sure it's the *latest* comment
                        ->first();

    $username = $lastCommentwe ? \App\Models\User::where('id', $lastCommentwe->user_id)->first() : null;
@endphp
<div class="forum-item">
    <div class="forum-item-left">
        <h2><a href="{{ route('forum.topic.web', $item->slug) }}">{{ $item->title }}</a></h2>
        <p style="text-align:left">by {{ $item->name }}, {{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</p>
    </div>
    <div class="forum-item-right">
        <img src="{{ asset('profile-placeholder.jpg') }}" alt="User">
        <p>{{ $username?->firstName ?? 'No Reply Yet' }}</p>
        <p>{{ $comments }} {{ trans('general.Replies') }} | {{ $item->views }} {{ trans('general.views') }}</p>
@if (auth()->check() && auth()->id() == $item->user_id)
            <button class="btn btn-sm btn-warning edit-btn edit-post-btn"
                data-id="{{ $item->id }}"
                data-toggle="modal"
                data-target="#editModal">
                Edit
            </button>

<!-- Delete Button Form -->
<form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('account.post.destroy', $item->id) }}" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">Delete</button>
</form>


        @endif
    </div>
</div>

<!-- Edit Modal Container -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="editModalContent">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>
@endforeach
