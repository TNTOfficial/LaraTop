<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Contact;
use Illuminate\Http\Request;

class ContactUsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $emails = Contact::all();
        return view('dashboard/contactUs/index', ['emails' => $emails]);
    }


    /**
     * Display the specified resource.
     */
    public function showEmail($emailId)
    {
        $email = Contact::findOrFail($emailId);

        return view('dashboard/contactUs/show', ['email' => $email]);
    }

    public function markAsRead($id)
    {
        $email = Contact::findOrFail($id);
        $email->mark_as_read = $email->mark_as_read ? true : false;
        $email->save();
        return response()->json(['result' =>  $email->mark_as_read]);
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $email = Contact::find($id);
        if ($email) {
            $email->delete();
            return redirect()->route('emails.index');
        }
    }
}
