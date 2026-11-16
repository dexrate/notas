<?php

namespace App\Http\Controllers;

use App\Http\Services\Operations;
use App\Models\Nota;
use App\Models\Usuario;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

class MainController extends Controller
{
    public function index()
    {
        //carrega notas do usuário logado
        $id = session('usuario.id');
        $usuario = Usuario::find($id);

        $notas = $usuario->notas()->whereNull('deleted_at')->get();

        //carrega a view
        return view('home', compact('notas'));
    }

    public function novaNota()
    {
        //mostrar view para criar nova nota
        return view('nova-nota');
    }
    public function criarNota(Request $request)
    {
        //busca id do usuário logado na sessão
        $id = session('usuario.id');
        $request->validate(
            [
                'titulo' => ['required', 'min:2', 'max:255'],
                'conteudo' => ['required']
            ],
            [   
                'titulo.required' => 'O campo de título é obrigatório.',
                'titulo.min' => 'O campo de título deve ter pelo menos :min caracteres.',
                'titulo.max' => 'O campo de título deve ter no máximo :max caracteres.',
                'conteudo.required' => 'O campo de nota é obrigatório.',
                // 'conteudo.min' => 'O conteúdo deve ter pelo menos :min caracteres.',
                // 'conteudo.max' => 'O conteúdo deve ter no máximo :max caracteres'
            ]
        );
        //criar nova nota
        $nota = new Nota();
        $nota->usuario_id = $id;
        $nota->titulo = $request->titulo;
        $nota->conteudo = $request->conteudo;
        $nota->save();

        return redirect()->route('home')->with(['success' => 'Nota criada com sucesso!']);
        // echo 'Nota criada com sucesso!';
    }

    public function editarNota($id)
    {
        $id = Operations::verificaId($id);

        $nota = Nota::find($id);
        return view('editar-nota', compact('nota'));
    }

    public function editarNotaSubmit(Request $request)
    {
        // validar
        $request->validate(
            [
                'titulo' => ['required', 'min:2', 'max:255'],
                'conteudo' => ['required']
            ],
            [   
                'titulo.required' => 'O campo de título é obrigatório.',
                'titulo.min' => 'O campo de título deve ter pelo menos :min caracteres.',
                'titulo.max' => 'O campo de título deve ter no máximo :max caracteres.',
                'conteudo.required' => 'O campo de nota é obrigatório.',
                // 'conteudo.min' => 'O conteúdo deve ter pelo menos :min caracteres.',
                // 'conteudo.max' => 'O conteúdo deve ter no máximo :max caracteres'
            ]
        );
        // decript nota_id
        if ($request->nota_id == null) {
            return redirect()->route('home');
        }
        $id = Operations::verificaId($request->nota_id);

        $nota = Nota::find($id);
        //update nota
        $nota->titulo = $request->titulo;
        $nota->conteudo = $request->conteudo;
        $nota->save();

        return redirect()->route('home')->with(['success' => 'Nota editada com sucesso!']);
    }

    public function deletarNota($id)
    {
        $id = Operations::verificaId($id);
        $nota = Nota::find($id);

        return view('deletar-nota', compact('nota'));
    }
    public function deletarNotaConfirma($id)
    {
        $id = Operations::verificaId($id);
        // carrega nota
        $nota = Nota::find($id);

        //1- hard delete -- Tirar fisicamente o campo do banco de dados
        // $nota->delete();

        //2- soft delete - atualizando o campo deleted_at com a data atual, para que a nota não seja exibida na tela, mas ainda esteja no banco de dados
        // $nota->deleted_at = now();
        // $nota->save();

        // 3- Soft delete - usando o método delete() usando o SoftDeletes trait no model, que atualiza o campo deleted_at com a data atual 
        $nota->delete();

        // 4- Hard delete - com a propriedade do softdelete ligado no model 
        // $nota->forceDelete();

        return redirect()->route('home')->with(['success' => 'Nota deletada com sucesso!']);
    }
}
