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


        $user = new User([
                'employee_id' => $row['employee_id'],
                'fullname' => $row['fullname'],
                'join_date'=> \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date']),
                'tempat_lahir' => $row['tpt_lahir'],
                'tanggal_lahir' => \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir']),
                'almt_ktp' => $row['alamat_ktp'],
                'almt_domisili' => $row['alamat_domisili'],
                'tlp_rumah' => $row['telp_rumah'],
                'tlp_hp' => $row['telp_hp'],
                'ktp' => $row['ktp'],
                'kk' => $row['kk'],
                'npwp' => $row['npwp'],
                'passport' => $row['passport'],
                'email' => $row['email'],
                'jabatan' => $row['jabatan'],
                //'divisi' => $divisi,
                'agama' => $row['agama'],
                'status_pernikahan' => $row['status_pernikahan'],
                'kewarganegaraan' => $row['kewarganegaraan'],
                'golongan_darah' => $row['golongan_darah'],
                // 'sosmed' => $row['sosmed'],
                'password' => $row['employee_id'],
        ]);
        $role_r = Role::where('name', '=', $row['jabatan'])->get();
        return $user->assignRole($role_r);

    }

    // //rule untuk mengecek data yang sama stop ketika ada yang sama atau ada validasi yang error
    public function rules(): array
    {
        return [
            // 'employee_id' => 'nullable|unique:users,employee_id',
            // 'kk' => 'nullable|unique:users,kk',
            // 'npwp' => 'nullable|unique:users,npwp',
            // 'passport' => 'nullable|unique:users,passport',
            'employee_id' => 'nullable|unique:users,employee_id',
            'fullname' => 'nullable|unique:users,fullname',
            'join_date'=> 'nullable|unique:users,join_date',
            'tempat_lahir' => 'nullable|unique:users,tempat_lahir',
            'tanggal_lahir' =>'nullable|unique:users,tanggal_lahir',
            'almt_ktp' => 'nullable|unique:users,almt_ktp',
            'almt_domisili' =>'nullable|unique:users,almt_domisili',
            'tlp_rumah' => 'nullable|unique:users,tlp_rumah',
            'tlp_hp' => 'nullable|unique:users,tlp_hp',
            'ktp' => 'nullable|unique:users,ktp',
            'kk' => 'nullable|unique:users,kk',
            'npwp' => 'nullable|unique:users,npwp',
            'passport' => 'nullable|unique:users,passport',
            'email' => 'nullable|unique:users,email',
            'jabatan' => 'nullable|unique:users,jabatan',
            'divisi' => 'nullable|unique:users,divisi',
            'agama' => 'nullable|unique:users,agama',
            'status_pernikahan' => 'nullable|unique:users,status_pernikahan',
            'kewarganegaraan' => 'nullable|unique:users,kewarganegaraan',
            'golongan_darah' =>'nullable|unique:users,golongan_darah'
        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
            // 'employee_id' => 'employee_id sama',
            // 'email.unique' => 'email sama',
            // 'employee_id' => 'nulla
            'fullname' => 'employee_id sama',
            'join_date'=> 'employee_id sama',
            'tempat_lahir' => 'employee_id sama',
            'tanggal_lahir' => 'employee_id sama',
            'almt_ktp' => 'employee_id sama',
            'almt_domisili' => 'employee_id sama',
            'tlp_rumah' => 'employee_id sama',
            'tlp_hp' => 'employee_id sama',
            'ktp' => 'employee_id sama',
            'kk' => 'employee_id sama',
            'npwp' => 'employee_id sama',
            'passport' => 'employee_id sama',
            'email' => 'employee_id sama',
            'jabatan' => 'employee_id sama',
            'divisi' => 'employee_id sama',
            'agama' => 'employee_id sama',
            'status_pernikahan' => 'employee_id sama',
            'kewarganegaraan' => 'employee_id sama',
            'golongan_darah' => 'employee_id sama',
        ];
    }

}
