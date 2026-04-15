            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ trans('general.Update_Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.task.update')}} " method="post" enctype="multipart/form-data">
                    @csrf
                              <input type="hidden" class="form-control" name="id" value="{{$task->id}}">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="task_title" class="form-label">{{ trans('general.Task_Title') }}</label>
                            <input type="text" class="form-control" id="task_title" name="title" required value="{{$task->title}}">
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">{{ trans('general.Due_Date') }}</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required value="{{$task->due_date}}">
                        </div>
 
                            
                            <div class="col-12 mb-3">
                                <label for="description" class="form-label">{{ trans('general.Description') }}</label>
                                <textarea class="form-control" id="description" name="description" rows="3">{{ old('description', $task->description) }}</textarea>
                            </div>
                            
                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Time') }}</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="time"
                                                            value="{{ date('Y-m-d\TH:i') }}" required value="{{$task->time}}">
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="attachment" class="form-label">{{ trans('general.Attachment') }}</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                            @if($task->attachment !=null)

                            <img src="{{asset($task->attachment)}}" width="100px" height="100">
                            
                            @endif
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('general.Save_Task') }}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                </form>
            </div>