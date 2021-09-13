<?php

namespace App\Http\Controllers;

use App\Models\Inversion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
        $inv = Inversion::where('user_id', $user->id)->get();
        
        return view('users.show-user')
            ->with('user', $user)
            ->with('inv', $inv);
    }

    public function editProfile()
    {
        // $countries = Country::all()->where('id', 'name');
        // //    $timezone = Timezone::orderBy('list_utc','ASC')->get();

        $user = Auth::user();

        return view('users.profile')
            ->with('user', $user);
            // ->with('countries', $countries);
    }

    public function updateProfile(Request $request)
    {
        $user = User::find(Auth::user()->id);

        $msj = [
            'fullname.required' => 'El nombre es requerido',
            'email.unique' => 'El correo debe ser unico'
        ];

        $this->validate($request, $msj);

        $user->update($request->all());

        if ($request->hasFile('photoDB')) {
            $file = $request->file('photoDB');

            $nombre = time() . $file->getClientOriginalName();

            $ruta = 'photo/' . $user->id . '/' . $nombre;

            Storage::disk('public')->put($ruta,  \File::get($file));
            $user->photoDB = $ruta;
            $user->save();
        }


        return redirect()->route('profile')->with('msj-success', 'Se actualizo tu perfil');
    }
}
