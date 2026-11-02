<?php

namespace App\Http\Controllers;
use App\Models\SubscriptionPackage;
use App\Models\Book;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $subscriptionPackages = SubscriptionPackage::latest()->limit(3)->get();
        $latestBooks = Book::latest()->limit(10)->get();
        $freeBooks = Book::where('price', 0)->latest()->limit(6)->get();
        return view('home', compact('subscriptionPackages', 'latestBooks', 'freeBooks'));
    }
}
