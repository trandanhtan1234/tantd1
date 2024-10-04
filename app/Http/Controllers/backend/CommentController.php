<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function getComment()
    {
        return view('backend.comment.comment');
    }

    public function editComment()
    {
        return view('backend.comment.editcomment');
    }
}
