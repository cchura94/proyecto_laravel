<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Documento;
use Illuminate\Support\Facades\Auth;

class DocumentoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lista_docs = Documento::get(); // select * from documentos
        return view("admin.documento.lista", compact('lista_docs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("admin.documento.nuevo");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validar  
        $request->validate([
            "titulo" => "required|max:150|min:3",
            "archivo" => "required"
        ]);

        // subir documento
        $nom_archivo = "";
        if($file = $request->file("archivo")){
            // nombre original del archivo
            $nom_archivo = $file->getClientOriginalName();
            $file->move("archivo", $nom_archivo);
            $nom_archivo = "archivo/" . $nom_archivo;            
        }
        // return $request;
        $documento = new Documento;
        $documento->titulo = $request->titulo;
        $documento->fecha = $request->fecha;
        $documento->tipo = $request->tipo;    
        $documento->descripcion = $request->descripcion;    
        $documento->archivo = $nom_archivo;
        $documento->user_id = Auth::user()->id; 
        $documento->save();
        
        return redirect("/documento");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
