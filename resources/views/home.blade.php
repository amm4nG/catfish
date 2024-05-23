@extends('layouts.app')
@section('title')
    Dashboard
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
                <div class="card">
                    <div class="card-body">
                        <h5 class="card-title" id="clock"><span>
                            </span></h5>
                        @if ($scheduleDateTime)
                            <div class="container mb-3"
                                style="display: flex; justify-content: center; align-items: center; height: 200px; width: 200px; border: 6px solid grey; border-radius: 50%;">
                                <h1 class="card-title" style="font-size: 42px;">
                                    {{ sprintf('%02d', $scheduleDateTime->hour) . ' : ' . sprintf('%02d', $scheduleDateTime->minute) }}
                                </h1>
                            </div>
                        @endif
                        <div class="activity-item d-flex">
                            <div class="activity-content">
                                <span id="countdown" class="text-dark"></span>
                            </div>
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
                text: "Anda berhasil login!",
                showConfirmButton: true
            })
        </script>
    @endpush
@endif
@push('scripts')
    <script>
        // Memperbarui waktu setiap detik menggunakan AJAX
        setInterval(function() {
            let clock = document.getElementById('countdown')
            fetch('/get-time')
                .then(response => response.text())
                .then(timeDiff => {
                    if (timeDiff === "selesai") {
                        window.location.href = "{{ route('home') }}"
                    }
                    if (timeDiff) {
                        document.getElementById('countdown').textContent =
                            "Pemberian Pakan Akan Diberikan Dalam " + timeDiff + " Lagi";
                    } else {
                        document.getElementById('countdown').textContent = "No schedule available.";
                    }
                })
                .catch(error => {
                    console.error('Error fetching time:', error);
                });
        }, 1000);
    </script>
    <script>
        function submitForm() {
            document.getElementById("updateForm").submit();
        }
    </script>
    <script>
        // clock.js
        function updateClock() {
            var now = new Date();
            // Menentukan opsi untuk format tanggal dan waktu
            var options = {
                hour: '2-digit',
                minute: '2-digit',
                second: '2-digit',
                timeZone: 'Asia/Jakarta',
                hour12: false
            };

            // Membuat objek formatter dengan opsi yang ditentukan
            var formatter = new Intl.DateTimeFormat('en-US', options);

            // Mengonversi waktu saat ini ke waktu dalam zona waktu Asia/Jakarta dengan format yang diinginkan
            var timeString = formatter.format(now);

            // Mendapatkan hari dalam bahasa Inggris
            var day = now.toLocaleDateString('en-US', {
                weekday: 'long'
            });

            // Mendapatkan tanggal, bulan, dan tahun
            var date = now.getDate();
            var month = now.toLocaleDateString('en-US', {
                month: 'long'
            });
            var year = now.getFullYear();

            // Membuat string waktu lengkap
            var dateTimeString = timeString + ' | ' + day + ', ' + date + ' ' + month + ' ' + year;

            // Menampilkan waktu dalam elemen dengan ID "clock"
            document.getElementById('clock').textContent = dateTimeString;
        }

        // Memanggil fungsi updateClock setiap detik
        setInterval(updateClock, 1000);
    </script>
@endpush
