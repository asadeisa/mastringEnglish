<?php

namespace App\Actions\Fortify;

use App\Models\User;
use App\Models\Teacher;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Illuminate\Http\Request;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array  $input
     * @return \App\Models\User
     */
    public $teacher=0;
    public function create(array $input)
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                Rule::unique(User::class),
            ],
            'password' => $this->passwordRules(),
            'image' => 'mimes:jpeg,jpg,png,gif|max:20000',
        ])->validate();
      
        
        $original_name = strtolower(trim( $input['file']->getClientOriginalName()));
        $pathImg = "assets/images/users/".time().rand(100,999).$original_name;
   
        $input['file']->move(public_path('assets/images/users'), $pathImg);
        
      
      
            if($input["student"] == 0){
               return User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'teacher' => $input['student'] ,
                    'img' =>$pathImg,
                ]);
            



            }else if($input["student"] == 1) {
                User::create([
                    'name' => $input['name'],
                    'email' => $input['email'],
                    'password' => Hash::make($input['password']),
                    'teacher' => $input['student'] ,
                    'img' =>$pathImg,
                   

                ]);
               $user = User::where(["name" =>$input['name'],'email' => $input['email'],])->first() ;
             
                Teacher::create([
                    "user_id" =>$user->id,
              ]);
              return $user;
            }
            
             

    }
}
