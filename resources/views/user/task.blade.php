@extends('user.layout')

@section('title',trans('general.Task_Calendar'))

@section('content')

    <div class="container-fluid">
        <div class="card">
            <div class="card-body">
                    <button type="button" class="create-visit btn btn-primary" data-bs-toggle="modal" data-bs-target="#addTaskModal">+ {{ trans('general.Create_Task') }}</button>
                    <a href="{{route('account.show.allTask')}}" class="btn btn-primary">{{trans('general.Show_All_Task') }}</a>
                <div id="calendar"></div>
            </div>
        </div>
    </div>
    
<div class="modal fade" id="addTaskModal" tabindex="-1" aria-labelledby="modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalLabel">{{ trans('general.Create_Task') }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="{{ route('account.task.store')}} " method="post" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label for="task_title" class="form-label">{{ trans('general.Task_Title') }}</label>
                            <input type="text" class="form-control" id="task_title" name="title" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label for="due_date" class="form-label">{{ trans('general.Due_Date') }}</label>
                            <input type="date" class="form-control" id="due_date" name="due_date" required>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Description') }}</label>
                            <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                        </div>

                        <div class="col-12 mb-3">
                            <label for="description" class="form-label">{{ trans('general.Time') }}</label>
                            <input type="datetime-local" class="form-control" id="datetime" name="time"
                                value="" required>
                        </div>
                        
                        <div class="col-md-12 mb-3">
                            <label for="attachment" class="form-label">{{ trans('general.Attachment') }}</label>
                            <input type="file" class="form-control" id="attachment" name="attachment">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-success">{{ trans('general.Save_Task') }}</button>
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">{{ trans('general.Cancel') }}</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
    <!-- FullCalendar CSS & JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.11.3/main.min.js"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f6f9;
        }
        #calendar {
            max-width: 95%;
            margin: 20px auto;
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
                @php
                $tasks = App\Models\Task::where('user_id', auth()->user()->id)->get();
                
                   $events = $tasks->map(function ($task) {
            return [
                'id' => $task->id,
                'title' => $task->title,
                'start' => $task->time,
                'backgroundColor' => '#007bff' // Default blue color
            ];
        });
        
            @endphp
        <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'timeGridWeek', // Google Calendar style
                selectable: true,
                editable: true,
                nowIndicator: true,
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay,listWeek'
                },
                events: {!! json_encode($events) !!}, // Laravel data Blade se pass ho raha hai
            });
            calendar.render();
        });
    </script>




@endsection
