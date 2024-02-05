<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DonorController;

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});



Route::get('/r/{code}', function ($code) {

    $user = \App\Models\User::where('referral_code', $code)->first();
    if ($user) {
        Session::put('refferal_code', $code);

        return redirect()->route('register');
    } else {
        abort(404);
    }

})->name('web.refer');

Route::get('/dashboard', function () {




    if(auth()->user()->referral_code == null)
    {
        $user = auth()->user();



        $referral_code = null;
        do {

            $letters = Str::random(3);
            $numbers = mt_rand(100, 999);
            $mixedString = str_shuffle($letters . $numbers . Str::random(1));

            $referral_code = $mixedString;
        } while (\App\Models\User::where("referral_code", "=", $referral_code)->first());

         $user->referral_code = $referral_code;
         $user->save();


    }
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {



    Route::get('/verify-mobile', [ProfileController::class, 'mobileVerify'])->name('mobile.verify');
    Route::post('/verify-mobile', [ProfileController::class, 'doMobileVerify'])->name('mobile.do-verify');

    Route::get('/add-donor', [DonorController::class, 'add'])->name('donors.add');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
