@extends('user.layout')
@section('title',trans('general.Notifications'))
@section('content')
<div class="d-flex dashboard-parent">
    <div class="content">
        <div class="container-fluid">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h5 class="card-title mb-0">{{ trans('general.Notifications') }}</h5>
                    <button class="btn btn-primary" onclick="markAllRead()">{{ trans('general.Mark_Read') }}</button>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                            <tr>
                                <th>{{ trans('general.Title') }}</th>
                                <th>{{ trans('general.Date') }}</th>
                                <th>{{ trans('general.Status') }}</th>
                            </tr>
                        </thead>
                        <tbody id="notificationTable">
                            <!-- Notifications will be loaded here dynamically -->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const notifications = [
        { title: "{{ trans('general.Project_Deadline') }}", date: "2025-03-01", status: "Unread" },
        { title: "{{ trans('general.Meeting_Client') }}", date: "2025-03-03", status: "Unread" },
        { title: "{{ trans('general.Invoice_Due') }}", date: "2025-03-05", status: "Read" }
    ];

    function loadNotifications() {
        let table = document.getElementById("notificationTable");
        table.innerHTML = "";

        notifications.forEach((notif, index) => {
            let row = document.createElement("tr");
            row.innerHTML = `
                <td>${notif.title}</td>
                <td>${notif.date}</td>
                <td>
                    <span class="badge ${notif.status === 'Unread' ? 'bg-danger' : 'bg-success'}">
                        ${notif.status}
                    </span>
                </td>
            `;
            if (notif.status === "Unread") {
                row.classList.add("table-warning");
            }
            table.appendChild(row);
        });
    }

    function markAllRead() {
        notifications.forEach(notif => notif.status = "Read");
        loadNotifications();
    }

    document.addEventListener("DOMContentLoaded", loadNotifications);
</script>
@endsection