@extends('layouts.web')

@section('content')

<!-- <x-partials.about-us /> -->
    <div class="justify-center items-center mt-24 grid bg-white">
        <div class="mt-24">
            <div class="text-md font-medium text-center uppercase text-gray-700">
                   <!-- Sebaran Alumni -->
            </div>
        </div>
        <div class="row my-10">
            <div class="-mx-4 my-10 shadow bg-white sm:-mx-6 md:mx-0 md:rounded-lg">
                <div class="divide-y">
                    <!-- <div class="flex items-center justify-center text-center px-4 py-4 w-full">
                        <div class="text-md font-small uppercase text-gray-700 ">
                           Daftar Sebaran Alumni Angkatan 2022
                        </div>
                    </div> -->
                    <div class="rounded-b flex flex-col px-4 py-4">
                        <livewire:dash.alumni-index.table wire:model="selectedYear"/>
                     
                    </div>
            
                </div>
            </div>
        </div>
    </div>
@endsection

