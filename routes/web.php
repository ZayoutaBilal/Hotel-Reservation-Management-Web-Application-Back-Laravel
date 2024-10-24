<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Models\Message;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*//*Route::post('/',function(){
    return view('welcome.blade.php');});
Route::post('/api/contact', function (Request $request) {
    // Validate the request data
    $validatedData = $request->validate([
        'name' => 'required',
        'email' => 'required|email',
        'subject' =>'required',
        'message' => 'required',
    ]);

    // Create a new message in the database
    $message = new Message;
    $message->name = $validatedData['name'];
    $message->email = $validatedData['email'];
    $message->subject = $validatedData['subject'];
    $message->message = $validatedData['message'];
    $message->save();

    // Send an email
    Mail::send('emails.contact', [
        'name' => $validatedData['name'],
        'email' => $validatedData['email'],
        'subject' => $validatedData['subject'],
        'message' => $validatedData['message']
    ], function ($message) {
        $message->to('meiszay@gmail.com', 'Contact Form')->subject('New Contact Form Submission');
    });

    // Return a success response
    return response()->json(['success' => true]);
});*/
// Route::get('/contact', 'App\Http\Controllers\Contactcontroller@con')->name("con");




// Route::group(['middleware' => ['web']], function () {
//     // your routes here
// });