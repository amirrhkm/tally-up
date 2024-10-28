<x-layout>
    <x-slot:heading>Outlet Report</x-slot:heading>
    <x-slot:description>{{ $selectedMonth->format('F Y') }}</x-slot:description>

    <div class="bg-white p-8 rounded-xl shadow-lg">
        <h3 class="text-xl font-semibold mb-4 text-indigo-800">Part-Time Staff Details</h3>
        <div class="mb-6">
            <form action="{{ route('reports.part-time-details') }}" method="GET" class="flex items-center space-x-4">
                <div class="relative">
                    <select id="month" name="month" class="block appearance-none w-full bg-gray-100 border border-gray-300 text-gray-700 py-2 px-4 pr-8 rounded-lg leading-tight focus:outline-none focus:bg-white focus:border-indigo-500 transition duration-200">
                        @foreach(range(1, 12) as $month)
                            @php
                                $date = \Carbon\Carbon::create(null, $month, 1);
                            @endphp
                            <option value="{{ $date->format('Y-m') }}" {{ $selectedMonth->format('m') == $month ? 'selected' : '' }}>
                                {{ $date->format('F Y') }}
                            </option>
                        @endforeach
                    </select>
                    <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5H7z"></path>
                        </svg>
                    </div>
                </div>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-700 text-white py-2 px-4 rounded-lg transition duration-300 ease-in-out shadow-md hover:shadow-lg text-center text-sm">
                    Filter
                </button>
            </form>
        </div>

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white border border-gray-300">
                <thead>
                    <tr>
                        <th class="py-2 px-4 border-b">Name</th>
                        <th class="py-2 px-4 border-b">Nickname</th>
                        <th class="py-2 px-4 border-b">Regular Hours</th>
                        <th class="py-2 px-4 border-b">OT Hours</th>
                        <th class="py-2 px-4 border-b">PH Regular Hours</th>
                        <th class="py-2 px-4 border-b">PH OT Hours</th>
                        <th class="py-2 px-4 border-b">Total Hours</th>
                        <th class="py-2 px-4 border-b">Total Salary</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($partTimeStaff as $staff)
                    <tr>
                        <td class="py-2 px-4 border-b">{{ $staff->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $staff->nickname }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($staff->total_reg_hours, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($staff->total_ot_hours, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($staff->total_ph_reg_hours, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($staff->total_ph_ot_hours, 2) }}</td>
                        <td class="py-2 px-4 border-b">{{ number_format($staff->total_hours, 2) }}</td>
                        <td class="py-2 px-4 border-b">RM {{ number_format($staff->total_salary, 2) }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-layout>