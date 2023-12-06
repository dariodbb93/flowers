<?php

namespace App\Http\Controllers;

use App\Models\Upload;
use Illuminate\Http\Request;


class PublicController extends Controller
{

    public function salvaArticolo(Request $request)
    {
        $titolo = $request->input('titolo');
        $autore = $request->input('autore');
        $descrizione = $request->input('descrizione');

        if ($request->hasFile('img')) {
            $img = $request->file('img')->getClientOriginalName();
            $request->file('img')->move(public_path('uploadsImg'), $img);
        } else {
            // Se non è stato caricato un file, assegna un valore predefinito o lascia vuoto
            $img = ''; // o puoi assegnare un valore di default


        }



        $pianta = Upload::create([
            'titolo' => $titolo,
            'autore' => $autore,
            'descrizione' => $descrizione,
            'img' => $img

        ]);

        return redirect(route('index'));
    }

    public function index()
    {
        $uploads = Upload::all();
        return view('index', compact('uploads'));
    }



    public function pubblica()
    {
        return view('pubblica');
    }



    public function destroy(Upload $upload)
    {
        $upload->delete();

        return redirect(route('index'));
    }


}
