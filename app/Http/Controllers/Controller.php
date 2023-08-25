<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Auth;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function __construct(){
    	// $this->data['identitas'] = Identitas::first();
    	// $this->data['menu'] = Menu::where('aktif',1)->get();
    	// $this->data['sumberita'] = Berita::where('kategori',1)->count();
    	// $this->data['sumeven'] = Berita::where('kategori',2)->count();
    	// $this->data['summemo'] = Berita::where('kategori',3)->count();
    }
}
