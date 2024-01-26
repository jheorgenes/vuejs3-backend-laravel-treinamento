<?php

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/user', function(Request $request) {
    $request->validate([
        'firstName' => 'required',
        'lastName' => 'required',
        'email' => 'required|unique:users',
        'password' => 'required'
    ], [
        'firstName.required' => 'O campo nome é obrigatório',
        'email.unique' => 'O email já está cadastrado',
        'lastName.required' => 'O campo do sobrenome é obrigatório',
        'password.required' => 'O campo senha é obrigatório',
    ]);
});


Route::get('/users', function() {
    // return User::all();
    return User::paginate(10);
});

Route::get('/users/search', function(Request $request) {
    $user = $request->input('user');
    return User::where('firstName', 'like', '%'.$user.'%')->get();
});

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
