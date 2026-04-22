<?php

namespace App\Http\Controllers;

use App\Models\Paket;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;

class PaketController extends Controller
{
    private function normalizeRupiah(?string $value): ?float
    {
        if ($value === null) {
            return null;
        }

        $value = trim($value);
        if ($value === '') {
            return null;
        }

        $normalized = preg_replace('/[^0-9]/', '', $value);
        if ($normalized === null || $normalized === '') {
            return null;
        }

        return (float) $normalized;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $q = trim((string) $request->query('q', ''));
        $status = trim((string) $request->query('status', ''));

        $query = Paket::query();

        if ($q !== '') {
            $query->where(function ($sub) use ($q) {
                $sub->where('name', 'like', "%{$q}%")
                    ->orWhere('description', 'like', "%{$q}%");
            });
        }

        if (in_array($status, ['active', 'inactive'], true)) {
            $query->where('status', $status);
        }

        $pakets = $query->orderByDesc('created_at')->paginate(10)->withQueryString();
        return view('admin.paket.index', compact('pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.paket.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->merge([
            'price' => $this->normalizeRupiah($request->input('price')),
            'original_price' => $this->normalizeRupiah($request->input('original_price')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric|gte:price',
            'portion' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        if (!Schema::hasColumn('pakets', 'original_price')) {
            unset($validated['original_price']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/paket'), $imageName);
            $validated['image'] = 'images/paket/' . $imageName;
        }

        Paket::create($validated);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $paket = Paket::findOrFail($id);
        return view('admin.paket.edit', compact('paket'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $paket = Paket::findOrFail($id);

        $request->merge([
            'price' => $this->normalizeRupiah($request->input('price')),
            'original_price' => $this->normalizeRupiah($request->input('original_price')),
        ]);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'original_price' => 'nullable|numeric|gte:price',
            'portion' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        if (!Schema::hasColumn('pakets', 'original_price')) {
            unset($validated['original_price']);
        }

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($paket->image && file_exists(public_path($paket->image))) {
                unlink(public_path($paket->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/paket'), $imageName);
            $validated['image'] = 'images/paket/' . $imageName;
        }

        $paket->update($validated);

        return redirect()->route('paket.index')->with('success', 'Paket berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $paket = Paket::findOrFail($id);
        
        // Delete image if exists
        if ($paket->image && file_exists(public_path($paket->image))) {
            unlink(public_path($paket->image));
        }
        
        $paket->delete();

        return redirect()->route('paket.index')->with('success', 'Paket berhasil dihapus');
    }
}
