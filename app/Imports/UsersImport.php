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
	$dateJoin = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['join_date']);
	$dateBirth = \PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['tgl_lahir']);
	$user = new User([
                'employee_id' => $row['employee_id'],
                'fullname' => $row['fullname'],
                'join_date'=> $dateJoin->format('Y-m-d'),
                'tempat_lahir' => $row['tpt_lahir'],
                'tanggal_lahir' => $dateBirth->format('Y-m-d'),
                'almt_domisili' => $row['alamat_domisili'],
	            'almt_ktp' => $row['alamat_ktp'],
		        'tlp_rumah' => $row['telp_rumah'],
                'tlp_hp' => $row['telp_hp'],
		        'ktp' => $row['ktp'],
                'kk' => $row['kk'],
                'npwp' => $row['npwp'],
                'passport' => $row['passport'],
                'email' => $row['email'],
                'jabatan' => $row['jabatan'],
                'agama' => $row['agama'],
                'status_pernikahan' => $row['status_pernikahan'],
                'kewarganegaraan' => $row['kewarganegaraan'],
                'golongan_darah' => $row['golongan_darah'],
                'password' => $row['employee_id']]);
        $role_r = Role::where('name', '=', $row['jabatan'])->get();
        return $user->assignRole($role_r);

    }

    // //rule untuk mengecek data yang sama stop ketika ada yang sama atau ada validasi yang error
    public function rules(): array
    {
        return [
            'employee_id' => 'nullable|unique:users,employee_id',
            //'fullname' => 'nullable|unique:users,fullname',


        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
	    'employee_id' => 'employee_id sama',
            //'fullname' => 'fullname sama',
        ];
    }
}
