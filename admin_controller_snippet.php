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
            $serviceLabels = $services->pluck('name')->toArray();
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
