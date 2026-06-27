<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Refund;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    
    private function getDashboardData()
    {
        $filter = request()->query('filter', 'month');
        $services = \App\Models\Service::all();
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalPhotographers = User::where('role', 'photographer')->count();
        $rewards = \App\Models\Reward::orderBy('points_required')->get();
        $totalPointsInCirculation = User::where('role', 'customer')->sum('points');

        // Check if dummy past years
        if (in_array($filter, ['2023', '2024', '2025'])) {
            $year = (int)$filter;
            $totalRevenue = $year == 2023 ? 45000000 : ($year == 2024 ? 85000000 : 120000000);
            $revenueThisMonth = 0;
            $revenueGrowth = 0;
            $pendingBookingsCount = 0;
            
            // Dummy Revenue Data for the selected year
            $monthlyRevenueLabels = ['Jan', 'Feb', 'Mar', 'Apr', 'Mei', 'Jun', 'Jul', 'Ags', 'Sep', 'Okt', 'Nov', 'Des'];
            $monthlyRevenueData = [];
            $base = $totalRevenue / 12;
            for ($i=0; $i<12; $i++) {
                $monthlyRevenueData[] = rand($base * 0.8, $base * 1.2);
            }

            // Dummy Service Data
            $serviceLabels = $services->pluck('title')->toArray();
            $serviceData = array_map(function() { return rand(10, 50); }, $serviceLabels);

            // Dummy Status
            $statusLabels = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];
            $statusData = [0, rand(5,15), rand(100, 200), rand(5,10)];

            // Dummy Photographers
            $photographers = User::where('role', 'photographer')->get();
            $photographerLabels = $photographers->pluck('name')->toArray();
            $photographerData = array_map(function() { return rand(20, 80); }, $photographerLabels);

            $recentBookings = collect();
            $bookings = collect();
            $customers = collect();
            $allUsers = collect();

            return compact('services', 'totalUsers', 'totalCustomers', 'totalPhotographers', 'rewards', 'totalRevenue', 'revenueThisMonth', 'revenueGrowth', 'pendingBookingsCount', 'totalPointsInCirculation', 'monthlyRevenueLabels', 'monthlyRevenueData', 'serviceLabels', 'serviceData', 'statusLabels', 'statusData', 'photographerLabels', 'photographerData', 'recentBookings', 'bookings', 'customers', 'allUsers');
        }

        // --- REALTIME DATA (month, quarter, year, all) ---
        $now = \Carbon\Carbon::now();
        $queryBookings = \App\Models\Booking::query();
        $queryCompleted = \App\Models\Booking::where('status', 'Completed');

        if ($filter == 'month') {
            $queryBookings->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
            $queryCompleted->whereMonth('created_at', $now->month)->whereYear('created_at', $now->year);
        } elseif ($filter == 'quarter') {
            $queryBookings->whereBetween('created_at', [$now->copy()->firstOfQuarter(), $now->copy()->lastOfQuarter()]);
            $queryCompleted->whereBetween('created_at', [$now->copy()->firstOfQuarter(), $now->copy()->lastOfQuarter()]);
        } elseif ($filter == 'year') {
            $queryBookings->whereYear('created_at', $now->year);
            $queryCompleted->whereYear('created_at', $now->year);
        }

        $totalRevenue = (clone $queryCompleted)->sum('amount');
        
        $currentMonth = $now->month;
        $currentYear = $now->year;
        $lastMonth = $now->copy()->subMonth();

        $revenueThisMonth = \App\Models\Booking::where('status', 'Completed')
            ->whereMonth('created_at', $currentMonth)
            ->whereYear('created_at', $currentYear)
            ->sum('amount');
            
        $revenueLastMonth = \App\Models\Booking::where('status', 'Completed')
            ->whereMonth('created_at', $lastMonth->month)
            ->whereYear('created_at', $lastMonth->year)
            ->sum('amount');

        $revenueGrowth = 0;
        if ($revenueLastMonth > 0) {
            $revenueGrowth = (($revenueThisMonth - $revenueLastMonth) / $revenueLastMonth) * 100;
        } elseif ($revenueThisMonth > 0) {
            $revenueGrowth = 100;
        }

        $pendingBookingsCount = (clone $queryBookings)->where('status', 'Pending')->count();

        // A. Monthly Revenue Trend (Last 6 Months, ignoring filter for consistency)
        $monthlyRevenueData = [];
        $monthlyRevenueLabels = [];
        for ($i = 5; $i >= 0; $i--) {
            $date = \Carbon\Carbon::now()->subMonths($i);
            $monthName = $date->translatedFormat('M');
            $monthlyRevenueLabels[] = $monthName;
            
            $revenue = \App\Models\Booking::where('status', 'Completed')
                ->whereMonth('created_at', $date->month)
                ->whereYear('created_at', $date->year)
                ->sum('amount');
            $monthlyRevenueData[] = $revenue;
        }

        // B. Service Popularity
        $serviceCounts = [];
        $allBookingsFiltered = (clone $queryBookings)->get();
        foreach($allBookingsFiltered as $b) {
            $srv = $b->service_name;
            $serviceCounts[$srv] = ($serviceCounts[$srv] ?? 0) + 1;
        }
        $serviceLabels = array_keys($serviceCounts);
        $serviceData = array_values($serviceCounts);

        // C. Booking Status Distribution
        $statusCounts = (clone $queryBookings)->select('status', \DB::raw('count(*) as total'))
            ->groupBy('status')
            ->pluck('total', 'status')->toArray();
        
        $statusLabels = ['Pending', 'Confirmed', 'Completed', 'Cancelled'];
        $statusData = [];
        foreach ($statusLabels as $lbl) {
            $statusData[] = $statusCounts[$lbl] ?? 0;
        }

        // D. Photographer Workload
        $photographerStats = [];
        $photographers = User::where('role', 'photographer')->get();
        foreach ($photographers as $photo) {
            $count = (clone $queryBookings)->where('photographer_id', $photo->id)
                ->whereIn('status', ['Confirmed', 'Completed'])
                ->count();
            $photographerStats[] = [
                'name' => $photo->name,
                'count' => $count
            ];
        }
        usort($photographerStats, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });
        $photographerLabels = array_column($photographerStats, 'name');
        $photographerData = array_column($photographerStats, 'count');

        // --- RECENT ACTIVITY & LEGACY DATA ---
        $recentBookings = (clone $queryBookings)->with('user')->orderBy('created_at', 'desc')->take(5)->get();

        $bookings = \App\Models\Booking::with('user')->orderBy('created_at', 'desc')->get()->map(function($booking) {
            return [
                'id' => $booking->id,
                'name' => $booking->user->name ?? 'User Terhapus',
                'email' => $booking->user->email ?? '',
                'service' => $booking->service_name,
                'date' => $booking->booking_date->format('Y-m-d H:i'),
                'amount' => 'Rp ' . number_format($booking->amount, 0, ',', '.'),
                'status' => $booking->status,
                'requests' => $booking->requests ?? ''
            ];
        });

        $customers = User::where('role', 'customer')->orderBy('points', 'desc')->get()->map(function($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'points' => $customer->points
            ];
        });

        $allUsers = User::orderBy('name')->get()->map(function($usr) {
            return [
                'id' => $usr->id,
                'name' => $usr->name,
                'email' => $usr->email,
                'role' => $usr->role,
                'joined' => $usr->created_at ? $usr->created_at->format('d M Y') : '-'
            ];
        });

        return compact('services', 'totalUsers', 'totalCustomers', 'totalPhotographers', 'rewards', 'totalRevenue', 'revenueThisMonth', 'revenueGrowth', 'pendingBookingsCount', 'totalPointsInCirculation', 'monthlyRevenueLabels', 'monthlyRevenueData', 'serviceLabels', 'serviceData', 'statusLabels', 'statusData', 'photographerLabels', 'photographerData', 'recentBookings', 'bookings', 'customers', 'allUsers');
    }

    public function index()
    {
        $data = $this->getDashboardData();
        return view('admin.dashboard', $data);
    }

    public function dashboardData()
    {
        $data = $this->getDashboardData();
        $data['recentBookingsHtml'] = view('admin.partials.recent_bookings', ['recentBookings' => $data['recentBookings']])->render();
        return response()->json($data);
    }

    /**
     * Display a listing of the bookings / transactions.
     */
    public function bookingsIndex(Request $request)
    {
        $status = $request->query('status', '');
        $search = trim($request->query('search', ''));
        $dateRange = $request->query('date_range', '');

        $query = \App\Models\Booking::with(['user', 'photographer'])->orderBy('created_at', 'desc');

        if ($status && in_array($status, ['Pending', 'Confirmed', 'Completed', 'Cancelled'])) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('service_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($dateRange === 'today') {
            $query->whereDate('booking_date', \Carbon\Carbon::today());
        } elseif ($dateRange === 'this_week') {
            $query->whereBetween('booking_date', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
        } elseif ($dateRange === 'this_month') {
            $query->whereMonth('booking_date', \Carbon\Carbon::now()->month)
                  ->whereYear('booking_date', \Carbon\Carbon::now()->year);
        }

        $bookings = $query->get();

        $totalPending   = \App\Models\Booking::where('status', 'Pending')->count();
        $totalConfirmed = \App\Models\Booking::where('status', 'Confirmed')->count();
        $totalCompleted = \App\Models\Booking::where('status', 'Completed')->count();
        $totalCancelled = \App\Models\Booking::where('status', 'Cancelled')->count();

        $photographers = User::where('role', 'photographer')->orderBy('name')->get();

        return view('admin.bookings.index', compact(
            'bookings', 'status', 'search', 'dateRange',
            'totalPending', 'totalConfirmed', 'totalCompleted', 'totalCancelled',
            'photographers'
        ));
    }

    private function getFilteredBookingsQuery(Request $request)
    {
        $status = $request->query('status', '');
        $search = trim($request->query('search', ''));
        $dateRange = $request->query('date_range', '');

        $query = \App\Models\Booking::with(['user', 'photographer'])->orderBy('created_at', 'desc');

        if ($status && in_array($status, ['Pending', 'Confirmed', 'Completed', 'Cancelled'])) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('id', 'like', "%{$search}%")
                  ->orWhere('service_name', 'like', "%{$search}%")
                  ->orWhereHas('user', function ($uq) use ($search) {
                      $uq->where('name', 'like', "%{$search}%")
                         ->orWhere('email', 'like', "%{$search}%");
                  });
            });
        }

        if ($dateRange === 'today') {
            $query->whereDate('booking_date', \Carbon\Carbon::today());
        } elseif ($dateRange === 'this_week') {
            $query->whereBetween('booking_date', [\Carbon\Carbon::now()->startOfWeek(), \Carbon\Carbon::now()->endOfWeek()]);
        } elseif ($dateRange === 'this_month') {
            $query->whereMonth('booking_date', \Carbon\Carbon::now()->month)
                  ->whereYear('booking_date', \Carbon\Carbon::now()->year);
        }

        return $query;
    }

    public function exportBookingsCsv(Request $request)
    {
        $bookings = $this->getFilteredBookingsQuery($request)->get();

        $fileName = 'laporan_transaksi_studio_' . date('Y-m-d') . '.csv';
        $headers = [
            "Content-type"        => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        $columns = [
            'ID Booking', 'Tanggal Dibuat', 'Jadwal Sesi', 'Pelanggan', 'Email', 
            'Layanan', 'Total Biaya', 'Metode Pembayaran', 'Status', 'Fotografer', 'Catatan Khusus'
        ];

        $callback = function() use($bookings, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($bookings as $booking) {
                $row = [
                    $booking->id,
                    $booking->created_at->format('Y-m-d H:i:s'),
                    $booking->booking_date->format('Y-m-d H:i:s'),
                    $booking->user->name ?? 'User Terhapus',
                    $booking->user->email ?? '',
                    $booking->service_name,
                    $booking->amount,
                    $booking->payment_method ?? 'Transfer',
                    $booking->status,
                    $booking->photographer->name ?? 'Belum Ditugaskan',
                    $booking->requests ?? '-'
                ];
                fputcsv($file, $row);
            }
            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

    public function exportBookingsWord(Request $request)
    {
        $status = $request->query('status', '');
        $dateRange = $request->query('date_range', '');
        $bookings = $this->getFilteredBookingsQuery($request)->get();

        $totalBookings = $bookings->count();
        $totalRevenue = $bookings->where('status', 'Completed')->sum('amount');
        
        $photographerStats = [];
        $photographers = User::where('role', 'photographer')->get();
        foreach ($photographers as $photographer) {
            $count = $bookings->where('photographer_id', $photographer->id)->count();
            if ($count >= 0) {
                $photographerStats[] = [
                    'name' => $photographer->name,
                    'count' => $count
                ];
            }
        }
        usort($photographerStats, function($a, $b) {
            return $b['count'] <=> $a['count'];
        });

        // QuickChart Pie Chart Base64
        $serviceCounts = [];
        foreach($bookings as $booking) {
            $service = $booking->service_name;
            $serviceCounts[$service] = ($serviceCounts[$service] ?? 0) + 1;
        }
        $pieConfig = [
            'type' => 'pie',
            'data' => [
                'labels' => array_keys($serviceCounts),
                'datasets' => [['data' => array_values($serviceCounts)]]
            ]
        ];
        
        // Use stream context to avoid timeouts/SSL issues if any
        $context = stream_context_create([
            "http" => ["method" => "GET", "timeout" => 10, "ignore_errors" => true],
            "ssl" => ["verify_peer" => false, "verify_peer_name" => false],
        ]);

        $pieChartUrl = 'https://quickchart.io/chart?w=350&h=200&c=' . urlencode(json_encode($pieConfig));
        $pieChartData = @file_get_contents($pieChartUrl, false, $context);
        $pieChartBase64 = $pieChartData ? 'data:image/png;base64,' . base64_encode($pieChartData) : '';

        // QuickChart Bar Chart Base64
        $barConfig = [
            'type' => 'bar',
            'data' => [
                'labels' => array_column($photographerStats, 'name'),
                'datasets' => [[
                    'label' => 'Total Sesi',
                    'data' => array_column($photographerStats, 'count')
                ]]
            ]
        ];
        $barChartUrl = 'https://quickchart.io/chart?w=400&h=200&c=' . urlencode(json_encode($barConfig));
        $barChartData = @file_get_contents($barChartUrl, false, $context);
        $barChartBase64 = $barChartData ? 'data:image/png;base64,' . base64_encode($barChartData) : '';

        $fileName = 'laporan_transaksi_studio_' . date('Y-m-d') . '.doc';
        $headers = [
            "Content-type"        => "application/vnd.ms-word",
            "Content-Disposition" => "attachment;Filename=$fileName",
            "Pragma"              => "no-cache",
            "Cache-Control"       => "must-revalidate, post-check=0, pre-check=0",
            "Expires"             => "0"
        ];

        return response()->view('admin.bookings.report', compact(
            'bookings', 'status', 'dateRange', 'totalBookings', 'totalRevenue', 'photographerStats',
            'pieChartBase64', 'barChartBase64'
        ), 200, $headers);
    }

    /**
     * Manually assign photographer to a booking.
     */
    public function assignPhotographer(Request $request, $id)
    {
        $booking = \App\Models\Booking::findOrFail($id);
        
        $request->validate([
            'photographer_id' => 'nullable|exists:users,id,role,photographer',
        ]);

        $booking->photographer_id = $request->photographer_id;
        $booking->save();

        $photographerName = $booking->photographer ? $booking->photographer->name : 'Tidak Ada';

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Fotografer untuk booking ' . $booking->id . ' berhasil diatur ke ' . $photographerName . '!');
    }

    /**
     * Automatically assign unassigned Confirmed bookings to photographers evenly.
     */
    public function autoAssignPhotographers(Request $request)
    {
        // Get all photographers
        $photographers = User::where('role', 'photographer')->get();

        if ($photographers->isEmpty()) {
            return redirect()->route('admin.bookings.index')
                ->with('error', 'Tidak ada fotografer terdaftar untuk dibagikan sesi!');
        }

        // Get all Confirmed bookings that do not have photographer assigned yet
        $unassignedBookings = \App\Models\Booking::where('status', 'Confirmed')
            ->whereNull('photographer_id')
            ->orderBy('booking_date', 'asc')
            ->get();

        if ($unassignedBookings->isEmpty()) {
            return redirect()->route('admin.bookings.index')
                ->with('info', 'Tidak ada booking terkonfirmasi yang membutuhkan pembagian fotografer.');
        }

        // We want to distribute them evenly. Let's count how many bookings each photographer has currently.
        $photographerLoads = [];
        foreach ($photographers as $photo) {
            $load = \App\Models\Booking::where('photographer_id', $photo->id)
                ->whereIn('status', ['Confirmed', 'Pending'])
                ->count();
            $photographerLoads[$photo->id] = $load;
        }

        $assignedCount = 0;
        foreach ($unassignedBookings as $booking) {
            // Find the photographer with the least load
            asort($photographerLoads);
            reset($photographerLoads);
            $photographerId = key($photographerLoads);

            // Assign the booking
            $booking->photographer_id = $photographerId;
            $booking->save();

            // Increment their load in our tracking array
            $photographerLoads[$photographerId]++;
            $assignedCount++;
        }

        return redirect()->route('admin.bookings.index')
            ->with('success', 'Berhasil membagikan ' . $assignedCount . ' sesi pemotretan secara merata kepada fotografer!');
    }

    // ─────────────────────────────────────────
    //  USER MANAGEMENT
    // ─────────────────────────────────────────

    /**
     * Display a listing of users grouped by role.
     */
    public function usersIndex(Request $request)
    {
        $role   = $request->query('role', '');
        $search = trim($request->query('search', ''));

        $query = User::orderBy('name');

        if ($role && in_array($role, ['admin', 'photographer', 'customer'])) {
            $query->where('role', $role);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('email', 'like', "%{$search}%");
            });
        }

        $users         = $query->get();
        $totalAdmins   = User::where('role', 'admin')->count();
        $totalPhotogs  = User::where('role', 'photographer')->count();
        $totalCustomers = User::where('role', 'customer')->count();

        return view('admin.users.index', compact(
            'users', 'role', 'search',
            'totalAdmins', 'totalPhotogs', 'totalCustomers'
        ));
    }

    /**
     * Show form to create a new user.
     */
    public function createUser(Request $request)
    {
        $role = $request->query('role', 'customer');
        return view('admin.users.create', compact('role'));
    }

    /**
     * Store a newly created user.
     */
    public function storeUser(Request $request)
    {
        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'role'     => ['required', 'string', 'in:admin,photographer,customer'],
            'password' => ['required', 'string', 'min:6', 'confirmed'],
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'role'     => $request->role,
            'password' => Hash::make($request->password),
            'points'   => 0,
        ]);

        return redirect()->route('admin.users.index', ['role' => $request->role])
            ->with('success', 'Akun ' . ucfirst($request->role) . ' berhasil ditambahkan!');
    }

    /**
     * Show form to edit an existing user.
     */
    public function editUser($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    /**
     * Update the specified user.
     */
    public function updateUser(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'name'     => ['required', 'string', 'max:255'],
            'email'    => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'role'     => ['required', 'string', 'in:admin,photographer,customer'],
            'password' => ['nullable', 'string', 'min:6'],
        ]);

        $user->name  = $request->name;
        $user->email = $request->email;
        $user->role  = $request->role;

        if ($request->filled('password')) {
            $user->password = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index', ['role' => $user->role])
            ->with('success', 'Data user berhasil diperbarui!');
    }

    /**
     * Remove the specified user.
     */
    public function deleteUser($id)
    {
        $user = User::findOrFail($id);

        if (Auth::id() == $id) {
            return back()->with('error', 'Anda tidak bisa menghapus akun Anda sendiri!');
        }

        $role = $user->role;
        $user->delete();

        return redirect()->route('admin.users.index', ['role' => $role])
            ->with('success', 'User berhasil dihapus!');
    }

    /**
     * Add points to a customer.
     */
    public function addPoints(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'points' => ['required', 'integer', 'min:1', 'max:99999'],
            'action' => ['required', 'in:add,set,sub'],
        ]);

        if ($request->action === 'set') {
            $user->points = $request->points;
        } elseif ($request->action === 'sub') {
            $user->points = max(0, $user->points - $request->points);
        } else {
            $user->points += $request->points;
        }

        $user->save();

        // Notify the customer about their points update
        if ($user->role === 'customer') {
            $action_labels = ['add' => 'ditambahkan', 'sub' => 'dikurangi', 'set' => 'disesuaikan'];
            $label = $action_labels[$request->action] ?? 'diperbarui';
            NotificationController::notify(
                $user->id,
                'points_updated',
                '🌟 Poin Loyalitas Diperbarui',
                'Poin Anda telah ' . $label . ' oleh admin. Total poin Anda sekarang: ' . $user->points . ' poin.',
                route('customer.loyalty')
            );
        }

        if ($request->wantsJson()) {
            return response()->json([
                'success' => true,
                'user' => [
                    'id' => $user->id,
                    'name' => $user->name,
                    'email' => $user->email,
                    'points' => $user->points
                ]
            ]);
        }

        return redirect()->route('admin.users.index', ['role' => 'customer'])
            ->with('success', 'Poin customer ' . $user->name . ' berhasil diperbarui!');
    }

    /**
     * Display a listing of holidays and session slots.
     */
    public function holidaysIndex()
    {
        $holidays = \App\Models\Holiday::orderBy('date')->get()->map(function($h) {
            return [
                'id' => $h->id,
                'date' => $h->date->format('Y-m-d'),
                'desc' => $h->desc
            ];
        });
        
        $timeSlots = \App\Models\TimeSlot::all()->sortBy(function($slot) {
            return preg_replace('/[^0-9]/', '', $slot->time);
        })->map(function($s) {
            return [
                'id' => $s->id,
                'time' => $s->time
            ];
        })->values();

        $settingsPath = storage_path('app/settings.json');
        $settings = file_exists($settingsPath) ? json_decode(file_get_contents($settingsPath), true) : [];
        $mapAddress = $settings['map_address'] ?? 'Studio.mu Building, Jl. Sunset Boulevard No. 101, Jakarta Selatan, Indonesia';
        $mapIframeUrl = $settings['map_iframe_url'] ?? 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3966.273617300705!2d106.81223961529528!3d-6.227561862725514!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e69f15049cf525b%3A0x6b9d6287bc1a28a3!2sSenayan%20City!5e0!3m2!1sid!2sid!4v1652885955681!5m2!1sid!2sid';
        $mapLinkUrl = $settings['map_link_url'] ?? 'https://maps.google.com/?q=-6.227561,106.812239';

        return view('admin.holidays.index', compact('holidays', 'timeSlots', 'mapAddress', 'mapIframeUrl', 'mapLinkUrl'));
    }

    /**
     * Store a newly created holiday.
     */
    public function storeHoliday(Request $request)
    {
        $request->validate([
            'date' => 'required|date|unique:holidays,date',
            'desc' => 'nullable|string'
        ]);

        $holiday = \App\Models\Holiday::create([
            'date' => $request->date,
            'desc' => $request->desc ?? 'Studio Libur'
        ]);

        return response()->json([
            'success' => true,
            'holiday' => [
                'id' => $holiday->id,
                'date' => $holiday->date->format('Y-m-d'),
                'desc' => $holiday->desc
            ]
        ]);
    }

    /**
     * Remove the specified holiday.
     */
    public function deleteHoliday($id)
    {
        $holiday = \App\Models\Holiday::findOrFail($id);
        $holiday->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Store a newly created operational time slot.
     */
    public function storeTimeSlot(Request $request)
    {
        $request->validate([
            'time' => 'required|string|unique:time_slots,time'
        ]);

        $slot = \App\Models\TimeSlot::create([
            'time' => $request->time
        ]);

        return response()->json([
            'success' => true,
            'slot' => [
                'id' => $slot->id,
                'time' => $slot->time
            ]
        ]);
    }

    /**
     * Remove the specified operational time slot.
     */
    public function deleteTimeSlot($id)
    {
        $slot = \App\Models\TimeSlot::findOrFail($id);
        $slot->delete();

        return response()->json([
            'success' => true
        ]);
    }

    /**
     * Display a listing of customer loyalty balances and settings.
     */
    public function loyaltyIndex()
    {
        $rewards = \App\Models\Reward::orderBy('points_required')->get();
        $customers = User::where('role', 'customer')->orderBy('points', 'desc')->get()->map(function($customer) {
            return [
                'id' => $customer->id,
                'name' => $customer->name,
                'email' => $customer->email,
                'points' => $customer->points
            ];
        });

        return view('admin.loyalty.index', compact('rewards', 'customers'));
    }

    /**
     * Display a listing of the services.
     */
    public function servicesIndex()
    {
        $services = \App\Models\Service::all();
        return view('admin.services.index', compact('services'));
    }

    /**
     * Show the form for creating a new service.
     */
    public function createService()
    {
        return view('admin.services.create');
    }

    /**
     * Store a newly created service.
     */
    public function storeService(Request $request)
    {
        $request->validate([
            'title'    => 'required|string',
            'starting' => 'required|string',
            'slides.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Upload multiple slides
        $slidePaths = [];
        if ($request->hasFile('slides')) {
            foreach ($request->file('slides') as $file) {
                $slidePaths[] = $file->store('services', 'public');
            }
        }

        $data = [
            'title'       => $request->input('title'),
            'starting'    => $request->input('starting'),
            'description' => $request->input('description'),
            'note'        => $request->input('note'),
            'slides'      => $slidePaths,
            'highlights'  => array_values(array_filter(array_map('trim', explode("\n", $request->input('highlights', ''))))),
            'col1' => [
                'title'    => $request->input('col1_title', ''),
                'old'      => $request->input('col1_old', ''),
                'new'      => $request->input('col1_new', ''),
                'features' => array_values(array_filter(array_map('trim', explode("\n", $request->input('col1_features', '')))))
            ],
            'col2' => [
                'title'    => $request->input('col2_title', ''),
                'old'      => $request->input('col2_old', ''),
                'new'      => $request->input('col2_new', ''),
                'features' => array_values(array_filter(array_map('trim', explode("\n", $request->input('col2_features', '')))))
            ],
            'addons' => array_values(array_filter(array_map(function($addon) {
                return [
                    'name' => trim($addon['name'] ?? ''),
                    'price' => (int) ($addon['price'] ?? 0)
                ];
            }, $request->input('addons', [])), function($item) {
                return $item['name'] !== '';
            })),
        ];

        \App\Models\Service::create($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil ditambahkan!');
    }

    /**
     * Show the form for editing the specified service.
     */
    public function editService($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        return view('admin.services.edit', compact('service'));
    }

    /**
     * Update the specified service.
     */
    public function updateService(Request $request, $id)
    {
        $service = \App\Models\Service::findOrFail($id);

        $request->validate([
            'title'    => 'required|string',
            'starting' => 'required|string',
            'slides.*' => 'image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $oldSlides = $service->slides ?? [];
        
        // Handle deletions of existing photos
        $deletedSlides = $request->input('delete_slides', []);
        if (!empty($deletedSlides)) {
            foreach ($deletedSlides as $delPath) {
                if (in_array($delPath, $oldSlides)) {
                    Storage::disk('public')->delete($delPath);
                }
            }
            // Remove deleted items from $oldSlides
            $oldSlides = array_filter($oldSlides, function($path) use ($deletedSlides) {
                return !in_array($path, $deletedSlides);
            });
        }

        // Initialize slide paths with remaining old slides (re-indexed)
        $slidePaths = array_values($oldSlides);

        // Append new files if uploaded
        if ($request->hasFile('slides')) {
            foreach ($request->file('slides') as $file) {
                $slidePaths[] = $file->store('services', 'public');
            }
        }


        $data = [
            'title'       => $request->input('title'),
            'starting'    => $request->input('starting'),
            'description' => $request->input('description'),
            'note'        => $request->input('note'),
            'slides'      => $slidePaths,
            'highlights'  => array_values(array_filter(array_map('trim', explode("\n", $request->input('highlights', ''))))),
            'col1' => [
                'title'    => $request->input('col1_title', ''),
                'old'      => $request->input('col1_old', ''),
                'new'      => $request->input('col1_new', ''),
                'features' => array_values(array_filter(array_map('trim', explode("\n", $request->input('col1_features', '')))))
            ],
            'col2' => [
                'title'    => $request->input('col2_title', ''),
                'old'      => $request->input('col2_old', ''),
                'new'      => $request->input('col2_new', ''),
                'features' => array_values(array_filter(array_map('trim', explode("\n", $request->input('col2_features', '')))))
            ],
            'addons' => array_values(array_filter(array_map(function($addon) {
                return [
                    'name' => trim($addon['name'] ?? ''),
                    'price' => (int) ($addon['price'] ?? 0)
                ];
            }, $request->input('addons', [])), function($item) {
                return $item['name'] !== '';
            })),
        ];

        $service->update($data);

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil diperbarui!');
    }

    /**
     * Remove the specified service.
     */
    public function deleteService($id)
    {
        $service = \App\Models\Service::findOrFail($id);
        $service->delete();

        return redirect()->route('admin.services.index')->with('success', 'Layanan berhasil dihapus!');
    }

    /**
     * Save loyalty points multiplier configuration.
     */
    public function saveMultiplier(Request $request)
    {
        $request->validate([
            'multiplier' => 'required|integer|min:100',
        ]);

        $settingsPath = storage_path('app/settings.json');
        $settings = file_exists($settingsPath) ? json_decode(file_get_contents($settingsPath), true) : [];
        $settings['points_multiplier'] = $request->multiplier;

        if (!file_exists(dirname($settingsPath))) {
            mkdir(dirname($settingsPath), 0755, true);
        }
        file_put_contents($settingsPath, json_encode($settings));

        return response()->json(['success' => true]);
    }

    /**
     * Save map and location settings.
     */
    public function saveLocationSettings(Request $request)
    {
        $request->validate([
            'map_address' => 'required|string',
            'map_iframe_url' => 'required|string',
            'map_link_url' => 'required|string',
        ]);

        $settingsPath = storage_path('app/settings.json');
        $settings = file_exists($settingsPath) ? json_decode(file_get_contents($settingsPath), true) : [];
        
        $settings['map_address'] = $request->map_address;
        $settings['map_iframe_url'] = $request->map_iframe_url;
        $settings['map_link_url'] = $request->map_link_url;

        if (!file_exists(dirname($settingsPath))) {
            mkdir(dirname($settingsPath), 0755, true);
        }
        file_put_contents($settingsPath, json_encode($settings));

        return response()->json(['success' => true]);
    }

    /**
     * Show reviews from customers.
     */
    public function reviewsIndex()
    {
        $reviews = \App\Models\Booking::with(['user', 'photographer'])
            ->whereNotNull('review')
            ->orderBy('updated_at', 'desc')
            ->get();

        return view('admin.reviews.index', compact('reviews'));
    }

    /**
     * Show all pending and processed refunds.
     */
    public function refundsIndex()
    {
        $refunds = Refund::with(['booking.user'])
            ->orderByRaw("FIELD(status, 'pending', 'completed')")
            ->orderBy('created_at', 'desc')
            ->get();

        $pendingCount = $refunds->where('status', 'pending')->count();

        return view('admin.refunds.index', compact('refunds', 'pendingCount'));
    }

    /**
     * Mark a refund as completed (admin has transferred the funds).
     */
    public function processRefund(Request $request, $id)
    {
        $refund = Refund::with('booking.user')->findOrFail($id);

        if ($refund->status === 'completed') {
            return redirect()->route('admin.refunds.index')->with('info', 'Refund ini sudah diproses sebelumnya.');
        }

        $refund->update([
            'status'       => 'completed',
            'processed_at' => now(),
        ]);

        // Notify the customer that refund is done
        if ($refund->booking && $refund->booking->user) {
            $customer = $refund->booking->user;
            NotificationController::notify(
                $customer->id,
                'refund_completed',
                '✅ Refund Berhasil Dikirim',
                'Dana refund untuk Booking #' . $refund->booking_id . ' sebesar Rp ' . number_format($refund->amount, 0, ',', '.') . ' telah berhasil ditransfer ke rekening Anda (' . $refund->account_holder . ' — ' . $refund->bank_name . ' ' . $refund->account_number . '). Terima kasih!',
                route('customer.history')
            );
        }

        return redirect()->route('admin.refunds.index')->with('success', 'Refund #' . $refund->id . ' berhasil ditandai selesai. Notifikasi telah dikirim ke customer.');
    }
}
