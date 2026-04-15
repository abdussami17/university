<div class="modal-content">
  <form action="{{ route('user.event.update') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <div class="modal-header">
      <h5 class="modal-title">Ereignis bearbeiten</h5>
      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
    </div>
    
    <div class="modal-body">
      <!-- Name -->
      <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input type="text" class="form-control" name="name" value="{{ old('name', $edit->name) }}" required>
      </div>

        <input type="text" class="form-control" name="user_id" value="{{ auth()->user()->id}}" required>

        <input type="text" class="form-control" name="parent_id" value="{{ session('meett_cat_main_id')}}" required>
        
      <!-- Parent -->
      <!--<div class="mb-3">-->
      <!--  <label for="parent_id" class="form-label">Parent</label>-->
      <!--  <select name="parent_id" class="form-control">-->
      <!--    <option value="0" {{ $edit->parent_id == 0 ? 'selected' : '' }}>Parent</option>-->
      <!--    @foreach (App\Models\meet::where('parent_id', 0)->get() as $item)-->
      <!--      <option value="{{ $item->id }}" {{ $edit->parent_id == $item->id ? 'selected' : '' }}>-->
      <!--        {{ $item->name }}-->
      <!--      </option>-->
      <!--    @endforeach-->
      <!--  </select>-->
      <!--</div>-->

      <!-- Description -->
      <div class="mb-3">
        <label class="form-label">Description</label>
        <textarea class="form-control" name="description" rows="3" required>{{ old('description', $edit->description) }}</textarea>
      </div>

      <!-- Image -->
      <div class="mb-3">
        <label class="form-label">Image</label>
        <input type="file" class="form-control" name="image" accept="image/*">
        @if($edit->image)
          <img src="{{ asset($edit->image) }}" alt="Event Image" class="mt-2" width="100">
        @endif
      </div>

      <!-- Date -->
      <div class="mb-3">
        <label class="form-label">Date</label>
        <input type="date" class="form-control" name="date" value="{{ old('date', $edit->date) }}" required>
      </div>

      <!-- Time -->
      <div class="mb-3">
        <label class="form-label">Time</label>
        <input type="time" class="form-control" name="time" value="{{ old('time', $edit->time) }}" required>
      </div>
    </div>

    <div class="modal-footer">
      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
      <button type="submit" class="btn btn-primary">Update</button>
    </div>
  </form>
</div>
