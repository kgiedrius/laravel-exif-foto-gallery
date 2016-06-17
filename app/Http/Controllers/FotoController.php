<?php

namespace App\Http\Controllers;

use App\Image;
use Illuminate\Http\Request;

use App\Http\Requests;

class FotoController extends Controller
{
    public function index( Image $photo )
    {
        $photosList = $photo->getPhotosList();
        return view( 'foto_index', compact( 'photosList' ) );
    }
}
