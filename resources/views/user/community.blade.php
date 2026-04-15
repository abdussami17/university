@extends('user.layout')
@section('title', trans('general.Community'))
@section('content')

    <head>
        <style>
            .selected-topic {
                background-color: #007bff !important;
                color: #fff !important;
            }

            .chat-box {
                max-height: 300px;
                overflow-y: auto;
            }

            .chat-message {
                padding: 10px;
                margin-bottom: 10px;
                border-radius: 8px;
            }

            .user-message {
                background-color: #007bff;
                color: white;
                text-align: right;
            }

            .bot-message {
                background-color: #e9ecef;
                text-align: left;
            }
        </style>
    </head>
    {{-- <div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="mb-0">{{ trans('general.AI_Powered_Community') }}</h5>
            </div>
            <div class="card-body">
            
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h5>🔍 {{ trans('general.Topics') }}</h5>
                        </div>
                        <div class="card-body">
                            <ul id="studyGroups" class="list-group">
                                <input type="hidden" id="getTopicsRoute" value="{{ route('discussion.getTopics') }}">

                            </ul>
                            <input type="text" id="newTopic" class="form-control mt-2" placeholder="{{ trans('general.Enter_New_Topic') }}">
                            <button class="btn btn-primary mt-2 w-100" id="addTopic">{{ trans('general.Add_Topics') }}</button>
                        </div>
                    </div>
                </div>
                
                <!-- AI-Powered Chat -->
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header bg-success text-white">
                            <h5 id="chatTopic">💬 {{ trans('general.Select_Topics') }}</h5>
                        </div>
                        <div class="card-body chat-box" id="chatBox">
                            <div class="chat-message bot-message">{{ trans('general.Welcome_Start_Discussion') }}</div>
                        </div>
                        <div class="card-footer">
                            <input type="text" id="chatInput" class="form-control" placeholder=">{{ trans('general.Type_Message') }}" disabled>
                            <button class="btn btn-success mt-2 w-100" id="sendBtn" disabled>{{ trans('general.Send') }}</button>
                        </div>
                    </div>
                </div>
                
        
    </div>
                
            </div>
        </div>
    </div>
</div>
</div>
<!-- Discussion Popup Modal -->
<div class="modal fade" id="discussionModal" tabindex="-1" aria-labelledby="discussionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="discussionModalLabel">{{ trans('general.Start_Find_Discussion') }}</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body text-center">
          <p id="selectedTopicName"></p>
          <button id="startDiscussionBtn" class="btn btn-primary w-100 mb-2">{{ trans('general.Start_Discussion') }}</button>
          <button id="findDiscussionBtn" class="btn btn-secondary w-100">{{ trans('general.Find_Discussion') }}</button>
        </div>
      </div>
    </div>
  </div> --}}


    <div class="main-section">
        <div class="mb-4 d-flex justify-content-between flex-wrap align-items-center">

            <div>
                <h4 style="  color: rgb(56, 59, 66);" class="mb-1">Community-Zentrum</h4>
                <p class="text-muted mb-0">Vernetze dich, stelle Fragen, finde Lerngruppen und arbeite mit Kommilitonen
                    zusammen.</p>
            </div>
            <img src="{{ asset('new_asset/images/abcd.png') }}" width="100px" height="130px" alt="not-found">
        </div>


        <!-- Top Tabs -->
        <div class="top-tabs">
            <button class="tab-button active" onclick="switchTab(0)"><i class="bi bi-chat-left-dots me-1"></i>
                Forum</button>
            <button class="tab-button" onclick="switchTab(1)"><i class="bi bi-geo-alt me-1"></i>Lokale Studenten</button>
            <button class="tab-button" onclick="switchTab(2)"><i class="bi bi-calendar me-1"></i> Treffen</button>
            <button class="tab-button" onclick="switchTab(3)"><i
                    class="bi bi-people-fill me-1"></i>Interessengruppen</button>


        </div>

        <!-- Dynamic Tab Content -->
        <div class="card-section">
            <!-- Tab 1 -->
            <div class="card tab-card p-4 shadow-sm pop-up" id="tab-0">
                <div class="discuss-wrapper">
                    <!-- Header -->
                    <div class="discuss-header">
                        <h5 class="mb-0"><strong>Aktuelle Diskussionen</strong></h5>

                        <div class="discuss-search">
                            <input type="text" class="form-control form-control-sm search-bar-1" placeholder="Diskussionen suchen...">
                            <button type="button" class="btn btn-primary" id="openPostModal"
                                style="width:300px;font-size: 13px;">
                                Neuen Beitrag erstellen
                            </button> 

                        </div>
                    </div>

                    <div id="discussion-container">
                        @php
                            $user = auth()->user();
                            $postIds = \App\Models\Comment::where('user_id', $user->id)
                                ->orderBy('created_at', 'desc')
                                ->pluck('post_id')
                                ->unique()
                                ->take(3);
                            $discussedPosts = \App\Models\DiscussionTopic::whereIn('id', $postIds)->get();
                        @endphp

                        @include('partials.discussions', ['posts' => $discussedPosts])
                    </div>

                    <!-- Load More -->
                    <div class="discuss-loadmore" id="load-more-discussions" data-offset="3">Weitere Diskussionen laden
                    </div>


                    <!-- Load More -->

                </div>
            </div>

            <!-- Tab 2 -->


            <!-- Tab 3 -->
            <div class="card tab-card p-4 shadow-sm d-none pop-up" id="tab-2">
                <h5><strong><i class="bi bi-geo-alt text-danger me-1"></i>Lokale Studenten &amp; Tutoren finden</strong>
                </h5>
                <p class="text-muted small">Vernetze dich mit Studenten und Tutoren an deiner Universitat order in deiner
                    Nahe.</p>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="{{ asset('new_asset/images/abcd.png') }}" height="250px" style="width: 200px !important;"
                        alt="">
                    <i class="bi bi-people text-danger" style="font-size: 60px;"></i>
                    <div class="text-center">
                        <h6>Entdecke deine lokale Community!</h6>
                        <p class="small text-muted">Gib deine Stadt oder Universitat ein, um dich mit Kommilitonen zu
                            vernetzen oder Tutoren zu finden.</p>
