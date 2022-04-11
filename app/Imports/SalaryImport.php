<?php

namespace App\Imports;

use App\models\Salary;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\SkipsEmptyRows;
use Maatwebsite\Excel\Concerns\WithValidation;

class SalaryImport implements ToModel, SkipsEmptyRows, WithValidation, WithHeadingRow
{

    public function  __construct($salaryDate)
    {
        $this->salaryDate = $salaryDate;
    }
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        $request = request()->all();
        $dateConvert = Carbon::createFromFormat('m-Y', $request['salary_periode'])->format('Y-m-d');
        return new Salary([
            'employee_id' => $row['employee_id'],
            'gaji_pokok' => $row['gaji_pokok'],
            'tunjangan_jabatan' => $row['tunjangan_jabatan'],
            'tunjangan_makan' => $row['tunjangan_makan'],
            'tunjangan_transport' => $row['tunjangan_transport'],
            'loyal_reward' => $row['loyal_reward'],
            'attending'=> $row['attending'],
            'overtime' => $row['overtime'],
            'insentif' => $row['insentif'],
            'rapel' => $row['rapel'],
            'late_reduce' => $row['late_reduce'],
            'absent_reduce' => $row['absent_reduce'],
            'other_reduce' => $row['other_reduce'],
            'cash_advance_reduce' => $row['cash_advance_reduce'],
            'bpjs_tk' => $row['bpjs_tk'],
            'bpjs_ks' => $row['bpjs_ks'],
            'pph_21' => $row['pph_21'],
            'salary_periode' =>$dateConvert,
        ]);

    }

    // //rule untuk mengecek data yang sama stop ketika ada yang sama atau ada validasi yang error
    public function rules(): array
    {
        return [
            'salary_periode' => 'nullable|unique:salary,salary_periode',
        ];
    }

    // //validasi sama akan memberika messages
    public function customValidationMessages()
    {
        return [
	        'salary_periode' => 'salary_periode sama',
        ];
    }
}
