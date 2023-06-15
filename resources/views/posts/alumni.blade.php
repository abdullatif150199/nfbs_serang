@extends('layouts.web')

@section('content')

<!-- <x-partials.about-us /> -->
    <div class="justify-center items-center mt-24">
        <div class="mt-24">
            <div class="text-center">
                <h1>Ini adalah halaman sebaran alumni</h1>
            </div>
        </div>
        <div class="row my-10">
            <div>
                <table class="min-w-full divide-y divide-gray-200">
                    <thead>
                        <tr>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Nama
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Email
                        </th>
                        <th scope="col" class="px-6 py-3 bg-gray-50 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                            Telepon
                        </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                John Doe
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                john@example.com
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                123-456-7890
                            </td>
                        </tr>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap">
                                Jane Smith
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                jane@example.com
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                987-654-3210
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
       
    </div>
@endsection