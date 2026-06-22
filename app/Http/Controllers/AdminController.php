<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function index()
    {
        $services = \App\Models\Service::all();
        $totalUsers = User::count();
        $totalCustomers = User::where('role', 'customer')->count();
        $totalPhotographers = User::where('role', 'photographer')->count();
        $rewards = \App\Models\Reward::orderBy('points_required')->get();

        // Fetch bookings & customers for the admin dashboard
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

        return view('admin.dashboard', compact('services', 'totalUsers', 'totalCustomers', 'totalPhotographers', 'bookings', 'customers', 'allUsers', 'rewards'));
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
            'password' => ['required', 'string', 'min:6'],
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
        return view('admin.holidays.index');
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
            'slide_1'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_2'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_3'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_4'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_5'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        // Upload each slide slot individually
        $slidePaths = [];
        for ($i = 1; $i <= 5; $i++) {
            if ($request->hasFile("slide_{$i}")) {
                $slidePaths[] = $request->file("slide_{$i}")->store('services', 'public');
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
            'slide_1'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_2'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_3'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_4'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
            'slide_5'  => 'nullable|image|mimes:jpeg,png,jpg,gif,webp|max:4096',
        ]);

        $oldSlides = $service->slides ?? [];
        $slidePaths = [];

        // For each slot: if new file uploaded → replace old, else keep old
        for ($i = 1; $i <= 5; $i++) {
            $oldPath = $oldSlides[$i - 1] ?? null;
            if ($request->hasFile("slide_{$i}")) {
                // Delete old file if it exists
                if ($oldPath) {
                    Storage::disk('public')->delete($oldPath);
                }
                $slidePaths[] = $request->file("slide_{$i}")->store('services', 'public');
            } elseif ($oldPath) {
                // Keep the existing photo for this slot
                $slidePaths[] = $oldPath;
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
}
