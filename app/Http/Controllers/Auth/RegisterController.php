<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
// use App\User;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Auth\Events\Registered;
use App\Models\Master\User;
use App\Models\Master\Employee;
use App\Models\Master\Menu;
// use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use App\Mail\User\VerifyUser;
use \Carbon\Carbon;
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
    public function register(Request $request)
    {
        // $register   = $this->create($request->all());
        dd($request->all());
        $today = Carbon::today();
        $today = $today->addDay('-30');
        // Cek Username
        $checkUsername = User::where('username', $request->username)->count();

        if($checkUsername > 0)
        {
            return redirect()->route('login-form')->with('error','Username Sudah Terdaftar');
        }
        
        $oldCountUser       =   User::count();
        $oldCountKaryawan   =   Employee::count();
        $password           =   Hash::make('sentulappuser');
        $karyawan           =   Employee::Insert([
                                    'fullname'              => $request->fullname,
                                    'departement_id'         => $request->departemen,
                                    'email'                 => $request->email,
                                    'is_active'             => '1',
                                ]);
        $karyawan           = Employee::where('fullname',$request->fullname)->first();
        $user               = User::Insert([
                                    'username'              => $request->username,
                                    'employee_id'           => $karyawan->id,
                                    'password'              => $password,
                                    'verified'              => '0',
                                    'verified_by_admin'     => '0',
                                    'last_update_password'  => $today,
                                    'is_active'             => '0',
                                ]);
        // Input Hak Akses
        $user               = User::where('username',$request->username)->first();
        $menus = Menu::all();
        $newCountUser =  User::count();
        $newCountKaryawan = Employee::count();
        // Cek Berhasil / Tidak
        if($newCountKaryawan > $oldCountKaryawan && $newCountUser > $oldCountUser)
        {
            Mail::to($request->email)->send(new VerifyUser($user));
            return redirect()->route('face.page')->with('success','Anda berhasil mendaftar di portal Sisy. Harap cek inbox email anda untuk verifikasi akun anda.');
        }
        else
        {
            return redirect()->route('face.page')->with('error','Gagal mendaftar');
        }
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
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \App\User
     */
    protected function create(array $data)
    {
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);
    }
}
