<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="container p-4 mx-auto">
    <div class="overflow-x-auto">
      @if (session('success'))
          <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500">
              {{ session('success') }}
          </div>
      @elseif(session('error'))
          <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500">
              {{ session('error') }}
          </div>
      @endif

      <!-- Tombol Tambah Mahasiswa -->
      <a href="{{ route('mahasiswas.create') }}">
        <button class="px-6 py-4 text-white bg-green-500 border border-green-500 rounded-lg shadow-lg hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
            Add Mahasiswa
        </button>
      </a>

      <!-- Form Pencarian -->
      <form method="GET" action="{{ route('mahasiswas.index') }}" class="mb-4">
          <input type="text" name="search" placeholder="Search Mahasiswa..." value="{{ request()->search }}" class="px-4 py-2 border rounded-md">
          <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
      </form>

      <table class="min-w-full border border-collapse border-gray-200">
        <thead>
          <tr class="bg-gray-100">
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">ID</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Nama</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">NPM</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Prodi</th>
            <th class="px-4 py-2 text-left text-gray-600 border border-gray-200">Aksi</th>
          </tr>
        </thead>
        <tbody>
          @foreach ($mahasiswas as $mahasiswa)
            <tr class="bg-white">
              <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->id }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->nama }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->npm }}</td>
              <td class="px-4 py-2 border border-gray-200">{{ $mahasiswa->prodi }}</td>
              <td class="px-4 py-2 border border-gray-200">
                <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}" class="px-2 text-blue-600 hover:text-blue-800">Edit</a>
                <button class="px-2 text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('mahasiswas.destroy', $mahasiswa->id) }}')">Hapus</button>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>

  <script>
    function confirmDelete(deleteUrl) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            // Jika user mengonfirmasi, kita dapat membuat form dan mengirimkan permintaan delete
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;

            // Tambahkan CSRF token
            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            // Tambahkan method spoofing untuk DELETE (karena HTML form hanya mendukung GET dan POST)
            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            // Tambahkan form ke body dan submit
            document.body.appendChild(form);
            form.submit();
        }
    }
  </script>
</x-app-layout>
