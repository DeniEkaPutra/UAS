<x-app-layout>
  <x-slot name="header">
    <h2 class="text-xl font-semibold leading-tight text-gray-800">
      {{ __('Dashboard') }}
    </h2>
  </x-slot>

  <div class="container p-4 mx-auto">
    <div class="overflow-x-auto">
      <!-- Notification for success or error -->
      @if (session('success'))
          <div class="mb-4 rounded-lg bg-green-50 p-4 text-green-500 border-l-4 border-green-500">
              {{ session('success') }}
          </div>
      @elseif(session('error'))
          <div class="mb-4 rounded-lg bg-red-50 p-4 text-red-500 border-l-4 border-red-500">
              {{ session('error') }}
          </div>
      @endif

      <!-- Action Buttons (Add Mahasiswa, Download Excel) -->
      <div class="flex items-center justify-between mb-6">
        <a href="{{ route('mahasiswas.create') }}">
          <button class="px-6 py-3 text-white bg-green-500 border border-green-500 rounded-lg shadow-md hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-500">
              Add Mahasiswa
          </button>
        </a>
        <a href="{{ route('mahasiswas.download') }}" class="inline-flex items-center px-4 py-3 text-sm font-medium text-white bg-blue-500 border border-blue-500 rounded-lg shadow-md hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-blue-500">
          Download Excel
        </a>
      </div>

      <!-- Search Form -->
      <form method="GET" action="{{ route('mahasiswas.index') }}" class="mb-4 flex items-center space-x-4">
        <input type="text" name="search" placeholder="Search Mahasiswa..." value="{{ request()->search }}" class="px-4 py-2 border rounded-md w-full md:w-1/4">
        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Search</button>
      </form>

      <!-- Table Data Mahasiswa -->
      <div class="overflow-x-auto max-w-full">
        <table class="min-w-full border-collapse table-auto shadow-md">
          <thead class="bg-gray-100">
            <tr>
              <th class="px-6 py-3 text-left text-gray-600 border border-gray-200">ID</th>
              <th class="px-6 py-3 text-left text-gray-600 border border-gray-200">Nama</th>
              <th class="px-6 py-3 text-left text-gray-600 border border-gray-200">NPM</th>
              <th class="px-6 py-3 text-left text-gray-600 border border-gray-200">Prodi</th>
              <th class="px-6 py-3 text-left text-gray-600 border border-gray-200">Aksi</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($mahasiswas as $mahasiswa)
              <tr class="bg-white hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 border border-gray-200">{{ $mahasiswa->id }}</td>
                <td class="px-6 py-4 border border-gray-200">{{ $mahasiswa->nama }}</td>
                <td class="px-6 py-4 border border-gray-200">{{ $mahasiswa->npm }}</td>
                <td class="px-6 py-4 border border-gray-200">{{ $mahasiswa->prodi }}</td>
                <td class="px-6 py-4 border border-gray-200 space-x-2">
                  <a href="{{ route('mahasiswas.edit', $mahasiswa->id) }}" class="text-blue-600 hover:text-blue-800">Edit</a>
                  <button class="text-red-600 hover:text-red-800" onclick="confirmDelete('{{ route('mahasiswas.destroy', $mahasiswa->id) }}')">Hapus</button>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>
      </div>
    </div>
  </div>

  <script>
    function confirmDelete(deleteUrl) {
        if (confirm('Apakah Anda yakin ingin menghapus data ini?')) {
            let form = document.createElement('form');
            form.method = 'POST';
            form.action = deleteUrl;

            let csrfInput = document.createElement('input');
            csrfInput.type = 'hidden';
            csrfInput.name = '_token';
            csrfInput.value = '{{ csrf_token() }}';
            form.appendChild(csrfInput);

            let methodInput = document.createElement('input');
            methodInput.type = 'hidden';
            methodInput.name = '_method';
            methodInput.value = 'DELETE';
            form.appendChild(methodInput);

            document.body.appendChild(form);
            form.submit();
        }
    }
  </script>
</x-app-layout>
