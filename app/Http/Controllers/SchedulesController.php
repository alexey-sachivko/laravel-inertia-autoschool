<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Schedule;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class SchedulesController extends Controller
{
    public function index() {
        return Inertia::render('Schedules/Index', [
            'filters' => Request::only(['search']),
            'groups' => Group::all(),
            'schedules' => Schedule::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('group_id', '=', $search);
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn($schedule) => [
                    'id' => $schedule->id,
                    'class_time' => $schedule->class_time,
                    'day_of_week' => $schedule->day_of_week,
                    'group' => $schedule->group->group_number
                ])
        ]);
    }

    public function create() {
        return Inertia::render('Schedules/Create', [
           'groups' => Group::all()
        ]);
    }

    public function store() {
        $attributes = Request::validate([
            'class_time' => ['required', 'date_format:H:i'],
            'day_of_week' => ['required'],
            'group_id' => ['required', Rule::exists('groups', 'id')]
        ]);

        Schedule::create($attributes);

        return Redirect::route('schedules')->with('success', 'Расписание добавлено.');
    }

    public function edit(Schedule $schedule) {
        return Inertia::render('Schedules/Edit', [
           'schedule' => [
               'id' => $schedule->id,
               'class_time' => $schedule->class_time,
               'day_of_week' => $schedule->day_of_week,
               'group_id' => $schedule->group->id
           ],
           'groups' => Group::all()
        ]);
    }

    public function update(Schedule $schedule) {
        $attributes = Request::validate([
            'class_time' => ['required', 'date_format:H:i'],
            'day_of_week' => ['required'],
            'group_id' => ['required', Rule::exists('groups', 'id')]
        ]);

        $schedule->update($attributes);

        return Redirect::back()->with('success', 'Расписание обновлено.');
    }

    public function destroy(Schedule $schedule) {
        $schedule->delete();

        return Redirect::route('schedules')->with('success', 'Расписание удалено.');
    }
}
