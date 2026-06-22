<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

Route::get('/', function () {
    $services = \App\Models\Service::all();
    return view('welcome', compact('services'));
})->name('welcome');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Password Reset Routes
Route::get('/forgot-password', [AuthController::class, 'showForgotPassword'])->name('password.request');
Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reset-password/{token}', [AuthController::class, 'showResetPassword'])->name('password.reset');
Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Protected Routes
Route::middleware('auth')->group(function () {
    Route::get('/menu-utama', function () {
        $user = Auth::user();
        $bookings = $user ? $user->bookings()->orderBy('created_at', 'desc')->get()->map(function($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->user->name ?? 'User Terhapus',
                'email' => $booking->user->email ?? '',
                'service' => $booking->service_name,
                'date' => $booking->booking_date->format('d M Y') . ', ' . $booking->booking_date->format('H.i') . ' - ' . $booking->booking_date->copy()->addHour()->format('H.i'),
                'amount' => 'Rp ' . number_format($booking->amount, 0, ',', '.'),
                'status' => $booking->status,
                'requests' => $booking->requests ?? '',
                'snap_token' => $booking->snap_token ?? '',
                'payment_method' => $booking->payment_method ?? 'Transfer',
                'result_link' => $booking->result_link ?? '',
                'photographer_name' => $booking->photographer->name ?? 'Belum Ditugaskan'
            ];
        }) : collect();
        $rewards = \App\Models\Reward::active()->orderBy('points_required')->get();
        $services = \App\Models\Service::all();
        return view('customer.dashboard', compact('bookings', 'rewards', 'services'));
    })->name('customer.dashboard')->middleware('role:customer');

    Route::get('/poin-loyalitas', function () {
        $user = Auth::user();
        $points = $user->points ?? 0;
        $rewards = \App\Models\Reward::active()->orderBy('points_required')->get();
        $bookings = $user ? $user->bookings()
            ->where(function($q) {
                $q->where('points_earned', '>', 0)
                  ->orWhere('points_used', '>', 0);
            })
            ->orderBy('booking_date', 'desc')
            ->get() : collect();
        return view('customer.loyalty', compact('points', 'rewards', 'bookings'));
    })->name('customer.loyalty')->middleware(['role:customer']);

    Route::get('/riwayat-booking', [BookingController::class, 'historyIndex'])->name('customer.history')->middleware('role:customer');

    Route::get('/galeri-foto', function () {
        $user = Auth::user();
        $bookings = $user ? $user->bookings()->orderBy('created_at', 'desc')->get()->map(function($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->user->name ?? 'User Terhapus',
                'email' => $booking->user->email ?? '',
                'service' => $booking->service_name,
                'date' => $booking->booking_date->format('d M Y') . ', ' . $booking->booking_date->format('H.i') . ' - ' . $booking->booking_date->copy()->addHour()->format('H.i'),
                'amount' => 'Rp ' . number_format($booking->amount, 0, ',', '.'),
                'status' => $booking->status,
                'requests' => $booking->requests ?? '',
                'snap_token' => $booking->snap_token ?? '',
                'payment_method' => $booking->payment_method ?? 'Transfer',
                'result_link' => $booking->result_link ?? '',
                'photographer_name' => $booking->photographer->name ?? 'Belum Ditugaskan'
            ];
        }) : collect();
        return view('customer.gallery', compact('bookings'));
    })->name('customer.gallery')->middleware('role:customer');

    Route::get('/booking/{service}', function ($service) {
        $rewards = \App\Models\Reward::active()->orderBy('points_required')->get();
        $services = \App\Models\Service::all();
        return view('customer.booking', [
            'serviceKey' => $service,
            'rewards' => $rewards,
            'userPoints' => Auth::user()->points ?? 0,
            'services' => $services
        ]);
    })->name('customer.booking')->middleware('role:customer');

    Route::get('/admin/dashboard', [\App\Http\Controllers\AdminController::class, 'index'])->name('admin.dashboard')->middleware('role:admin');
    Route::get('/admin/holidays', [\App\Http\Controllers\AdminController::class, 'holidaysIndex'])->name('admin.holidays.index')->middleware('role:admin');
    Route::get('/admin/loyalty', [\App\Http\Controllers\AdminController::class, 'loyaltyIndex'])->name('admin.loyalty.index')->middleware('role:admin');


    // Admin Booking/Transaction Management Routes
    Route::get('/admin/bookings', [\App\Http\Controllers\AdminController::class, 'bookingsIndex'])->name('admin.bookings.index')->middleware('role:admin');
    Route::post('/admin/bookings/{id}/assign', [\App\Http\Controllers\AdminController::class, 'assignPhotographer'])->name('admin.bookings.assign')->middleware('role:admin');
    Route::post('/admin/bookings/auto-assign', [\App\Http\Controllers\AdminController::class, 'autoAssignPhotographers'])->name('admin.bookings.autoAssign')->middleware('role:admin');

    // Admin User Management Routes
    Route::get('/admin/users', [\App\Http\Controllers\AdminController::class, 'usersIndex'])->name('admin.users.index')->middleware('role:admin');
    Route::get('/admin/users/create', [\App\Http\Controllers\AdminController::class, 'createUser'])->name('admin.users.create')->middleware('role:admin');
    Route::post('/admin/users', [\App\Http\Controllers\AdminController::class, 'storeUser'])->name('admin.users.store')->middleware('role:admin');
    Route::get('/admin/users/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editUser'])->name('admin.users.edit')->middleware('role:admin');
    Route::put('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'updateUser'])->name('admin.users.update')->middleware('role:admin');
    Route::delete('/admin/users/{id}', [\App\Http\Controllers\AdminController::class, 'deleteUser'])->name('admin.users.destroy')->middleware('role:admin');
    Route::post('/admin/users/{id}/points', [\App\Http\Controllers\AdminController::class, 'addPoints'])->name('admin.users.points')->middleware('role:admin');
    
    // Admin Service Routes
    Route::get('/admin/services', [\App\Http\Controllers\AdminController::class, 'servicesIndex'])->name('admin.services.index')->middleware('role:admin');
    Route::get('/admin/services/create', [\App\Http\Controllers\AdminController::class, 'createService'])->name('admin.services.create')->middleware('role:admin');
    Route::post('/admin/services', [\App\Http\Controllers\AdminController::class, 'storeService'])->name('admin.services.store')->middleware('role:admin');
    Route::get('/admin/services/{id}/edit', [\App\Http\Controllers\AdminController::class, 'editService'])->name('admin.services.edit')->middleware('role:admin');
    Route::put('/admin/services/{id}', [\App\Http\Controllers\AdminController::class, 'updateService'])->name('admin.services.update')->middleware('role:admin');
    Route::delete('/admin/services/{id}', [\App\Http\Controllers\AdminController::class, 'deleteService'])->name('admin.services.destroy')->middleware('role:admin');

    // Admin Reward / Loyalty Routes
    Route::get('/admin/rewards', [\App\Http\Controllers\RewardController::class, 'index'])->name('admin.rewards.index')->middleware('role:admin');
    Route::get('/admin/rewards/create', [\App\Http\Controllers\RewardController::class, 'create'])->name('admin.rewards.create')->middleware('role:admin');
    Route::post('/admin/rewards', [\App\Http\Controllers\RewardController::class, 'store'])->name('admin.rewards.store')->middleware('role:admin');
    Route::get('/admin/rewards/{id}/edit', [\App\Http\Controllers\RewardController::class, 'edit'])->name('admin.rewards.edit')->middleware('role:admin');
    Route::put('/admin/rewards/{id}', [\App\Http\Controllers\RewardController::class, 'update'])->name('admin.rewards.update')->middleware('role:admin');
    Route::post('/admin/rewards/{id}/toggle', [\App\Http\Controllers\RewardController::class, 'toggleStatus'])->name('admin.rewards.toggle')->middleware('role:admin');
    Route::delete('/admin/rewards/{id}', [\App\Http\Controllers\RewardController::class, 'destroy'])->name('admin.rewards.destroy')->middleware('role:admin');

    Route::get('/photographer/jadwal', function () {
        $photographer = Auth::user();
        $bookings = \App\Models\Booking::with('user')
            ->where('photographer_id', $photographer->id)
            ->orderBy('booking_date', 'asc')
            ->get();
        
        $completedCount = $bookings->where('status', 'Completed')->count();
        $pendingCount = $bookings->where('status', 'Confirmed')->count();

        return view('photographer.dashboard', compact('bookings', 'completedCount', 'pendingCount'));
    })->name('photographer.dashboard')->middleware('role:photographer');

    Route::post('/photographer/bookings/{id}/complete', [\App\Http\Controllers\BookingController::class, 'completeSession'])
        ->name('photographer.bookings.complete')
        ->middleware('role:photographer');

    Route::post('/photographer/bookings/{id}/result-link', [\App\Http\Controllers\BookingController::class, 'updateResultLink'])
        ->name('photographer.bookings.resultLink')
        ->middleware('role:photographer');

    // Customer Booking Routes
    Route::post('/booking', [BookingController::class, 'store'])->name('booking.store')->middleware('role:customer');
    Route::post('/booking/{id}/confirm-payment', [BookingController::class, 'confirmPayment'])->name('booking.confirmPayment')->middleware('role:customer');
    Route::get('/payment/finish', [PaymentController::class, 'finish'])->name('payment.finish')->middleware('role:customer');
    Route::get('/payment/error', [PaymentController::class, 'error'])->name('payment.error')->middleware('role:customer');

    // Admin Booking & Settings Routes
    Route::put('/admin/bookings/{id}/status', [BookingController::class, 'updateStatus'])->name('admin.bookings.updateStatus')->middleware('role:admin');
    Route::post('/admin/settings/multiplier', [\App\Http\Controllers\AdminController::class, 'saveMultiplier'])->name('admin.settings.multiplier')->middleware('role:admin');
});

// Midtrans Webhook Callback Route (must be outside auth middleware, and CSRF is excluded in bootstrap/app.php)
Route::post('/booking/callback', [PaymentController::class, 'callback'])->name('booking.callback');
