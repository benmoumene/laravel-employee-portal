<?php

namespace App\Http\Controllers\HR\Employees;

use App\Models\HR\Employee;
use App\Http\Controllers\Controller;
use App\Models\HR\EmployeeTimelineEvent;
use App\Http\Requests\HR\Employees\EmployeeTimelineEventRequest;

class EmployeeTimelineEventController extends Controller
{
    /**
     * Display the timeline of an employee
     *
     * @param  \App\Models\Employee $employee
     * @return \Illuminate\Http\Response
     */
    public function index(Employee $employee)
    {
        $employee->load('timelineEvents');
        // sorting timeline events by latest and then grouping by date
        $timelineEventsByDate = $employee->timelineEvents->sortByDesc('occurred_on')->groupBy('occurred_on');
        return view('hr.employees.timeline', compact('employee', 'timelineEventsByDate'));
    }

    public function store(EmployeeTimelineEventRequest $request, Employee $employee)
    {
        $validated = $request->validated();
        EmployeeTimelineEvent::create([
            'employee_id' => $employee->id,
            'name' => $validated['name'],
            'description' => $validated['description'],
        ]);
        return redirect(route('employees.timeline-event', $employee))->with('status', 'Event added successfully!');
    }
}
