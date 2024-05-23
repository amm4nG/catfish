@extends('layouts.app')
@section('title')
    Pemantauan
@endsection
@section('content')
    <main id="main" class="main">

        <div class="pagetitle">
            <h1>Dashboard</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </nav>
        </div><!-- End Page Title -->

        <section class="section dashboard">
            <div class="row">

                <!-- Left side columns -->
                <div class="col-lg-12">
                    <div class="row">

                        <!-- Sales Card -->
                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card sales-card">
                                <div class="card-body">
                                    <h5 class="card-title">Sisa Pakan <span>| Hari Ini</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-hourglass-split"></i>
                                        </div>
                                        <div class="ps-4">
                                            <div class="progress" style="width: 200%;">
                                                <div class="progress-bar progress-bar-striped progress-bar-animated"
                                                    role="progressbar" style="width: <?php echo number_format($percentage); ?>%"
                                                    aria-valuenow="10" aria-valuemin="0" aria-valuemax="100"></div>
                                            </div>
                                            <span class="text-success small pt-1 fw-bold">
                                                <?php echo number_format($percentage); ?>%
                                            </span>
                                            <span class="text-muted small pt-2 ps-1">Tersisa</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-4 col-md-6">
                            <div class="card info-card revenue-card">

                                <div class="filter">
                                    <a class="icon" href="#" type="button" data-bs-toggle="modal"
                                        data-bs-target="#verticalycentered"><i class="bi bi-pencil"></i></a>
                                    <div class="modal fade" id="verticalycentered" tabindex="-1">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title">Edit Data</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <!-- Formulir -->
                                                    <form action="{{ route('update.stok', 1) }}" method="post">
                                                    @csrf
                                                    @method('put')
                                                        <div class="row mb-3">
                                                            <label for="inputNumber" class="col-sm-2 col-form-label">Batas
                                                                Minimum</label>
                                                            <div class="col-sm-10">
                                                                <input type="number" required class="form-control" name="min"
                                                                    id="inputNumber">
                                                            </div>
                                                        </div>


                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-secondary"
                                                                data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary"
                                                                style="background-color: #4159AF;">Save changes</button>
                                                        </div>
                                                    </form>

                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="card-body">
                                    <h5 class="card-title">Minimal <span>| Stok</span></h5>

                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-inboxes"></i>
                                        </div>
                                        <div class="ps-3">


                                            <h6>
                                                {{ $stok->min }} %
                                            </h6>
                                            <!-- <span class="text-success small pt-1 fw-bold"><?php echo number_format(100); ?>%</span> <span class="text-muted small pt-2 ps-1">Hari Ini</span> -->

                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div><!-- End Revenue Card -->

                        <div class="col-xxl-4 col-xl-12">

                            <div class="card info-card customers-card">

                                <div class="card-body">
                                    <h5 class="card-title">Stok <span>| Hari Ini</span></h5>
                                    <div class="d-flex align-items-center">
                                        <div
                                            class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                                            <i class="bi bi-clock"></i>
                                        </div>
                                        <div class="ps-3">
                                            <h6 id="clock" style="font-size: 18px;">
                                                <?php echo date('l, d F Y'); ?>
                                            </h6>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- End Customers Card -->
                        <div class="col-12">
                            <div class="card top-selling overflow-auto">
                                <div class="card-body pb-0">
                                    <h5 class="card-title">Jadwal Pemberian Pakan <span>| Hari Ini</span></h5>
                                    <table class="table datatable">
                                        <thead>
                                            <tr>
                                                <th>No </th>
                                                <th>ID </th>
                                                <th>Tanggal</th>
                                                <th>Stok</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($pakan as $row)
                                                <tr>
                                                    <td>
                                                        {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        <?php echo $row['id']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['tanggal']; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $row['pakan']; ?>
                                                    </td>

                                                    <td>
                                                        <a type="button" data-bs-toggle="modal"
                                                            data-bs-target="#verticalycentered<?php echo $row['id']; ?>">
                                                            <i class="bi bi-pencil"
                                                                style="color: black; font-size: 20px;"></i>
                                                        </a>
                                                        <div class="modal fade" id="verticalycentered<?php echo $row['id']; ?>"
                                                            tabindex="-1">
                                                            <div class="modal-dialog modal-dialog-centered">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title">Edit Data</h5>
                                                                        <button type="button" class="btn-close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        <!-- Formulir -->
                                                                        <form action="update_pakan.php" method="post">
                                                                            <div class="row mb-3">
                                                                                <label for="inputText"
                                                                                    class="col-sm-2 col-form-label">ID</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="text"
                                                                                        class="form-control"
                                                                                        name="id"
                                                                                        value="<?php echo $row['id']; ?>"
                                                                                        readonly>
                                                                                </div>
                                                                            </div>
                                                                            <div class="row mb-3">
                                                                                <label for="inputNumber"
                                                                                    class="col-sm-2 col-form-label">Jumlah</label>
                                                                                <div class="col-sm-10">
                                                                                    <input type="number"
                                                                                        class="form-control"
                                                                                        name="pakan" id="inputNumber"
                                                                                        value="<?php echo $row['pakan']; ?>"
                                                                                        required>
                                                                                </div>
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
                                    data-bs-target="#delete<?php echo $row['id']; ?>">
                                    <i class="bi bi-trash" style="color: black; font-size: 20px;"></i>
                                </a>

                                <div class="modal fade" id="delete<?php echo $row['id']; ?>" tabindex="-1">
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
                                                <form method="post" action="{{ route('pemantauan.destroy', $row->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <input name="id" value="<?php echo $row['id']; ?>" hidden>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-danger"
                                                        style="background-color: red;">Hapus
                                                        Data</button>
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
                            </div>
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
                        <form action="{{ route('pemantauan.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputNumber" class="col-sm-2 col-form-label">Jumlah</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control" name="pakan" id="inputNumber" required>
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
