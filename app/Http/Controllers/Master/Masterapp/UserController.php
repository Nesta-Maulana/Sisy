<?php

namespace App\Http\Controllers\Master\MasterApp;

use Illuminate\Http\Request;
use App\Http\Controllers\ResourceController;
use App\Models\Master\User;
use App\Models\Master\Employee;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use \Carbon\Carbon;
use App\Mail\User\ChangePassword;
use App\Mail\User\VerifiedUser;

class UserController extends ResourceController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function showChangePasswordForm($username)
    {
        $user       = User::where('username',$this->decrypt($username))->first();
        return view('credential_access.change-password',['user'=>$user]);
    }

        /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function processChangePassword(Request $request)
    {
        $user = User::where('username', $request->username)->first();
        if(is_null($user))
        {
            return back()->with('error', 'Username tidak terdaftar');
        }
        else
        {
            if(Hash::check($request->oldPassword, $user->password))
            {
                if (strlen($request->newPassword) < 6) 
                {
                    return back()->with('error', 'Password harus terdiri dari minimal 6 karakter')->withInput();
                }
                else
                {
                    if($request->newPassword !== $request->cNewPassword)
                    {
                        return back()->with('error', 'Konfirmasi password anda tidak sesuai dengan password baru')->withInput();
                    }
                    else
                    {   
                            $today                      = Carbon::today();
                            $today                      = $today->toDateString();
                            $user->password             = Hash::make($request->newPassword);
                            $user->last_update_password = $today;
                            $user->save();
                            Mail::to($user->employee->email)->bcc('nesta.maulana@nutrifood.co.id')->send(new ChangePassword($user,gethostbyaddr($_SERVER['REMOTE_ADDR']),$request->newPassword));
                            return redirect(route('credential_access.home-page'))->with('success', 'Password Berhasil Diubah');
                    }
                }
            }
            else 
            {
                return back()->with('error', 'Password lama anda tidak sesuai');
            }

        }


        

    }
    public function customChangePassword(Request $request)
    {
        $username       = $request->username;
        $userData       = User::where('username',$username)->first();
        if (is_null($userData)) 
        {
            return redirect(route('face.page'))->with('error','Username tidak terdaftar, Harap cek kembali username yang anda masukan');
        } 
        else 
        {
            if (is_null($userData->employee)) 
            {
                return redirect(route('face.page'))->with('error','Username tidak terkait pada karyawan mana pun harap hubungi admin untuk melakukan validasi sistem user');
            }
            else
            {
                if ($userData->employee->is_active == '0') 
                {
                    return redirect(route('face.page'))->with('error','Status user sebagai karyawan nonaktif, harap hubungi administrator untuk melakukan validasi sistem user');
                }
                else
                {
                    $resetPassword          = Hash::make('sentulappuser');
                    $userData->password     = $resetPassword;
                    $userData->save();
                    Mail::to($userData->employee->email)->bcc('nesta.maulana@nutrifood.co.id')->send(new ChangePassword($userData,gethostbyaddr($_SERVER['REMOTE_ADDR']),$resetPassword));
                    return redirect(route('face.page'))->with('success','Password berhasil diubah, informasi perubahan password telah berhasil dikirim melalui email anda yang terdaftar : '.$userData->employee->email);

                }
            }
        }
        
    }
    public function verifyAccount($user_id)
    {
        $user_id                        = $this->decrypt($user_id);
        $user                           = User::find($user_id);
        $user->verified                 = '1';
        $user->verified_by_admin        = '1';
        $user->save();

        Mail::to($user->employee->email)->send(new VerifiedUser($user));
        return  redirect()->route('face.page')->with('success','Verifikasi akun berhasil, kami telah mengirimkan data akses aplikasi ke email anda. ');
        

    }
    // public function editUserData($user_id)
    // {
    //     $cekAkses = $this->CheckAksesEdit(\Request::getRequestUri(),'show-user-form');
    //     if ($cekAkses['success'] == true) 
    //     {
    //         $user       = User::find($this->dekripsi($user_id));
    //         foreach ($user->karyawan as $key => $karyawan) 
    //         {

    //         }
    //         unset($user->id);
    //         $user->user_id   = $user_id;
    //         return $user;
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error',$cekAkses['message']);
    //     }
    // }

    // public function updateUserData(Request $request)
    // {
    //     $cekAkses   = $this->CheckAksesEdit(\Request::getRequestUri(),'show-user-form');
    //     if ($cekAkses == true) 
    //     {
    //         $user                           = User::find($this->dekripsi($request->id));
    //         $user->status                   = $request->loginstatus;
    //         $user->password                 = Hash::make('sentulappuser');
    //         $user->password_wrong           = '0';
    //         $user->last_update_password     = date('Y-m-d');
    //         $user->save();
    //         return redirect()->route('show-user-form')->with('success','Data user '.$request->fullname.' Telah berhasil di ubah');
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error',$cekAkses['message']);
    //     }
    // }
    
    // public function verifyUser(Request $request)
    // {
    //     $cekAkses   = $this->CheckAksesEdit(\Request::getRequestUri(),'show-user-form');
    //     if ($cekAkses == true) 
    //     {
    //         $user                           = User::find($this->dekripsi($request->user_id));
    //         $user->verified_by_admin        = '1';
    //         if ($user->verified == '1') 
    //         {
    //             $user->status = '1';
    //         }
    //         $user->save();
    //         return redirect()->route('show-user-form')->with('success','User '.$request->fullname.' Telah berhasil di verifikasi');
    //     }
    //     else
    //     {
    //         return redirect()->back()->with('error',$cekAkses['message']);
    //     }
    // }
    // public function gantiUserPassword(Request $request)
    // {
    //     $user = User::where('username', $request->username)->first();
    //     if(!$user)
    //     {
    //         return back()->with('failed', 'Username tidak sesuai');
    //     }
    //     if($request->newPassword !== $request->cNewPassword)
    //     {
    //         return back()->with('failed', 'Konfirmasi password tidak sesuai')->withInput();
    //     }
    //     if (strlen($request->newPassword) < 6) 
    //     {
    //         return back()->with('failed', 'Password harus terdiri dari minimal 6 karakter')->withInput();
    //     }

        
    //     if(Hash::check($request->oldPassword, $user->password)){
    //         $today = Carbon::today();
    //         $today = $today->toDateString();
    //         $user->password = Hash::make($request->newPassword);
    //         $user->last_update_password = $today;
    //         $user->save();
    //         session()->pull('ganti-password', null);
    //         return redirect('/home')->with('success', 'Password berhasil diubah');
    //     }
    //     else {
    //         return back()->with('failed', 'Password lama tidak sesuai');
    //     }
    // }
    // /**
    //  * Store a newly created resource in storage.
    //  *
    //  * @param  \Illuminate\Http\Request  $request
    //  * @return \Illuminate\Http\Response
    //  */

    // public function verifikasiUser($username)
    // {
    //     $username        = $this->dekripsi($username);
    //     $userdata        = User::where('username',$username)->first();
    //     $userdata->verified     = '1';
    //     $userdata->save();
    //     foreach ($userdata->karyawan as $karyawan) 
    //     {
    //     }

    //     Mail::to('nesta.maulana@nutrifood.co.id')->send(new ApprovalUser($userdata));    
        
    //     return redirect()->route('login')->with('success', 'Terima kasih sudah memverifikasi akun anda. Akun anda akan aktif setelah Administrator kami memverifikasi akun anda dan mengaktifkannya.');
    // }
    // public function store(Request $request)
    // {
    //     //
    // }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\master_data\User  $user
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\master_data\User  $user
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\master_data\User  $user
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\master_data\User  $user
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        //
    }
}
