<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

use Illuminate\Support\Facades\Auth;


use App\Models\Page;
use App\Models\Slider;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\GlobalSection;
use App\Models\ContactSubmission;
use App\Models\Newsletter;
use App\Models\SearchMeta;
use App\Models\Author;


class HomeController extends Controller
{
    public function index()
    {
        // $page = Page::where('slug', 'home')->first();
        // $sliders = Slider::active();
        // $featuredCategories = ProductCategory::active()->where('is_featured', true)->get(10);
        // $popularProducts = Product::active()->where('is_featured', true)->get(10);
        // $braceletProducts = Product::active()->where('is_featured', true)->get(10);
        // $newProducts = Product::active()->where('is_featured', true)->get(10);
        // $globalSection = GlobalSection::active()->where('page_id', 1)->get();
        // $customizeBracelet = Product::active()->where('id', 1)->get();

        // return view('frontend.home', compact('page', 'sliders'));


        return view('frontend.home');
        // return view('frontend.cart');
        // return view('frontend.checkout');
        // return view('frontend.contact');
        // return view('frontend.login');
        // return view('frontend.register');
        // return view('frontend.page');
        // return view('frontend.product-category');
        // return view('frontend.product-details');
        // return view('frontend.register');
        // return view('frontend.search');
        // return view('frontend.shop');
        // return view('frontend.sitemap');
    }

    public function page($slug)
    {
        $page = Page::where('slug', $slug)->first();

        if (!$page) {
            abort(404);
        }
        if ($page->slug == 'contact-us') {
            return view('frontend.contact', compact('page'));
        } else if ($page->slug == 'sitemap') {

            //$categories = Category::forDomain($domain->id)

            $categories = Category::with('children')->whereNull('parent_id')->orderBy('name')->get();

            $articles = Blog::active()->orderBy('title')->get();
            $pages = Page::with('children')->active()->whereNotIn('id', [1])->orderBy('title')->get();

            $sitemapData = [
                'pages' => $pages,
                'categories' => $categories,
                'articles' => $articles,
            ];

            return view('frontend.sitemap', compact('sitemapData', 'page'));
        }
        return view('frontend.page', compact('page'));
    }

    public function sitemapXML()
    {
        $domain = $this->domain;

        // Pages (with children)
        $pages = Page::active()
            ->whereNotIn('id', [1])
            // ->where('domain_id', $domain->id)
            ->with('children')
            ->orderBy('title')
            ->get();

        // Categories (with multi-level children)
        $categories = Category::active()
            ->with('children.children')
            // ->where('domain_id', $domain->id)
            ->whereNull('parent_id')
            ->orderBy('name')
            ->get();

        // Articles
        $articles = Article::active()
            //->where('domain_id', $domain->id)
            ->orderBy('title')
            ->get();

        $xml = $this->generateXml($pages, $categories, $articles);

        return response($xml, 200)
            ->header('Content-Type', 'application/xml');
    }

    private function generateXml($pages, $categories, $articles)
    {
        $xml = '<?xml version="1.0" encoding="UTF-8"?>';
        $xml .= '<urlset 
                xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
                xmlns:xhtml="http://www.w3.org/1999/xhtml">';

        // ==========================
        // PAGES + CHILDREN
        // ==========================
        foreach ($pages as $page) {
            $xml .= $this->urlTag(
                route('page', $page->slug),
                $page->updated_at,
                'monthly',
                '0.7'
            );

            if ($page->children) {
                foreach ($page->children as $child) {
                    $xml .= $this->urlTag(
                        route('page', $child->slug),
                        $child->updated_at,
                        'monthly',
                        '0.6'
                    );
                }
            }
        }

        // ==========================
        // CATEGORIES + CHILDREN + SUB-CHILDREN
        // ==========================
        foreach ($categories as $category) {
            $xml .= $this->urlTag(
                route('category', $category->full_slug ?? $category->slug),
                $category->updated_at,
                'weekly',
                '0.6'
            );

            foreach ($category->children ?? [] as $child) {
                $xml .= $this->urlTag(
                    route('category', $child->full_slug ?? $child->slug),
                    $child->updated_at,
                    'weekly',
                    '0.55'
                );

                foreach ($child->children ?? [] as $sub) {
                    $xml .= $this->urlTag(
                        route('category', $sub->full_slug ?? $sub->slug),
                        $sub->updated_at,
                        'weekly',
                        '0.50'
                    );
                }
            }
        }

        // ==========================
        // ARTICLES
        // ==========================
        foreach ($articles as $article) {
            $xml .= $this->urlTag(
                route('article', $article->slug),
                $article->updated_at,
                'daily',
                '0.8'
            );
        }

        $xml .= '</urlset>';

        return $xml;
    }
    private function urlTag($loc, $lastmod, $freq, $priority)
    {
        return "
        <url>
            <loc>{$loc}</loc>
            " . ($lastmod ? "<lastmod>{$lastmod->toAtomString()}</lastmod>" : "") . "
            <changefreq>{$freq}</changefreq>
            <priority>{$priority}</priority>
        </url>
    ";
    }


    // public function contactFormSubmit(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'name' => 'required',
    //         'phone' => 'required',
    //         'email' => 'required|email:rfc,dns',
    //         // 'subject' => 'required',
    //         'message' => 'required|min:5',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }

    //     try {
    //         ContactSubmission::create($request->only('name', 'phone', 'email', 'message'));
    //         Mail::send('emails.contact', ['request' => $request], function ($mail) use ($request) {
    //             $mail->to('yashvir.pal@kalkine.co.in')
    //                 ->subject('New Contact Message: ' . $request->subject)
    //                 ->replyTo($request->email);
    //         });
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Thanks for reaching out! We’ll get back to you soon.',
    //             'redirect_url' => route('page', 'thank-you'),
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }

    // public function newsletterSubscribe(Request $request)
    // {
    //     $validator = \Validator::make($request->all(), [
    //         'email' => 'required|email:rfc,dns|unique:newsletters,email',
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json([
    //             'status' => false,
    //             'errors' => $validator->errors()
    //         ], 422);
    //     }
    //     try {
    //         Newsletter::create($request->only('email'));
    //         // Send confirmation email
    //         Mail::send('emails.newsletter', ['email' => $request->email], function ($mail) use ($request) {
    //             $mail->to($request->email)
    //                 ->subject('Thanks for Subscribing to Our Newsletter');
    //         });

    //         // Send email to admin
    //         // Mail::send('emails.newsletter_admin', [
    //         //     'email' => $request->email
    //         // ], function ($mail) {
    //         //     $mail->to('admin@example.com')
    //         //         ->subject('New Newsletter Subscriber');
    //         // });
    //         return response()->json([
    //             'status' => true,
    //             'message' => 'Subscription successful! You’ll start receiving updates soon.'
    //         ]);
    //     } catch (\Exception $e) {
    //         return response()->json([
    //             'status' => false,
    //             'message' => $e->getMessage()
    //         ], 500);
    //     }
    // }
}
