<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBundlePost;
use App\Models\Bundle;
use App\Http\CustomResponse;

class BundleController extends Controller
{
    public function index()
    {
        $bundle = Bundle::all();
        return CustomResponse::json(CustomResponse::$STATUS_OK, $bundle);
    }

    public function store(StoreBundlePost $request)
    {
        $bundle = Bundle::create($request->validated());
        return CustomResponse::json(CustomResponse::$STATUS_OK, $bundle);
    }
}
