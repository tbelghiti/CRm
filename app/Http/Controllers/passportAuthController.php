<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\User;
use Illuminate\Http\Request;

class passportAuthController extends Controller
{
    public function registerUserExample(Request $request){
        $this->validate($request,[
            'nom'=>'required',
            'prenom'=>'required',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:8',

        ]);

            $profil = Profil::create([
                "admin" => $request->admin ,
                "gestionnaire" => $request->gestionnaire,
                "user" => 1 ,
                "client" => $request->client ,
                "fournisseur" => $request->fournisseur 
            ]);

            // declaration des deux variables  
            $photo=null;
            $cv=null;
            // le traitement pour enregister image et le cv
            if($request->file('photo'))
            {
             $destination='storage/images';
                $image=$request->file('photo');
                $photo=$image->getClientOriginalName();
                $image->move($destination, $photo);  
            }

            if($request->file('cv')){

                $destination='storage/cv';
                $file=$request->file('cv');
                $cv=$file->getClientOriginalName();
                $file->move($destination, $cv);

            }


        $user= User::create([
            'nom' =>$request->nom,
            'prenom'=>$request->prenom,
            'email'=>$request->email,
            'password'=>bcrypt($request->password),
            'poste'=>$request->poste,
            'naissance'=>$request->naissance,
            'base_salaire'=>$request->base_salaire,
            //changer le cv et photo avec les variables declarée
            'cv'=>$request->$cv,
            'photo'=>$request->$photo,
            'date_recrutement'=>$request->date_recrutement,
            'date_derniere_connexion'=>$request->date_derniere_connexion,
            'lieu_du_travail'=>$request->lieu_du_travail,
            'contrat'=>$request->contact,
            'statut'=>$request->statut,
            'adresse'=>$request->adresse,
            'ville'=>$request->ville,
            'pays'=>$request->pays,
            'telephone1'=>$request->telephone1,
            'telephone2'=>$request->telephone2,
            'note1'=>$request->note1,
            'note2'=>$request->note2,
            'profils_id'=>$profil->id,
        ]);

   //return the access token we generated in the above step
        return response()->json(['status'=>"ok"],200);
    }

    /**
     * login user to our application
     */
    
    public function loginUserExample(Request $request){
        $login_credentials=[
            'email'=>$request->email,
            'password'=>$request->password,
        ];
        if(auth()->attempt($login_credentials)){
            //generate the token for the user
            $user_login_token= auth()->user()->createToken('PassportExample@Section.io')->accessToken;
            //now return this token on success login attempt
            return response()->json(['token' => $user_login_token], 200);
        }
        else{
            //wrong login credentials, return, user not authorised to our system, return error code 401
            return response()->json(['error' => 'UnAuthorised Access'], 401);
        }
    }

    /**
     * This method returns authenticated user details
     */
    public function authenticatedUserDetails(){
        //returns details
        return response()->json(['authenticated-user' => auth()->user()], 200);
    }
}
