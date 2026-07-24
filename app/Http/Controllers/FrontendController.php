<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function index()
    {
        $featuredProducts = Product::with('category')
            ->inRandomOrder()
            ->limit(8)
            ->get();

        $categories = Category::withCount('products')->get();

        $recentBlogs = Blog::latest()->limit(3)->get();

        return view('frontend.index', compact('featuredProducts', 'categories', 'recentBlogs'));
    }

    public function categoryShow($slug)
    {
        $category = Category::with(['products' => function ($q) {
            $q->orderBy('name');
        }])->where('slug', $slug)->firstOrFail();

        $otherCategories = Category::where('id', '!=', $category->id)->withCount('products')->get();

        return view('frontend.category', compact('category', 'otherCategories'));
    }

    public function productShow($slug)
    {
        $product = Product::with(['category', 'seoMeta'])->where('slug', $slug)->firstOrFail();

        $relatedProducts = Product::with('category')
            ->where('id', '!=', $product->id)
            ->where('category_id', $product->category_id)
            ->inRandomOrder()
            ->limit(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

    public function blogIndex()
    {
        $blogs = Blog::latest()->get();
        return view('frontend.blog_index', compact('blogs'));
    }

    public function blogShow($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();
        return view('frontend.blog_show', compact('blog'));
    }

    public function about()
    {
        return view('frontend.about');
    }

    public function contact()
    {
        return view('frontend.contact');
    }

    public function privacyPolicy()
    {
        return view('frontend.privacy_policy');
    }
}
