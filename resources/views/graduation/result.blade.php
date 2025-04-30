<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan 2025</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary: #4361ee;
            --secondary: #3f37c9;
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
        .result-container {
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 70vh;
        }
        .header-card {
            color: white;
            padding: 1.5rem;
            border-radius: 3px;
            text-align: center;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            background: linear-gradient(135deg, rgba(40,167,69,0.9) 0%, rgba(33,150,83,0.9) 100%);
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.2);
        }
        .bg-danger {
            background: linear-gradient(135deg, rgba(220,53,69,0.9) 0%, rgba(200,35,51,0.9) 100%) !important;
        }
        .result-card {
            background: rgba(255,255,255,0.9);
            border-radius: 3px;
            padding: 2rem;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            margin-top: 10px;
            backdrop-filter: blur(10px);
            border: 1px solid rgba(255,255,255,0.3);
        }
        .student-info {
            font-size: 1.1rem;
            width: 100%;
        }
        .student-info p {
            margin-bottom: 0.8rem;
            display: flex;
            align-items: baseline;
        }
        .student-info strong {
            color: #495057;
            min-width: 130px;
            text-align: left;
        }
        .student-info strong::after {
            content: ":";
            margin-right: 5px;
        }
        .student-info span {
            font-weight: 500;
            margin-left: 5px;
        }
        .btn-back {
            background-color: #6c757d;
            border: none;
            margin-top: 1.5rem;
        }
    </style>
</head>
<body>
    <div class="result-container">
        <div style="max-width: 700px; width: 100%;">
            <!-- Header Card -->
            <div class="header-card @if($student && $student->keterangan == 'Lulus') bg-success @else bg-danger @endif">
                <h2 class="mb-1">
                    @if($student && $student->keterangan == 'Lulus')
                        SELAMAT!
                    @else
                        MAAF
                    @endif
                </h2>
                <p class="mb-0" style="font-size: 1.2rem">
                    @if($student && $student->keterangan == 'Lulus')
                        ANDA DINYATAKAN LULUS DARI SMAN 1 BANTARUJEG
                    @else
                        ANDA DINYATAKAN TIDAK LULUS DARI SMAN 1 BANTARUJEG
                    @endif
                </p>
            </div>

            <!-- Result Card -->
            <div class="result-card">
                @if($student)
                    
                    
                    <div class="student-info">
                        <p><strong>Nama</strong> <span>{{ $student->name }}</span></p>
                        <p><strong>NISN</strong> <span>{{ $student->nisn }}</span></p>
                        <p><strong>Kelas</strong> <span>{{ $student->classroom->name }}</span></p>
                        <p><strong>Tempat Lahir</strong> <span>{{ $student->tempat_lahir }}</span></p>
                        <p><strong>Tanggal Lahir</strong> <span>{{ $tanggal_lahir }}</span></p>
                    </div>
                @else
                    <div class="text-center">
                        <p class="text-dark">Silahkan cek kembali NISN dan Tanggal Lahir Anda</p>
                        <a href="/" class="btn btn-primary btn-back">Coba Lagi</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</body>
</html>
