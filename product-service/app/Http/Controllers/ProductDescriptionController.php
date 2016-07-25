<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Description;

use App\Http\Requests;

class ProductDescriptionController extends Controller
{
    public function index($productId)
    {
        return Description::ofProduct($productId)->get();
    }

    public function store(Request $request)
    {
        
    }
}
