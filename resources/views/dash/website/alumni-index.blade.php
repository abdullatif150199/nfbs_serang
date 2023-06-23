<x-dash-layout>
@include('dash.website.alumni-modal')
<div class="pt-8 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <h1 class="flex-1 text-2xl font-bold text-gray-900">Sebaran Alumni</h1>

        <!-- alert -->
        @if(session('success'))
        <div class="bg-green-500 text-white text-center px-4 py-3 mt-5 rounded relative" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
            <button class="absolute top-0 right-0 px-2 py-1 mt-2" data-dismiss="alert">
                <svg class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M6 18L18 6M6 6l12 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </button>
        </div>
        @endif

        <!-- Table -->
        <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
            <div class="divide-y">
            <div class="flex items-center justify-between px-4 py-4 w-full">
                <div class="text-md font-medium uppercase text-gray-700">
                    Daftar Alumni
                </div>
                <div class="flex space-x-1">
                    <div class="ms-auto">
                        <button id="openModalImport" class="bg-green-500 hover:bg-green-700 text-white pb-2 pt-2 px-2 rounded font-medium">
                            <span class="font-medium"><i class="bi bi-cloud-arrow-down"></i> Import</span>
                        </button>

                        <button id="openModalExport" class="bg-red-500 hover:bg-green-700 text-white pb-2 pt-2 px-2 rounded font-medium">
                            <span class="font-medium"><i class="bi bi-cloud-arrow-up"></i> Export</span>
                        </button>
                    </div>
                        <a href="{{ route('dash.create', 'alumni') }}"
                            class="inline-flex items-center pl-3 pr-4 py-2 text-xs font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 ml-auto">
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
  const openModalBtnImport = document.getElementById('openModalImport');
  const closeModalBtnImport = document.getElementById('closeModalImport');
  const modalImport = document.getElementById('modalImport');

  openModalBtnImport.addEventListener('click', () => {
    modalImport.classList.remove('hidden');
  });

  closeModalBtnImport.addEventListener('click', () => {
    modalImport.classList.add('hidden');
  });

  const openModalBtnExport = document.getElementById('openModalExport');
  const closeModalBtnExport  = document.getElementById('closeModalExport');
  const modalExport = document.getElementById('modalExport ');

  openModalBtnExport.addEventListener('click', () => {
    modalExport.classList.remove('hidden');
  });

  closeModalBtnExport.addEventListener('click', (event) => {
    modalExport.classList.add('hidden');
    event.preventDefault();
  });

  const closeButton = document.querySelector("[data-dismiss='alert']");
  const alert = closeButton.parentNode;

  closeButton.addEventListener("click", function() {
    alert.remove();
  });
</script>