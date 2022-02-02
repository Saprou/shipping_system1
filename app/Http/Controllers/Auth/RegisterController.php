<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use App\Models\Contact;
use App\Models\Location;
class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8'],
            'mobile' => ['required']
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\Models\User
     */
/**
* Handle account registration request
* 
* @param RegisterRequest $request
* 
* @return \Illuminate\Http\Response
*/
    protected function createUser(array $data)
    {              
        try {
            $user = User::create([
                'f_name' => $data['user']['f_name'],
                'l_name' => $data['user']['l_name'],
                'email' => $data['user']['email'],
                'password' => Hash::make($data['user']['password']),
                'mobile' => $data['user']['mobile'],
                'sec_mobile' => $data['user']['sec_mobile'],
                'heard_from' => $data['user']['heard_from'],
                'payment_method' => $data['user']['payment_method'],
                'ref' => "S-".$data['user']['mobile']
            ]);
            $user->ref = 'S-'.$user->id;
            $user->save();

            Location::create([
                'user_id'=>$user->id,
                'city'=>$data['location']['city'],
                'area'=>$data['location']['area'],
                'street'=>$data['location']['street'],
                'building'=>$data['location']['building'],
                'floor'=>$data['location']['floor'],
                'apartment'=>'joijio',
                'landmarks'=>$data['location']['landmarks']
            ]);
            
            Contact::create([
                'name'=>$data['user']['f_name'].' '.$data['user']['l_name'],
                'user_id'=>$user->id,
                'email'=>$data['user']['email'],
                'mobile'=>$data['user']['mobile'],
            ]);

        } catch (Exception $e) {
            return $e->getMessage()."\n";
        }
        return $user;
    }

    public function customSignup(Request $request)
    {  
        $data = $request->all();
        if(User::where('email',$data['user']['email'])->count()){return 66;}
        if(User::where('mobile',$data['user']['mobile'])->orWhere('sec_mobile',$data['user']['mobile'])->count()){return 77;}
        if($data['user']['sec_mobile']&&User::where('sec_mobile',$data['user']['sec_mobile'])->orWhere('mobile',$data['user']['sec_mobile'])->count()){return 88;}
        $user = $this->createUser($data);
        $credentials = ['password'=>$request['user']['password'], 'email'=>$request['user']['email']];
        event(new Registered($user));
        if (Auth::attempt($credentials)) {
            return 200;
        }
    }
}
