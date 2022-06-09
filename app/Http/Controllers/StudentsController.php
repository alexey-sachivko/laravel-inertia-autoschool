<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Group;
use App\Models\Student;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class StudentsController extends Controller
{
    public function index() {
        return Inertia::render('Students/Index', [
            //'students' => Student::with('group')->get()
            'students' => Student::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('surname', 'like', "%{$search}%")
                    ->orWhere('name', 'like', "%{$search}%")
                    ->orWhere('third_name', 'like', "%{$search}%");
                })
                ->with('group')
                ->paginate(5)
                ->withQueryString()
                ->through(fn($student) => [
                    'id' => $student->id,
                    'surname' => $student->surname,
                    'name' => $student->name,
                    'third_name' => $student->third_name,
                    'birthday' => $student->birthday,
                    'contact_info' => $student->contact_info,
                    'group' => $student->group->only('group_number')
                ]),
            "filters" => Request::only(['search']),
        ]);
    }

    public function create() {
        return Inertia::render('Students/Create', [
            'groups' => Group::all(),
            'autos' => Auto::all()
        ]);
    }

    public function store() {
        $attributes = Request::validate([
            'surname' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'third_name' => ['required', 'max:50'],
            'birthday' => ['required', 'max:50'],
            'address' => ['required', 'max:100'],
            'contact_info' => ['required', 'max:20'],
            'passport_info' => ['required', 'max:10'],
            'group_id' => ['required', Rule::exists('groups', 'id')],
            'auto_id' => ['nullable', Rule::exists('autos', 'id')]
        ]);

        Student::create($attributes);

        return Redirect::route('students')->with('success', 'Курсант добавлен.');
    }

    public function edit(Student $student) {
        return Inertia::render('Students/Edit', [
            'student' => [
                'id' => $student->id,
                'surname' => $student->surname,
                'name' => $student->name,
                'third_name' => $student->third_name,
                'birthday' => $student->birthday,
                'address' => $student->address,
                'contact_info' => $student->contact_info,
                'passport_info' => $student->passport_info,
                'group_id' => $student->group->id,
                'auto_id' => $student->auto ? $student->auto->id : null,
            ],
            'groups' => Group::all(),
            'autos' => Auto::all()
        ]);
    }

    public function update(Student $student) {
        $attributes = Request::validate([
            'surname' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'third_name' => ['required', 'max:50'],
            'birthday' => ['required', 'max:50'],
            'address' => ['required', 'max:100'],
            'contact_info' => ['required', 'max:20'],
            'passport_info' => ['required', 'max:10'],
            'group_id' => ['required', Rule::exists('groups', 'id')],
            'auto_id' => ['nullable', Rule::exists('autos', 'id')]
        ]);

        $student->update($attributes);

        return Redirect::back()->with('success', 'Курсант обновлен.');
    }

    public function destroy(Student $student) {
        $student->delete();

        return Redirect::route('students')->with('success', 'Курсант удален.');
    }
}
