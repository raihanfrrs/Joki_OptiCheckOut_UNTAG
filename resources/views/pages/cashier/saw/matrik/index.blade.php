@extends('layouts.main')

@section('section-content')
<div class="container-xxl flex-grow-1 container-p-y">
    <div class="card mb-4">
      <div class="card-header border-bottom">
        <h5 class="card-title mb-3">Matriks Keputusan (X)</h5>
        <div class="alert alert-primary" role="alert">
            <h5 class="alert-heading mb-2">Matriks Keputusan (X) & Ternomalisasi (R)</h5>
            <p class="mb-0">
              Melakukan perhitungan normalisasi untuk mendapatkan matriks nilai ternomalisasi (R), dengan ketentuan : Untuk normalisasi nilai, jika faktor/attribute kriteria bertipe cost maka digunakan rumusan: Rij = ( min{Xij} / Xij) sedangkan jika faktor/attribute kriteria bertipe benefit maka digunakan rumusan: Rij = ( Xij/max{Xij} ).
            </p>
        </div>
        <button class="btn btn-primary btn-sm" id="button-trigger-modal-add-alternative-matrik" type="button" data-bs-target="#modalAddAlternativeMatrik" aria-controls="modalAddAlternativeMatrik" data-bs-toggle="modal"><i class="ti ti-stack-push me-2"></i> Data Alternatif</button>
      </div>
      <div class="table-responsive text-nowrap table-responsive">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>Alternatif</th>
              <th>Kriteria</th>
            </tr>
            <tr>
                <th></th>
                <th>C1</th>
                <th>C2</th>
                <th>C3</th>
                <th>C4</th>
                <th></th>
            </tr>
          </thead>
          <tbody class="table-border-bottom-0">
            @foreach ($alternative_matriks as $alternative_matrik)
              <tr>
               <td>{{ $alternative_matrik->product->name }}</td>
               {{-- <td>A<sub>{{ $loop->iteration }}</sub></td> --}}
               <td>@rupiah($alternative_matrik->price->price)</td>
               <td>{{ $alternative_matrik->temperature->name ?? 0 }}</td>
               <td>{{ $alternative_matrik->size->name ?? 0 }}</td>
               <td>{{ $alternative_matrik->topping->name ?? 0 }}</td>
               <td>
                <button type="button" class="btn btn-icon rounded-pill btn-outline-reddit waves-effect me-2" id="button-trigger-modal-edit-alternative-matrik" data-id="{{ $alternative_matrik->id }}" data-bs-target="#modalEditAlternativeMatrik" aria-controls="modalEditAlternativeMatrik" data-bs-toggle="modal">
                    <i class="tf-icons ti ti-pencil"></i>
                </button>
                <form action="{{ route('cashier.matrik.delete', $alternative_matrik->id) }}" method="post" class="d-inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-icon rounded-pill btn-outline-youtube waves-effect">
                        <i class="tf-icons ti ti-trash"></i>
                    </button>
                </form>
               </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>

    </div>

    <div class="card">
        <div class="card-header border-bottom">
          <h5 class="card-title mb-3">Matriks Ternormalisasi (R)</h5>
        </div>
        <div class="table-responsive text-nowrap table-responsive">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Alternatif</th>
                <th>Kriteria</th>
              </tr>
              <tr>
                  <th></th>
                  <th>C1</th>
                  <th>C2</th>
                  <th>C3</th>
                  <th>C4</th>
                  <th></th>
              </tr>
            </thead>
            <tbody class="table-border-bottom-0">
              @foreach ($normalization_matriks as $normalization_matrik)
                  <tr>
                    {{-- <td>A<sub>{{ $loop->iteration }}</sub></td> --}}
                    <td>{{ $normalization_matrik->alternative_matrik->product->name }}</td>
                    <td>{{ $normalization_matrik->price }}</td>
                    <td>{{ $normalization_matrik->temperature ?? 0 }}</td>
                    <td>{{ $normalization_matrik->size ?? 0 }}</td>
                    <td>{{ $normalization_matrik->topping ?? 0 }}</td>
                  </tr>
              @endforeach
            </tbody>
          </table>
        </div>
  
      </div>
</div>
@endsection