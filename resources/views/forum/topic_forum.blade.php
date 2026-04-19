@extends('layout.app')
@section('title', trans('general.Forum_University_Community'))

@section('content')
<style>
   body{
        background: #f8f9fa!important;
   }
</style>
<style>
    main{
        margin-top:0!important;
    }
</style>
<section class="comments-feed" style="background: #f8f9fa!important;">
    <div class="forum-container mt-120">
        <div class="post-header">
            
            <h1>{{ $post->title }}</h1>
            <div class="header-actions">
                @auth
                    @php
                        $isFollowing = \App\Models\Follower::where('user_id', auth()->id())
                            ->where('user_post_id', $post->id)
                            ->where('module', $post instanceof \App\Models\Post ? 'post' : 'userpost')
                            ->exists();
                    @endphp


                    <button class="btn btn-sm btn-primary follow-btn"
                        data-post-id="{{ $post->id }}"
                        data-user-id="{{ auth()->user()->id ?? ''}}">
                        {{ $isFollowing ? 'Unfollow' : 'Follow' }}
                    </button>


                @endauth
                
                        <span class="followers">
                            {{ trans('general.Followers') }}:
                            {{ \App\Models\Follower::where('user_post_id', $post->id)->count() }}
                        </span>


                <button class="share-btn btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#shareModal">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="28" fill="currentColor">
                        <path d="M7.928 9.24a4.02 4.02 0 0 1-.026 1.644l5.04 2.537a4 4 0 1 1-.867 1.803l-5.09-2.562a4 4 0 1 1 .083-5.228l5.036-2.522a4 4 0 1 1 .929 1.772L7.928 9.24z"></path>
                    </svg> {{ trans('general.Share') }}
                </button>

            </div>
        </div>
        <div class="d-flex align-items-center mt-2">
            <div class="author-info d-flex align-items-center">
                <img class="profile-pic-one" src="{{ $post->thumb ? asset($post->thumb) : asset('profile-placeholder.jpg') }}" alt="User Avatar">
                <div class="ms-2 d-flex flex-column" >
                    <div class="username" style="text-align:left">{{ $post->name }}</div>
                    <small>{{ \Carbon\Carbon::parse($post->date)->format('F d, Y') }} {{ trans('general.In_Forum_Feedback') }}</small>
                </div>
            </div>
        </div>
        
    </div>
</section>

<section class="commentbox-feed" style="background: #f8f9fa!important;">
@foreach(App\Models\Comment::where('post_id', $post->id)->get() as $show)
    @php
        $users = App\Models\User::where('id', $show->user_id)->first();
        $reactions = \App\Models\Reaction::where('comment_id', $show->id)
            ->select('emoji', DB::raw('count(*) as total'))
            ->groupBy('emoji')
            ->get();
    @endphp
    <div class="forum-container two">
        <div class="post-content d-flex">
            <div class="profile-detail">
                <div class="profile-column">
                    <img src="{{ asset('profile-placeholder.jpg') }}" alt="User">
                    <div class="username">{{ $users->firstName }}</div>
                </div>
                <div class="content-column">
                    <div class="date">
                        <p>{{ trans('general.Posted') }} {{ \Carbon\Carbon::parse($show->created_at)->format('F d, Y') }}</p>
                    </div>
                    <p>{!! $show->content !!}</p>
                </div>
            </div>
        </div>

        <div class="post-footer mt-2">
            <div class="d-flex align-items-center mb-2">
                @foreach ($reactions as $reaction)
                    <span class="me-2 react-box">{{ $reaction->emoji }} {{ $reaction->total }}</span>
                @endforeach
            </div>

            {{-- Emoji buttons --}}
            <div class="emoji-options d-flex flex-wrap gap-1">
                @foreach (['❤️','😂','👍','😢','😡','🎉','🙏','👏'] as $emoji)
                    <button class="btn btn-outline-secondary btn-sm emoji-btn" data-comment="{{ $show->id }}" data-emoji="{{ $emoji }}">{{ $emoji }}</button>
                @endforeach
            </div>

                <button class="share-btn btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#shareModal" style="border:none">
                    <svg xmlns="http://www.w3.org/2000/svg" viewBox="-2 -2 24 24" width="28" fill="currentColor">
                        <path d="M7.928 9.24a4.02 4.02 0 0 1-.026 1.644l5.04 2.537a4 4 0 1 1-.867 1.803l-5.09-2.562a4 4 0 1 1 .083-5.228l5.036-2.522a4 4 0 1 1 .929 1.772L7.928 9.24z"></path>
                    </svg>
                </button>

        </div>
    </div>
