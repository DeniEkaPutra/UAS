<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <div class="container mx-auto mt-5">
                        <h2 class="mb-5 text-2xl font-bold">Tambah Mahasiswa Baru</h2>
                        <x-auth-session-status class="mb-4" :status="session('success')" />

                        <!-- Form untuk menambahkan mahasiswa -->
                        <form action="{{ route('mahasiswas.store') }}" method="POST" class="space-y-4">
                            @csrf <!-- Perlindungan CSRF Laravel -->

                            <div class="form-group">
                                <label for="nama" class="block text-sm font-medium text-gray-700">Nama Mahasiswa</label>
                                <input type="text" id="nama" name="nama" 
                                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ old('nama') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="npm" class="block text-sm font-medium text-gray-700">NPM (Nomor Pokok Mahasiswa)</label>
                                <input type="text" id="npm" name="npm" 
                                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ old('npm') }}" required>
                            </div>

                            <div class="form-group">
                                <label for="prodi" class="block text-sm font-medium text-gray-700">Program Studi (Prodi)</label>
                                <input type="text" id="prodi" name="prodi" 
                                    class="block w-full p-2 mt-1 border border-gray-300 rounded-md shadow-sm focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm" 
                                    value="{{ old('prodi') }}" required>
                            </div>

                            <!-- Tombol Kirim -->
                            <button type="submit" 
                                class="inline-flex justify-center px-4 py-2 text-sm font-medium text-black bg-white border-2 border-blue-500 rounded-md shadow-sm hover:bg-blue-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                                Kirim
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
