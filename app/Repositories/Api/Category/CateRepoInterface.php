<?php

namespace App\Repositories\Api\Category;

interface CateRepoInterface
{
    public function index($data);

    public function show($id);

    public function destroy($id);
}