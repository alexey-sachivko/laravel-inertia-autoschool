<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Inertia\Inertia;

class CategoriesController extends Controller
{
    public function index() {
        return Inertia::render('Categories/Index', [
            'categories' => Category::all()
        ]);
    }
}
