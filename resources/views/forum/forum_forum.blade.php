@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
@section('content')
<style>
    
     .post-card__actions{
        display: flex;
        justify-content: end;
        margin-top: 14px;
        gap:10px;
     }
     .post-card__title a{
        text-decoration: underline
     }
    .post-card {text-align: start}
    .community__topbar {text-align: start}
    .navbar__inner {width:100% }
    p{
        margin-bottom: unset
    }
</style>
<style>
    /* BACKDROP FIX */
.modal-backdrop.show {
    opacity: 0.6 !important;
}

/* MODAL CENTER FIX */
.modal {
    z-index: 1055 !important;
}

.modal-dialog {
    margin: auto;
    display: flex;
    align-items: center;
    min-height: 100vh;
}

/* CONTENT LOOK */
.modal-content {
    border-radius: 16px;
    overflow: hidden;
    box-shadow: 0 20px 60px rgba(0,0,0,0.25);
}

/* PREVENT PAGE SHIFT ISSUES */
body.modal-open {
    overflow: hidden !important;
}
</style>
{{--<div class="container mt-120">
    <div class="accordion" id="mainAccordion">
    @php
        $activeSubcategories = $cat->child->where('status', 1)->count()>0;
    @endphp
        @if ($activeSubcategories)
        <div class="accordion-item">
            <h2 class="accordion-header">
                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapse{{ $cat->id }}">
                    {{ $cat->name }}
                </button>
            </h2>
            <div id="collapse{{ $cat->id }}" class="accordion-collapse collapse show" data-bs-parent="#mainAccordion">
                <div class="accordion-body">
                    <div class="group-card">
                
                        @if ($activeSubcategories->count() > 0)
                                @foreach ($activeSubcategories as $subcategory)
                                    @if ($subcategory->status==1)                                    
                                        <div class="card">
                                            <img src="{{ asset($subcategory->thumb) }}" alt="{{ $subcategory->name }}">
                                            <div class="card-content">
                                                <div class="card-title" onclick="window.location='{{ route('forum.forum.web',$subcategory->slug) }}'">{!! $subcategory->name !!}</div>
                                                <div class="stats">233.6k {{ trans('general.Posts') }} / 106 {{ trans('general.Followers') }}</div>
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
    </div>
</div>--}}

<div class="community">
 
    <!-- ── TOP BAR ── -->
    <div class="community__topbar">
      <div class="community__topbar-left">
        <h1 class="community__topbar-title">{{ trans('general.Forum_Feedback') }}</h1>
        <p class="community__topbar-sub">{{ trans('general.Followers') }}:  {{ $totalFollowerCount }}</p>
        <p class="community__topbar-sub">Nutzen Sie diesen Raum, um Gedanken, Fragen und Vorschläge zum Forum zu teilen.</p> 
    </div>


            <div class="mt-2">
            
            @if(!auth()->check())
            <a href="{{route('account.create.user.post',$cat->id)}}">
                <button class="btn btn-primary">Neuen Beitrag erstellen</button>
            </a>
            @endif
            @auth
                <button type="button" class="btn btn-primary" id="openPostModal"
                    style="width:300px;font-size: 13px;">
                    Neuen Beitrag erstellen
                </button> 
            @endauth
        </div>
    </div>
   
    <!-- ── TWO-COLUMN LAYOUT ── -->
    <div class="community__layout">
   
      <!-- ── FEED ── -->
      <main class="community__feed" id="feed">
   
        @include('forum.forum_forum_partial')
        <div id="pagination">
            {{ $post->links('vendor.pagination.numbers') }}


        </div>
      </main>
   
      <!-- ── SIDEBAR ── -->
      <aside class="community__sidebar">
   
        <!-- Search -->
        <span class="community__sidebar-label">Search</span>
        <div class="community__search" style="margin-bottom: var(--sp-8);">
          <i  data-lucide="search" class=" community__search-icon"></i>
          <input
            type="text"
            class="community__search-input"
            placeholder="Search topics..."
            id="sidebarSearch"
          />
        </div>
   
        <!-- Categories -->
        <span class="community__sidebar-label">Categories</span>
        <div class="community__categories" id="categoryPills">
          <button class="community__cat-pill active" data-cat="all">All</button>
          <button class="community__cat-pill" data-cat="career">career</button>
          <button class="community__cat-pill" data-cat="studies">Studies</button>
          <button class="community__cat-pill" data-cat="ai & tech">AI &amp; Tech</button>
          <button class="community__cat-pill" data-cat="finances">Finances</button>
          <button class="community__cat-pill" data-cat="lifestyle">Lifestyle</button>
        </div>
   
        <!-- Trending -->
        <span class="community__sidebar-label">Trending</span>
        <div class="community__trending-tags">
          <span class="community__trending-tag">Application</span>
          <span class="community__trending-tag">Internship</span>
          <span class="community__trending-tag">Artificial Intelligence</span>
          <span class="community__trending-tag">Financing</span>
          <span class="community__trending-tag">Study Abroad</span>
        </div>
   
      </aside>
    </div><!-- /.community__layout -->
  </div><!-- /.community -->
  <div class="modal fade custom-modal-backdrop" id="exampleModalScrollable" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable modal-dialog-centered">
        <div class="modal-content shadow-lg border-0 rounded-4">

            <!-- Header -->
            <div class="modal-header border-0">
                <h5 class="modal-title fw-semibold">Beitrag erstellen</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Body -->
            <div class="modal-body" id="modalPostContent">
                <div class="text-center py-5">
                    <div class="spinner-border text-primary"></div>
                </div>
            </div>

        </div>
    </div>
