<x-layout>
    <x-slot:heading>Add Staff for {{ Carbon\Carbon::parse($date)->format('d F Y') }}</x-slot:heading>

    <form action="{{ route('shift.store') }}" method="POST">
        @csrf
        <input type="hidden" name="date" value="{{ $date }}">

        <div class="mb-4">
            <label for="staff_id" class="block text-sm font-medium text-gray-700">Staff</label>
            <select name="staff_id" id="staff_id" class="p-2 mt-1 block w-1/2">
                @foreach ($staff as $member)
                    @if ($member->name !== "admin")
                        <option value="{{ $member->id }}">{{ $member->name }}</option>
                    @endif
                @endforeach
            </select>
        </div>

        <div class="mb-4">
            <label for="start_time" class="block text-sm font-medium text-gray-700">Start Time</label>
            <input type="time" name="start_time" id="start_time" class="mt-1 block w-1/2">
        </div>

        <div class="mb-4">
            <label for="end_time" class="block text-sm font-medium text-gray-700">End Time</label>
            <input type="time" name="end_time" id="end_time" class="mt-1 block w-1/2">
        </div>

        <div class="mb-4">
            <label for="break_duration" class="block text-sm font-medium text-gray-700">Break Duration (hours)</label>
            <input type="number" step="1" name="break_duration" id="break_duration" class="p-2 mt-1 block w-1/2" value="0">
        </div>

        <button type="submit" class="bg-blue-500 text-white px-4 py-2">Add Shift</button>
    </form>
</x-layout>