<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\URL;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class UsersController extends Controller
{
    public function index() {
        return Inertia::render('Users/Index', [
            'filters' => Request::only(['search']),
            'users' => User::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('surname', 'like', "%{$search}%")
                        ->orWhere('name', 'like', "%{$search}%")
                        ->orWhere('third_name', 'like', "%{$search}%");
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn($user) => [
                    'id' => $user->id,
                    'surname' => $user->surname,
                    'name' => $user->name,
                    'third_name' => $user->third_name,
                    'birthday' => $user->birthday,
                    'contact_info' => $user->contact_info,
                    'rank' => $user->rank,
                ]),
        ]);
    }

    public function create() {
        return Inertia::render('Users/Create');
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
            'rank' => ['required'],
            'username' => ['required', 'max:50', Rule::unique('users')],
            'password' => ['required'],
        ]);

        User::create($attributes);

        return Redirect::route('users')->with('success', 'Сотрудник добавлен.');
    }

    public function edit(User $user) {
        return Inertia::render('Users/Edit', [
            'user' => [
                'id' => $user->id,
                'surname' => $user->surname,
                'name' => $user->name,
                'third_name' => $user->third_name,
                'birthday' => $user->birthday,
                'address' => $user->address,
                'contact_info' => $user->contact_info,
                'passport_info' => $user->passport_info,
                'rank' => $user->rank,
                'username' => $user->username,
            ],
        ]);
    }

    public function update(User $user) {
        Request::validate([
            'surname' => ['required', 'max:50'],
            'name' => ['required', 'max:50'],
            'third_name' => ['required', 'max:50'],
            'birthday' => ['required', 'max:50'],
            'address' => ['required', 'max:100'],
            'contact_info' => ['required', 'max:20'],
            'passport_info' => ['required', 'max:10'],
            'rank' => ['required'],
        ]);

        $user->update(Request::only('surname', 'name', 'third_name', 'birthday', 'address', 'contact_info', 'passport_info', 'rank'));

        if (Request::get('password')) {
            $user->update(['password' => Request::get('password')]);
        }

        return Redirect::back()->with('success', 'Сотрудник обновлен.');
    }

    public function destroy(User $user) {
        $user->delete();

        return Redirect::route('users')->with('success', 'Сотрудник удален.');
    }
}
