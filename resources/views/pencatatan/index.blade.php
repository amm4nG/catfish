@extends('layouts.app')
@section('title')
    Pencatatan
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
        <section class="section">
            <div class="row">
                <div class="col-lg-12">

                    <div class="card">
                        <div class="card-body">
                            <h5 class="card-title">Datata Jadwal</h5>
                            <!-- Table with stripped rows -->
                            <table class="table datatable">


                                <thead>
                                    <tr>
                                        <th>No </th>
                                        <th>Waktu</th>
                                        <th style="width: 50%;" class="text-center">Catatan</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($catatan as $row)
                                        <tr>
                                            <td>
                                                {{ $loop->iteration }}
                                            </td>

                                            <td>
                                                <?php echo $row['waktu']; ?>
                                            </td>
                                            <td class="text-center">
                                                <?php echo $row['catatan']; ?>
                                            </td>

                                            <td>
                                                <a type="button" data-bs-toggle="modal"
                                                    data-bs-target="#verticalycentered<?php echo $row['id']; ?>">
                                                    <i class="bi bi-pencil" style="color: black; font-size: 20px;"></i>
                                                </a>
                                                <div class="modal fade" id="verticalycentered<?php echo $row['id']; ?>"
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
                                                                <form action="{{ route('pencatatan.update', $row->id) }}"
                                                                    method="post">
                                                                    @csrf
                                                                    @method('put')
                                                                    <div class="row mb-3">
                                                                        <label for="inputDateTime"
                                                                            class="col-sm-2 col-form-label">Waktu</label>
                                                                        <div class="col-sm-10">
                                                                            <input type="datetime-local" required
                                                                                class="form-control" name="waktu"
                                                                                id="inputDateTime"
                                                                                value="<?php echo $row['waktu']; ?>">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row mb-3">
                                                                        <label for="inputCatatan"
                                                                            class="col-sm-2 col-form-label">Catatan</label>
                                                                        <div class="col-sm-10">
                                                                            <textarea class="form-control" required name="catatan" rows="5"><?php echo $row['catatan']; ?></textarea>
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
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                Apakah yakin ingin
                                                                menghapus data?
                                                            </div>
                                                            <div class="modal-footer">
                                                                <form method="post"
                                                                    action="{{ route('pencatatan.destroy', $row->id) }}">
                                                                    @csrf
                                                                    @method('delete')
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
                        <form action="{{ route('pencatatan.store') }}" method="post">
                            @csrf
                            <div class="row mb-3">
                                <label for="inputDateTime" class="col-sm-2 col-form-label">Waktu</label>
                                <div class="col-sm-10">
                                    <input type="datetime-local" class="form-control" name="waktu" id="inputDateTime"
                                        required>
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="inputCatatan" class="col-sm-2 col-form-label">Catatan</label>
                                <div class="col-sm-10">
                                    <textarea class="form-control" required name="catatan" rows="5"></textarea>
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
