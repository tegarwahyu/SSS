<!DOCTYPE html>
<html>
<head>
	<title>Slip Gaji</title>

    <style>
        .table-borderless > tbody > tr > td,
        .table-borderless > tbody > tr > th,
        .table-borderless > tfoot > tr > td,
        .table-borderless > tfoot > tr > th,
        .table-borderless > thead > tr > td,
        .table-borderless > thead > tr > th {
            border: none;
        }

    </style>
</head>
<body>

    <div class="container">
        <div class="table-responsive-md">


            <table class="table table-borderless" border="1" style="background-color:#cde6f5 !important; table-layout: fixed;
            overflow: hidden;
            text-overflow: ellipsis; width: max-content;">
                <thead>
                <tr>
                    <th scope="col"><img src="{{ asset('assets/img/logosahabat.png') }}" alt="" style="width: 65% !important;"></img></th>
                    <th colspan="3"><center>SLIP GAJI KARYAWAN<br>
                        PT SAHABAT SAKINAH SENTER<br>
                        SURABAYA</center></th>
                </tr>
                </thead>
                <tbody>
                <tr>
                    <td>Urut  <br>
                        Nama  <br>
                        Employee ID <br></td>
                    <td><?php foreach($noUrut as $i => $k){
                        if ($dataUser->employee_id == $noUrut[$i]->employee_id){
                            echo $i+1;
                        }
                    }?><br>
                        <?php echo $dataUser->fullname ;?><br>
                        <?php echo $dataUser->employee_id ;?><br>
                    </td>
                    <td>Periode   <br>
                        Jabatan   <br>
                        Actualy Working Days
                    </td>
                    <td><?php echo date("M-Y", strtotime($dataSalary->salary_periode));?><br>
                        <?php echo $jabatanUser[0]->name ;?><br>
                        <?php echo date("d-M-Y", strtotime($dataUser->join_date)); ?>
                    </td>
                </tr>
                <tr>
                    <td><strong><u>Pendapatan</u></strong><br><br>
                        Gaji Pokok  <br>
                        Tunjangan Jabatan  <br>
                        Tunjangan Makan  <br>
                        Tunjangan Transport  <br>
                        Loyalty Reward  <br>
                        Overtime  <br>
                        Insentif  <br>
                        Attending  <br>
                        Rapel  <br>
                        Bonus  <br>

                        <br><br>
                        <strong>TOTAL PENDAPATAN  </strong>
                    </td>
                    <td><br><br>
                        : Rp  <?php echo str_replace(",00","",number_format($dataSalary->gaji_pokok,2,',','.'));?><br>
                        : Rp  <?php echo ($dataSalary->tunjangan_jabatan == null || $dataSalary->tunjangan_jabatan == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->tunjangan_jabatan));?><br>
                        : Rp  <?php echo ($dataSalary->tunjangan_makan == null || $dataSalary->tunjangan_makan == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->tunjangan_makan));?><br>
                        : Rp  <?php echo ($dataSalary->tunjangan_transport == null || $dataSalary->tunjangan_transport == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->tunjangan_transport));?><br>
                        : Rp  <?php echo ($dataSalary->loyal_reward == null || $dataSalary->loyal_reward == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->loyal_reward));?><br>
                        : Rp  <?php echo ($dataSalary->overtime == null || $dataSalary->overtime == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->overtime));?><br>
                        : Rp  <?php echo ($dataSalary->insentif == null || $dataSalary->insentif == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->insentif));?><br>
                        : Rp  <?php echo ($dataSalary->attending == null || $dataSalary->attending == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->attending));?><br>
                        : Rp  <?php echo ($dataSalary->rapel == null || $dataSalary->rapel == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->rapel));?><br>
                        : Rp  <?php echo ($dataSalary->bonus == null || $dataSalary->bonus == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->bonus));?><br>
                        _______________________+<br><br>
                        : Rp  <?php echo str_replace(",",".",number_format(($dataSalary->gaji_pokok + $dataSalary->tunjangan_jabatan + $dataSalary->tunjangan_makan + $dataSalary->tunjangan_transport + $dataSalary->loyal_reward + $dataSalary->overtime + $dataSalary->insentif + $dataSalary->attending + $dataSalary->rapel + $dataSalary->bonus)))?></bold>
                    </td>
                    <td><strong><u>Potongan</u></strong><br><br>
                        Late Reducetion  <br>
                        Absent Reducetion  <br>
                        Other Reducetion  <br>
                        Cash Advance Deduction  <br>
                        BPJS TK (3%)  <br>
                        BPJS Kes (1%)  <br>
                        PPh 21  <br><br><br><br><br><br>
                        <strong>TOTAL POTONGAN  </strong>
                    </td>
                    <td><br><br>
                        : Rp  <?php echo ($dataSalary->late_reduce == null || $dataSalary->late_reduce == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->late_reduce));?><br>
                        : Rp  <?php echo ($dataSalary->absent_reduce == null || $dataSalary->absent_reduce == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->absent_reduce));?><br>
                        : Rp  <?php echo ($dataSalary->other_reduce == null || $dataSalary->other_reduce == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->other_reduce));?><br>
                        : Rp  <?php echo ($dataSalary->cash_advance_reduce == null || $dataSalary->cash_advance_reduce == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->cash_advance_reduce));?><br>
                        : Rp  <?php echo ($dataSalary->bpjs_tk == null || $dataSalary->bpjs_tk == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->bpjs_tk));?><br>
                        : Rp  <?php echo ($dataSalary->bpjs_ks == null || $dataSalary->bpjs_ks == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->bpjs_ks));?><br>
                        : Rp  <?php echo ($dataSalary->pph_21 == null || $dataSalary->pph_21 == 0) ?  '-' : str_replace(",",".",number_format($dataSalary->pph_21));?><br><br><br><br>
                        _______________________+<br><br>
                        : Rp  </strong><?php echo str_replace(",",".",number_format(($dataSalary->late_reduce + $dataSalary->absent_reduce + $dataSalary->other_reduce + $dataSalary->cash_advance_reduce + $dataSalary->bpjs_tk + $dataSalary->bpjs_ks + $dataSalary->pph_21)))?></strong>
                    </td>
                </tr>
                <tr style="background-color: #7ac0e9 !important;">
                    <th colspan="2"><center>GAJI YANG DITERIMA  :</center></th>
                    <th colspan="2"><center>RP <?php  $pendapatan = $dataSalary->gaji_pokok + $dataSalary->tunjangan_jabatan + $dataSalary->tunjangan_makan + $dataSalary->tunjangan_transport + $dataSalary->loyal_reward + $dataSalary->overtime + $dataSalary->insentif + $dataSalary->attending + $dataSalary->rapel + $dataSalary->bonus;
                                                   $potongan = $dataSalary->late_reduce + $dataSalary->absent_reduce + $dataSalary->other_reduce + $dataSalary->cash_advance_reduce + $dataSalary->bpjs_tk + $dataSalary->bpjs_ks + $dataSalary->pph_21;
                                                   echo str_replace(",",".",number_format(($pendapatan - $potongan)));
                                                ?>
                                    </center></th>
                </tr>
                <tr>
                    <td colspan="4"><small>*Kekurangan pembayaran akan dibayarkan pada penggajian bulang berikutnya</small><br>
                                    <small>**kelebihan pembayaran gaji bulan, akan dipotong pada bulan berikutnya</small><br>
                        Sisa Cuti : <br>
                        Cuti Berlaku :<br></td>
                </tr>
                </tbody>
            </table>
        </div>
    </div>

	<script src="{{ asset('assets/vendor/jquery/jquery.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/popper.min.js') }}"></script>
	<script src="{{ asset('assets/vendor/bootstrap/dist/js/bootstrap.min.js') }}"></script>
</body>
</html>
