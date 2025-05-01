<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pengumuman Kelulusan & SNBP 2025</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body class="font-roboto bg-cover bg-center min-h-screen p-8" style="background-image: url('/img/bg.jpg');">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm -z-10"></div>
    <div class="flex justify-center items-center min-h-[70vh]">
        <!-- Combined Card -->
        <div class="max-w-3xl w-full bg-white rounded-sm shadow-lg">
            <!-- Countdown Section -->
            <div id="countdown-section">
                <div class="p-8 text-center">
                    <div class="grid grid-cols-3 gap-4 mb-4 text-lg font-extrabold text-black">
                        <span>Jam</span>
                        <span>Menit</span>
                        <span>Detik</span>
                    </div>
                    <div class="text-6xl md:text-8xl font-extrabold text-black tracking-[0.5rem] md:tracking-[1rem] px-8 font-['Orbitron']" id="countdown">00:00:00</div>
                </div>
                <div class="bg-blue-600 text-white p-4 shadow-lg rounded-t-sm">
                    <div class="flex justify-center mb-4">
                        <img src="/img/logo-sekolah.png" alt="Logo Sekolah" class="w-20 h-20">
                    </div>
                    <h5 class="flex justify-between font-bold">
                        <span>HASIL KELULUSAN 2025</span>
                        <span>DIBUKA TANGGAL 05 MEI 2025 JAM 13.00 WIB</span>
                    </h5>
                </div>
            </div>

            <!-- Form Section (hidden initially) -->
            <div id="form-section" class="hidden p-8">
                <div class="text-center mb-8">
                    <h2 class="text-3xl font-bold text-black mb-2">PENGUMUMAN KELULUSAN 2025</h2>
                    <p class="text-gray-600">Masukkan data untuk melihat hasil</p>
                </div>
                <form action="/cek-kelulusan" method="POST" class="space-y-6">
                    @csrf
                    <div class="space-y-2">
                        <label class="block text-black font-medium">NISN (NOMOR INDUK SISWA NASIONAL)</label>
                        <input type="text" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" name="nisn" placeholder="Nomor Induk Siswa Nasional" required>
                    </div>
                    <div class="space-y-2">
                        <label class="block text-black font-medium">TANGGAL LAHIR</label>
                        <input type="date" class="w-full px-4 py-3 border-2 border-gray-200 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" name="tanggal_lahir" required>
                    </div>
                    <button type="submit" class="w-full bg-blue-600 text-white py-3 px-4 rounded-lg hover:bg-blue-700 transition-colors font-semibold text-lg">
                        LIHAT HASIL
                    </button>
                </form>
            </div>
        </div>
    </div>

    <script>
        // Set tanggal pengumuman
        const announcementDate = new Date('2025-05-01 09:10:00').getTime();

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