<x-layout>
    <x-slot:heading>
        
    </x-slot:heading>

    <div class="bg-gradient-to-br from-indigo-50 to-blue-100 p-8 rounded-xl shadow-lg">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-3xl font-bold text-gray-800">Admin Dashboard</h2>
            <div class="flex items-center">
                <p class="text-lg font-semibold text-gray-600">{{ now()->format('d M Y (l)') }}</p>
                <a href="{{ route('account.settings') }}" class="text-gray-600 hover:text-green-600 mr-2 pl-4">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                    </svg>
                </a>
                <form action="{{ route('logout') }}" method="POST" class="inline-flex items-center">
                    @csrf
                    <button type="submit" class="pl-2 text-red-500 hover:text-red-600">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1" />
                        </svg>
                    </button>
                </form> 
            </div>
        </div>
        <p class="mb-8 text-gray-600"><strong>BBC078 P15</strong>: Bask Bear Coffee Presint 15 </p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Staff Overview</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $totalStaff }}</p>
                <div class="mt-2 text-sm">
                    <p>🟢 {{ $activeStaff }} Active</p>
                    <p>👥 {{ $partTimeCount }} Part-time</p>
                    <p>🎯 {{ $fullTimeCount }} Full-time</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl flex flex-col">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Today's Operations</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $activeShiftsToday - 1 }} Shifts</p>
                <div class="mt-2 text-sm">
                    <p>🕒 {{ $totalHoursToday - 7.5 }}h Scheduled</p>
                    <p>🏖️ {{ $onLeaveToday }} On Leave</p>
                    <p>
                        <span class="animate-pulse inline-block">🎉</span> 
                        @if($isPublicHoliday)
                            <span class="text-amber-500 font-semibold">Public Holiday</span>
                        @else
                            Regular Day
                        @endif
                    </p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Sales Performance</h3>
                <p class="text-3xl font-bold {{ $probabilityOfMeetingTarget < 80 ? 'text-red-600' : 'text-green-600' }}"
                   title="Probability to achieve this month RM 100,000 target">
                    {{ number_format($probabilityOfMeetingTarget, 2) }}%
                </p>
                
                <div class="mt-2 text-sm">
                    <p>📊 vs ATH (RM {{ number_format($allTimeHighSales, 2) }}): <span class="{{ $salesTrend >= 0 ? 'text-green-500' : 'text-red-500' }}">{{ $salesTrend }}%</span></p>
                    <p>💰 MTD: RM {{ number_format($monthToDateSales, 2) }}</p>
                    <p>📈 Target: {{ number_format($salesTargetProgress, 2) }}%</p>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-lg font-semibold mb-2 text-gray-800">Inventory</h3>
                <p class="text-3xl font-bold text-gray-800">{{ $pendingInvoices }}</p>
                <div class="mt-2 text-sm">
                    <p>📦 Pending Deliveries</p>
                    <p>⚠️ {{ $todayWastageCount }} Items Wasted Today</p>
                    <p>💸 RM {{ number_format($monthlyInvoiceTotal, 2) }} MTD</p>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-10">
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-xl font-semibold text-gray-800">Upcoming Public Holidays</h3>
                </div>
                <ul class="space-y-3">
                    @foreach($upcomingHolidays as $holiday)
                        <li class="flex items-center bg-green-600 p-3 rounded-lg justify-center">
                            <span class="w-28 text-white font-semibold whitespace-nowrap">{{ $holiday->date->format('d M Y') }}</span>
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Top Performers in {{ now()->format('F') }}</h3>
                <ul class="space-y-2">
                    @foreach($topStaffByHours as $staff)
                        <li class="flex items-center justify-between">
                            <span class="text-gray-800">{{ $staff->name }}</span>
                            <span class="text-gray-800 font-medium">{{ $staff->shifts_sum_total_hours }} hours</span>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Team Hub</h3>
                <p class="text-gray-600 mb-4">Manage employee roles, payroll, and leaves.</p>
                <div class="flex justify-end">
                    <a href="/staff" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Shift Central</h3>
                <p class="text-gray-600 mb-4">Manage employee schedules, track hours, and optimize allocation.</p>
                <div class="flex justify-end">
                    <a href="/shift" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Sales Dashboard</h3>
                <p class="text-gray-600 mb-4">Track revenue, analyze trends, and monitor performance.</p>
                <div class="flex justify-end">
                    <a href="/sales" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Inventory and Invoices</h3>
                <p class="text-gray-600 mb-4">Track stock levels, manage invoices, and monitor supplies.</p>
                <div class="flex justify-end">
                    <a href="/invoices" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Outlet Holidays</h3>
                <p class="text-gray-600 mb-4">Configure and manage public holidays and special events.</p>
                <div class="flex justify-end">
                    <a href="{{ route('holidays.index') }}" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="bg-white p-6 rounded-lg shadow-md transition duration-300 ease-in-out hover:shadow-xl">
                <h3 class="text-xl font-semibold mb-4 text-gray-800">Report Summary</h3>
                <p class="text-gray-600 mb-4">Generate and analyze comprehensive business reports.</p>
                <div class="flex justify-end">
                    <a href="/reports" class="inline-flex items-center gap-2 bg-gray-800 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition duration-300 ease-in-out">
                        <span>Manage</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2m3 2v-4m3 4v-6m2 10H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-layout>
