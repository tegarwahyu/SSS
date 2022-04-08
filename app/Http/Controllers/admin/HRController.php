<?php

namespace App\Http\Controllers\admin;

use App\Imports\UsersImport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class HRController extends Controller
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
    // ke view hr
    public function index()
    {
        $dataRole = Role::where('name','!=','Super Admin')->get();
        return view('admin.hr.index',['dataRole'=>$dataRole]);
    }

    public function editUser($id)
    {
        // $dataUser = User::find($id);
        // $dataUser = User::where('id',$id)->with(['roles' => function ($query) {
        //                 $query->where('name', '=', 'jabatan');
        //             }])->get();
        $dataUser = User::where('id','=',$id)->with('roles')->get();
        // dd($dataUser);
        // return view('admin.hr.uploadFile',['dataUser'=>$dataUser]);
        return $dataUser;
    }

    // ke view tabel user yang tidak aktif
    public function viewUserTidakAktif(){
        return view('admin.hr.pegawaiTidakAktif');
    }

    //data table user
    public function getDataUser($id){
        if($id == 1){
            // $users = User::where('email','!=','admin@local.host')->where('user_status','!=','aktif')->get();
            $users = User::whereNotIn('fullname',['Super Admin'])
            ->whereNotIn('fullname',['akun hrd'])
            ->where('user_status','!=','aktif')
            ->orderBy('id', 'ASC')
            ->get();
        }else{
            $users = User::whereNotIn('fullname',['Super Admin'])
            ->whereNotIn('fullname',['akun hrd'])
            ->where('user_status','!=','tidak aktif')
            ->orderBy('id', 'ASC')
            ->get();
        }
        // dd($users);
        $tb = Datatables::of($users)
                ->addIndexColumn()
                ->addColumn('employee_id', function($user){
                    return ($user->employee_id != null) ? $user->employee_id : 'employee_id kosong';
                })
                ->addColumn('full_name', function($user){
                    return $user->NamaLengkap;
                })
                ->addColumn('ktp', function($user){
                    return ($user->ktp != null) ? $user->ktp : '-';
                })
                ->addColumn('passport', function($user){
                    return ($user->passport != null) ? $user->passport : '-';
                })
                ->addColumn('domisili ', function($user){
                    // dd($data->domisili);
                    return ($user->almt_domisili) ? $user->almt_domisili : '-';
                })
                ->addColumn('no_hp ', function($user){
                    return ($user->tlp_hp  != null) ? $user->tlp_hp  : '-';
                })
                ->addColumn('noteUser', function($user){
                    $data = json_decode($user->note);
                    $note = '';
                    if(json_decode($user->note) == null){
                        $note .= '-';
                    }elseif((!empty(json_decode($user->note)->note2)) && (!empty(json_decode($user->note)->note3))){
                        $note .= $data->note3;
                    }elseif((!empty(json_decode($user->note)->note1)) && (!empty(json_decode($user->note)->note2))){
                        $note .= $data->note2;
                    }else{
                        $note .= $data->note1;
                    }
                    return $note;
                    // return $user->note;
                })
                ->addColumn('status', function($data){
                    $return = "";
                        if($data->user_status == 'aktif' && $data->user_status != null){
                            $return .= '<a style="color: green;" title="Menonaktifkan Karyawan">Aktif</a>';
                            // onclick="nonaktif_user('.$data->id.')"
                        }else{
                            $return .= '<a style="color: red;" title="Mengaktifkan Karyawan">Non Aktif</a>';
                        }
                    return $return;
                })

                ->addColumn('action', function($data){
                    $user = auth()->user();
                    $buttonAction = "";

                    $btnEmployee = "";
                    if($data->user_status == 'aktif' && $data->user_status != null){ //mengecek apakah user aktif atau tidak
                        $btnEmployee = '<a href="#" class="dropdown-item" onclick="nonaktif_user('.$data->id.')"><i class="ikon ni ni-single-02"></i>Non Aktifkan Karyawan</a>';
                    }else{
                        $btnEmployee = '<a href="#" class="dropdown-item" onclick="aktif_user('.$data->id.')"><i class="ikon ni ni-single-02"></i>Aktifkan Karyawan</a>';
                    }

                    if($user->hasAnyRole(['HR Manager','Super Admin'])){ //menu button untuk hr manager dan super admin
                    $buttonAction .='
                            <div class="btn-group dropleft">
                            <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                Menu
                            </button>
                                <div class="dropdown-menu">
                                    <a class="dropdown-item" href="#" onclick="editUser('. $data->id .')"><i class="ikon ni ni-single-02"></i>Ubah Data Karyawan</a>
                                    '.$btnEmployee.'

                                </div>
                            </div>
                        </div>';
                        // <a class="dropdown-item disabled">Lihat Data Karyawan</a>
                    }
                    if($user->hasAnyRole(['HR Staff'])){ //menu untuk hr staff
                    $buttonAction .='
                        <div class="btn-group dropleft">
                        <button type="button" class="btn btn-secondary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Menu
                        </button>
                            <div class="dropdown-menu">
                                <a class="dropdown-item" href="#" onclick="editUser('. $data->id .')"><i class="ikon ni ni-single-02"></i>Ubah Data Karyawan</a>
                            </div>
                        </div>
                    </div>';
                    }
                    return $buttonAction;
                    })
                    ->escapeColumns([])
                    ->make(true);
            return $tb;
    }

    // ke view upload data
    public function uploadDataView(){
        $dataRole = Role::where('name','!=','Super Admin')->get();
        return view('admin.hr.uploadFile',['dataRole'=>$dataRole]);
        // return view('admin.hr.uploadFile');
    }

    // insert user by upload excel and save file excel in public file/DataKaryawan
    public function uploadData(Request $request){
        Excel::import(new UsersImport,  $request->file('file_excel_karyawan'));
        return redirect()->route('hr');
    }

    //download tamplate excel user
    public function getTamplateExcel(){
        $filepath = public_path('/storage/FormatDokumen/Data Karyawan.xlsx');
        // dd(file_exists($filepath));
        if (file_exists($filepath)) {
            return Response()->download($filepath);
        }
    }

    //edit status by id user
    public function editstatus($id){
        $status_user = User::find($id);
        $data = "";
        if($status_user->user_status == 'aktif'){
            $data .= User::find($id)->update(['user_status'=>'tidak aktif']);
        }else{
            $data .= User::find($id)->update(['user_status'=>'aktif']);
        }
        return $data;
    }

    public function deactiveUser(Request $request){
        $status_user = User::find($request->id);
        $data = "";
        if($status_user->user_status == 'aktif'){
            $data .= User::find($request->id)->update(['user_status'=>'tidak aktif']);

                // limit note max 3x
                $getNoteUserById = User::find($request->id);
                // dd(json_decode($getNoteUserById->note) == null);
                if(!empty($request->noteValue)){
                    // cek apakah note sudah ada apa tidak jika kosong maka insert baru
                    if(json_decode($getNoteUserById->note) == null){
                        $note = [
                            'note1'=>$request->noteValue
                        ];
                        $getDataUserById = User::find($request->id)->update(['note'=>json_encode($note)]);
                        return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    }
                    // jika note1 sudah ada maka membuat note2
                    elseif(json_decode($getNoteUserById->note)->note1 != null){
                        $note = [
                            'note1'=>json_decode($getNoteUserById->note)->note1,
                            'note2'=>$request->noteValue
                        ];
                        $getDataUserById = User::find($request->id)->update(['note'=>json_encode($note)]);
                        return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    }
                    // jika note1 sudah ada maka membuat note3, bila mana sudah 3x maka akan overwrite
                    elseif(json_decode($getNoteUserById->note)->note2 != null){
                        $note = [
                            'note1'=>json_decode($getNoteUserById->note)->note1,
                            'note2'=>json_decode($getNoteUserById->note)->note2,
                            'note3'=>$request->noteValue
                        ];
                        $getDataUserById = User::find($request->id)->update(['note'=>json_encode($note)]);
                        return 'user telah di nonaktifkan dan diberikan note'. $request->noteValue;
                    }else{
                        return redirect()->back()->with('failedDeactiveUser', 'Gagal memberi note pada Karyawan');
                    }
                }
        }
        return $data;
    }

    // inser user
    public function create(Request $request)
    {
        // mengambil id yang terbesar dari db
        $getLastIDSSS = User::orderBy('employee_id', 'desc')->value('employee_id');
        // setelah id nya di ambil lalu diambil angkanya langsung di tambahkan 1
        $strPlus = preg_replace("/[^a-zA-Z0-9]/", "", filter_var($getLastIDSSS, FILTER_SANITIZE_NUMBER_INT)) + 1;
        $idUser = 'ID-SSS'.$strPlus;

        $validator = Validator::make($request->all(), [
            'ktp' => 'required|string|min:8|unique:users',
            'kk' => 'string|nullable',
            'fullname'=>'required|string|max:255|min:3',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'passport' =>'string|nullable',
            'password'=>'required|min:6|confirmed',
            'sosmed'=>'string|nullable',
            // 'ec_families'=>'string|nullable',
            //json format graduated_from graduated_from:{SD:{'nama':'','jurusan':'','program':'',....}} for future use.
            // 'graduated_from'=>'string|nullable',

        ]);
        // $phone = [
        //     'rumah'=>$request['phone_rumah'],
        //     'hp'=>$request['phone_hp']
        // ];

        // $address = [
        //     'domisili'=>$request['alamat_domisili'],
        //     'ktp'=>$request['alamat_ktp']
        // ];

        $data = [
            'employee_id' => $idUser,
            'ktp' => $request['ktp'],
            'kk' => $request['kk'],
            'passport' => $request['passport'],
            'npwp' => $request['npwp'],
            'fullname' => $request['fullname'],
            'almt_ktp' => $request['alamat_ktp'],
            'almt_domisili' => $request['alamat_domisili'],
            'tempat_lahir' => $request['tempat_lahir'],
            'tanggal_lahir' => $salaryDate=date('Y-m-d',strtotime($request['tanggal_lahir'])),
            'email' => $request['email'],
            'tlp_rumah' => $request['telp_rumah'],
            'tlp_hp' => $request['telp_hp'],
            'jabatan' => $request['jabatan'],
            'divisi' => $request['divisi'],
            'agama' => $request['agama'],
            'status_pernikahan' => $request['status_pernikahan'],
            'kewarganegaraan' => $request['kewarganegaraan'],
            'golongan_darah' => $request['darah'],
            'sosmed'=>$request['sosmed'],
            // 'ec_families'=>$request['ec_families'],
            // 'graduated_from'=>$request['graduated_from'],
            'password' => $request['password'],
        ];

        $user = User::create($data);

        $roles = $request['jabatan'];
        if(isset($roles)){
            $role_r = Role::where('id', '=', $roles)->firstOrFail();
            $user->assignRole($role_r); //Assigning role to user
        }

        return $user;
    }


    public function updateUser(Request $request){ //perlu di update ini
        // dd($request);
        $getDataUser = User::find($request->id_user);
        $validator = Validator::make($request->all(), [
            'ktp' => 'required|string|min:8|unique:users',
            'kk' => 'string|nullable',
            'fullname'=>'required|string|max:255|min:3',
            'email' =>'required|string|email|max:255|min:3|unique:users',
            'passport' =>'string|nullable',
            'password'=>'required|min:6|confirmed',
            'sosmed'=>'string|nullable',
            // 'ec_families'=>'string|nullable',
            //json format graduated_from graduated_from:{SD:{'nama':'','jurusan':'','program':'',....}} for future use.
            // 'graduated_from'=>'string|nullable',

        ]);

        $data = [
            // 'employee_id' => $idUser,
            'fullname' => ($request['fullname'] !== null) ? $request['fullname'] : $getDataUser->fullname,
            'email' => ($request['email'] !== null) ? $request['email'] : $getDataUser->email,
            'tlp_hp' => ($request['phone_hp'] !== null) ? $request['phone_hp'] : $getDataUser->tlp_hp,
            'tlp_rumah' => ($request['phone_rumah'] !== null) ? $request['phone_rumah'] : $getDataUser->tlp_rumah,
            'passport' => ($request['passport'] !== null) ?$request['passport'] : $getDataUser->passport,
            'ktp' => ($request['ktp'] !== null) ?$request['ktp'] : $getDataUser->ktp,
            'kk' => ($request['kk'] !== null) ?$request['kk'] : $getDataUser->kk,
            'npwp' => ($request['npwp'] !== null) ?$request['npwp'] : $getDataUser->npwp,
            'jabatan' => ($request['jabatan'] !== null) ?$request['jabatan'] : $getDataUser->jabatan,
            'almt_ktp' => ($request['alamat_ktp'] !== null) ?$request['alamat_ktp'] : $getDataUser->almt_ktp,
            'status_pernikahan' => ($request['status_pernikahan'] !== null) ?$request['status_pernikahan'] : $getDataUser->status_pernikahan,
            'agama' => ($request['agama'] !== null) ?$request['agama'] : $getDataUser->agama,
            'kewarganegaraan' => ($request['kewarganegaraan'] !== null) ?$request['kewarganegaraan'] : $getDataUser->kewarganegaraan,
            'golongan_darah' => ($request['darah'] !== null) ?$request['darah'] : $getDataUser->golongan_darah,
            'almt_domisili' => ($request['alamat_domisili'] !== null) ?$request['alamat_domisili'] : $getDataUser->almt_domisili,
            'password' => ($request['password'] !== null) ?$request['password'] : $getDataUser->password,
        ];
        $getDataUser->update($data);
        return $getDataUser;
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
