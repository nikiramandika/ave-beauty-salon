<?php

// app/Http/Controllers/CategoryController.php
namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    /**
     * Display a listing of the categories.
     */
    public function index()
    {
        $categories = Category::all();
        return view('owner.pages.categories.categories', compact('categories'));
    }

    /**
     * Show the form for creating a new category.
     */
    public function create()
    {
        return view('owner.pages.categories.categories-create');
    }

    /**
     * Store a newly created category in storage.
     */
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:50|unique:categories',
            'category_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        // If validation fails, redirect back with errors
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Handle image upload
            $imageUrl = null; // Initialize the variable to hold the image URL
            if ($request->hasFile('category_image')) {
                // Get the uploaded image
                $image = $request->file('category_image');
                // Generate a unique name for the image
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                // Store the image in the public/categories directory
                $image->storeAs('public/categories', $imageName);
                // Create the URL to access the stored image
                $imageUrl = 'storage/categories/' . $imageName;
            }

            // Create a new category with the validated data and uploaded image URL
            Category::create([
                'category_name' => $request->category_name,
                'category_slug' => Category::generateSlug($request->category_name),
                'category_image' => $imageUrl
            ]);

            // Redirect to the categories index with a success message
            return redirect()
                ->route('categories.index')
                ->with('success', 'Category created successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error creating category: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Show the form for editing the specified category.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('owner.pages.categories.categories-edit', compact('category'));
    }

    /**
     * Update the specified category in storage.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        // Validate data
        $validator = Validator::make($request->all(), [
            'category_name' => 'required|string|max:50|unique:categories,category_name,' . $id . ',category_id', // Adjusted validation rule
            'category_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ]);

        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }

        try {
            // Check if a new image is uploaded
            if ($request->hasFile('category_image')) {
                // Delete old image if exists
                if ($category->category_image) {
                    Storage::delete(str_replace('storage/', 'public/', $category->category_image));
                }

                // Upload new image
                $image = $request->file('category_image');
                $imageName = time() . '.' . $image->getClientOriginalExtension();
                $image->storeAs('public/categories', $imageName);
                $category->category_image = 'storage/categories/' . $imageName; // Update image URL
            }

            // Update category name and slug
            $category->category_name = $request->category_name;
            $category->category_slug = Category::generateSlug($request->category_name);
            $category->save();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category updated successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error updating category: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Remove the specified category from storage.
     */
    public function destroy($id)
    {
        try {
            $category = Category::findOrFail($id);

            // Delete category image if exists
            if ($category->category_image) {
                Storage::delete(str_replace('storage/', 'public/', $category->category_image));
            }

            $category->delete();

            return redirect()
                ->route('categories.index')
                ->with('success', 'Category deleted successfully');

        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('error', 'Error deleting category: ' . $e->getMessage());
        }
    }
}
