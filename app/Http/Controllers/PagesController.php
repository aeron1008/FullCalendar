<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function pravilaPrivatnosti()
    {
        return view('pages.pravila_privatnosti');
    }

    public function uvjetiKoristenja()
    {
        return view('pages.uvjeti_koristenja');
    }
}
