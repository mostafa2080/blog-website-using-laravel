<?php

namespace App\Http\Controllers\Home;

use App\Models\BlogCategory;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class BlogCategoryController extends Controller
{
    public function AllBlogCategory()
    {

        $blogcategory = BlogCategory::latest()->get();
        return view('admin.blog_category.blog_category_all', compact('blogcategory'));
    } // End Method

    public function AddBlogCategory()
    {

        return view('admin.blog_category.blog_category_add');
    } // End Method

    public function StoreBlogCategory(Request $request)
    {
        $request->validate([
            'blog_category' => 'required',


        ], [

            'blog_category.required' => 'Blog Category Name is Required',
        ]);
        BlogCategory::insert([
            'blog_category' => $request->blog_category,
            'created_at' => Carbon::now(),

        ]);
        $notification = array(
            'message' => 'Blog Category Inserted Successfully',
            'alert-type' => 'success'
        );

        return redirect()->route('all.blog.category')->with($notification);
    } // End Method





}
