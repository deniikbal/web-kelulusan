<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Kelulusan & SNBP 2025</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --danger: #f72585;
        }
        body {
            font-family: 'Inter', sans-serif;
            background: url('/img/bg.jpg') no-repeat center center fixed;
            background-size: cover;
            min-height: 100vh;
            padding: 2rem;
        }
        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.5);
            backdrop-filter: blur(5px);
            z-index: -1;
        }
        .countdown-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }
        .countdown-card {
            background: white;
            border-radius: 3px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .info-card {
            background: #6c757d;
            color: white;
            padding: 1rem;
            border-radius: 0;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-top: -1px;
        }
        .countdown {
            font-size: 6rem;
            font-weight: 700;
            color: black;
            line-height: 1;
            margin: 0;
            letter-spacing: 1.5rem;
            padding: 0 1rem;
        }

        /* Desktop Styles */
        .info-card h5 {
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            min-height: 3rem;
        }
        .info-card h5 span {
            display: block;
        }

        /* Mobile Styles */
        @media (max-width: 768px) {
            .countdown {
                font-size: 3rem;
                letter-spacing: 0.8rem;
                padding: 0 0.5rem;
            }
            .countdown-card {
                padding: 1rem;
                width: 95%;
                margin: 0 auto;
            }
            .countdown-labels {
                font-size: 1rem;
                padding: 0 0.5rem;
            }
            .info-card {
                width: 95%;
                margin: 0 auto;
                padding: 0.8rem;
            }
            .info-card h5 {
                font-size: 0.9rem;
                line-height: 1.3;
                padding: 0.3rem;
                min-height: auto;
            }
        }
        .countdown-labels {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            margin-bottom: 1rem;
            font-size: 1.2rem;
            font-weight: bold;
            color: black;
            text-align: center;
            padding: 0 1.5rem;
        }
        .form-card {
            max-width: 700px;
            background-color: white;
            border-radius: 3px;
            padding: 2rem;
            margin: 2rem auto;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.1);
        }
        .form-card .form-label {
            color: black;
            font-weight: 500;
        }
        .form-card .btn-primary {
            background-color: #6c757d;
            border-color: #6c757d;
        }
    </style>
</head>
<body>
    <div class="countdown-container">
        <!-- Countdown Section -->
        <div id="countdown-section">
            <div class="countdown-card">
                <div class="countdown-labels">
                    <span>Jam</span>
                    <span>Menit</span>
                    <span>Detik</span>
                </div>
                <div class="countdown display-3 fw-bold" id="countdown">00:00:00</div>
            </div>
            <div class="info-card">
                <h5 class="text-center mb-0">
                    <span class="d-block">HASIL KELULUSAN 2025</span>
                    <span class="d-block">DIBUKA TANGGAL 05 MEI JAM 13.00</span>
                </h5>
            </div>
        </div>

        <!-- Form Section (hidden initially) -->
        <div id="form-section" style="display: none;">
            <div class="form-card">
                <div class="text-center mb-4">
                    <h2 class="text-dark">PENGUMUMAN KELULUSAN 2025</h2>
                    <p class="text-secondary">Masukkan data untuk melihat hasil</p>
                    {{-- <a href="#" class="text-white d-block mt-3 fw-bold">Unduh Pengumuman Resmi</a> --}}
                </div>

                <form action="/cek-kelulusan" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">NISN (NOMOR INDUK SISWA NASIONAL)</label>
                        <input type="text" class="form-control" name="nisn" placeholder="Nomor Induk Siswa Nasional" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">TANGGAL LAHIR</label>
                        <input type="date" class="form-control" name="tanggal_lahir" required>
                    </div>
                    <div class="d-grid">
                        <button type="submit" class="btn btn-primary">LIHAT HASIL</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set tanggal pengumuman
        const announcementDate = new Date('2025-04-30 22:34:00').getTime();

        const countdown = setInterval(function() {
            const now = new Date().getTime();
            const distance = announcementDate - now;

            // Hitung waktu
            const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
            const seconds = Math.floor((distance % (1000 * 60)) / 1000);

            // Tampilkan countdown
            document.getElementById("countdown").innerHTML =
                `${hours.toString().padStart(2, '0')}:${minutes.toString().padStart(2, '0')}:${seconds.toString().padStart(2, '0')}`;

            // Jika waktu habis, tampilkan form
            if (distance < 0) {
                clearInterval(countdown);
                document.getElementById("countdown-section").style.display = "none";
                document.getElementById("form-section").style.display = "block";
            }
        }, 1000);
    </script>
</body>
</html>
