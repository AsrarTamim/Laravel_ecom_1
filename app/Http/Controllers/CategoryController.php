<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
class CategoryController extends Controller
{
    public function create(){
        return view('categories.create');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'name' => 'required'
        ]);
        Category:: create($validated);
        return redirect() ->route('categories.index') -> with('success', 'category created!');
    }
    public function index()
    {
        $categories = Category::withCount('products')->get();
        return view('categories.index', ['categories' => $categories]);
    }
    public function edit($id){
        $category = Category::findOrFail($id);
        return view('categories.edit', ['category' => $category]);
    }
    public function update(Request $request,$id){
        $category = Category::findOrFail($id);
         $validated = $request->validate([
            'name' => 'required'
        ]);
        $category->update($validated);
        return redirect() ->route('categories.index') -> with('success', 'category Updated!');
    }
    public function destory($id){
        $category = Category::findorFail($id);
        $category->delete();
        return redirect() ->route('categories.index') -> with('success', 'category Deleted!');
    }


}
