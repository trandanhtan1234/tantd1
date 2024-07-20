<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class VariantController extends Controller
{
    public function getAddVariant()
    {
        return view('backend.variant.addvariant');
    }

    public function getEditVariant()
    {
        return view('backend.variant.editvariant');
    }
}
