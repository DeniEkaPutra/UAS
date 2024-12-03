<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold leading-tight text-gray-800">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>    

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-green shadow-sm sm:rounded-lg">
                <div class="p-6 text-black-900">
                    <div class="container mx-auto mt-5">
                        <h2 class="mb-5 text-2xl font-bold">Update Mahasiswa</h2>
                        <x-auth-session-status class="mb-4" :status="session('success')" />
                        @if ($errors->any())
                            <div class="mb-5 text-sm text-red-600">
                                @foreach ($errors->all() as $error)
                                    <p>{{ $error }}</p>
                                @endforeach
                            </div>
                        @endif

                        <form action="{{ route('mahasiswas.update', $mahasiswa->id) }}" method="POST" class="p-6 bg-white rounded shadow-md">
                            @csrf
                            @method('PUT')

                            <div class="mb-4">
                                <label for="nama" class="block font-medium text-gray-700">Nama:</label>
                                <input type="text" id="nama" name="nama" value="{{ old('nama', $mahasiswa->nama) }}" required class="w-full p-2 mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="mb-4">
                                <label for="npm" class="block font-medium text-gray-700">NPM:</label>
                                <input type="text" id="npm" name="npm" value="{{ old('npm', $mahasiswa->npm) }}" required class="w-full p-2 mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="mb-4">
                                <label for="prodi" class="block font-medium text-gray-700">Prodi:</label>
                                <input type="text" id="prodi" name="prodi" value="{{ old('prodi', $mahasiswa->prodi) }}" required class="w-full p-2 mt-2 border-gray-300 rounded-lg focus:ring-indigo-500 focus:border-indigo-500">
                            </div>

                            <div class="flex justify-end">
                                <button type="submit" 
                                    class="px-6 py-4 text-green-500 bg-white border border-green-500 rounded-lg shadow-lg hover:bg-green-500 hover:text-white focus:outline-none focus:ring-2 focus:ring-green-500">
                                    Update Mahasiswa
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
