<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Cek Kelulusan</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <style>
        :root {
            --primary: #4361ee;
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
        .result-card {
            border: none;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            background: white;
            max-width: 500px;
            margin: 0 auto;
            padding: 2.5rem;
            transition: all 0.3s ease;
        }
        .result-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.15);
        }
        .result-icon {
            font-size: 4rem;
            margin-bottom: 1.5rem;
            transition: all 0.3s ease;
        }
        .result-title {
            font-weight: 700;
            margin-bottom: 1rem;
        }
        .result-message {
            color: var(--dark);
            margin-bottom: 2rem;
        }
        .btn-back {
            background-color: var(--primary);
            border: none;
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.3s ease;
        }
        .btn-back:hover {
            background-color: #3a56d4;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(67, 97, 238, 0.3);
        }
        .student-info {
            background: var(--light);
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="result-card">
        @if($student)
            <div class="text-center">
                <i class="bi bi-check-circle-fill result-icon" style="color: var(--success);"></i>
                <h2 class="result-title">SELAMAT!</h2>
                <p class="result-message">Anda dinyatakan LULUS</p>
                
                <div class="student-info text-start">
                                <p><strong>Nama:</strong> {{ $student->name }}</p>
                                <p><strong>NIS:</strong> {{ $student->nis }}</p>
                                <p><strong>NISN:</strong> {{ $student->nisn }}</p>
                                <p><strong>Tempat/Tgl Lahir:</strong> {{ $student->tempat_lahir }}, {{ $tanggal_lahir }}</p>
                                <p><strong>Kelas:</strong> {{ $student->classroom->name }}</p>
                </div>
            </div>
        @else
            <div class="text-center">
                <i class="bi bi-exclamation-circle-fill result-icon" style="color: var(--danger);"></i>
                <h2 class="result-title">DATA TIDAK DITEMUKAN</h2>
                <p class="result-message">Silahkan cek kembali NISN dan Tanggal Lahir Anda</p>
                <a href="/cek-kelulusan" class="btn btn-back">
                    <i class="bi bi-arrow-left me-2"></i>Coba Lagi
                </a>
            </div>
        @endif
    </div>
</body>
</html>