<input type="text" id="searchUser" class="form-control" placeholder="Gib deine Stadt oder Universität ein"
    style="font-size: 14px;">
<ul id="suggestions" class="list-group mt-2"></ul>

<div class="mt-3 gap-2 d-flex justify-content-center">
    <button class="btn btn-light rounded-3">
        <i class="bi bi-search me-2"></i>Studenten suchen
    </button>
    <button class="btn btn-light rounded-3">
        <i class="bi bi-person me-2"></i>Tutoren finden
    </button>
</div>

                    </div>
                </div>


            </div>
            <div class="card tab-card p-4 shadow-sm d-none pop-up" id="tab-1">
                <h5><strong><i class="bi bi-calendar text-info me-2"></i>Treffen planen &amp; finden</strong></h5>
                <p class="text-muted small">Organisiere Lensitzungen oder soziale Treffen, oder nimm an bestehenden teil.
                </p>
                <div class="d-flex justify-content-center align-items-center flex-column">
                    <img src="{{ asset('new_asset/images/abcd.png') }}" height="250px" style="width: 200px !important;"
                        alt="">
                    <i class="bi bi-calendar-check text-info" style="font-size: 60px;"></i>
                    <div class="text-center">
                        <h6>Plane dein nachstes Treffen!</h6>
                        <p class="small text-muted">Ob Lerngruppen oder Kaffeeklatsch - hier kannst du Events erstellen oder
                            spannende Treffin in deiner Nahe finden.</p>

                        <div class="mt-3 gap-2 d-flex justify-content-center">
                            @if(session()->get('meett_cat_main_id'))
                            <button class="btn btn-light rounded-3"  data-bs-toggle="modal" data-bs-target="#exampleModalScrollablenew" type="button"><i class="bi bi-calendar-plus me-2"></i>Neues Treffen
                                erstellen</button>
                            @endif
                                <button type="button" id="openSearch" class="btn btn-light rounded-3">
                                    <i class="bi bi-search me-2"></i>Bestehende Treffen suchen
                                </button>

                        </div>
                    </div>
                </div>

<!-- Hidden Search Box -->
<div id="searchContainer" class="mt-3" style="display:none;">
    <input type="text" id="searchInput" class="form-control" placeholder="Treffen suchen...">
    <div id="searchResults" class="list-group mt-2" style="max-height:200px; overflow-y:auto;"></div>
