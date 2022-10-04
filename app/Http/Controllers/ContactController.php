<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;
use App\Mail\ContactMail;
use App\Mail\MessageMail;
use Mail;

class ContactController extends Controller
{
    
    public function index()
    {
        $messages = Contact::all();

        return response()->json([
            'messages' => $messages
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'name' => 'required',
            'subject' => 'required',
            'message' => 'required'
        ]);

        Contact::create([
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ]);

        $data = [
            'subject' => $request->subject,
            'body' => 'Thank you for contacting me. I will be in touch shortly.'
        ];
         
        Mail::to($request->email)->send(new ContactMail($data));
           
        return response()->json('success', 201);
    }

    public function show(Contact $contact, $id)
    {
        $contact = Contact::where('id', $id)->first();

        return response()->json([
            'contact' => $contact
        ], 200);
    }

    public function replyMessage(Request $request, $id)
    {
        $data = [
            'subject' => $request->subject,
            'message' => $request->message,
        ];
         
        Mail::to($request->email)->send(new MessageMail($data));
           
        return response()->json('success', 201);
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy(Contact $contact, $id)
    {
        $contact = Contact::find($id, 'id');
        // return $contact;
        $contact->delete();

        return response()->json('Contact deleted', 200);
    }
}
