<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Mail\ContactMessageMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Request as FacadesRequest;

class ContactController extends Controller
{
    public function message(Request $request)
    {
        $data = $request->all();
        $mail = new ContactMessageMail(sender: $data['sender'], subject: $data['subject'], content: $data['content']);
        Mail::to(env('MAIL_TO_ADDRESS'))->send($mail);
        return response(null, 204);
    }
}
