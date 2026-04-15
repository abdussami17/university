<?php

namespace App\Http\Controllers;
use Spatie\GoogleCalendar\Event;
use Google_Client;
use App\Models\Task;
use App\Http\Requests\StoreTaskRequest;
use App\Http\Requests\UpdateTaskRequest;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;


use Google_Service_Calendar;
use Google_Service_Calendar_Event;
use Illuminate\Support\Facades\Validator;
use Google_Service_Tasks;

class TaskController extends Controller
{
    /**
     * Display a listing of the resource.
     */
public function googleTask()
{
    return Socialite::driver('google')
        ->scopes([
            'https://www.googleapis.com/auth/calendar',
            'https://www.googleapis.com/auth/calendar.events',
            'https://www.googleapis.com/auth/tasks', // ✅ Tasks scope
            'openid',
            'profile',
            'email'
        ])
        ->with(['access_type' => 'offline', 'prompt' => 'consent'])
        ->redirect();
}

public function getUserEvents()
{
    $user = auth()->user();

    if (!$user || !$user->google_token) {
        return redirect()->route('account.task.google')
            ->with('error', __('messages.connect_google'));
    }

    $client = new Google_Client();
    $client->setClientId(env('GOOGLE_CLIENT_ID'));
    $client->setClientSecret(env('GOOGLE_CLIENT_SECRET'));
    $client->setAccessToken($user->google_token);

    // ✅ Refresh token if expired
    if ($client->isAccessTokenExpired()) {
        if ($user->google_refresh_token) {
            $client->fetchAccessTokenWithRefreshToken($user->google_refresh_token);
            $newToken = $client->getAccessToken();

            $user->google_token = $newToken['access_token'];
            $user->google_refresh_token = $newToken['refresh_token'] ?? $user->google_refresh_token;
            $user->save();
        } else {
            return redirect()->route('account.task.google')
                ->with('error', __('messages.session_expired'));
        }
    }

    $mergedData = [];

    // ✅ Fetch Google Calendar Events
    $calendarService = new Google_Service_Calendar($client);
    $calendarId = 'primary';
    $events = $calendarService->events->listEvents($calendarId);

    foreach ($events->getItems() as $event) {
        $mergedData[] = [
            'id' => $event->id,
            'title' => $event->getSummary(),
            'start' => $event->start->dateTime ?? $event->start->date,
            'end'   => $event->end->dateTime ?? $event->end->date,
            'type'  => 'event',
            'backgroundColor' => '#28a745' // Green for events
        ];
    }

    // ✅ Fetch Google Tasks
    $tasksService = new Google_Service_Tasks($client);
    $taskLists = $tasksService->tasklists->listTasklists();

    foreach ($taskLists->getItems() as $taskList) {
        $tasks = $tasksService->tasks->listTasks($taskList->getId());
        foreach ($tasks->getItems() as $task) {
            if ($task->getStatus() !== 'completed') { // Optional: skip completed tasks
                $mergedData[] = [
                    'id' => $task->id,
                    'title' => $task->getTitle(),
                    'start' => $task->getDue() ?? now()->toDateString(), // If no due date, today
                    'end'   => $task->getDue() ?? now()->toDateString(),
                    'type'  => 'task',
                    'backgroundColor' => '#ffc107' // Yellow for tasks
                ];
            }
        }
    }

    return view('user.task.index', [
        'mergedData' => $mergedData
    ]);
}
  public function show_alltask()
  {
     return view('user.show_alltask');  
  }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
      

        $request->validate([

        ]);

      $validator = Validator::make($request->all(), [
            'title' => 'required',
    ]);


    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }

        $store = new Task();
        $store->user_id = auth()->user()->id;
        $store->title = $request->title;
        $store->due_date = $request->due_date;
        $store->priority_level = $request->priority_level;
        $store->task_category = $request->task_category;
        $store->reminder_notification = $request->reminder_notification;
        $store->status = $request->status;
        $store->description = $request->description;
        $store->repeat_task = $request->repeat_task;
        $store->repeat_task_time = $request->repeat_task_time;

        $store->time = $request->time;
        if ($request->hasFile('attachment')) {
            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
        
            $destinationPath = public_path('task/attachment');
            $file->move($destinationPath, $fileName);
        
            $store->attachment = 'public/task/attachment/' . $fileName; 
        }
        
    
        $store->save();
    
        return back()->with('success', __('messages.task.created'));
    }
    

    /**
     * Display the specified resource.
     */
    public function show(Task $task)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request)
    {
        $task = Task::findOrFail($request->id);
        return view('user.taskedit', compact('task'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([

        ]);

      $validator = Validator::make($request->all(), [
            'title' => 'required',
    ]);


    if ($validator->fails()) {
        return back()->withErrors($validator)->withInput();
    }
        $task=Task::find($request->id);

        $task->user_id = auth()->user()->id;
        $task->title = $request->title;
        $task->due_date = $request->due_date;
        $task->priority_level = $request->priority_level;
        $task->task_category = $request->task_category;
        $task->reminder_notification = $request->reminder_notification;
        $task->status = $request->status;
        $task->description = $request->description;
        $task->repeat_task = $request->repeat_task ? 1 : 0;
        $task->repeat_task_time = $request->repeat_task_time;


        $task->time = $request->time;
        
        // Handle file upload if new file is provided
        if ($request->hasFile('attachment')) {
            // Delete old attachment if exists
            if ($task->attachment && file_exists(public_path($task->attachment))) {
                unlink(public_path($task->attachment));
            }

            $file = $request->file('attachment');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = public_path('task/attachment');
            $file->move($destinationPath, $fileName);

            $task->attachment = 'public/task/attachment/' . $fileName;
        }

        $task->save();

        return redirect()->back()->with('success', __('messages.task.updated'));

    }


    /**
     * Remove the specified resource from storage.
     */
 public function destroy($id)
{
    try {
        $delete=Task::find($id);

        if ($delete->attachment && file_exists(public_path($delete->attachment))) {
            unlink(public_path($delete->attachment));
        }

        $delete->delete();

        return back()->with('success', __('messages.task.deleted'));
    } catch (\Exception $e) {
        return back()->with('error', __('messages.task.something_wrong') . $e->getMessage());
    }
}

}
