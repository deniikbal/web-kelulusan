<x-filament::page>
    <x-filament::card>
        <div class="space-y-4">
            <h2 class="text-xl font-bold">Import/Export Nilai Siswa</h2>

            <div class="grid grid-cols-1 gap-4 md:grid-cols-2">
                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="mb-4 text-lg font-medium">Export Template Nilai</h3>
                    <p class="mb-4 text-gray-600">Export template Excel berisi daftar siswa untuk diisi nilai</p>
                    {{ $this->getActions()['export'] }}
                </div>

                <div class="p-4 bg-white rounded-lg shadow">
                    <h3 class="mb-4 text-lg font-medium">Import Nilai</h3>
                    <p class="mb-4 text-gray-600">Upload file Excel yang sudah diisi dengan nilai siswa</p>
                    {{ $this->getActions()['import'] }}
                </div>
            </div>
        </div>
    </x-filament::card>
</x-filament::page>
