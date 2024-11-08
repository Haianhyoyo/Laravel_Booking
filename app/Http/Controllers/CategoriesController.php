<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Str;

class CategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::orderBy('id', 'DESc')->get();
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required|max:220',
            'image' => 'required|max:220',
            'status' => 'required|max:220',
        ], [
            'title.required' => 'Yêu cầu nhập title',
            'description.required' => 'Yêu cầu nhập description',
            'image.required' => 'Yêu cầu nhập hình ảnh',
            'status.required' => 'Yêu cầu tích',
            'title.unique' => 'Title đã có không được trùng',
        ]);
        $category = new Category();
        $category->title = $data['title'];
        $category->description = $data['description'];

        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);

        // Them anh vao folder
        $get_image = $request->image;
        $path = 'uploads/categories/';
        $get_name_image = $get_image->getClientOriginalName();
        $name_image = current(explode('.', $get_name_image));
        $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
        $get_image->move($path, $new_image);
        $category->image = $new_image;

        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categories = Category::find($id);
        return view('admin.categories.edit', compact('categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = $request->validate([
            'title' => 'required|unique:categories|max:255',
            'description' => 'required|max:220',

            'status' => 'required|max:220',
        ], [
            'title.required' => 'Yêu cầu nhập title',
            'description.required' => 'Yêu cầu nhập description',

            'status.required' => 'Yêu cầu tích',
            'title.unique' => 'Title đã có không được trùng',
        ]);
        $category = Category::find($id);
        $category->title = $data['title'];
        $category->description = $data['description'];

        $category->status = $data['status'];
        $category->slug = Str::slug($data['title']);

        // Them anh vao folder
        if ($request->image) {
            $get_image = $request->image;
            $path = 'uploads/categories/';
            $get_name_image = $get_image->getClientOriginalName();
            $name_image = current(explode('.', $get_name_image));
            $new_image = $name_image . rand(0, 999) . '.' . $get_image->getClientOriginalExtension();
            $get_image->move($path, $new_image);
            $category->image = $new_image;
        }


        $category->save();
        return redirect()->route('categories.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $categories = Category::find($id);
        $categories->delete();
        return redirect()->route('categories.index');

    }
}
