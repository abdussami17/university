@extends('layout.app')

@section('title', trans('general.Forum_University_Community'))
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-sRIl4kxILFvY47J16cr9ZwB07vP4J8+LH7qKQnuqkuIAvNWLzeN8tE5YBujZqJLB" crossorigin="anonymous">
<link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
@section('content')
<style>
    .navbar__inner {width:100% }
</style>
<style>
    main{
        margin-top:0!important;
    }
    
    
    .modal-content {
        position: relative;
        z-index: 10000!important;
    }
    header{
        z-index: 1000!important;
        
    }   
    #editPostModal{
        text-align: left;
    }
    
</style>

<section class="main-feedback-heading" style="background: #f8f9fa!important;">
    <div class="container" style=" border-top: 3px solid rgb(1, 56, 18);">
        <div class="header">
            <h1></h1>
            <div class="">

@if(auth()->check())
                   <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModalScrollable">Neues Ereignis hinzufügen
</button>
@else
<a href="{{ route('account.meet.session', ['slug' => Str::slug($category->name)]) }}">
    <button class="btn btn-primary" id="addEventButton">
        Neues Ereignis hinzufügen
    </button>
</a>


@endif

                    
            </div>
        </div>
        
    </div>
    <div class="container" style="padding-top: 0px;">
        <div class="forum-list">
            <div id="posts-container">

@foreach ($child as $item)

<div class="forum-item">
    <div class="forum-item-left">
        <h2><a href="">{{ $item->name }}</a></h2>
        <p style="text-align:left">{{$item->description}}</p>
        <p style="text-align:left">{{ \Carbon\Carbon::parse($item->date)->format('F d, Y') }}</p>
        <p style="text-align:left">Time : {{ $item->time }}</p>
    </div>
    <div class="forum-item-right">
        <img src="{{ asset('profile-placeholder.jpg') }}" alt="User">


@auth

<button class="btn btn-sm btn-warning edit-btn edit-post-btn"
                data-id="{{ $item->id }}"
                data-toggle="modal"
                data-target="#editModal">
                Edit
            </button>
            
<!-- Delete Button Form -->
<form id="delete-form-{{ $item->id }}" method="POST" action="{{ route('user.event.destroy', $item->id) }}" style="display: inline;">
    @csrf
    @method('DELETE')
    <button type="button" class="btn btn-danger" onclick="confirmDelete({{ $item->id }})">Delete</button>
</form>


@endauth

    </div>
</div>

<!-- Edit Modal Container -->
<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true"  style="background: #00000057;">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="editModalContent">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>
@endforeach


                
            </div>
        </div>
    </div>
</section>


<div class="modal fade" id="exampleModalScrollable" tabindex="-1" aria-labelledby="exampleModalScrollableTitle" aria-hidden="true" style="    background: #00000061;">
  <div class="modal-dialog modal-dialog-scrollable">
    <div class="modal-content">
      <form action="{{ route('user.event.store') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalScrollableTitle">Neues Ereignis hinzufügen</h5>
          <butto n type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        
        <div class="modal-body">
          <div class="mb-3" style="text-align:left">
            <label for="name" class="form-label">Name</label>
            <input type="text" class="form-control" name="name" required>
          </div>
@if(auth()->check())
          <input type="hidden" name="user_id" value="{{ auth()->user()->id }}">
          <input type="hidden" name="parent_id" value="{{ $category->id }}">
          @endif
          <div class="mb-3" style="text-align:left">
            <label for="description" class="form-label" style="text-align:left">Description</label>
            <textarea class="form-control" name="description" rows="3" required></textarea>
          </div>

          <div class="mb-3" style="text-align:left">
            <label for="image" class="form-label" style="text-align:left">Image</label>
            <input type="file" class="form-control" name="image" accept="image/*">
          </div>

          <div class="mb-3" style="text-align:left">
            <label for="date" class="form-label" style="text-align:left">Date</label>
            <input type="date" class="form-control" name="date" required>
          </div>

          <div class="mb-3" style="text-align:left">
            <label for="time" class="form-label" style="text-align:left">Time</label>
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


<div class="modal fade" id="editPostModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">
        <div class="modal-content" id="editModalContent">
            <!-- Content loaded via AJAX -->
        </div>
    </div>
</div>


@endsection
@section('script')
<script>
    $(document).ready(function () {
    $('.edit-post-btn').on('click', function () {
        let postId = $(this).data('id');

        $.ajax({
            url: '{{ url('account/user/event/edit/') }}/' + postId,
            type: 'GET',
            success: function (response) {
                $('#editModalContent').html(response);
                $('#editPostModal').modal('show');
            },
            error: function (xhr) {
                console.log(xhr);
                alert('Error loading edit form.');
            }
        });
    });
});
</script>
<script>
    function confirmDelete(id) {
        if (confirm('Are you sure you want to delete this event?')) {
            document.getElementById('delete-form-' + id).submit();
        }
    }
</script>

<script>

</script>
<script>
    @if ($errors->any())
        @foreach ($errors->all() as $error)
            toastr.error("{{ $error }}", "Validation Error", {
                closeButton: true,
                progressBar: true
            });
        @endforeach
    @endif
</script>
@endsection