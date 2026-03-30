<?php

use App\Livewire\Ads\PersonalAdManager;
use App\Livewire\Ads\SlotForm;
use App\Livewire\Ads\SlotIndex;
use App\Livewire\Ads\AdSenseManager;
use App\Livewire\Category\Create as cartegoryCreate;
use App\Livewire\Category\Edit as categoryEdit;
use App\Livewire\Category\Index as cartegoryIndex;
use App\Livewire\Permission\PermissionList;
use App\Livewire\Post\Create as postCreate;
use App\Livewire\Post\Edit as postEdit;
use App\Livewire\Post\Index as postIndex;
use App\Livewire\Permission\RoleList;
use App\Livewire\User\Index as userIndex;
use App\Livewire\Permission\UserRoleManager;
use App\Livewire\Poll\Create as createPoll;
use App\Livewire\Poll\Index as indexPoll;
use App\Livewire\Post\Published as postPublished;
use App\Livewire\Website\Index as websiteIndex;
use App\Livewire\Website\Logos as websiteLogos;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'redirect.if.no.permission:admin.panel'])->group(function () {
    Route::get('/admin/', function () {
        return view('dashboard');
    })->name('admin.dashboard');
    
    
    
    Route::group(['middleware' => ['redirect.if.no.permission:categories.edit']], function () {
        Route::get('/admin/categories/', cartegoryIndex::class)->name('categories.index');
        Route::get('/admin/categories/create', cartegoryCreate::class)->name('categories.create');
        Route::get('/admin/categories/{id}/edit', categoryEdit::class)->name('categories.edit');
    });

    Route::group(['middleware' => ['redirect.if.no.permission:post.maintenance|post.create|post.published']], function () {
        Route::get('admin/posts/', PostIndex::class)->name('posts.index')->middleware('permission:post.maintenance');
        Route::get('admin/posts/published', postPublished::class)->name('posts.published')->middleware('permission:post.maintenance|post.published');
        Route::get('admin/posts/create', PostCreate::class)->name('posts.create'); 
        Route::get('admin/posts/{id}/edit', PostEdit::class)->name('posts.edit')->middleware('permission:post.maintenance');
    });

    Route::group(['middleware' => ['redirect.if.no.permission:website.maintenance']], function () {
        Route::get('/admin/website', websiteIndex::class)->name('website.index');
        Route::get('/admin/website/logo', websiteLogos::class)->name('website.logos');
    });

    Route::group(['middleware' => ['redirect.if.no.permission:user.edit']], function () {
        Route::get('/admin/users', userIndex::class)->name('users.index');
    });
    
    // Permission Management Routes
    Route::group(['middleware' => ['redirect.if.no.permission:user.permission']], function () {
        Route::get('/admin/permissions/', PermissionList::class)->name('permissions.index');
        Route::get('/admin/permissions/roles', RoleList::class)->name('permissions.roles.index');
        Route::get('/admin/permissions/user-roles', UserRoleManager::class)->name('permissions.user-roles.index');
    });
    
    Route::group(['middleware' => ['redirect.if.no.permission:post.maintenance|polls.edit|polls.create']], function () {
        Route::get('/admin/polls/create', createPoll::class)->name('posts.polls.create');
        Route::get('/admin/polls', indexPoll::class)->name('posts.polls.index')->middleware('permission:polls.edit');
    });

    Route::group(['middleware' => ['redirect.if.no.permission:ads']], function () {    
        Route::get('admin/ads/slots', SlotIndex::class)->name('admin.ads.slots.index');
        Route::get('admin/ads/slots/create', SlotForm::class)->name('admin.ads.slots.create');
        Route::get('admin/ads/slots/{adSlot}/edit', SlotForm::class)->name('admin.ads.slots.edit');
        Route::get('admin/ads/slots/{adSlot}/personal-ads', PersonalAdManager::class)->name('admin.ads.slots.personal-ads');
        Route::get('/admin/ads/settings', AdSenseManager::class)->name('admin.ads.settings');
    });
        
});