<?php

namespace App\Imports;

use App\User;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;
use Carbon\Carbon;

class UsersImport implements ToModel, SkipsEmptyRows, WithValidation ,WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        // $request = request()->all();
        // dd($request);
        $employeeID = "";
        if($row['employee_id'] == null){
            $getLastIDSSS = User::orderBy('employee_id', 'desc')->value('employee_id');
            // setelah id nya di ambil lalu diambil angkanya langsung di tambahkan 1
            $strPlus = preg_replace("/[^a-zA-Z0-9]/", "", filter_var($getLastIDSSS, FILTER_SANITIZE_NUMBER_INT)) + 1;
            $employeeID = 'ID-SSS'.$strPlus;
        }else{
            $employeeID = $row['employee_id'];
        }


        $phone = [
            'rumah'=>$row['telp_rumah'],
            'hp'=>$row['telp_hp']
        ];

        $address = [
            'domisili'=>$row['alamat_domisili'],
            'ktp'=>$row['alamat_ktp']
        ];

        $role = Role::where('name',$row['jabatan'])->get();
        $role_r = Role::where('id', '=', $role[0]->id)->get();

        if($role[0]->name == 'Collection Staff' || $role[0]->name == 'Supervisor DC' || $role[0]->name == 'Leader DC' || $role[0]->name == 'Desk Collection'){
            $divisi = 'Collection';
        }elseif($role[0]->name == 'HR Staff' || $role[0]->name == 'HR Manager'){
            $divisi = 'HRD';
        }else{
            $divisi = "";
        }

        $user = User::create([
            'employee_id' => $row['employee_id'],
            'fullname' => $row['fullname'],
            'join_date'=> date('Y-m-d',strtotime($row['join_date'])),
            'tempat_lahir' => $row['tpt_lahir'],
            'tanggal_lahir' => date('Y-m-d',strtotime($row['tgl_lahir'])),
            'address' => json_encode($address),
            'phone' => json_encode($phone),
            'ktp' => $row['ktp'],
            'kk' => $row['kk'],
            'npwp' => $row['npwp'],
            'passport' => $row['passport'],
            'email' => $row['email'],
            'jabatan' => $role[0]->id,
            'divisi' => $divisi,
            'agama' => $row['agama'],
            'status_pernikahan' => $row['status_pernikahan'],
            'kewarganegaraan' => $row['kewarganegaraan'],
            'golongan_darah' => $row['golongan_darah'],
            // 'sosmed' => $row['sosmed'],
            'password' => $employeeID,
        ])->assignRole($role_r);
        return $user;
    }

    // //rule untuk mengecek data yang sama stop ketika ada yang sama atau ada validasi yang error
    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|unique:users,employee_id',
            //'ktp' => 'required|unique:users,ktp',
            'kk' => 'nullable|unique:users,kk',
            'npwp' => 'nullable|unique:users,npwp',
            'passport' => 'nullable|unique:users,passport',
            //'fullname' => 'required|unique:users,fullname',
            // 'email' => 'required|unique:users,email',

            // 'employee_id' => 'required|unique:users,employee_id',
            // 'ktp' => 'required|unique:users,ktp',
            // 'fullname' => 'required|unique:users,fullname',
            // 'email' => 'required|unique:users,email',
            // 'passport' => 'nullable|unique:users,passport',
            // 'phone' => 'required|unique:users,phone',
            // 'address' => 'required|unique:users,address',

        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
            'employee_id' => 'employee_id sama',
            // 'ktp.unique' =>'ktp sama',
            'kk.unique' =>'kk sama',
            'npwp.unique' => 'npwp sama',
            'passport.unique' => 'passport sama',
            //'fullname.unique' => 'fullname sama',
            // 'email.unique' => 'email sama',

            // 'employee_id.unique' => 'employee_id sama',
            // 'ktp.unique' => 'ktp sama',
            // 'email.unique' => 'email sama',
            // 'passport.unique' => 'passport sama',
            // 'phone.unique' => 'phone sama',
            // 'address.unique' => 'address sama',
        ];
    }

}
