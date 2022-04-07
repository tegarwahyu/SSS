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
            'employee_id' => 'nullable|unique:users,employee_id',
            'kk' => 'nullable|unique:users,kk',
            'npwp' => 'nullable|unique:users,npwp',
            'passport' => 'nullable|unique:users,passport',

        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
            'employee_id' => 'employee_id sama',
            'email.unique' => 'email sama',
        ];
    }

}
