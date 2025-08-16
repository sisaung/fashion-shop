<?php

namespace App\Http\Controllers;

use App\Mail\InvoiceMail;
use App\Mail\TestMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class TestController extends Controller
{

    public function index()
    {

        $name = 'Aguagan';

         Mail::to('sisaungvipse780@gmail.com')->send(new TestMail($name));
         return 'Email sent';
    }
}

