@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))

@section('content')

<style>
    main{
        margin-top:0!important;
    }
    #exampleModalScrollable .card{
            width: 100%;
    text-align: left;
    }
        #exampleModalScrollable .modal-body button{
            width: 100%!important;
        }
    
            .modal-content {
    position: relative;
    z-index: 10000!important;
    }
    header{
    z-index: 1000!important;}   
    
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

<section class="main-feedback-heading" style="background: #f8f9fa!important;">
    <div class="container" style=" border-top: 3px solid rgb(1, 56, 18);">
        <div class="header">
            <h1>{{ trans('general.Forum_Feedback') }}</h1>
            <div class="followers">{{ trans('general.Followers') }}:  {{ $totalFollowerCount }}</div>
        </div>
        <div class="mt-2">
            <p>{{ trans('general.Share_thoughts') }}</p>
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
    <div class="container" style="padding-top: 0px;">
        <div class="forum-list">
            <div id="posts-container">
            @include('forum.forum_forum_partial')
                
            </div>
            <div id="pagination">
                {{ $post->links('vendor.pagination.numbers') }}


            </div>
        </div>
    </div>
</section>

    <div class="modal fade" id="exampleModalScrollable" tabindex="-1" role="dialog" aria-hidden="true" style="    background: #00000057;">
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
</style>

@endsection

