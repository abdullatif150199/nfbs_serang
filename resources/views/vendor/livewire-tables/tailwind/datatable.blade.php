<div>
    @if(!empty($this->selectedYear))
    <div class="w-full mb-4">
        <div class="text-center">
            <p><b>SEBARAN KAMPUS ANGKATAN LULUS TAHUN {{ implode(', ', $this->selectedYear) }}</b></p>
        </div>
            <canvas id="myChart"></canvas>
        <div class=" px-5 flex justify-center text-center">
            <ul style="list-style-type: decimal;" >
            @foreach(array_slice($this->kampusList, 0, 10) as $kampus => $jumlah)
                <li><small>{{$kampus}} : {{$jumlah}} Orang</small></li>
            @endforeach
            </ul>
        </div>
    </div>
    
    <div class="flex mt-10 items-center justify-center text-center px-4 py-4 w-full border ">
        <div class="text-md font-medium uppercase text-gray-700 ">
            Daftar Sebaran Alumni Angkatan Lulus Tahun {{ implode(', ', $this->selectedYear) }}
        </div>
    </div>
    
    @endif
    <div
        @if (is_numeric($refresh))
            wire:poll.{{ $refresh }}ms
        @elseif(is_string($refresh))
            @if ($refresh === '.keep-alive' || $refresh === 'keep-alive')
                wire:poll.keep-alive
            @elseif($refresh === '.visible' || $refresh === 'visible')
                wire:poll.visible
            @else
                wire:poll="{{ $refresh }}"
            @endif
        @endif
    class="{{!empty($this->selectedYear) ? 'border p-3' : ' '}}">
        @include('livewire-tables::includes.debug')
        @include('livewire-tables::tailwind.includes.offline')

        <div class="flex-col">
            @include('livewire-tables::tailwind.includes.sorting-pills')
            @include('livewire-tables::tailwind.includes.filter-pills')

            <div class="space-y-4">
                <div class="md:flex md:justify-between px-6 py-2 md:p-0">
                    <div class="w-full mb-4 md:mb-0 md:w-2/4 md:flex space-y-4 md:space-y-0 md:space-x-2">
                        @include('livewire-tables::tailwind.includes.reorder')
                        @include('livewire-tables::tailwind.includes.search')
                        @include('livewire-tables::tailwind.includes.filters')
                    </div>

                    <div class="md:flex md:items-center">
                        <div>@include('livewire-tables::tailwind.includes.bulk-actions')</div>
                        <div>@include('livewire-tables::tailwind.includes.column-select')</div>
                        <div>@include('livewire-tables::tailwind.includes.per-page')</div>
                    </div>
                </div>

                @include('livewire-tables::tailwind.includes.table')
                @include('livewire-tables::tailwind.includes.pagination')
            </div>
        </div>
    </div>

    @isset($modalsView)
        @include($modalsView)
    @endisset
</div>



@if(!empty($this->selectedYear))
    @push('script')
        <script src="https://cdn.jsdelivr.net/npm/chart.js@4.3.0/dist/chart.umd.min.js"></script>
        <script>
            
                var chartData = {!! $sebaranKampus !!};
                const ctx = document.getElementById('myChart');
               const myChart = new Chart(ctx, {
                type: 'bar',
                data: {
                labels: chartData.label,
                datasets: [{
                    label: 'Sebaran 10 Terbanyak',
                    data: chartData.data,
                    borderWidth: 1
                }]
                },
                options: {
                scales: {
                    y: {
                    beginAtZero: true
                    }
                }
                }
            });

            Livewire.on('chartUpdate', data => {
            var updatedData = JSON.parse(data);
            chartData = updatedData;
            myChart.data.labels = chartData.label;
            myChart.data.datasets.forEach((dataset) => {
                dataset.data = chartData.data;
            });
            myChart .update();
        });
        </script>
    @endpush
@endif
  
