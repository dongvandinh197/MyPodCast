<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Music;

class HomeController extends Controller
{

    protected $music_model;


    public function __construct(Music $music_model)
    {
        $this->music_model = $music_model;
    }

    public function index(Request $request)
    {
//        $file=  'files/nuoc_mat_lau_bang_tinh_yeu_moi.mp3';
//        =[
//            'Accept-Ranges' => "bytes",
//            'Accept-Encoding' => "gzip, deflate",
//            'Pragma' => 'public',
//            'Expires' => '0',
//            'Cache-Control' => 'must-revalidate',
//            'Content-Transfer-Encoding' => 'binary',
//            'Content-Type' => "audio/mpeg",
//            'Connection' => "Keep-Alive",
//            'X-Pad' => 'avoid browser bug',
//        ];
//        return response()->view('frontEnd.layouts.master',compact('file'))->header("Accept-Ranges", "bytes");

        $data = $this->music_model->get_ready($request);

    }


}
