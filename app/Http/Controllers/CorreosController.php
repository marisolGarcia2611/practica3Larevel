<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\Email\direct;

class CorreosController extends Controller
{
    public function mandarCorreos()
    {
        $correo=Mail::to('19170157@utt.edu.mx')->send(new direct());
        return response()->json(["Correo"=>$correo],200);
    }
}//marisol.garciaa.101@gmail.com
