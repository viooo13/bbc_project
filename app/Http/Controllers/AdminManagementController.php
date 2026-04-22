<?php

namespace App\Http\Controllers;

use App\Models\Admin;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminManagementController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $role = trim((string) $request->query('role', ''));
        $status = trim((string) $request->query('status', ''));

        $query = Admin::query();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('username', 'like', "%{$q}%")
                    ->orWhere('email', 'like', "%{$q}%");
            });
        }

        if (in_array($role, ['owner', 'admin'], true)) {
            $query->where('role', $role);
        }

        if (in_array($status, ['active', 'inactive'], true)) {
            $query->where('status', $status);
        }

        $admins = $query->orderByDesc('id')->paginate(10)->withQueryString();
        
        // Jika belum ada admin, generate dummy data
        if ($admins->total() === 0) {
            $this->seedDummyData();
            $admins = Admin::query()->orderByDesc('id')->paginate(10)->withQueryString();
        }
        
        return view('admin.admin-management.index', compact('admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.admin-management.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255|unique:admins',
            'email' => 'required|email|unique:admins',
            'password' => 'required|string|min:6|confirmed',
            'role' => 'required|in:owner,admin',
            'status' => 'required|in:active,inactive'
        ]);

        $validated['password'] = Hash::make($validated['password']);

        Admin::create($validated);

        return redirect()->route('admin.management.index')->with('success', 'Admin berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $admin = Admin::findOrFail($id)->toArray();

        return view('admin.admin-management.edit', compact('admin'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:255',
            'email' => 'required|email',
            'password' => 'nullable|string|min:6|confirmed',
            'role' => 'required|in:owner,admin',
            'status' => 'required|in:active,inactive'
        ]);

        if (!empty($validated['password'])) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        Admin::findOrFail($id)->update($validated);

        return redirect()->route('admin.management.index')->with('success', 'Admin berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Admin::findOrFail($id)->delete();
        return redirect()->route('admin.management.index')->with('success', 'Admin berhasil dihapus');
    }

    /**
     * Seed dummy data jika tabel kosong
     */
    private function seedDummyData()
    {
        $dummyAdmins = [
            [
                'name' => 'Adrian',
                'username' => 'Cekep CEO',
                'email' => 'CekepCT@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'owner',
                'status' => 'active',
            ],
            [
                'name' => 'Vio',
                'username' => 'Vio Chef',
                'email' => 'VioChef@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
            ],
            [
                'name' => 'Jayshita',
                'username' => 'Jayshita Admin',
                'email' => 'Jayshita@gmail.com',
                'password' => Hash::make('password123'),
                'role' => 'admin',
                'status' => 'active',
            ],
        ];

        foreach ($dummyAdmins as $admin) {
            Admin::create($admin);
        }
    }
}
