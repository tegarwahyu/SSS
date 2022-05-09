<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\models\Salary;
use App\User;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Illuminate\Support\Facades\Hash;

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
        if(Auth::user()->id == $id){
            $dataUserById = User::where('id',$id)->get();
            return view('admin.profile.index',['dataUser'=>$dataUserById]);
        }else{
            return redirect()->route('admin');
        }
        
    }

    public function editPasswordProfile(Request $request){
        // $2y$10$5.6Cs4VHw0doRvG6pIPYT.Ygrx2VV7J4nFdHD1U66McsvwL2DTpdO
        $dataUser = User::find($request->user_id);
        $validator = Validator::make($request->all(), [
            'name'=>'required|string|min:3',
            'ktp'=>'required',
            'kk'=>'required',
            'alamat_ktp'=>'required',
            'alamat_domisili'=>'required',
            'no_hp' =>'required|string',
            'no_telp' =>'required|string',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'tempat_lahir'=>'required',
            'file_cv' => 'required|max:5024',
            'file_ktp' => 'required|max:1024',
            'file_ijazah' => 'required|max:1024',
            'file_foto' => 'required|max:1024',
            'file_kk' => 'required|max:1024',
        ]);

        // pendidikan
        $pendidikan1 = [
            'thn_masuk1' => $request->tahun_masuk1,
            'thn_keluar1' => $request->tahun_keluar1,
            'nama1' => $request->sekolah1,
            'jenjang1' => $request->pendidikan_1
        ];
        $pendidikan2 = [
            'thn_masuk2' => $request->tahun_masuk2,
            'thn_keluar2' => $request->tahun_keluar2,
            'nama2' => $request->sekolah2,
            'jenjang2' => $request->pendidikan_2
        ];
        $pendidikan3 = [
            'thn_masuk3' => $request->tahun_masuk3,
            'thn_keluar3' => $request->tahun_keluar3,
            'nama3' => $request->sekolah3,
            'jenjang3' => $request->pendidikan_3
        ];
        $pendidikan = [
            'sekolah1' => $pendidikan1,
            'sekolah2' => $pendidikan2,
            'sekolah3' => $pendidikan3
        ];
        // pengalaman kerja 
        $pengalaman1 = [
            'tgl_msk1' => $request->tanggal_masukkerja1,
            'tgl_klr1' => $request->tanggal_keluarkerja1,
            'nama1' => $request->perusahaan1,
            'jbtn1' => $request->jabatan1
        ];
        $pengalaman2 = [
            'tgl_msk2' => $request->tanggal_masukkerja2,
            'tgl_klr2' => $request->tanggal_keluarkerja2,
            'nama2' => $request->perusahaan2,
            'jbtn2' => $request->jabatan2
        ];
        $pengalaman_kerja = [
            'pengalaman1' => $pengalaman1,
            'pengalaman2' => $pengalaman2,
        ];

        // file_cv
        $file_cv = request()->file('file_cv');
        $extn_cv = $file_cv->getClientOriginalExtension(); //get extension file
        $file_cv->move("file_upload/".$dataUser->employee_id, 'CV-'.date('dmY').'.'.$extn_cv); //moving file to directory
        $path_cv = 'CV-'.date('dmY').'.'.$extn_cv;
        // file_foto_diri
        $file_f_diri = request()->file('file_foto');
        $extn_f_diri = $file_f_diri->getClientOriginalExtension(); //get extension file
        $file_f_diri->move("file_upload/".$dataUser->employee_id, 'Foto-'.date('dmY').'.'.$extn_f_diri); //moving file to directory
        $path_f_diri = 'Foto-'.date('dmY').'.'.$extn_f_diri;
        // file_ktp
        $file_ktp = request()->file('file_ktp');
        $extn_ktp = $file_ktp->getClientOriginalExtension(); //get extension file
        $file_ktp->move("file_upload/".$dataUser->employee_id, 'KTP-'.date('dmY').'.'.$extn_ktp); //moving file to directory
        $path_ktp = 'KTP-'.date('dmY').'.'.$extn_ktp;
        // file_ijazah
        $file_ijazah = request()->file('file_ijazah');
        $extn_ijazah = $file_ijazah->getClientOriginalExtension(); //get extension file
        $file_ijazah->move("file_upload/".$dataUser->employee_id, 'Ijazah-'.date('dmY').'.'.$extn_ijazah); //moving file to directory
        $path_ijazah = 'Ijazah-'.date('dmY').'.'.$extn_ijazah;
        // file_kk
        $file_kk = request()->file('file_kk');
        $extn_kk = $file_kk->getClientOriginalExtension(); //get extension file
        $file_kk->move("file_upload/".$dataUser->employee_id, 'KK-'.date('dmY').'.'.$extn_kk); //moving file to directory
        $path_kk = 'KK-'.date('dmY').'.'.$extn_kk;



        $date = str_replace('/', '-', $request->tanggal_lahir);
        $updateProfile = [
            'fullname'=> $request->name,
            'ktp'=> $request->ktp,
            'kk'=> $request->kk,
            'almt_ktp'=> $request->alamat_ktp,
            'almt_domisili'=> $request->alamat_domisili,
            'tlp_hp' => $request->no_hp,
            'tlp_rumah' => $request->no_telp,
            'email' => $request->email,
            'tempat_lahir'=> $request->tempat_lahir,
            'tanggal_lahir'=> date('Y-m-d', strtotime($date)),
            'resume' => $path_cv,
            'f_diri' => $path_f_diri,
            'f_kk' => $path_kk,
            'f_ktp' => $path_ktp, 
            'f_ijazah' => $path_ijazah,
            'pendidikan' => json_encode($pendidikan),
            'p_kerja' => json_encode($pengalaman_kerja),
        ];
        
        $user = User::find($request->user_id);
        $user->update($updateProfile);
        // dd($request);
        // die();
        // return 'success';
        return redirect()->route('admin');
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
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel + $data->bonus;
                    $convrtPendapatan = "Rp " . str_replace(",00","",number_format($pendapatan,2,',','.'));
                    return $convrtPendapatan;
                })
                ->addColumn('periode', function($data){

                    // dd();
                    return date("F Y", strtotime($data->salary_periode));
                })
                ->addColumn('potongan', function($data){
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21;
                    $convrtPotongan = "Rp " . str_replace(",00","",number_format($potongan,2,',','.'));
                    return $convrtPotongan;
                })
                ->addColumn('total', function($data){
                    $pendapatan = $data->gaji_pokok + $data->tunjangan_jabatan + $data->tunjangan_makan + $data->tunjangan_transport + $data->loyal_reward + $data->overtime + $data->insentif + $data->attending + $data->rapel + $data->bonus;
                    $potongan = $data->late_reduce + $data->permit_reduce + $data->absent_reduce + $data->other_reduce + $data->cash_advance_reduce + $data->bpjs_tk + $data->bpjs_ks + $data->pph_21 ;
                    $total = $pendapatan - $potongan;
                    $convrtTotal = "Rp " . str_replace(",00","",number_format($total,2,',','.'));
                    return $convrtTotal;
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
