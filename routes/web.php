<?php

use App\Models\Employee;
use App\Models\Religion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ReligionController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/registeruser', [RegisterController::class, 'registeruser'])->name('registeruser');
Route::get('/login', [LoginController::class, 'login'])->name('login');
Route::post('/loginproses', [LoginController::class, 'loginproses'])->name('loginproses');
Route::get('/logout', [LoginController::class, 'logout'])->name('logout');

Route::group(['middleware' => ['auth', 'hakakses:admin,user']], function () {
    Route::get('/', function () {
        $jumlahpegawai = Employee::count();
        $jumlahpegawailaki = Employee::where('jeniskelamin', 'Laki-Laki')->count();
        $jumlahpegawaiperempuan = Employee::where('jeniskelamin', 'perempuan')->count();
        return view('welcome', compact('jumlahpegawai', 'jumlahpegawailaki', 'jumlahpegawaiperempuan'));
    });
    Route::get('/pegawai', [EmployeeController::class, 'index'])->name('pegawai');
    Route::get('/tambahpegawai', [EmployeeController::class, 'tambahpegawai'])->name('tambahpegawai');
    Route::post('/insertdata', [EmployeeController::class, 'insertdata'])->name('insertdata');
    Route::get('/tampildata/{id}', [EmployeeController::class, 'tampildata'])->name('tampildata');
    Route::post('/updatedata/{id}', [EmployeeController::class, 'updatedata'])->name('updatedata');
    Route::get('/delete/{id}', [EmployeeController::class, 'delete'])->name('delete');

    Route::get('/religion', [ReligionController::class, 'index'])->name('religion');
    Route::get('/tambahagama', [ReligionController::class, 'tambahagama'])->name('tambahagama');
    Route::post('/insertagama', [ReligionController::class, 'insertagama'])->name('insertagama');
    Route::get('/tampilagama/{id}', [ReligionController::class, 'tampilagama'])->name('tampilagama');
    Route::post('/updateagama/{id}', [ReligionController::class, 'updateagama'])->name('updateagama');
    Route::get('/deleteagama/{id}', [ReligionController::class, 'deleteagama'])->name('deleteagama');


    Route::get('/exportpdf', [EmployeeController::class, 'exportpdf'])->name('exportpdf');
    Route::get('/exportexcel', [EmployeeController::class, 'exportexcel'])->name('exportexcel');
    Route::post('/importexcel', [EmployeeController::class, 'importexcel'])->name('importexcel');
});