</div>

            </div>
            <div class="card tab-card p-4 shadow-sm d-none " id="tab-3">
                <div class="bg-white rounded">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div>
                            <h6 class="mb-1">Interessengruppen (Discord-Style)</h6>
                            <small class="text-muted">Tritt Gruppen bei oder erstelle deine eigenen, um dich über gemeinsame
                                Interessen auszutauschen.</small>
                        </div>
                        <button class="btn btn-primary" style="width:300px;font-size: 13px;" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            Neue Gruppe erstellen
                        </button>

                    </div>

                    <div class="mb-3">
                        <input type="text" class="form-control search-bar" placeholder="Gruppen suchen...">
                    </div>

                    <div class="row g-3">
                        <!-- Group 1 -->
      @foreach (App\Models\Group::where('user_id', auth()->id())->get() as $showgroup)
    @php
        $isJoined = $showgroup->members()->where('user_id', auth()->id())->exists();
        $memberCount = $showgroup->members()->count();
    @endphp

    <div class="col-md-4">
        <div class="interest-card bg-white">
            <img src="{{ asset($showgroup->group_thumb) }}" class="interest-img" alt="Group Thumbnail">
            <div class="interest-body">
                <div class="group-name">{{ $showgroup->name }}</div>
                <div class="group-members">{{ $memberCount }} Mitglieder</div>

                @if ($isJoined)
                    <button class="btn btn-secondary w-100" disabled>
                        Joined
                    </button>
                @else
                    <button class="join-group-btn btn btn-light w-100"
                        data-url="{{ route('group.join', $showgroup->id) }}">
                        Beitreten
                    </button>
                @endif
            </div>
        </div>
    </div>
