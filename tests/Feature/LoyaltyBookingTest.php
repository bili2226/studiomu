<?php

namespace Tests\Feature;

use App\Models\User;
use App\Models\Booking;
use App\Models\Reward;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoyaltyBookingTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();

        // Make sure Midtrans config doesn't throw errors
        config(['midtrans.server_key' => 'mock-server-key']);
        config(['midtrans.client_key' => 'mock-client-key']);
        config(['midtrans.is_production' => false]);
    }

    /**
     * Test booking creation with reward discount.
     */
    public function test_booking_creation_with_points_discount(): void
    {
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'points' => 150,
        ]);

        $reward = Reward::create([
            'name' => 'Diskon Rp 200.000',
            'description' => 'Tukar 100 poin untuk diskon 200k',
            'code' => 'DISC200K',
            'points_required' => 100,
            'type' => 'discount',
            'discount_amount' => 200000,
            'status' => 'active',
        ]);

        $response = $this->actingAs($customer)->postJson(route('booking.store'), [
            'service_key' => 'wedding',
            'service_title' => 'Wedding & Pre-Wedding',
            'package_name' => 'BASIC PREWEDD',
            'date' => '2026-06-20',
            'time' => '09:00 WIB',
            'price' => 'Rp 1.500.000',
            'payment_method' => 'Cash',
            'reward_id' => $reward->id,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);

        // Assert user points were decremented
        $customer->refresh();
        $this->assertEquals(50, $customer->points); // 150 - 100

        // Assert booking details in db
        $booking = Booking::first();
        $this->assertNotNull($booking);
        $this->assertEquals(1300000, $booking->amount); // 1.500.000 - 200.000
        $this->assertEquals(200000, $booking->discount);
        $this->assertEquals(100, $booking->points_used);
        $this->assertEquals(130, $booking->points_earned); // 1.300.000 / 10.000
        $this->assertEquals('Pending', $booking->status);
    }

    /**
     * Test booking completion awards points.
     */
    public function test_booking_completion_adds_points_earned(): void
    {
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'points' => 50,
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $booking = Booking::create([
            'id' => 'BOOK-1111',
            'user_id' => $customer->id,
            'service_name' => 'Wedding Sesi',
            'booking_date' => now()->addDays(2),
            'amount' => 1000000,
            'discount' => 0,
            'points_used' => 0,
            'points_earned' => 100,
            'status' => 'Confirmed',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.bookings.updateStatus', $booking->id), [
            'status' => 'Completed',
        ]);

        $response->assertRedirect(route('admin.bookings.index'));

        // User points should increase by points_earned
        $customer->refresh();
        $this->assertEquals(150, $customer->points); // 50 + 100
    }

    /**
     * Test booking cancellation refunds points.
     */
    public function test_booking_cancellation_refunds_points_used(): void
    {
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'points' => 50,
        ]);

        $admin = User::create([
            'name' => 'Admin User',
            'email' => 'admin@test.com',
            'password' => bcrypt('password'),
            'role' => 'admin',
        ]);

        $booking = Booking::create([
            'id' => 'BOOK-2222',
            'user_id' => $customer->id,
            'service_name' => 'Wedding Sesi',
            'booking_date' => now()->addDays(2),
            'amount' => 800000,
            'discount' => 200000,
            'points_used' => 100,
            'points_earned' => 80,
            'status' => 'Pending',
        ]);

        $response = $this->actingAs($admin)->put(route('admin.bookings.updateStatus', $booking->id), [
            'status' => 'Cancelled',
        ]);

        $response->assertRedirect(route('admin.bookings.index'));

        // User points should be refunded points_used
        $customer->refresh();
        $this->assertEquals(150, $customer->points); // 50 + 100
    }

    /**
     * Test free booking (amount Rp 0) auto-confirmation.
     */
    public function test_free_booking_auto_confirmation(): void
    {
        $customer = User::create([
            'name' => 'John Doe',
            'email' => 'john@test.com',
            'password' => bcrypt('password'),
            'role' => 'customer',
            'points' => 300,
        ]);

        $reward = Reward::create([
            'name' => 'Diskon Rp 500.000',
            'description' => 'Tukar 250 poin untuk diskon 500k',
            'code' => 'DISC500K',
            'points_required' => 250,
            'type' => 'discount',
            'discount_amount' => 500000,
            'status' => 'active',
        ]);

        // Sesi foto berharga Rp 500.000, didiskon Rp 500.000 menjadi Rp 0
        $response = $this->actingAs($customer)->postJson(route('booking.store'), [
            'service_key' => 'family',
            'service_title' => 'Keluarga & Maternity',
            'package_name' => 'BEST DEAL',
            'date' => '2026-06-25',
            'time' => '11:30 WIB',
            'price' => 'Rp 500.000',
            'payment_method' => 'Transfer',
            'reward_id' => $reward->id,
        ]);

        $response->assertStatus(200);
        $response->assertJsonPath('success', true);
        $response->assertJsonPath('snap_token', null);
        $response->assertJsonFragment(['message' => 'Booking sukses terkonfirmasi menggunakan potongan poin penuh!']);

        // Assert booking status is immediately Confirmed
        $booking = Booking::first();
        $this->assertNotNull($booking);
        $this->assertEquals(0, $booking->amount);
        $this->assertEquals('Confirmed', $booking->status);
        $this->assertEquals(250, $booking->points_used);
        $this->assertEquals(0, $booking->points_earned);

        // Check user points
        $customer->refresh();
        $this->assertEquals(50, $customer->points); // 300 - 250
    }
}
