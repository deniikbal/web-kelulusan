<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Hasil Kelulusan 2025</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="font-sans min-h-screen p-4 md:p-8" id="result-page">
    <div class="absolute inset-0 bg-black/50 backdrop-blur-sm -z-10"></div>
    <div class="flex justify-center items-center min-h-[70vh]">
        <div class="max-w-2xl w-full">
            <!-- Combined Card -->
            <div class="bg-white/90 backdrop-blur-sm rounded-lg shadow-lg border border-white/20 relative">
                <!-- Shadow Blur Effect -->
                <div class="absolute -bottom-4 left-1/2 -translate-x-1/2 w-11/12 h-4 bg-black/20 blur-md rounded-full"></div>

                <!-- Header Section -->
                <div class="@if($student && $student->keterangan == 'Lulus') bg-gradient-to-r from-green-500 to-green-600 @else bg-gradient-to-r from-red-500 to-red-600 @endif text-white p-6 rounded-t-lg flex items-center justify-between">
                    <div>
                        <h2 class="text-2xl font-bold mb-2">
                            @if($student && $student->keterangan == 'Lulus')
                                SELAMAT!
                            @else
                                MAAF
                            @endif
                        </h2>
                        <p class="text-lg">
                            @if($student && $student->keterangan == 'Lulus')
                                ANDA DINYATAKAN LULUS DARI SMAN 1 BANTARUJEG
                            @else
                                ANDA DINYATAKAN TIDAK LULUS DARI SMAN 1 BANTARUJEG
                            @endif
                        </p>
                    </div>
                    <img src="/img/logo.png" alt="Logo Sekolah" class="w-16 h-16 md:w-20 md:h-20">
                </div>

                <!-- Content Section -->
                <div class="p-4 md:p-8">
                    @if($student)
                        <div class="flex flex-col gap-4 md:flex-row md:gap-8">
                            <!-- Student Information -->
                            <div class="space-y-3 text-sm md:text-lg flex-1">
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">Nama</strong> <span class="font-medium ml-2">{{ ucwords(strtolower($student->name))}}</span></p>
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">NISN</strong> <span class="font-medium ml-2">{{ $student->nisn }}</span></p>
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">NIS</strong> <span class="font-medium ml-2">{{ $student->nis }}</span></p>
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">Tempat Lahir</strong> <span class="font-medium ml-2">{{ ucwords(strtolower($student->tempat_lahir))}}</span></p>
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">Tanggal Lahir</strong> <span class="font-medium ml-2">{{ ucwords(strtolower($tanggal_lahir)) }}</span></p>
                                <p class="flex items-baseline"><strong class="text-gray-700 min-w-[100px] md:min-w-[130px]">Kelas</strong> <span class="font-medium ml-2">{{ $student->classroom->name }}</span></p>
                            </div>

                            <!-- QR Code Section -->
                            <div class="flex flex-col items-center justify-center md:order-last">
                                <div class="bg-white p-2 md:p-4 rounded-lg shadow-md">
                                    {!! QrCode::size(150)->generate("Nama: {$student->name}\nNISN: {$student->nisn}\nTempat Lahir: {$student->tempat_lahir}\nTanggal Lahir: {$tanggal_lahir}") !!}
                                </div>
                                <p class="mt-2 text-xs md:text-sm text-gray-600 text-center">Scan untuk verifikasi kelulusan</p>
                            </div>
                        </div>
                    @else
                        <div class="text-center">
                            <p class="text-gray-700">Silahkan cek kembali NISN dan Tanggal Lahir Anda</p>
                            <a href="/" class="mt-6 inline-block px-4 py-2 md:px-6 md:py-2 bg-gray-600 text-white rounded-lg hover:bg-gray-700 transition-colors">Coba Lagi</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</body>
</html>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const page = document.getElementById('result-page');
        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    page.style.backgroundImage = "url('/img/bg.jpg')";
                    page.classList.add('bg-cover', 'bg-center');
                    observer.unobserve(page);
                }
            });
        }, { threshold: 0.1 });

        observer.observe(page);
    });
</script>
