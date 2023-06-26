
<!-- Modal Import -->
<div id="modalImport" class="fixed z-10 top-0 left-0 w-full h-full flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg mx-auto">
        <form action="{{ route('dash.import', 'import') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-4">
                <div class="text-lg font-bold mb-2">Import Data Alumni</div>
                <div class="mb-4">
                        <input type="file" name="file" accept=".xlsx, .xls" required="required">
                </div>
                <div class="text-right">
                    <button id="closeModalImport" class="bg-gray-500 hover:bg-gray-700 text-white  py-1 px-2 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-2 rounded">Import</button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Modal Export -->
<div id="modalExport " class="fixed z-10 top-0 left-0 w-full h-full flex items-center justify-center hidden">
    <div class="bg-white rounded shadow-lg mx-auto">
        <form action="{{ route('dash.export','alumni') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="p-4">
                <div class="text-lg font-bold mb-2">Export Data Alumni</div>
                    <div class="mb-4">
                        <label>Angkatan</label>
                        <select name="tahun_lulus" id="tahun_lulus" class='w-full' >
                        @foreach ($listTahunLulus as $tahun)
                            <option value="{{ $tahun }}">{{ $tahun }}</option>
                        @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Jenis Kampus</label>
                        <select name="jenis_kampus" class='w-full' >
                            @foreach ($listJenisKampus as $key => $val)
                            <option value="{{ $key }}">{{ $val }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-4">
                        <label>Nama Kampus</label>
                        <select name="nama_kampus" class='w-full' id="nama_kampus">
                                    <option value="">Semua</option> 
                            @foreach ($listNamaKampus as $key => $nama)
                                <option value="{{ $key }}">{{ $nama }}</option>
                            @endforeach
                        </select>
                    </div>
                <div class="text-right">
                    <button id="closeModalExport" class="bg-gray-500 hover:bg-gray-700 text-white  py-1 px-2 rounded">
                        Cancel
                    </button>
                    <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white  py-1 px-2 rounded">Export</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        var defaultOption = '<option value="">Semua</option>';
        $('#tahun_lulus').on('change', function() {
            var tahunLulus = $(this).val();
            $.ajax({
                url: '{{ route("update.kampus") }}',
                method: 'GET',
                data: {
                    selectedValue: tahunLulus
                },
                success: function(response) {
                    var options = defaultOption;

                    $.each(response, function(index, value) {
                        options += '<option value="' + value + '">' + value + '</option>';
                    });

                    $('#nama_kampus').html(options);
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>




