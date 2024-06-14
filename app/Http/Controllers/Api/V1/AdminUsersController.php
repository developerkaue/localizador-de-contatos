<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use App\Rules\ValidCpf;
use App\Rules\ValidCep;


class AdminUsersController extends Controller
{
   
    public function index()
    {
        $users = AdminUser::all(); // Busca todos os usuários
        return response()->json($users); // Retorna os usuários como JSON
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'celular' => 'required|string',
            'estado' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required', 'string', 
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'numero' => 'required|string',
            'cpf' => ['required', 'unique:admin_users,cpf', 'cpf'],
            // Adicione outras validações conforme necessário
        ]);

        if ($validator->fails()) {
            // Tratar os erros de validação aqui
            if ($validator->errors()->has('cpf')) {
                $message = 'CPF inválido ou já está cadastrado no sistema.';
                return redirect()->back()->withErrors($validator)->with('alert', $message)->withInput();
            }

            return redirect()->back()->withErrors($validator)->withInput();
        }

    
        $ownerId = auth()->id(); // ID do usuário autenticado
    
        $adminUser = new AdminUser();
        $adminUser->name = $request->input('name');
        $adminUser->latitude = $request->input('latitude');
        $adminUser->longitude = $request->input('longitude');
        $adminUser->celular = $request->input('celular');
        $adminUser->estado = $request->input('estado');
        $adminUser->cidade = $request->input('cidade');
        $adminUser->cep = $request->input('cep');
        $adminUser->endereco = $request->input('endereco');
        $adminUser->bairro = $request->input('bairro');
        $adminUser->numero = $request->input('numero');
        $adminUser->complemento = $request->input('complemento');
        $adminUser->cpf = $request->input('cpf');
        $adminUser->owner_id = $ownerId; // Associando o usuário criador
    
        $adminUser->save();
    
        return redirect('/gerenciar')->with('success', 'Admin usuário cadastrado com sucesso!');
    }
    
    public function edit($id)
    {
        $user = AdminUser::findOrFail($id);
        return view('editUser', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'latitude' => 'required|string',
            'longitude' => 'required|string',
            'celular' => 'required|string',
            'estado' => 'required|string',
            'cidade' => 'required|string',
            'cep' => 'required|string',
            'endereco' => 'required|string',
            'bairro' => 'required|string',
            'numero' => 'required|string',
            // Adicione outras validações conforme necessário
        ]);
    
        if ($validator->fails()) {       
            // Para outros erros de validação, apenas redireciona de volta com os erros e os dados submetidos
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $adminUser = AdminUser::findOrFail($id);
    
        $adminUser->name = $request->input('name');
        $adminUser->latitude = $request->input('latitude');
        $adminUser->longitude = $request->input('longitude');
        $adminUser->celular = $request->input('celular');
        $adminUser->estado = $request->input('estado');
        $adminUser->cidade = $request->input('cidade');
        $adminUser->cep = $request->input('cep');
        $adminUser->endereco = $request->input('endereco');
        $adminUser->bairro = $request->input('bairro');
        $adminUser->numero = $request->input('numero');
        $adminUser->complemento = $request->input('complemento');
        $adminUser->cpf = $request->input('cpf');
    
        $adminUser->save();
    
        return redirect('/gerenciar')->with('success', 'Admin usuário atualizado com sucesso!');
    }
    
    //Buscar por cpf
    public function findByCpf(string $cpf)
    {
        $user = AdminUser::where('cpf', $cpf)->first(); // Busca o usuário pelo CPF
        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404); // Retorna um erro 404 caso o usuário não seja encontrado
        }
        return response()->json($user); // Retorna o usuário como JSON
    }

    public function destroy($id)
    {
        $adminUser = AdminUser::findOrFail($id);
        $adminUser->delete();

        return response()->json(['message' => 'Usuario excluido com sucesso', 200]);
    }

}
