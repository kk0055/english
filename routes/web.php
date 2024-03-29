<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\WordController;
use App\Http\Controllers\UserItemController;
use App\Http\Controllers\WebsiteController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\WordPostController;
use App\Http\Controllers\Auth\LoginController;

use Illuminate\Support\Facades\Auth;

Auth::routes();



Route::resource('/', LanguageController::class)->except('edit','update');

Route::get('/japanese', [LanguageController::class,'JapaneseToEnglish'])->name('japanese');

Route::get('/website', [WebsiteController::class,'index'])->name('website');
Route::get('/about', [WebsiteController::class,'about'])->name('about');
Route::get('/search', [SearchController::class, 'search'])->name('item.search');

// Route::get('/login/google', [LoginController::class, 'redirectToGoogle'])->name('twitter.login');
Route::get('login/google/callback', [LoginController::class, 'handleGoogleCallback'])->name('');
Route::get('/login/{provider}', [LoginController::class, 'redirectToProvider'])->name('twitter.login');
Route::get('login/{provider}/callback', [LoginController::class, 'handleProviderCallback'])->name('');



//Middleware AUTH 
Route::group(['middleware' => ['auth']], function () {

Route::get('/edit/{id}', [LanguageController::class,'edit'])->name('edit');
Route::put('/edit/{id}', [LanguageController::class,'update'])->name('update');

Route::post('/favorite/{language}', [LanguageController::class,'favoritePost']);
Route::post('/unfavorite/{language}', [LanguageController::class,'unfavoritePost']);
Route::get('/my_favorites', [LanguageController::class,'myFavorites'])->name('my_favorites');

Route::get('/mypost/{user:name}', [UserItemController::class,'index'])->name('user.post');


  });



  //Middleware admin
Route::group(['middleware' => ['auth.admin']], function () {

  Route::get('/admin/show', [AdminController::class, 'show'])->name('admin.show');
  Route::get('/admin/index', [AdminController::class, 'index'])->name('admin.index');
  Route::post('/admin/logout', [AdminController::class, 'logout']);
  Route::get('/admin/user_list', [AdminController::class, 'showUserList'])->name('admin.showUserList');
  Route::get('/admin/user/{id}', [AdminController::class, 'showUserDetail'])->name('admin.showUserDetail');
  Route::get('/admin/edit/{id}', [AdminController::class, 'edit'])->name('admin.edit');
  Route::put('/admin/edit/{id}', [AdminController::class, 'update'])->name('admin.update');
  Route::get('/admin/search', [AdminController::class, 'adminSearch'])->name('admin.search');

  //wordの管理
  Route::get('/admin/words/create', [WordController::class,'adminWordsCreate'])->name('japaneseWord.create');
  Route::post('/ja-words/create', [WordController::class,'japaneseStore'])->name('japaneseWord.store');
  Route::post('/en-words/create', [WordController::class,'englishStore'])->name('englishWord.store');
  Route::delete('/en-words/{word}/delete', [WordController::class,'enWordsDestroy'])->name('englishWord.destroy');
  Route::delete('/ja-words/{word}/delete', [WordController::class,'jaWordsDestroy'])->name('japaneseWord.destroy');
  Route::get('admin/words-post', [WordPostController::class,'adminWordsPost'])->name('admin.wordsPost');
  Route::delete('admin/en-words/post/{post}/delete', [WordPostController::class,'EnglishWordPostDelete'])->name('EnglishWordPostDelete');
  Route::delete('admin/ja-words/post/{post}/delete', [WordPostController::class,'JapaneseWordPostDelete'])->name('JapaneseWordPostDelete');
  });

  Route::get('/admin/login', [AdminController::class, 'showLoginform'])->name('showAdminLogin');
  Route::post('/admin/login', [AdminController::class, 'login']);


 //englishWord
  Route::get('/en-words/gacha', [WordController::class,'englishWord'])->name('englishWord');
  Route::get('/en-words', [WordController::class,'getEnglishWord'])->name('getEnglishWord');
  //japanseword
  Route::get('/ja-words/gacha', [WordController::class,'japanesehWord'])->name('japaneseWord');
  Route::get('/ja-words', [WordController::class,'getJapaneseWord'])->name('getJapaneseWord');

   //englishWordPost
  Route::get('/en-words/post', [WordPostController::class,'EngliahWordPostIndex'])->name('EngliahWordPostIndex');
  Route::post('/en-words/post/create', [WordPostController::class,'EngliahWordPostStore'])->name('EngliahWordPostStore');
  // Route::delete('/en-words/post/{id}', [WordPostController::class,'EngliahWordPostDelete'])->name('EngliahWordPostDelete');

  //japansewordPost
  Route::get('/ja-words/post', [WordPostController::class,'JapaneseWordPostIndex'])->name('JapaneseWordPostIndex');
  Route::post('/ja-words/post/create', [WordPostController::class,'JapaneseWordPostStore'])->name('JapaneseWordPostStore');
  // Route::delete('/ja-words/post/{id}', [WordPostController::class,'JapaneseWordPostDelete'])->name('JapaneseWordPostDelete');

