<div class="form-row">
      <div class="col-md-4">
          <select class="form-control selectize" id="periode" name="periode">
              <option value="" selected disabled>Pilih Periode</option>
              <option value="januari">Januari</option>
              <option value="februari">Februari</option>
              <option value="maret">Maret</option>
              <option value="april">April</option>
              <option value="mei">Mei</option>
              <option value="juni">Juni</option>
              <option value="juli">Juli</option>
              <option value="agustus">Agustus</option>
              <option value="sepetember">September</option>
              <option value="oktober">Oktober</option>
              <option value="november">November</option>
              <option value="desember">Desember</option>
          </select>
      </div>
      <div class="col-sm-1">
        <input type="text" class="form-control" name="tahun" id="tahun" autocomplete="off" placeholder="{{ __('Tahun')}}" value="{{date('Y')}}">
      </div>
      <div class="col-md-2">
          <button class="btn btn-primary " type="submit" id="cari-salary" disabled>Tampilkan Data</button>
      </div>
      <div class="col-md-2">
        <button type="button" class="btn btn-outline-success" id="btn-import-salary" onclick="window.location='{{ route('formSalary') }}'" disabled>{{ __('Insert Data Salary') }}</button>
      </div>
      <div class="col-md-1">
        <a type="button" class="btn btn-outline-primary disabled" href="{{route('getTamplateSalary')}}" id="btn-download-tamplate">{{ __('Download Format Data Salary') }}</a>
      </div>
</div>
  