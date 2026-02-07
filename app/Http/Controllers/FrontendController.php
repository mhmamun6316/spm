<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Service;
use App\Models\HeroSlider;
use App\Models\HomeContent;
use App\Models\PageContent;
use App\Models\GlobalPartner;
use App\Models\SatisfiedClient;
use App\Models\Certification;
use App\Models\BoardMember;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function home()
    {
        // Get active hero sliders with title/subtitle
        $heroSliders = HeroSlider::where('is_active', 1)
            ->orderBy('sort_order')
            ->get();

        // Get active home contents sorted by sort_order
        $homeContents = HomeContent::where('is_active', 1)
            ->orderBy('sort_order', 'asc')
            ->get();

        // Get active categories with their active products
        $categories = ProductCategory::where('status', 1)
            ->with(['products' => function($query) {
                $query->where('status', 1);
            }])
            ->get();

        // Get active services
        $services = Service::where('is_active', 1)->get();

        // Get active Global Partners
        $globalPartners = GlobalPartner::where('is_active', 1)->get();

        // Get active Satisfied Clients
        $satisfiedClients = SatisfiedClient::where('is_active', 1)->get();

        // Get active Certifications
        $certifications = Certification::where('is_active', 1)->get();

        // Get page content (mission, values, footer info)
        $pageContent = PageContent::first();

        return view('frontend.home', compact('heroSliders', 'homeContents', 'categories', 'services', 'pageContent', 'globalPartners', 'satisfiedClients', 'certifications'));
    }

    public function sustainability()
    {
        return view('frontend.sustainability');
    }

    public function ethicalSourcing()
    {
        return view('frontend.ethical-sourcing');
    }

    public function manufacturingExcellence()
    {
        return view('frontend.manufacturing-excellence');
    }

    public function boardOfDirectors()
    {
        $members = BoardMember::where('is_active', 1)->orderBy('sort_order', 'asc')->get();
        return view('frontend.about.board_of_directors', compact('members'));
    }

    public function category($slug = null)
    {
        // Get all active categories for dropdown/navigation
        $categories = ProductCategory::where('status', 1)->get();

        // Find the requested category by slug (using name converted to slug)
        $currentCategory = null;
        $products = collect();

        if ($slug) {
            $currentCategory = ProductCategory::where('status', 1)
                ->whereRaw('LOWER(REPLACE(name, " ", "-")) = ?', [strtolower($slug)])
                ->first();

            if ($currentCategory) {
                $products = Product::where('product_category_id', $currentCategory->id)
                    ->where('status', 1)
                    ->get();
            }
        }

        return view('frontend.category', compact('categories', 'currentCategory', 'products', 'slug'));
    }


    public function service($slug)
    {
        $service = Service::where('slug', $slug)->where('is_active', 1)->firstOrFail();
        return view('frontend.service', compact('service'));
    }

    public function productDetail($slug)
    {
        // Get the product with its category
        $product = Product::with('category')
            ->where('slug', $slug)
            ->where('status', 'active')
            ->firstOrFail();

        // Get related products from the same category (excluding current product)
        $relatedProducts = Product::where('product_category_id', $product->product_category_id)
            ->where('id', '!=', $product->id)
            ->where('status', 'active')
            ->limit(4)
            ->get();

        return view('frontend.product', compact('product', 'relatedProducts'));
    }

}
