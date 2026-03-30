<?php

use App\Livewire\Frontend\Home;
use App\Livewire\Frontend\PageDetails;
use App\Livewire\Frontend\PostCategory;
use App\Livewire\Frontend\PostList;
use App\Livewire\Frontend\PostView;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;


Route::middleware('log_visitor')->group(function () {

    Route::get('/', Home::class)->name('home');

    // Route::get('/', function () {
    //     return view('home');
    // })->name('home');

    Route::get('post/{slug}', PostView::class)->name('post.view');
    Route::get('search/{searchQuery}', PostList::class)->name('search.post');
    Route::get('search/category/{searchQuery}', PostCategory::class)->name('search.category');

    Route::get('/about-us', PageDetails::class)->name('page.about');
    Route::get('/privacy-policy', PageDetails::class)->name('page.privacy');
    Route::get('/contact-us', PageDetails::class)->name('page.contact');
    Route::get('/terms-and-conditions', PageDetails::class)->name('page.terms');
    

});
// RouteGroup