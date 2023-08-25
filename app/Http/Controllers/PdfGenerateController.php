<?php namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use DB;
use PDF;

class PdfGenerateController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function pdfview(Request $request)
    {
        $users = DB::table("users")->get();
        view()->share('users',$users);

        if($request->has('download')){
        	// Set extra option
        	PDF::setOptions(['dpi' => 150, 'defaultFont' => 'Arial']);
        	// pass view file
            $pdf = PDF::loadHtml('pdfview');
            // download pdf
            return $pdf->stream();
        }
        return view('pdfview');
    }
}