<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    //
    public function listUser()
    {
        $user = User::all();


        return view('users.list-users')
            ->with('user', $user);
    }

    public function showUser($id)
    {

        $user = user::find($id);
        $inversion = Inversion::where('user_id', $user->id)->first();
        
        return view('users.show-user')
            ->with('user', $user)
            ->with('inversion', $inversion);
    }

    public function editProfile()
    {
        // $countries = Country::all()->where('id', 'name');
        // //    $timezone = Timezone::orderBy('list_utc','ASC')->get();

        $user = Auth::user();
        $inv = Inversion::orderBy('id', 'desc')->get();
        return view('users.profile')
            ->with('user', $user)
            ->with('inv', $inv);        
            // ->with('countries', $countries);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $fields = [
            "fullname" => ['required'],
            "email" => ['required','string','email','max:255'],
            "celular" => ['required','numeric'],

        ];

        $msj = [
            'fullname.required' => 'El nombre es requerido',
            'email.unique' => 'El correo debe ser unico',
            'celular.numeric' => 'El celular solo puede ser numerico'
        ];

        $this->validate($request, $fields, $msj);

        $user->update($request->all());

        if ($request->hasFile('photoDB')) {
            $file = $request->file('photoDB');

            $nombre = time() . $file->getClientOriginalName();

            $ruta = 'photo/' . $user->id . '/' . $nombre;

            Storage::disk('public')->put($ruta,  \File::get($file));
            $user->photoDB = $ruta;
        }
        $user->save();


        return redirect()->route('dashboard')->with('msj-success', 'Se actualizo tu perfil');
    }
}
