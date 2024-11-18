<?php

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    // Menampilkan form kontak
    public function showForm()
    {
        return view('kontak');
    }

    // Menangani pengiriman form kontak
    public function submitForm(Request $request)
    {
        // Validasi data yang dikirimkan melalui form
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        // Kirim email dengan data yang di-submit
        Mail::to('admin@example.com')->send(new ContactMail($validated));

        // Kembalikan ke halaman kontak dengan pesan sukses
        return redirect()->route('kontak.form')->with('success', 'Pesan Anda telah dikirim!');
    }
}

// Route untuk menampilkan form kontak
Route::get('/kontak', 'ContactController@showForm')->name('kontak.form');

// Route untuk menangani pengiriman form kontak
Route::post('/kontak', 'ContactController@submitForm')->name('kontak.submit');

<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data; // Data yang akan dikirim dalam email

    public function __construct($data)
    {
        $this->data = $data; // Simpan data dari form kontak
    }

    public function build()
    {
        return $this->subject('Pesan Baru dari Kontak Website')
                    ->view('emails.contact');
    }
}


