@foreach ($posts as $post)
    @php
        $replyCount = \App\Models\Comment::where('post_id', $post->id)->count();
        $category = App\Models\Category::where('id',$post->id)->first();
        $authorName = App\Models\User::where('id',auth()->user()->id)->first(); // Assuming relation: Post belongsTo User
    @endphp

    <div class="discuss-card">
        <div class="discuss-flex mb-2">
            <img src="{{ asset('new_asset/images/abcd.png') }}" alt="Avatar" class="discuss-avatar">
            <div>
                <div class="discuss-title">{{ $post->title }}</div>
                <div class="discuss-meta">Von {{ $authorName->firstName }} • {{ $replyCount }} Antworten</div>

                <span class="discuss-badge">{{ $category->name ?? 'Uncategorized' }}</span>
            </div>
        </div>
    </div>
@endforeach
