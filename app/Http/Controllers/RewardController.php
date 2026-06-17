<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reward;
use Illuminate\Support\Str;

class RewardController extends Controller
{
    /**
     * Display a listing of rewards.
     */
    public function index(Request $request)
    {
        $status = $request->query('status', '');
        $search = trim($request->query('search', ''));

        $query = Reward::orderBy('points_required');

        if ($status && in_array($status, ['active', 'inactive'])) {
            $query->where('status', $status);
        }

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                $q->where('name', 'like', "%{$search}%")
                  ->orWhere('code', 'like', "%{$search}%");
            });
        }

        $rewards      = $query->get();
        $totalActive  = Reward::where('status', 'active')->count();
        $totalInactive = Reward::where('status', 'inactive')->count();

        return view('admin.rewards.index', compact(
            'rewards', 'status', 'search', 'totalActive', 'totalInactive'
        ));
    }

    /**
     * Show form to create a new reward.
     */
    public function create()
    {
        return view('admin.rewards.create');
    }

    /**
     * Store a newly created reward.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'code'            => ['required', 'string', 'max:50', 'unique:rewards,code'],
            'points_required' => ['required', 'integer', 'min:1'],
            'type'            => ['required', 'in:discount,free_session,other'],
            'discount_amount' => ['nullable', 'integer', 'min:0'],
            'status'          => ['required', 'in:active,inactive'],
            'stock'           => ['nullable', 'integer', 'min:0'],
        ]);

        Reward::create([
            'name'            => $request->name,
            'description'     => $request->description,
            'code'            => strtoupper($request->code),
            'points_required' => $request->points_required,
            'type'            => $request->type,
            'discount_amount' => $request->discount_amount,
            'status'          => $request->status,
            'stock'           => $request->stock ?: null,
        ]);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward "' . $request->name . '" berhasil ditambahkan!');
    }

    /**
     * Show form to edit a reward.
     */
    public function edit($id)
    {
        $reward = Reward::findOrFail($id);
        return view('admin.rewards.edit', compact('reward'));
    }

    /**
     * Update the specified reward.
     */
    public function update(Request $request, $id)
    {
        $reward = Reward::findOrFail($id);

        $request->validate([
            'name'            => ['required', 'string', 'max:255'],
            'description'     => ['nullable', 'string'],
            'code'            => ['required', 'string', 'max:50', 'unique:rewards,code,' . $id],
            'points_required' => ['required', 'integer', 'min:1'],
            'type'            => ['required', 'in:discount,free_session,other'],
            'discount_amount' => ['nullable', 'integer', 'min:0'],
            'status'          => ['required', 'in:active,inactive'],
            'stock'           => ['nullable', 'integer', 'min:0'],
        ]);

        $reward->update([
            'name'            => $request->name,
            'description'     => $request->description,
            'code'            => strtoupper($request->code),
            'points_required' => $request->points_required,
            'type'            => $request->type,
            'discount_amount' => $request->discount_amount,
            'status'          => $request->status,
            'stock'           => $request->stock ?: null,
        ]);

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward "' . $reward->name . '" berhasil diperbarui!');
    }

    /**
     * Toggle active/inactive status.
     */
    public function toggleStatus($id)
    {
        $reward = Reward::findOrFail($id);
        $reward->status = $reward->status === 'active' ? 'inactive' : 'active';
        $reward->save();

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Status reward "' . $reward->name . '" diubah ke ' . $reward->status . '.');
    }

    /**
     * Delete the specified reward.
     */
    public function destroy($id)
    {
        $reward = Reward::findOrFail($id);
        $name   = $reward->name;
        $reward->delete();

        return redirect()->route('admin.rewards.index')
            ->with('success', 'Reward "' . $name . '" berhasil dihapus.');
    }
}
