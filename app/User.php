<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Spatie\Permission\Traits\HasRoles;
use Carbon\Carbon;
use DB;
//spatie media library
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Image\Manipulations;

class User extends Authenticatable implements HasMedia
{
    use Notifiable;
    use HasRoles;
    use HasMediaTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    protected $fillable = [
        'employee_id','ktp','kk','passport','npwp','fullname',
        'tempat_lahir','tanggal_lahir','email','jabatan','divisi',
        'agama','status_pernikahan','almt_domisili','kewarganegaraan',
        'kerabat','golongan_darah','sosmed','user_status','note',
        'ec_families','graduated_from','password','join_date','tlp_hp','tlp_rumah',
        'almt_domisili','almt_ktp'
    ];
    protected $appends = ['NamaLengkap','full_name'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'ruang' => 'array',
        'pendidikan' => 'array',
        'tanggal_lahir' => 'datetime:d-m-Y',
    ];

    public function getNamaLengkapAttribute(){
        return $this->fullname;
    }

    public function getFullNameAttribute()
    {
        // return ucfirst($this->first_name) . ' ' . ucfirst($this->last_name);
        // return $this->full_name;
    }

    public function setPasswordAttribute($password)
    {
        $this->attributes['password'] = Hash::make($password);
    }

    public function profile(){
        return $this->hasOne('\App\models\Profile');
    }

    public function bisa(array $permissions):bool
    {
        return $this->hasAnyPermission($permissions);
    }

    //membership (to hide super admin visibility from another member )
    public function scopeMember($query){
        return $query->where('email','!=','admin@local.host');
    }

    public function scopeActive($q){
        return $q->where('user_status', 'aktif');
    }


    function alamat(){
        $users = User::where('address')->get();
        $alamat = json_decode($users)->domisili;

        return $alamat;
    }
}
