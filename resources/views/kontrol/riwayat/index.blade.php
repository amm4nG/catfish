@extends('layouts.app')
@section('title')
    Riwayat
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Data Tables</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">Tables</li>
                    <li class="breadcrumb-item active">Data</li>
                </ol>
            </nav>
        </div>
        <section class="section dashboard">
            <div class="row">
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card sales-card">
                        <div class="card-body">
                            <h5 class="card-title">Jadwal <span>| Hari Ini</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-day"></i>
                                </div>
    
                                <div class="ps-3">
                                    <h6>
                                        {{ optional($jadwalHariIni)->count() }}
                                    </h6>
                                    <span class="text-success small pt-1 fw-bold">
                                        {{ number_format($percentageTerlaksana) }}%
                                    </span>
                                    <span class="text-muted small pt-2 ps-1">Terlaksana</span>
                                </div>
    
                            </div>
                        </div>
                    </div>
                </div><!-- End Sales Card -->
    
                <!-- Revenue Card -->
                <div class="col-xxl-4 col-md-6">
                    <div class="card info-card revenue-card">
                        <div class="card-body">
                            <h5 class="card-title">Daftar <span>| Jadwal</span></h5>
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-calendar-week"></i>
                                </div>
                                <div class="ps-3">
    
                                    <h6>
                                        {{ $jadwal->count() }}
                                    </h6>
                                    <span class="text-success small pt-1 fw-bold">
                                        {{ number_format($percentageJadwal) }}%
                                    </span> <span class="text-muted small pt-2 ps-1">Hari Ini</span>
    
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- End Revenue Card -->
    
                <!-- Customers Card -->
                <div class="col-xxl-4 col-xl-12">
                    <div class="card info-card customers-card">
                        <div class="card-body">
                            <h5 class="card-title">Riwayat <span>| Pemberian</span></h5>
    
                            <div class="d-flex align-items-center">
                                <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                    <i class="bi bi-clock-history"></i>
                                </div>
                                <div class="ps-3">
                                    <h6>
                                        {{ $completedCount }}
                                    </h6>
                                    <span class="text-danger small pt-1 fw-bold">
                                        {{ number_format($percentage) }}%
                                    </span> <span class="text-muted small pt-2 ps-1">Dari Jadwal</span>
    
                                </div>
                            </div>
    
                        </div>
                    </div>
    
                </div><!-- End Customers Card -->
    
                <!-- Reports -->
                <div class="col-12">
    
                </div><!-- End Reports -->
    
                <!-- Recent Sales -->
    
                <div class="col-lg-12">
    
                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Data Jadwal</h5>
                            <div style="width: 241px; height: 37px; position: relative; left: 50%; transform: translateX(-50%);">
                                <div style="width: 241px; height: 37px; left: 0px; top: 0px; position: absolute">
                                    <div
                                        style="width: 241px; height: 37px; left: 0px; top: 0px; position: absolute; background: #D2D2D2; border-radius: 30px">
                                    </div>
                                    <a href="{{ route('kontrol.index') }}">
                                        <div
                                            style="left: 29px; top: 6px; position: absolute; color: black; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                                            Jadwal</div>
                                    </a>
                                </div>
                                <div style="width: 115px; height: 37px; left: 126px; top: 0px; position: absolute">
                                    <div
                                        style="width: 115px; height: 37px; left: 0px; top: 0px; position: absolute; background: #4159AF; border-radius: 30px">
                                    </div>
                                    <div
                                        style="left: 26px; top: 6px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                                        Riwayat</div>
                                </div>
                            </div>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">
                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Tanggal</th>
                                        <th>Waktu</th>
                                        <th>Durasi</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($jadwalSelesai as $item)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $item->tanggal }}</td>
                                        <td>{{ $item->waktu }}</td>
                                        <td>{{ $item->durasi }}</td>
                                        <td>{{ $item->status }}</td>
                                        <td> 
                                            <a type="button" class="px-2" data-bs-toggle="modal"
                                                data-bs-target="#delete<?php echo $item->id; ?>">
                                                <i class="bi bi-trash" style="color: black; font-size: 20px;"></i>
                                            </a>
    
                                            <div class="modal fade" id="delete<?php echo $item->id; ?>" tabindex="-1">
                                                <div class="modal-dialog modal-dialog-centered">
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title">Hapus Data</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                                aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            Apakah yakin ingin
                                                            menghapus data?
                                                        </div>
                                                        <div class="modal-footer">
                                                            <form method="post"
                                                                action="{{ route('kontrol.destroy', $item->id) }}">
                                                                @csrf
                                                                @method('delete')
                                                                <input name="id" value="<?php echo $item->id; ?>" hidden>
                                                                <button type="button" class="btn btn-secondary"
                                                                    data-bs-dismiss="modal">Close</button>
                                                                <button type="submit" class="btn btn-danger"
                                                                    style="background-color: red;">Hapus Data</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            <!-- End Table with stripped rows -->
                        </div>
                    </div>
    
                </div>
            </div>
            </div>
        </section> 
    </main>
@endsection