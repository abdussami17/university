@extends('user.layout')
@section('title', trans('general.Career_Planning'))
@section('content')
<div class="mt-60">
    <div class="card">
        <div class="card-body">


    <h4>Workshop Detail</h4>
                        
<table class="table table-bordered" id="myTableunique">
    <thead>
        <tr>
            <th>#</th>
            <th>{{ trans('general.Module_Type') }}</th>
            <th>{{ trans('general.Module_ID') }}</th>
            <th>{{ trans('general.Status') }}</th>
            <th>{{ trans('general.Payment_Status') }}</th>
            <th>{{ trans('general.Booking_Date') }}</th>
            <th>{{ trans('general.Read_Status') }}</th>
        </tr>
    </thead>
    <tbody>
        @php
            $userId = auth()->id();
            $workshops = App\Models\Enroll::where('module_type', 'kurs')->where('user_id', $userId)->get();
        @endphp

        @foreach ($workshops as $index => $enroll)
           @php
               $workshopname = App\Models\Workshops::where('id', $enroll->module_id)->first();
           @endphp
            <tr>
                <td>{{ $index + 1 }}</td>
                <td>{{ ucfirst($enroll->module_type) }}</td>
                <td>{{ $workshopname->title }}</td>
                <td>
                    <span class="badge bg-{{ $enroll->status == 'active' ? 'success' : 'danger' }}">
                        {{ ucfirst($enroll->status) }}
                    </span>
                </td>
                <td>
                    <span class="badge bg-{{ $enroll->payment_status == 'paid' ? 'success' : 'warning' }}">
                        {{ ucfirst($enroll->payment_status) }}
                    </span>
                </td>
                <td>{{ \Carbon\Carbon::parse($enroll->book_date)->format('Y-m-d') }}</td>
                <td>
                    @if($enroll->is_read)
                        <span class="badge bg-success">{{ trans('general.Read') }}</span>
                    @else
                        <span class="badge bg-danger">{{ trans('general.Unread') }}</span>
                    @endif
                </td>
            </tr>
        @endforeach

    </tbody>
</table>
</div>


        </div>
    </div>
@endsection
