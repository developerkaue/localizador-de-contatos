<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Users;
use App\Models\AdminUser;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\ResetPasswordEmail;
use Illuminate\Support\Facades\Hash;


class UsersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = Users::all(); // Busca todos os usuários
        return response()->json($users); // Retorna os usuários como JSON
    }


    public function checkEmailCpf(Request $request)
    {
        $emailExists = User::where('email', $request->email)->exists();
        return response()->json(['isUnique' => !$emailExists]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = new Users();

        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string|max:255',
            'password' => 'required|string|min:6',
            // Adicione outras validações conforme necessário
        ]);
    
        if ($validator->fails()) {
            // Tratar os erros de validação aqui
            if ($validator->errors()->has('email')) {
                $message = 'Email inválido ou já está cadastrado no sistema.';
                return redirect()->back()->withErrors($validator)->with('alert', $message)->withInput();
            }
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->password = bcrypt($request->input('password'));
        $user->celular = $request->input('celular');


        $user->save();
        $message = 'Usuário cadastrado com sucesso!';
        return redirect('/logar')->with('alert', $message)->withInput();

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id, Request $request)
    {
        $user = Users::find($id);

        if (!$user) {
            return response()->json(['message' => 'Usuário não encontrado'], 404);
        }

        // Verifique se a senha fornecida pelo usuário está correta
        if (Hash::check($request->input('password'), $user->password)) {
            // Se a senha estiver correta, exclua o usuário
            $adminUsers = AdminUser::where('owner_id', $user->id)->get();
            foreach ($adminUsers as $adminUser) {
                $adminUser->delete();
            }
            $user->delete();
            return response()->json(['message' => 'Usuário excluído com sucesso'], 200);
        } else {
            // Se a senha estiver incorreta, retorne uma mensagem de erro
            return response()->json(['message' => 'Senha incorreta. Verifique sua senha e tente novamente'], 422);
        }
    }

        public function deleteConfirmation($id)
        {
            $user = Users::findOrFail($id);
            return view('delete_confirmation', compact('user'));
        }
    
}