@endforeach




                    </div>
                </div>
            </div>

        </div>

    </div>


    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Beitrag erstellen</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="modalPostContent">

                    <div class="text-center py-5">
                        <span class="spinner-border"></span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Create Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('groups.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="createModalLabel">Neue Gruppe erstellen</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="name">Gruppenname</label>
                            <input type="text" class="form-control" name="name" required>
                        </div>
                        <div class="form-group mb-2">
                            <label for="description">Beschreibung</label>
                            <textarea class="form-control" name="description"></textarea>
                        </div>

                        <div class="form-group mb-2">
                            <label for="group__thumb">Beschreibung</label>
                            <input type="file" class="form-control" name="group_thumb" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-success">Erstellen</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
    
    <div class="modal fade" id="exampleModalScrollablenew" tabindex="-1" aria-labelledby="exampleModalScrollableTitlenew" aria-hidden="true">
  <div class="modal-dialog modal-dialog-scrollable modal-lg">
    <div class="modal-content">
      <form action="{{ route('user.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitlenew">Neues Ereignis hinzufügen</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>

          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">

@if(session()->get('meett_cat_main_id'))
    <input type="hidden" name="parent_id" value="{{ session('meett_cat_main_id') }}">
@endif
       
          <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
          </div>

          <div class="mb-3">
            <label for="image" class="form-label">Image</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

          <div class="mb-3">
            <label for="date" class="form-label">Date</label>
            <input type="date" class="form-control" name="date" required>
          </div>

          <div class="mb-3">
            <label for="time" class="form-label">Time</label>
            <input type="time" class="form-control" name="time" required>
          </div>
        </div>
        
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Save</button>
        </div>
      </form>
    </div>
  </div>
</div>

@endsection

@section('script')
    <script>
        function switchTab(index) {
            // Switch active tab button
            document.querySelectorAll('.tab-button').forEach((btn, i) => {
                btn.classList.toggle('active', i === index);
            });

            // Switch card content
            document.querySelectorAll('.tab-card').forEach((card, i) => {
                card.classList.toggle('d-none', i !== index);
            });
        }
    </script>


    <script>
        $(document).ready(function() {
            $('#openPostModal').on('click', function() {
                $('#exampleModalScrollable').modal('show');
                $('#modalPostContent').html(
                    '<div class="text-center py-5"><span class="spinner-border"></span></div>');

                $.ajax({
                    url: "{{ route('account.post.create') }}",
                    type: 'GET',
                    success: function(response) {
                        $('#modalPostContent').html(response);
                    },
                    error: function() {
                        $('#modalPostContent').html(
                            '<div class="alert alert-danger">Failed to load form.</div>');
                    }
                });
            });
        });
    </script>

    <link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>

    <script>
        function string_to_slug(str) {
            return str
                .toLowerCase()
                .trim()
                .replace(/[^a-z0-9\s-]/g, '') // remove invalid chars
                .replace(/\s+/g, '-') // replace spaces with -
                .replace(/-+/g, '-'); // collapse multiple dashes
        }

        $(document).on('input', '#title', function() {
            let title = $(this).val();
            let slug = string_to_slug(title);
            $('#slug').val(slug);
        });


        $(document).ready(function() {
            // Slug generator
            // Initialize summernote AFTER modal opens
            $('#exampleModalScrollable').on('shown.bs.modal', function() {
                $('#summernote').summernote({
                    placeholder: "{{ trans('general.Short_Description') }}",
                    tabsize: 2,
                    height: 150
                });

                $('#summernote1').summernote({
                    placeholder: "{{ trans('general.Long_Description') }}",
                    tabsize: 2,
                    height: 150
                });
            });
        });
    </script>

    <script>
        $(document).ready(function() {
            $('#load-more-discussions').on('click', function() {
                var offset = $(this).data('offset');

                $.ajax({
                    url: '{{ route('user.discussions.load') }}',
                    method: 'GET',
                    data: {
                        offset: offset
                    },
                    success: function(response) {
                        if (response.html.trim() !== '') {
                            $('#discussion-container').empty();
                            $('#discussion-container').append(response.html);
                            $('#load-more-discussions').data('offset', offset + 3);
                        } else {
                            $('#load-more-discussions').text('Keine weiteren Diskussionen');
                        }
                    }
                });
            });
        });
    </script>
    <script>
        $('.join-group-btn').click(function() {
            var button = $(this);
            var url = button.data('url'); // ← route() se aaya ready URL
            $.ajax({
                url: url,
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}'
                },

                success: function(res) {
                    toastr.success('you are join this group')
                    button.prop('disabled', true).text('Beigetreten');
                },
                error: function(xhr) {
                    alert(xhr.responseJSON?.message || 'Fehler');
                }
            });
        });
    </script>
    <script>
    $(document).ready(function () {
        $('.search-bar-1').on('keyup', function () {
            var value = $(this).val().toLowerCase();

            $('.interest-card').filter(function () {
                $(this).toggle($(this).find('.group-name').text().toLowerCase().indexOf(value) > -1);
            });
        });
    });
</script>
<script>
$(document).ready(function () {
    $('#searchUser').on('input', function () {
        let query = $(this).val();

        if (query.length > 1) {
            $.ajax({
                url: '{{ route('user.search') }}',
                data: { query: query },
                success: function (data) {
                    let suggestions = $('#suggestions');
                    suggestions.empty();

                    if (data.length > 0) {
                        data.forEach(function (item) {
                            suggestions.append('<li class="list-group-item">' + item + '</li>');
                        });
                    } else {
                        suggestions.append('<li class="list-group-item">Keine Ergebnisse gefunden</li>');
                    }
                },
                error: function (xhr) {
                    console.log(xhr);
                }
            });
        } else {
            $('#suggestions').empty();
        }
    });
});

</script>
<script>
$(document).ready(function(){

    // Show search input on button click
    $("#openSearch").on("click", function(){
        $("#searchContainer").slideToggle();
        $("#searchInput").focus();
    });

    // Live Search
    $("#searchInput").on("keyup", function(){
        let query = $(this).val();

        if(query.length > 1) {
            $.ajax({
                url: "{{ route('meet.search') }}", // Laravel route
                method: "GET",
                data: { query: query },
                success: function(data) {
                    $("#searchResults").html("");
                    
                    if(data.length > 0){
$.each(data, function(index, item){
    $("#searchResults").append(`
        <a href="${item.url}" class="list-group-item list-group-item-action">
            ${item.name}
        </a>
    `);
});

                    } else {
                        $("#searchResults").html('<div class="list-group-item">Keine Ergebnisse gefunden</div>');
                    }
                }
            });
        } else {
            $("#searchResults").html("");
        }
    });

});
</script>
@endsection
