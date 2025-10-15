<?php

use Illuminate\Support\Facades\Route;
use App\Models\Cgy;
use App\Http\Controllers\PermissionController;

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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

// Route::get('/cancheck',function(){
//     //先確認是否有登入
//     if(Auth::check()){
//         $user = Auth::user();
//         $cgy = Cgy::first();
//         //確認是否具有該權限
//         if($user->can("browse", $cgy)){
//             return "可以存取";
//         }else{
//             return "權限不足";
//         }
//     }else{
//         return '尚未登入';
//     }
// });

Route::get('/cancheck', [PermissionController::class, 'checkPermission'])->name('permission.check');

Route::get('/sources', function(){
    $sources = json_decode(setting('contant.surces'), true);
    return $sources;
    //return response()->json($sources, 200, [], JSON_UNESCAPED_UNICODE);
    //return response()->json($sources)->setEncodingOptions(JSON_UNESCAPED_UNICODE);
});
