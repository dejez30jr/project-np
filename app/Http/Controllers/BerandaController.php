<?php

namespace App\Http\Controllers;

use App\Models\Portfolio;
use App\Support\MathCaptcha;
use App\Support\PortfolioCategories;

class BerandaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $captcha = MathCaptcha::generate();

        return view('page.beranda', [
            'ports' => Portfolio::latest()->get(),
            'captchaToken' => $captcha['token'],
            'captchaQuestion' => $captcha['question'],
        ]);
    }

    /**
     * Halaman detail portfolio + filter kategori (server-side, paginated).
     */
    public function show(Portfolio $portfolio)
    {
        $categories = PortfolioCategories::all();

        $kategori = request()->query('kategori', 'all');

        if ($kategori !== 'all' && isset($categories[$kategori])) {
            $query = Portfolio::where('category', $kategori);
        } else {
            $kategori = 'all';
            $query = Portfolio::query();
        }

        $items = $query->latest()->paginate(6)->withQueryString();

        return view('page.portfolio-detail', [
            'portfolio' => $portfolio,
            'items' => $items,
            'categories' => $categories,
            'kategori' => $kategori,
        ]);
    }
}
