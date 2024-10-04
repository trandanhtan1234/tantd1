<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\Index\IndexRepositoryInterface;

class IndexController extends Controller
{
    protected $indexRepo;

    public function __construct(
        IndexRepositoryInterface $indexRepo
    ) {
        $this->indexRepo = $indexRepo;
    }

    public function index()
    {
        $data = $this->indexRepo->index();
        
        return view('backend.index', $data);
    }
}
