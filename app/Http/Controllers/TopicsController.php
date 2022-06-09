<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Topic;
use Illuminate\Support\Facades\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Inertia\Inertia;

class TopicsController extends Controller
{
    public function index() {
        return Inertia::render('Topics/Index', [
            'filters' => Request::only(['search']),
            'categories' => Category::all(),
            'topics' => Topic::query()
                ->when(Request::input('search'), function ($query, $search) {
                    $query->where('category_id', '=', $search);
                })
                ->paginate(5)
                ->withQueryString()
                ->through(fn($topic) => [
                    'id' => $topic->id,
                    'topic_name' => $topic->topic_name,
                    'category' => $topic->category->category_name
                ])
        ]);
    }

    public function create() {
        return Inertia::render('Topics/Create', [
            'categories' => Category::all()
        ]);
    }

    public function store() {
        $attributes = Request::validate([
            'topic_name' => ['required', 'max:100'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        Topic::create($attributes);

        return Redirect::route('topics')->with('success', 'Тема добавлена.');
    }

    public function edit(Topic $topic) {
        return Inertia::render('Topics/Edit', [
            'topic' => [
                'id' => $topic->id,
                'topic_name' => $topic->topic_name,
                'category_id' => $topic->category->id
            ],
            'categories' => Category::all()
        ]);
    }

    public function update(Topic $topic) {
        $attributes = Request::validate([
            'topic_name' => ['required', 'max:100'],
            'category_id' => ['required', Rule::exists('categories', 'id')]
        ]);

        $topic->update($attributes);

        return Redirect::back()->with('success', 'Тема обновлена.');
    }

    public function destroy(Topic $topic) {
        $topic->delete();

        return Redirect::route('topics')->with('success', 'Тема удалена.');
    }
}
