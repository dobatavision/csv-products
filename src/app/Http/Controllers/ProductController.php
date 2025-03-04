<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\User;

class ProductController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('welcome', compact('users'));
    }

    public function showUserProducts($userId)
    {
        $users = User::all();
        $products = Product::where('user_id', $userId)->paginate(10);

        return view('welcome', compact('users', 'products', 'userId'));
    }
}
