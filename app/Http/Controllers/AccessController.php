<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class AccessController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function doLogin(){
        // Creating Rules for Email and Password
    $rules = array(
        'email' => 'required|email', // make sure the email is an actual email
        'password' => 'required|alphaNum|min:8'
    );
        // password has to be greater than 3 characters and can only be alphanumeric and);
        // checking all field
        $validator = Validator::make(Input::all() , $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails())
          {
          return Redirect ('/login')->withErrors($validator) // send back all errors to the login form
          ->withInput(Input::except('password')); // send back the input (not the password) so that we can repopulate the form
          }
          else
          {
          // create our user data for the authentication

            $email = Input::get('email');
            $password = Input::get('password');


          $user = User::all()->Where('email',$email);
          foreach($user as $users){
          // attempt to do the login
          if (password_verify($password, $users->password))
            {
                session_start();
                $_SESSION["name"]=$users->name;
            // validation successful
            return redirect ('/');
            }
            else
            {
            // validation not successful, send back to form
            return Redirect ('/login')->with('error','Wrong Credentials, Please try again');
            }
          }
        }
        }

    public function register(){
        return view('auth.register');
    }

    public function doRegister(Request $request){
             // Creating Rules for Email and Password
    $rules = array(
        'name' => 'required', 'string', 'max:255',
        'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
        'password' => 'required', 'string', 'min:8', 'confirmed',
    );
        // password has to be greater than 3 characters and can only be alphanumeric and);
        // checking all field
        $validator = Validator::make(Input::all() , $rules);
        // if the validator fails, redirect back to the form
        if ($validator->fails())
          {
          return Redirect ('/register')->withErrors($validator); // send back all errors to the login form
          }
          else
          {
            $serial = uniqid('lsp',false);
            $s_no = md5($serial);
            $password = $request->input('password');

            $user = new User;
            $user->uuid = $s_no;
            $user->name = $request->input('name');
            $user->email = $request->input('email');
            $user->password = password_hash($password, PASSWORD_BCRYPT);
            $user->save();

            return redirect('/')->with('success','Congratulation, please proceed ');
          }
    }

    public function logout(){
        // remove all session variables
        session_start();
        session_unset();
        session_destroy();

        return Redirect ('/');
        exit(); // logging out user
    }


}
