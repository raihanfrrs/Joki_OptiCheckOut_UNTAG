@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Tabel Nilai Preferensi (P)</h5>
        <div class="alert alert-primary" role="alert">
            <h5 class="alert-heading mb-2">Matriks Keputusan (X) & Ternomalisasi (R)</h5>
            <p class="mb-0">
              Nilai preferensi (P) merupakan penjumlahan dari perkalian matriks ternormalisasi R dengan vektor bobot W.
            </p>
        </div>
      </div>
      <div class="table-responsive text-nowrap table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
                <th>No</th>
                <th>Alternatif</th>
                <th>Hasil</th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($preferences_matriks as $preferences_matrik)
              <tr>
               <td>{{ $loop->iteration }}</td>
               <td>{{ $preferences_matrik->normalization_matrik->alternative_matrik->product()->withTrashed()->first()->name }}</td>
               <td>{{ $preferences_matrik->value}}</td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

    <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">Tabel Hasil Perangkingan</h5>
        </div>
        <div class="table-responsive text-nowrap table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Alternatif</th>
                <th>Nilai</th>
                <th>Ranking</th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($preferences_matrik_ranks as $preferences_matrik_rank)
                  <tr>
                    <td>{{ $preferences_matrik_rank->normalization_matrik->alternative_matrik->product->name }}</td>
                    <td>{{ $preferences_matrik_rank->value}}</td>
                    <td>{{ $loop->iteration }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  
    </div>
</div>
@endsection