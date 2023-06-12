<x-dash-layout>
<div id="modal" class="fixed z-10 top-0 left-0 w-full h-full flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg mx-auto">
        <form action="{{ route('dash.import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-4">
                <div class="text-lg font-bold mb-2">Import Data</div>
                <div class="mb-4">
                        <input type="file" name="file" accept=".xlsx, .xls" required="required">
                </div>
                <div class="text-right">
                    <button id="closeModal" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Sebaran Alumni</h1>

        <!-- alert -->
        <div class="bg-blue-400 text-white text-center px-4 py-3 mt-5 rounded relative" role="alert">
            <span class="block sm:inline">File Berhasil Diimport!</span>
            <button class="absolute top-0 right-0 px-2 py-1 mt-2" data-dismiss="alert">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>

        <!-- Table -->
        <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
                <div class="flex items-center justify-between px-4 py-4">
                    <div class="text-md font-medium uppercase text-gray-700">
                        Daftar Alumni
                    </div>
                    <div class="space-x-1">
                        <button id="openModal" class="bg-green-500 hover:bg-green-700 text-white py-2 px-2 rounded font-medium">
                            <span class="font-medium"> Import</span>
                        </button>
                        <a href="{{ route('dash.create', 'alumni') }}"
                            class="inline-flex items-center pl-3 pr-4 py-2 text-xs
                                                    font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none
                                                    focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                            <x-icon.o-plus class="h-5 w-5 mr-1" />
                            <span>New</span>
                        </a>
                    </div>  
                </div>
                <div class="rounded-b flex flex-col px-4 py-4">
                    <livewire:dash.alumni.table />
                </div>
            </div>
        </div>
    </div>
</x-dash-layout>

<script>
  const openModalBtn = document.getElementById('openModal');
  const closeModalBtn = document.getElementById('closeModal');
  const modal = document.getElementById('modal');

  openModalBtn.addEventListener('click', () => {
    modal.classList.remove('hidden');
  });

  closeModalBtn.addEventListener('click', () => {
    modal.classList.add('hidden');
  });

  const closeButton = document.querySelector("[data-dismiss='alert']");
  const alert = closeButton.parentNode;

  closeButton.addEventListener("click", function() {
    alert.remove();
  });
</script>