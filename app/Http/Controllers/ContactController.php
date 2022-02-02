<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contact;

class ContactController extends Controller
{
    public function create($contact){
        $contact['user_id'] = auth()->user()->id;
        return Contact::create($contact);
    }
}
