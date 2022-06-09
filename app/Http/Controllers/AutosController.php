<?php

namespace App\Http\Controllers;

use App\Models\Auto;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class AutosController extends Controller
{
    public function index() {
        return Inertia::render('Autos/Index', [
            'filters' => Request::only(['search']),
            'autos' => Auto::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('brand', '=', $search);
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn($auto) => [
                    'id' => $auto->id,
                    'brand' => $auto->brand,
                    'model' => $auto->model,
                    'registration_number' => $auto->registration_number,
                    'user' => $auto->user->getFullName()
                ])
        ]);
    }

    public function create() {
        return Inertia::render('Autos/Create', [
            'users' => User::where('rank', '=', 'instructor')->get()
        ]);
    }

    public function store()
    {
        $attributes = Request::validate([
            'brand' => ['required', 'max:30'],
            'model' => ['required', 'max:30'],
            'registration_number' => ['required', 'max:10'],
            'year_of_manufacture' => ['required', 'min:4', 'max:4'],
            'type' => ['required'],
            'status' => ['required'],
            'user_id' => ['nullable', Rule::exists('users', 'id')]
        ]);

        Auto::create($attributes);

        return Redirect::route('autos')->with('success', 'Автомобиль добавлен.');
    }

    public function edit(Auto $auto) {
        return Inertia::render('Autos/Edit', [
            'auto' => [
                'id' => $auto->id,
                'brand' => $auto->brand,
                'model' => $auto->model,
                'registration_number' => $auto->registration_number,
                'year_of_manufacture' => $auto->year_of_manufacture,
                'type' => $auto->type,
                'status' => $auto->status,
                'user_id' => $auto->user->id,
            ],
            'users' => User::where('rank', '=', 'instructor')->get(),
            'students' => Student::where('auto_id', '=', $auto->id)->with('group')->get()
        ]);
    }

    public function update(Auto $auto) {
        $attributes = Request::validate([
            'brand' => ['required', 'max:30'],
            'model' => ['required', 'max:30'],
            'registration_number' => ['required', 'max:10'],
            'year_of_manufacture' => ['required', 'min:4', 'max:4'],
            'type' => ['required'],
            'status' => ['required'],
            'user_id' => ['nullable', Rule::exists('users', 'id')]
        ]);

        $auto->update($attributes);

        return Redirect::back()->with('success', 'Автомобиль обновлен.');
    }

    public function destroy(Auto $auto) {
        $auto->delete();

        return Redirect::route('autos')->with('success', 'Автомобиль удален.');
    }
}
