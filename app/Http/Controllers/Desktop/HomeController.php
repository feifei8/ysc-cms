<?php

namespace App\Http\Controllers\Desktop;

use Illuminate\Http\Request;

use Crypt;
use Auth;
use App\Jobs\ChangeLocale;
use Douyasi\Models\Product;
use Douyasi\Models\Category;

class HomeController extends FrontController
{

    /**
     * 博客首页
     */
    public function getIndex()
    {
        $products = Product::orderBy('created_at', 'desc')->simplePaginate(3);
        return view('desktop.index', compact('products'));
    }

    /**
     * 博客文章
     */
    public function getArticle($cslug, $slug)
    {
        $category = Category::where('slug', '=', $cslug)->first();
        if ($category) {
            $article = Article::where('cid', '=', $category->id)
                            ->where('slug', '=', $slug)
                            ->first();
            if ($article) {
                return view('desktop.detail', compact('article', 'category'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }
    /**
     * 产品明细
     */
    public function getProduct($cslug, $id)
    {
        $category = Category::where('slug', '=', $cslug)->first();
        if ($category) {
            $product = Product::where('cid', '=', $category->id)
                            ->where('id', '=', $id)
                            ->first();
            if ($product) {
                return view('desktop.detail', compact('product', 'category'));
            } else {
                return abort(404);
            }
        } else {
            return abort(404);
        }
    }

    /**
     * 博客分类
     */
    public function getCategory($slug)
    {
        $category = Category::where('slug', '=', $slug)->first();
        if ($category) {
            $query = Product::where('cid', '=', $category->id)
                            ->orderBy('created_at', 'desc');
            $count = $query->count();
            $products = $query->simplePaginate(6);
            return view('desktop.category', compact('products', 'category', 'count'));
        } else {
            return abort(404);
        }
    }

    /**
     * YASCMF landing page
     */
    public function getLandingPage()
    {
        return view('desktop.landing-page');
    }

    /**
     * Change Language
     */
    public function getLang(ChangeLocale $changeLocale)
    {
        $this->dispatch($changeLocale);

        return redirect()->back();
    }

}
