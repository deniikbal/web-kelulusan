<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Kelulusan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
            --success: #4cc9f0;
            --danger: #f72585;
            --light: #f8f9fa;
            --dark: #212529;
        }
        body {
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            background: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
            min-height: 100vh;
            display: flex;
            align-items: center;
            padding: 2rem;
        }
        .card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            background: white;
            max-width: 800px;
            margin: 0 auto;
        }
        .countdown {
            font-size: 3rem;
            font-weight: 700;
            background: linear-gradient(to right, var(--danger), var(--primary));
            -webkit-background-clip: text;
            background-clip: text;
            color: transparent;
            margin: 1.5rem 0;
        }
        .btn-primary {
            background-color: var(--primary);
            border: none;
            padding: 0.75rem 2rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-primary:hover {
            background-color: var(--secondary);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
    </style>
</head>
<body>
    <div class="card p-5 text-center">
        <h1 class="fw-bold mb-4" style="color: var(--dark);">Pengumuman Kelulusan</h1>
        
        <!-- Countdown Section -->
        <div id="countdown-section">
            <p class="text-muted mb-2">Pengumuman akan dibuka dalam:</p>
            <div class="countdown display-1 fw-bold" id="countdown">00:00:00</div>
            <p class="text-muted mb-4">Form cek kelulusan akan muncul setelah waktu habis</p>
        </div>

        <!-- Form Section (hidden initially) -->
        <div id="form-section" style="display: none;">
            <form action="/api/check-graduation" method="POST" class="mt-4">
                @csrf
                <div class="mb-3">
                    <label for="nisn" class="form-label">NISN</label>
                    <input type="text" class="form-control form-control-lg" id="nisn" name="nisn" required>
                </div>
                <div class="mb-3">
                    <label for="tanggal_lahir" class="form-label">Tanggal Lahir</label>
                    <input type="date" class="form-control form-control-lg" id="tanggal_lahir" name="tanggal_lahir" required>
                </div>
                <button type="submit" class="btn btn-primary btn-lg w-100">
                    <i class="bi bi-search me-2"></i>Cek Kelulusan
                </button>
            </form>
        </div>

        <script>
            // Set tanggal pengumuman (YYYY-MM-DD HH:MM:SS)
            const announcementDate = new Date('2025-04-30 12:36:00').getTime();

            const countdown = setInterval(function() {
                const now = new Date().getTime();
                const distance = announcementDate - now;

                // Hitung waktu
                const hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                const minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                const seconds = Math.floor((distance % (1000 * 60)) / 1000);

                // Tampilkan hasil
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
