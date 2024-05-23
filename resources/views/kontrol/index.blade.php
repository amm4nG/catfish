@extends('layouts.app')
@section('title')
    Kontrol
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
                            <div class="text-center"
                                style="width: 241px; height: 37px; position: relative; left: 50%; transform: translateX(-50%);">
                                <div
                                    style="width: 241px; height: 37px; left: 0px; top: 0px; position: absolute; background: #D2D2D2; border-radius: 30px">
                                </div>
                                <a href="{{ route('riwayat.index') }}">
                                    <div
                                        style="left: 152px; top: 6px; position: absolute; color: black; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                                        Riwayat</div>
                                </a>
                                <div style="width: 115px; height: 37px; left: 0px; top: 0px; position: absolute">
                                    <div
                                        style="width: 115px; height: 37px; left: 0px; top: 0px; position: absolute; background: #4159AF; border-radius: 30px">
                                    </div>
                                    <div
                                        style="left: 29px; top: 6px; position: absolute; color: white; font-size: 16px; font-family: Poppins; font-weight: 400; word-wrap: break-word">
                                        Jadwal</div>
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
                                    @foreach ($jadwalBelumSelesai as $item)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ $item->tanggal }}</td>
                                            <td>{{ $item->waktu }}</td>
                                            <td>{{ $item->durasi }}</td>
                                            <td>{{ $item->status }}</td>
                                            <td>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#verticalycentered<?php echo $item->id; ?>">
                                                    <i class="bi bi-pencil" style="color: black; font-size: 20px;"></i>
                                                </a>
                                                <div class="modal fade" id="verticalycentered<?php echo $item->id; ?>"
                                                    tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Edit Data</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <!-- Formulir -->
                                                                <form action="{{ route('kontrol.update', $item->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row mb-3">
                                                                        <label for="inputDate"
                                                                            class="col-sm-2 col-form-label">Date</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="date"
                                                                                value="{{ $item->tanggal }}"
                                                                                class="form-control" name="tanggal"
                                                                                value="<?php echo $item['tanggal']; ?> " required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputTime"
                                                                            class="col-sm-2 col-form-label">Waktu</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="time" class="form-control"
                                                                                name="waktu" value="<?php echo $item['waktu']; ?>"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputNumber"
                                                                            class="col-sm-2 col-form-label">Durasi</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="number" class="form-control"
                                                                                name="durasi" value="<?php echo $item['durasi']; ?>"
                                                                                required>
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label
                                                                            class="col-sm-2 col-form-label">Select</label>
                                                                        <div class="col-sm-10">
                                                                            <select class="form-select"
                                                                                aria-label="Default select example"
                                                                                name="status" required>
                                                                                <option value="<?php echo $item['status']; ?>"
                                                                                    selected>Pilih Status</option>
                                                                                <option value="Selesai">Selesai</option>
                                                                                <option value="Belum">Belum</option>
                                                                            </select>
                                                                        </div>
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">Close</button>
                                                                        <button type="submit" class="btn btn-primary"
                                                                            style="background-color: #4159AF;">Save
                                                                            changes</button>
                                                                    </div>
                                                                </form>

                                                            </div>

                                                        </div>
                                                    </div>
                                                </div>

                                                <a type="button" class="px-2" data-bs-toggle="modal"
                                                    data-bs-target="#delete<?php echo $item->id; ?>">
                                                    <i class="bi bi-trash" style="color: black; font-size: 20px;"></i>
                                                </a>

                                                <div class="modal fade" id="delete<?php echo $item->id; ?>" tabindex="-1">
                                                    <div class="modal-dialog modal-dialog-centered">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title">Hapus Data</h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
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
                                                                    <input name="id" value="<?php echo $item->id; ?>"
                                                                        hidden>
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
        <a data-bs-toggle="modal" data-bs-target="#adddata">
            <div
                style="position: fixed; bottom: 20px; right: 20px; width: 60px; height: 60px; background: #4159AF; border-radius: 50%; text-align: center;">
                <i class="bi bi-plus-lg"
                    style="font-size: 35px; font-weight: bold; color: white; position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%);"></i>
            </div>
        </a>

        <div class="modal fade" id="adddata" tabindex="-1">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Tambah Data</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form action="{{ route('kontrol.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputDate" class="col-sm-2 col-form-label">Date</label>
                                <div class="col-sm-10">
                                    <input type="date" class="form-control" name="tanggal" id="inputDate" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputTime" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-10">
                                    <input type="time" class="form-control" name="waktu" id="inputTime" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Durasi</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="durasi" id="inputNumber" required>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary"
                                    style="background-color: #4159AF;">Tambah</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@if (session('message'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: "success",
                title: "Berhasil",
                text: "{{ session('message') }}",
                showConfirmButton: true
            })
        </script>
    @endpush
@endif
