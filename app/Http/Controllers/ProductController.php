<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display catalog with search, category filtering, and sorting.
     */
    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        // Search by title or short_description
        if ($request->filled('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('short_description', 'like', "%{$search}%");
            });
        }

        // Filter by category slug or ID
        if ($request->filled('category')) {
            $categoryParam = $request->input('category');
            
            $query->whereHas('category', function ($q) use ($categoryParam) {
                if (is_numeric($categoryParam)) {
                    $q->where('id', $categoryParam);
                } else {
                    $q->where('slug', $categoryParam);
                }
            });
        }

        $products = $query->latest()->paginate(12)->withQueryString();
        $categories = Category::withCount('products')->get();

        return view('products.index', compact('products', 'categories'));
    }

    /**
     * Display a single product detail page using route model binding with slug.
     */
    public function show(Product $product)
    {
        $product->load('category');
        return $this->showWithRelatedProducts($product);
    }

    /**
     * Show related products sharing the same category.
     */
    protected function showWithRelatedProducts(Product $product)
    {
        $relatedProducts = Product::where('id', '!=', $product->id)
            ->when($product->category_id, function ($q) use ($product) {
                $q->where('category_id', $product->category_id);
            })
            ->with('category')
            ->latest()
            ->take(4)
            ->get();

        return view('products.show', compact('product', 'relatedProducts'));
    }
}