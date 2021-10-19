<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ParticipantController;
use App\Models\Participant;

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

Route::get('/', function () {
    return view('participant');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');


Route::get('participants', ParticipantController::class)->name('participant');
require __DIR__.'/auth.php';

Route::get('/download/{id}/{type}', function ($id, $type) {
    $data = Participant::find($id);

        switch ($type) {
            case 'certificate':
                $pdf = \PDF::loadView('pdf.certificate', ['data' => $data]);
                return $pdf->setPaper('a4', 'landscape')->download('certificate-' . \Str::slug($data->full_name) . '.pdf');
                
                break;
                
            case 'nametag':
                $pdf = \PDF::loadView('pdf.nametag', ['data' => $data]);
                return $pdf->setPaper('a4', 'landscape')->download('nametag-' . \Str::slug($data->full_name) . '.pdf');
                
                break;
            
            default:
                return;
                break;
        }

    return $pdf->download('nametag-' . $data->full_name . '.pdf');
})->name('print');