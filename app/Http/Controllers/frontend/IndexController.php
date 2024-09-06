<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Products\ProductsRepositoryInterface;

class IndexController extends Controller
{
    protected $productRepo;

    public function __construct(
        ProductsRepositoryInterface $productRepo
    ) {
        $this->productRepo = $productRepo;
    }

    public function getIndex()
    {
        $data['featured'] = $this->productRepo->getFeatured();
        $data['list'] = $this->productRepo->getListNew();
        $data['now'] = \Carbon\Carbon::now();

        return view('frontend.index', $data);
    }

    public function getAboutUs()
    {
        return view('frontend.about');
    }

    public function getContact()
    {
        return view('frontend.contact');
    }

    public function map()
    {
        return view('frontend.map');
    }
}
