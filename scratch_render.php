<?php
// Bootstrap Laravel
require __DIR__.'/vendor/autoload.php';
$app = require_once __DIR__.'/bootstrap/app.php';
$kernel = $app->make(Illuminate\Contracts\Console\Kernel::class);
$kernel->bootstrap();

use App\Models\User;
use App\Models\Reward;
use App\Models\Service;

try {
    $adminUser = User::where('role', 'admin')->first();
    if ($adminUser) {
        Auth::login($adminUser);
    }
    
    $services = Service::all();
    $totalUsers = User::count();
    $totalCustomers = User::where('role', 'customer')->count();
    $totalPhotographers = User::where('role', 'photographer')->count();
    $rewards = Reward::orderBy('points_required')->get();
    
    $bookings = collect();
    $customers = collect();
    $allUsers = collect();

    echo "Rendering admin.dashboard...\n";
    $html = view('admin.dashboard', compact(
        'services', 'totalUsers', 'totalCustomers', 'totalPhotographers', 
        'bookings', 'customers', 'allUsers', 'rewards'
    ))->render();
    
    echo "SUCCESS: Rendered dashboard successfully! HTML Length: " . strlen($html) . "\n";
} catch (\Exception $e) {
    echo "ERROR during rendering:\n";
    echo $e->getMessage() . "\n";
    echo $e->getTraceAsString() . "\n";
}