</div>

@endsection
@section('script')
<link href="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.css" rel="stylesheet">
  <script src="https://cdn.jsdelivr.net/npm/summernote@0.9.0/dist/summernote.min.js"></script>
  
<script>
    function string_to_slug(str) {
        return str
            .toLowerCase()
            .trim()
            .replace(/[^a-z0-9\s-]/g, '')     // remove invalid chars
            .replace(/\s+/g, '-')             // replace spaces with -
            .replace(/-+/g, '-');             // collapse multiple dashes
    }

    $(document).on('input', '#title', function () {
        let title = $(this).val();
        let slug = string_to_slug(title);
        $('#slug').val(slug);
    });
$(document).ready(function () {
    $('.edit-post-btn').on('click', function () {
        let postId = $(this).data('id');

        $.ajax({
            url: '{{ url('account/user/post/edit/') }}/' + postId,
            type: 'GET',
            success: function (response) {
                $('#editModalContent').html(response);
                $('#editPostModal').modal('show');

                // Initialize Summernote
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
            },
            error: function () {
                alert('Error loading edit form.');
            }
        });
    });
});
</script>

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
            $('#openPostModal').on('click', function() {
                const modal = new bootstrap.Modal(document.getElementById('exampleModalScrollable'));
        modal.show();

        $('#modalPostContent').html(
            '<div class="text-center py-5"><div class="spinner-border text-primary"></div></div>'
        );
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
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    function confirmDelete(id) {
        Swal.fire({
            title: 'Are you sure?',
            text: "You won't be able to revert this!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
            if (result.isConfirmed) {
                document.getElementById('delete-form-' + id).submit();
            }
        })
    }
</script>

<style>
    .mt-150-card{
        margin-top: 150px;
    }
 .btn-group button{       
    font-size: 13px!important;
    background-color: var(--primary);
    border-radius: 100px;
    height: 33px!important;
    padding: 0px 14px;
    color: #000;
    font-family: "myFont5";
    border: none;
    outline: none;
}
.custom-modal-backdrop {
    background: rgba(0,0,0,0.6) !important;
    backdrop-filter: blur(3px);
}

/* better modal look */
.modal-content {
    border-radius: 16px;
    overflow: hidden;
}

/* prevent flicker issue */
.modal-backdrop {
    z-index: 1040 !important;
}
.modal {
    z-index: 1050 !important;
}
</style>

@endsection

