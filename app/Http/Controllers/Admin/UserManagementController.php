<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class UserManagementController extends Controller
{
    public function index(Request $request)
    {
        $query = User::where('role', 'user');

        // Filter by Search
        if ($request->has('q') && $request->q != '') {
            $query->where(function($q) use ($request) {
                $q->where('name', 'like', '%' . $request->q . '%')
                  ->orWhere('email', 'like', '%' . $request->q . '%')
                  ->orWhere('phone', 'like', '%' . $request->q . '%');
            });
        }

        // Sorting Filter
        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'oldest':
                    $query->orderBy('created_at', 'asc');
                    break;
                case 'name_asc':
                    $query->orderBy('name', 'asc');
                    break;
                case 'name_desc':
                    $query->orderBy('name', 'desc');
                    break;
                default: // 'newest'
                    $query->orderBy('created_at', 'desc');
                    break;
            }
        } else {
            $query->orderBy('created_at', 'desc'); // default sort
        }

        $users = $query->paginate(10)->withQueryString();

        return view('admin.kelola-user.index', compact('users'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        
        // Optional: Anda bisa menambahkan logika jika user memiliki pesanan,
        // misalnya tidak bisa dihapus atau set statusnya, tapi biasanya langsung delete
        $user->delete();

        return redirect()->route('admin.user-management.index')->with('success', 'User berhasil dihapus.');
    }
}
