<div class="bg-white divide-y divide-gray-200">
    @foreach($alumnis as $alumni)
        <tr>
            <td class="px-6 py-4 whitespace-nowrap">
                <span class="text-sm text-gray-900">{{$alumni->nama}}</span>
            </td>
        </tr>
    @endforeach
</div>
