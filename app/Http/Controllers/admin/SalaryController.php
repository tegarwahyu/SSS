<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Salary;
use App\Imports\SalaryImport;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon;
use DateTime;
use Yajra\DataTables\DataTables;
use Barryvdh\DomPDF\Facade as PDF;
use App\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Auth;

class SalaryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if(Auth::user()->jabatan === 'HR Manager'||Auth::user()->jabatan === 'Super Admin') {
            return view('admin.salary.index');
        }
        return view('admin.dashboard.index');
    }

    public function viewFormSalary(){
        return view('admin.salary.formSalary');
    }

    public function uploadSalary(Request $request){

        // $file = $request->file('file_excel_salary');
        // $namaFile = $file->getClientOriginalName();
        // $file->move('DataSalary/',$namaFile);

        $salaryDate=date('Y-m-d H:i:s',strtotime($request->salary_periode));
        Excel::import(new SalaryImport($salaryDate), $request->file('file_excel_salary'));

        return redirect()->back()->with('SuccessImportData', 'Data berhasil di import ke Database');

    }

    public function getDataSalary($id){

        $querys =  DB::select('SELECT * FROM salary WHERE MONTH(salary_periode) ='.$id);
        $tb = Datatables::of($querys)
        ->addIndexColumn()
                ->addColumn('employee_id', function($data){
                    return $data->employee_id;
                })
                ->addColumn('fullname', function($data){
                    foreach(User::where('employee_id','=', $data->employee_id)->get() as $user){
                        return $user->fullname;
                    }
                })
                ->addColumn('pendapatan', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel;
                    return $pendapatan;
                })
                ->addColumn('potongan', function($data){
                    $potongan = $data->late_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21;
                    // dd($potongan);
                    return $potongan;
                })
                ->addColumn('total', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel;
                    $potongan = $data->late_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21 ;
                    $total = $pendapatan - $potongan;
                    return $total;
                })

                ->addColumn('action', function($data){
                //     return $this->buildControl($data->id);
                // href="'.route('spt_pdf',$id).
                //  $button = '<a href="#" onclick="show('.$data->id.')" data-toggle="tooltip" title="Edit Pegawai" class="btn btn-outline-primary btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    $button = '<a href="'.route('viewSlipSalary',$data->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    return $button;
                })->make(true);
        return $tb;
    }

    public function dataByPeriode (Request $request){
        return $request;
    }

    // fungsi cetak slip gaji karyawan
    public function viewSlipSalary($id){
        // get data salary by id yang dikirim
        $dataSalaryById = Salary::where('id',$id)->get();
        // menyocokkan data salary by employee_id dari salary ke user
        $dataUser = User::where('employee_id',$dataSalaryById[0]->employee_id)->get();
        $jabatanUser = Role::where('name',$dataUser[0]->jabatan)->get('name');

        $countUser =  User::whereNotIn('fullname',['Super Admin'])
        ->whereNotIn('fullname',['akun hrd'])
        ->where('user_status','!=','tidak aktif')
        ->orderBy('id', 'ASC')
        ->get();
        // for($i=1;$i<=count($countUser);$i++){
        //     echo $i;
        // }
        // dd($i);

        // kondisi jika data kosong
        if($dataUser->isEmpty()){
            return redirect()->back()->with('EmptyData', 'Maaf Slip Gaji yang anda cari tidak ada di Database');
        }else{
            // print pdf salary
            // $pdf = PDF::loadView('admin.salary.viewSlipSalary',
            // [
            //     'dataSalary'=>$dataSalaryById[0],
            //     'dataUser'=>$dataUser[0],
            //     'jabatanUser'=>$jabatanUser
            // ])->setPaper('a4', 'landscape');
            // return $pdf->stream('salary-'.$dataUser[0]->employee_id.'.pdf',array('Attachment'=>false));
            // see in html
            return view('admin.salary.viewSlipSalary',['dataSalary'=>$dataSalaryById[0],'dataUser'=>$dataUser[0],'jabatanUser'=>$jabatanUser,'noUrut'=>$countUser]);
        }

    }

    public function getFormatSalary(){
        $filepath = public_path('/storage/FormatDokumen/salary.xlsx');
        return Response()->download($filepath);
    }

    public function viewDataSalaryById(){
        return view('admin.salary.salaryku');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
