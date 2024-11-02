<?php

namespace App\Http\Controllers;
//
use Illuminate\Http\Request;
use App\Models\Chat_Documento;
use Illuminate\Support\Facades\Validator;


class ChatDocumentoController extends Controller
{
    public function index(Request $request)
    {
        $id_documentos= $request->input('id_documentos');
        $id_chats=$request->input('id_chats');
        $fecha_envio=$request->input('id_chats');

        $query= Chat_Documento::query();
        if($id_documentos){
            $query->where('id_documentos',$id_documentos);
        }
        if($id_chats){
            $query->where('id_chats',$id_chats);
        }
        if($fecha_envio){
            $query->whereDate('fecha_envio',$fecha_envio);
        }

        $chat_documentos = $query->get();
        return view('chat_documentos.index', compact('chat_documentos'));

    }

    public function create()
    {
        return view('chat_documentos.create');
    }

    public function store(Request $request)
    {
        $v = Validator::make($request->all(), [
            'id_documentos' => 'required|exists:documentos,id',
            'id_chats' => 'required|exists:chats,id',
            'fecha_envio' => 'required|date',
        ]);

        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }

        $chat_documento = new Chat_Documento();
        $chat_documento->id_documentos = $request->id_documentos;
        $chat_documento->id_chats = $request->id_chats;
        $chat_documento->fecha_envio = $request->fecha_envio;
        $chat_documento->save();
        return redirect()->route('chat_documentos.index');
    }

    public function edit($id)
    {
        $chat_documento = Chat_Documento::find($id);
        return view('chat_documentos.edit', compact('chat_documento'));
    }

    public function update(Request $request, $id)
    {
        $v = Validator::make($request->all(), [
            'id_documentos' => 'required|exists:documentos,id',
            'id_chats' => 'required|exists:chats,id',
            'fecha_envio' => 'required|date',
        ]);

        //si la validacion falla redirigira con los errores
        if($v->fails()){
            return redirect()->back()->withInput()->withErrors($v->errors());
        }
        $chat_documento = Chat_Documento::find($id);
        $chat_documento->id_documentos = $request->id_documentos;
        $chat_documento->id_chats = $request->id_chats;
        $chat_documento->fecha_envio = $request->fecha_envio;
        $chat_documento->save();
        return redirect()->route('chat_documentos.index');
    }

    public function destroy($id)
    {
        $chat_documento = Chat_Documento::find($id);
        $chat_documento->delete();
        return redirect()->route('chat_documentos.index');
    }
}
