<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Group;
use App\Models\Student;
use App\Models\User;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class GroupsController extends Controller
{
    public function index() {
        return Inertia::render('Groups/Index', [
            'groups' => Group::with('category')
                ->paginate('5')
                ->through(fn($group) => [
                    'id' => $group->id,
                    'group_number' => $group->group_number,
                    'date_start' => $group->date_start,
                    'date_end' => $group->date_end,
                    'category' => $group->category->category_name
                ])
        ]);
    }

    public function create() {
        return Inertia::render('Groups/Create', [
            'users' => User::where('rank', '=', 'teacher')->get(),
            'categories' => Category::all()
        ]);
    }

    public function store() {
        $attributes = Request::validate([
            'group_number' => ['required', 'max:2'],
            'date_start' => ['required', 'max:10'],
            'date_end' => ['required', 'max:10'],
            'description' => ['nullable', 'max:10'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        Group::create($attributes);

        return Redirect::route('groups')->with('success', 'Группа добавлена.');
    }

    public function edit(Group $group) {
        return Inertia::render('Groups/Edit', [
           'group' => [
               'id' => $group->id,
               'group_number' => $group->group_number,
               'date_start' => $group->date_start,
               'date_end' => $group->date_end,
               'description' => $group->description,
               'user_id' => $group->user->id,
               'category_id' => $group->category->id
           ],
            'users' => User::where('rank', '=', 'teacher')->get(),
            'categories' => Category::all(),
            'students' => Student::where('group_id', '=', $group->id)->get()
        ]);
    }

    public function update(Group $group) {
        $attributes = Request::validate([
            'group_number' => ['required', 'max:2'],
            'date_start' => ['required', 'max:10'],
            'date_end' => ['required', 'max:10'],
            'description' => ['nullable', 'max:10'],
            'user_id' => ['required', Rule::exists('users', 'id')],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $group->update($attributes);

        return Redirect::back()->with('success', 'Группа обновлена.');
    }

    public function destroy(Group $group) {
        $group->delete();

        return Redirect::route('groups')->with('success', 'Группа удалена.');
    }
}
