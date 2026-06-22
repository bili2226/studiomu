<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;
use Carbon\Carbon;

class AdminBookingFilterTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        config(['midtrans.server_key' => 'mock-server-key']);
        config(['midtrans.client_key' => 'mock-client-key']);
        config(['midtrans.is_production' => false]);
    }

    /**
     * Test admin can access bookings and filter by date range.
     */
    public function test_admin_can_filter_bookings_by_date_range(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        // Set test date context so we are in the middle of a week and month to avoid timezone/boundary overlaps.
        // E.g., June 10, 2026 is a Wednesday.
        $knownDate = Carbon::create(2026, 6, 10, 12, 0, 0);
        Carbon::setTestNow($knownDate);

        // 1. Create booking for today (June 10)
        $bookingToday = Booking::create([
            'id' => 'BOOK-TODAY',
            'user_id' => $customer->id,
            'service_name' => 'Sesi Foto Hari Ini',
            'booking_date' => Carbon::today()->addHours(14),
            'amount' => 500000,
            'status' => 'Pending',
        ]);

        // 2. Create booking for later this week (June 12, Friday - same week as June 10)
        $bookingThisWeek = Booking::create([
            'id' => 'BOOK-THIS-WEEK',
            'user_id' => $customer->id,
            'service_name' => 'Sesi Foto Minggu Ini',
            'booking_date' => Carbon::create(2026, 6, 12, 10, 0, 0),
            'amount' => 600000,
            'status' => 'Confirmed',
        ]);

        // 3. Create booking for next month (July 10)
        $bookingNextMonth = Booking::create([
            'id' => 'BOOK-NEXT-MONTH',
            'user_id' => $customer->id,
            'service_name' => 'Sesi Foto Bulan Depan',
            'booking_date' => Carbon::create(2026, 7, 10, 10, 0, 0),
            'amount' => 700000,
            'status' => 'Completed',
        ]);

        // Test: filter date_range = today
        $response = $this->actingAs($admin)->get(route('admin.bookings.index', ['date_range' => 'today']));
        $response->assertStatus(200);
        $response->assertSee('BOOK-TODAY');
        $response->assertDontSee('BOOK-THIS-WEEK');
        $response->assertDontSee('BOOK-NEXT-MONTH');

        // Test: filter date_range = this_week
        $response = $this->actingAs($admin)->get(route('admin.bookings.index', ['date_range' => 'this_week']));
        $response->assertStatus(200);
        $response->assertSee('BOOK-TODAY');
        $response->assertSee('BOOK-THIS-WEEK');
        $response->assertDontSee('BOOK-NEXT-MONTH');

        // Test: filter status = Completed
        $response = $this->actingAs($admin)->get(route('admin.bookings.index', ['status' => 'Completed']));
        $response->assertStatus(200);
        $response->assertSee('BOOK-NEXT-MONTH');
        $response->assertDontSee('BOOK-TODAY');
        $response->assertDontSee('BOOK-THIS-WEEK');

        // Reset the test date context
        Carbon::setTestNow();
    }
}
