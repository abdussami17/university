
@extends('admin.app')

@section('admin_content')

<div class="content">

    <!-- Start Content-->
    <div class="container-fluid">
<form action="{{ route('admin.event.update') }}" method="POST" enctype="multipart/form-data">
  @csrf
  <input type="hidden" name="id" value="{{ $edit->id }}">

  <div class="modal-header">
    <h5 class="modal-title" id="exampleModalScrollableTitle">Edit Event</h5>
    <a href="{{ route('admin.event.index') }}" class="btn-close" aria-label="Close"></a>
  </div>

  <div class="modal-body">

    <div class="mb-3">
      <label for="name" class="form-label">Name</label>
      <input type="text" class="form-control" name="name" value="{{ $edit->name }}" required>
    </div>

    <div class="mb-3">
      <label for="parent_id" class="form-label">Parent</label>
      <select name="parent_id" class="form-control">
        <option value="0">Parent</option>
        @foreach (App\Models\meet::where('parent_id',0)->get() as $item)
          <option value="{{ $item->id }}" {{ $edit->parent_id == $item->id ? 'selected' : '' }}>
            {{ $item->name }}
          </option>
        @endforeach
      </select>
    </div>

    <div class="mb-3">
      <label for="description" class="form-label">Description</label>
      <textarea class="form-control" name="description" rows="3" required>{{ $edit->description }}</textarea>
    </div>

    <div class="mb-3">
      <label for="image" class="form-label">Image</label>
      <input type="file" class="form-control" name="image" accept="image/*">
      @if($edit->image)
        <img src="{{ asset($edit->image) }}" alt="Current Image" width="100" class="mt-2">
      @endif
    </div>

    <div class="mb-3">
      <label for="date" class="form-label">Date</label>
      <input type="date" class="form-control" name="date" value="{{ $edit->date }}" required>
    </div>

    <div class="mb-3">
      <label for="time" class="form-label">Time</label>
      <input type="time" class="form-control" name="time" value="{{ $edit->time }}" required>
    </div>

  </div>

  <div class="modal-footer">
    <a href="{{ route('admin.event.index') }}" class="btn btn-secondary">Cancel</a>
    <button type="submit" class="btn btn-primary">Update</button>
  </div>
</form>

    </div>
</div>
@endsection
