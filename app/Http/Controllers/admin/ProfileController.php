<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Salary;
use App\User;
use Yajra\DataTables\DataTables;

class ProfileController extends Controller
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
        //
    }

    public function viewProfileById($id){
        $dataUserById = User::where('id',$id)->get();
        return view('admin.profile.index',['dataUser'=>$dataUserById]);
    }

    public function editPasswordProfile(Request $request){
        // $2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO
        $getDataUser = User::find($request->user_id)->update(['password'=>$request->password]);
        return redirect()->back()->with('SuccessChangePassword', 'Selamat password anda telah di rubah');
    }

    public function getDataSalaryUserById($id){
        // dd($id);
        $getDataUserById = User::FindOrFail($id);
        $data = Salary::where('employee_id',$getDataUserById->employee_id)->get();
        // dd($getDataSalaryById);
        return Datatables::of($data)
            ->addIndexColumn()
                ->addColumn('Nama', function($data){
                    foreach(User::where('employee_id','=', $data->employee_id)->get() as $user){
                        return $user->full_name;
                    }
                })
                ->addColumn('pendapatan', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->interview + $data->apptending + $data->rapel;
                    return $pendapatan;
                })
                ->addColumn('potongan', function($data){
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21;
                    // dd($potongan);
                    return $potongan;
                })
                ->addColumn('total', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->interview + $data->apptending + $data->rapel;
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21 ;
                    $total = $pendapatan - $potongan;
                    return $total;
                })
                ->addColumn('action', function($user){
                    $button = '<a href="'.route('viewSlipSalary',$user->id).'" data-toggle="tooltip" title="Lihat Slip Salary" class="btn btn-outline-info btn-sm"><i class="ni ni-single-copy-04"></i></a>';
                    return $button;
                })->make(true);
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
