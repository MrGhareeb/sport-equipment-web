<div class="min-full mt-6">
    <table class="w-full">
        <thead>
            <tr>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Name
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Description
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Status
                </th>
                <th class="p-2 text-xs font-semibold text-gray-600">
                    Actions
                </th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data as $item)
            <tr class="bg-white shadow-md">
                <td class="text-center p-6">
                    <p>{{ $item->equipment_name }}</p>
                </td>
                <td class="text-center p-6">
                    <p>{{ $item->equipment_description }}</p>
                </td>
                <td class="text-center p-6">
                    <p>{{ $item->equipment_status->equipment_status_value }}</p>
                </td>
                <td class="text-center p-6">
                    buttons here
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    {{ $data->links() }}
</div>

