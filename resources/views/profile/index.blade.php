@extends('layouts.app')
@section('title')
    My Profile
@endsection
@section('content')
    <main id="main" class="main">
        <div class="pagetitle">
            <h1>Profile</h1>
            <nav>
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                    <li class="breadcrumb-item">User</li>
                    <li class="breadcrumb-item active">Profile</li>
                </ol>
            </nav>
        </div>
        <section class="section profile">
            <div class="row">
                <div class="col-xl-4">

                    <div class="card">
                        <div class="card-body profile-card pt-4 d-flex flex-column align-items-center">
                            @if (Auth::user()->foto != '')
                                <img src="{{ asset('public/' . Auth::user()->foto) }}" alt="Profile"
                                    class="rounded-circle">
                            @else
                                <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile" class="rounded-circle">
                            @endif
                            <h2>
                                {{ Auth::user()->nama }}
                            </h2>
                            <h3>
                                {{ Auth::user()->email }}
                            </h3>

                        </div>
                    </div>

                </div>

                <div class="col-xl-8">

                    <div class="card">
                        <div class="card-body pt-3">
                            <!-- Bordered Tabs -->
                            <ul class="nav nav-tabs nav-tabs-bordered">

                                <li class="nav-item">
                                    <button class="nav-link active" data-bs-toggle="tab"
                                        data-bs-target="#profile-overview">Overview</button>
                                </li>

                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab" data-bs-target="#profile-edit">Edit
                                        Profile</button>
                                </li>


                                <li class="nav-item">
                                    <button class="nav-link" data-bs-toggle="tab"
                                        data-bs-target="#profile-change-password">Ganti Password</button>
                                </li>

                            </ul>
                            <div class="tab-content pt-2">

                                <div class="tab-pane fade show active profile-overview" id="profile-overview">

                                    <h5 class="card-title">Profile Details</h5>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label ">Nama</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->nama }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Username</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->username }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Email</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->email }}
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-lg-3 col-md-4 label">Alamat</div>
                                        <div class="col-lg-9 col-md-8">
                                            {{ Auth::user()->alamat }}
                                        </div>
                                    </div>

                                </div>

                                <div class="tab-pane fade profile-edit pt-3" id="profile-edit">

                                    <!-- Profile Edit Form -->
                                    <form method="post" action="{{ route('profile.update', Auth::user()->id) }}"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="profileImage" class="col-md-4 col-lg-3 col-form-label">Profile
                                                Image</label>
                                            <div class="col-md-8 col-lg-9">
                                                @if (Auth::user()->foto != '')
                                                    <img src="{{ asset('public/' . Auth::user()->foto) }}" alt="Profile"
                                                        class="rounded-circle">
                                                @else
                                                    <img src="{{ asset('assets/img/profile-img.jpg') }}" alt="Profile"
                                                        class="rounded-circle">
                                                @endif
                                                <div class="pt-2">
                                                    <input name="foto" type="file" class="form-control"
                                                        id="foto">
                                                </div>
                                            </div>
                                        </div>


                                        <div class="row mb-3">
                                            <label for="nama" class="col-md-4 col-lg-3 col-form-label">Nama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="nama" required type="text" class="form-control"
                                                    id="nama" value="{{ Auth::user()->nama }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="username" class="col-md-4 col-lg-3 col-form-label">Username</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="username" required type="text" class="form-control"
                                                    id="username" value="{{ Auth::user()->username }}">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="email" class="col-md-4 col-lg-3 col-form-label">Email</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="email" required type="email" class="form-control"
                                                    id="email" value="{{ Auth::user()->email }}">
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <label for="alamat" class="col-md-4 col-lg-3 col-form-label">Alamat</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="alamat" required type="text" class="form-control"
                                                    id="alamat" value="{{ Auth::user()->alamat }}">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Save Changes</button>
                                        </div>
                                    </form>
                                </div>
                                <div class="tab-pane fade pt-3" id="profile-change-password">
                                    <form method="post" action="{{ route('change.password', Auth::user()->id) }}">
                                        @csrf
                                        @method('put')
                                        <div class="row mb-3">
                                            <label for="passwordLama" class="col-md-4 col-lg-3 col-form-label">Password
                                                Lama</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="passwordLama" required type="password" class="form-control"
                                                    id="passwordLama">
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="password" class="col-md-4 col-lg-3 col-form-label">Password
                                                Baru</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password" required type="password"
                                                    class="form-control @error('password')
                                                    is-invalid
                                                @enderror"
                                                    id="password">
                                                @error('password')
                                                    <p class="text-danger">{{ $message }}</p>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="row mb-3">
                                            <label for="renewPassword" class="col-md-4 col-lg-3 col-form-label">Konfirmasi
                                                Password</label>
                                            <div class="col-md-8 col-lg-9">
                                                <input name="password_confirmation" required type="password"
                                                    class="form-control @error('password_confirmation')
                                                    is-invalid
                                                @enderror"
                                                    id="password_confirmation">
                                            </div>
                                        </div>

                                        <div class="text-center">
                                            <button type="submit" class="btn btn-primary">Change Password</button>
                                        </div>
                                    </form>

                                </div>

                            </div><!-- End Bordered Tabs -->

                        </div>
                    </div>

                </div>
            </div>
        </section>
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
@if ($errors->has('message'))
    @push('scripts')
        <script>
            Swal.fire({
                icon: "error",
                title: "Change failed",
                text: "{{ $errors->first() }}",
                showConfirmButton: true
            });
        </script>
    @endpush
@endif
