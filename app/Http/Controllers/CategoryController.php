<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function allCategory()
    {
        // Eloquent ORM 
        // $categories = Category::latest()->get();

        // Query Builder
        // $categories = DB::table('categories')->latest()->get();

        // pagination(Eloquent ORM)
        // $categories = Category::latest()->paginate(3);

        // pagination(Query Builder)
        // $categories = DB::table('categories')->latest()->paginate(3);

        // one to one join(Eloquent ORM)
        $categories = Category::latest()->paginate(3);
        $trashCategory = Category::onlyTrashed()->latest()->paginate(2);

        // one to one join (Query Builder)
        // $categories = DB::table('categories')
        //     ->join('users', 'categories.user_id', 'users.id')
        //     ->select('categories.*', 'users.name')
        //     ->latest()->paginate(3);
        return view('admin.category.index', compact('categories', 'trashCategory'));
    }

    public function addCategory(Request $request)
    {

        $validated = $request->validate(
            [
                'category_name' => 'required|unique:categories|max:255',
            ],

            // for default validation text
            [
                'category_name.required' => 'please Enter category name',
            ]
        );

        // one way of Inserting Data(Eloquent ORM)

        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        //  another way of data Insertion (Eloquent ORM) /* Most Efficient Way */

        $category = new Category();
        $category->category_name = $request->category_name;
        $category->user_id = Auth::user()->id;
        $category->save();

        // Data Insertion Using Query Builder

        // $category = array();
        // $category['category_name'] = $request->category_name;
        // $category['user_id'] = Auth::user()->id;
        // DB::table('categories')->insert($category);

        return back()->with('success', 'Category has been Inserted Successfully');
    }

    public function editCategory($id)
    {
        // Eloquent ORM
        // $categories = Category::find($id);

        // Query Builder
        $categories = DB::table('categories')->where('id', $id)->first();
        return view('admin.category.edit', compact('categories'));
    }

    public function updateCategory(Request $request, $id)
    {
        // Eloquent ORM
        // Category::find($id)->update([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        // ]);

        // Query Builder
        $categories = array();
        $categories['category_name'] = $request->category_name;
        $categories['user_id'] = Auth::user()->id;
        DB::table('categories')->where('id', $id)->update($categories);

        return redirect()->route('all.category')->with('success', 'Category has been updated successfully');
    }

    public function softDeleteCategory($id)
    {
        $categories = Category::find($id)->delete();
        return back()->with('success', 'category has been successfully Deleted');
    }

    public function restoreCategory($id)
    {
        $restore = Category::withTrashed()->find($id)->restore();
        return back()->with('success', 'category has been restore successfully');
    }

    public function deleteCategory($id)
    {
        $delete = Category::onlyTrashed()->find($id)->forceDelete();
        return back()->with('success', 'Category has been Permanently deleted Successfully');
    }
}