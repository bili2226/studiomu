<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Booking;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BookingHistoryTest extends TestCase
{
    use RefreshDatabase;

    /**
     * Test guest is redirected to login.
     */
    public function test_guest_is_redirected_to_login(): void
    {
        $response = $this->get('/riwayat-booking');
        $response->assertRedirect('/login');
    }

    /**
     * Test admin is redirected to admin dashboard.
     */
    public function test_admin_is_redirected_to_admin_dashboard(): void
    {
        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $response = $this->actingAs($admin)->get('/riwayat-booking');
        $response->assertRedirect('/admin/dashboard');
    }

    /**
     * Test customer can access booking history.
     */
    public function test_customer_can_access_booking_history(): void
    {
        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        $booking = Booking::create([
            'id' => 'BOOK-9999',
            'user_id' => $customer->id,
            'service_name' => 'Graduation Sesi (BEST DEAL)',
            'booking_date' => now()->addDays(2),
            'amount' => 850000,
            'status' => 'Pending',
            'requests' => 'Test request note',
            'snap_token' => 'mock-snap-token-123',
        ]);

        $response = $this->actingAs($customer)->get('/riwayat-booking');

        $response->assertStatus(200);
        $response->assertViewIs('customer.history');
        $response->assertViewHas('bookings');

        $response->assertSee('Riwayat Pemesanan Anda');
        $response->assertSee('BOOK-9999');
        $response->assertSee('Graduation Sesi');
    }

    /**
     * Test payment finish redirect.
     */
    public function test_payment_finish_redirect_updates_booking_and_renders_finish_view(): void
    {
        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        $booking = Booking::create([
            'id' => 'BOOK-1234',
            'user_id' => $customer->id,
            'service_name' => 'Wedding Sesi',
            'booking_date' => now()->addDays(5),
            'amount' => 1500000,
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($customer)->get('/payment/finish?order_id=BOOK-1234');

        $response->assertStatus(200);
        $response->assertViewIs('payment.finish');
        $response->assertViewHas('booking');
        $response->assertSee('Pembayaran Berhasil!');
        $response->assertSee('BOOK-1234');

        // Check if status updated to Confirmed
        $booking->refresh();
        $this->assertEquals('Confirmed', $booking->status);
    }

    /**
     * Test payment error redirect.
     */
    public function test_payment_error_redirect_updates_booking_and_renders_error_view(): void
    {
        $customer = User::create([
            'name' => 'Customer User',
            'email' => 'customer@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
        ]);

        $booking = Booking::create([
            'id' => 'BOOK-5678',
            'user_id' => $customer->id,
            'service_name' => 'Graduation Sesi',
            'booking_date' => now()->addDays(5),
            'amount' => 850000,
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($customer)->get('/payment/error?order_id=BOOK-5678');

        $response->assertStatus(200);
        $response->assertViewIs('payment.error');
        $response->assertViewHas('booking');
        $response->assertSee('Pembayaran Gagal!');
        $response->assertSee('BOOK-5678');

        // Check if status updated to Cancelled
        $booking->refresh();
        $this->assertEquals('Cancelled', $booking->status);
    }
}
