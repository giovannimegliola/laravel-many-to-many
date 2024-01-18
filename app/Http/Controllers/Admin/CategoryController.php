<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::all();
        return view('admin.categories.index', compact('categories'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $currentUserId= Auth::id();     //solo l'admin può creare le categorie
        if($currentUserId !=1) {
            abort(403);
        }
         return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request)
    {
        $formData = $request->validated();
        //CREATE SLUG
        $slug = Str::of($formData['name'])->slug('-');
        //add slug to formData
        $formData['slug'] = $slug;
        $category = Category::create($formData);
        return redirect()->route('admin.categories.show', $category->slug);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return view('admin.categories.show',compact('category'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        $currentUserId= Auth::id();     //solo l'admin può editare le categorie
        if($currentUserId !=1) {
            abort(403);
        }
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $formData = $request->validated();
        $formData['slug'] = $category->slug;

        if ($category->name !== $formData['name']) {
            //CREATE SLUG
            $slug = Str::of($formData['name'])->slug('-');
            $formData['slug'] = $slug;
        }
        $category->update($formData);
        return redirect()->route('admin.categories.show', $category->slug);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $currentUserId= Auth::id();     //solo l'admin può eliminare le categorie
        if($currentUserId !=1) {
            abort(403);
        }
        $category->delete();
        return to_route('admin.categories.index')->with('message', "$category->name eliminato con successo");
    }
}