@endforeach

    <div class="forum-container two">
        <textarea id="commentText" class="form-control mt-3" rows="3" placeholder="Write a comment..."></textarea>
        <button id="submitComment" class="btn btn-sm btn-success mt-2" data-post-id="{{ $post->id }}" data-module="{{ $post instanceof \App\Models\Post ? 'post' : 'userpost' }}">Comment</button>
    </div>

</section>


<!-- Share Modal -->
<div class="modal fade" id="shareModal" tabindex="-1" aria-labelledby="shareModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content p-3">
      <div class="modal-header">
        <h5 class="modal-title" id="shareModalLabel">Diese Seite teilen</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body text-center">

        <!-- URL Input + Clipboard -->
        <div class="input-group mb-3">
          <input type="text" id="currentUrl" class="form-control" readonly>
          <button class="btn btn-outline-secondary" id="copyBtn" type="button">
            <i class="fas fa-clipboard"></i>
          </button>
        </div>

        <!-- Optional Social Icons -->
        <div class="d-flex justify-content-center gap-3">
          <a href="#" target="_blank" class="btn btn-outline-primary" id="fbBtn"><i class="fab fa-facebook-f"></i></a>
          <a href="#" target="_blank" class="btn btn-outline-success" id="waBtn"><i class="fab fa-whatsapp"></i></a>
          <a href="#" target="_blank" class="btn btn-outline-info" id="twBtn"><i class="fab fa-twitter"></i></a>
        </div>

      </div>
    </div>
  </div>
</div>




@endsection
@section('script')
<script>
$(document).ready(function () {
    $('.share-btn').on('click', function () {
        const url = window.location.href;
        $('#currentUrl').val(url);

        $('#fbBtn').attr('href', `https://www.facebook.com/sharer/sharer.php?u=${encodeURIComponent(url)}`);
        $('#waBtn').attr('href', `https://wa.me/?text=${encodeURIComponent(url)}`);
        $('#twBtn').attr('href', `https://twitter.com/intent/tweet?url=${encodeURIComponent(url)}`);
    });

    $('#copyBtn').on('click', function () {
        const copyText = document.getElementById("currentUrl");
        copyText.select();
        copyText.setSelectionRange(0, 99999); // mobile support
        document.execCommand("copy");

        // Optional: visual feedback
        $(this).html('<i class="fas fa-check text-success"></i>');
        setTimeout(() => {
            $(this).html('<i class="fas fa-clipboard"></i>');
        }, 1000);
    });
});
</script>

<script>
$(document).ready(function () {
    $('.follow-btn').click(function (e) {
        e.preventDefault();

        var button = $(this);
        var postId = button.data('post-id');
        var postUserId = button.data('user-id');

        $.ajax({
            url: "{{ route('post.toggleFollow') }}",
            method: "POST",
            data: {
                _token: '{{ csrf_token() }}',
                post_id: postId,
                post_user_id: postUserId,
            },
            success: function (response) {
                console.log(response);
                if (response.status === 'followed') {
                    button.text('Unfollow');
                    $('#followers-count-' + postId).text('Followers: ' + response.count).show();
                } else if (response.status === 'unfollowed') {
                    button.text('Follow');
                    $('#followers-count-' + postId).hide();
                }
            },
            error: function (xhr) {
           console.log(xhr)
            }
        });
    });
});
</script>
<script>
$(document).ready(function () {
    $('#submitComment').on('click', function () {
        const content = $('#commentText').val();
        const postId = $(this).data('post-id');
        const module = $(this).data('module');

        $.ajax({
            url: '{{ route("comment.store") }}',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                post_id: postId,
                module: module,
                content: content
            },
            success: function (response) {
                      if (response.redirect) {
                    window.location.href = response.redirect;
                    return;
                }
                $('#commentText').val('');
                $('#commentError').text('');
                location.reload(); // Reload to show the new comment
            },
            error: function (xhr) {
                console.log(xhr);
                if (xhr.status === 422) {
                    let errors = xhr.responseJSON.errors;
                    $('#commentError').text(errors.content ? errors.content[0] : 'Something went wrong');
                }
            }
        });
    });


});
</script>
<script>
$(document).on('click', '.emoji-btn', function () {
    var commentId = $(this).data('comment');
    var emoji = $(this).data('emoji');

    $.ajax({
        url: "{{ route('comment.react') }}",
        method: "POST",
        data: {
            _token: "{{ csrf_token() }}",
            comment_id: commentId,
            emoji: emoji
        },
        success: function (response) {
            location.reload();
        },
        error: function (xhr) {
            alert("Login required to react.");
        }
    });
});
</script>


@endsection