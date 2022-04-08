<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Salary extends Model
{
    use Notifiable;

    protected $primaryKey = 'id';
    protected $table = 'salary';
    protected $fillable = ['employee_id','gaji_pokok','tunjangan_jabatan','tunjangan_makan','tunjangan_transport',
                            'loyal_reward', 'overtime','insentif','attending','rapel','late_reduce',
                            'absent_reduce', 'other_reduce','cash_advance_reduce','bpjs_tk','bpjs_ks','pph_21','salary_periode',
                            'status_salary','bonus'
                          ];


        // gaji_pokok
        // employee_id
        // tunjangan_jabatan
        // tunjangan_makan
        // tunjangan_transport
        // loyal_reward
        // overtime
        // interview
        // apptending
        // rapel
        // late_reduce
        // permit_reduce
        // absent_reduce
        // other_reduce
        // cash_advance_reduce
        // bpjs_tk
        // bpjs_ks
        // pph_21
        // salary_periode
}
