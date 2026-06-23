<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Holiday;
use App\Models\TimeSlot;

class HolidayAndSlotSeeder extends Seeder
{
    public function run(): void
    {
        Holiday::truncate();
        TimeSlot::truncate();

        $defaultHolidays = [
            ['date' => '2026-05-29', 'desc' => 'Hari Raya Waisak (Studio Libur)'],
            ['date' => '2026-06-01', 'desc' => 'Hari Lahir Pancasila (Studio Libur)']
        ];

        foreach ($defaultHolidays as $holiday) {
            Holiday::create($holiday);
        }

        $defaultTimeSlots = [
            '09.00 - 10.00',
            '11.30 - 12.30',
            '14.00 - 15.00',
            '16.30 - 17.30',
            '19.00 - 20.00',
            '21.00 - 22.00'
        ];

        foreach ($defaultTimeSlots as $slot) {
            TimeSlot::create(['time' => $slot]);
        }
    }
}
