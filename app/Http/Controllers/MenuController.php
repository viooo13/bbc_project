<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Paket;
use App\Models\Testimonial;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;

class MenuController extends Controller
{
    private function ensureDummyMenus(): void
    {
        if (!Schema::hasTable('menus')) {
            return;
        }

        if (Menu::query()->count() > 0) {
            return;
        }

        $items = [
            [
                'name' => 'Bakso Urat',
                'description' => 'Bakso urat gurih dengan kuah kaldu hangat.',
                'price' => 15000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Telur',
                'description' => 'Bakso isi telur, cocok untuk yang suka porsi lebih.',
                'price' => 18000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Bakso Tulang',
                'description' => 'Bakso tulang dengan cita rasa autentik.',
                'price' => 25000,
                'category' => 'bakso',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Original',
                'description' => 'Mie ayam dengan topping ayam manis gurih.',
                'price' => 14000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Mie Ayam Bakso',
                'description' => 'Mie ayam ditambah bakso, lebih kenyang.',
                'price' => 18000,
                'category' => 'mie',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 1',
                'description' => '1 Bakso + 1 Es Teh.',
                'price' => 22000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Paket Hemat 2',
                'description' => '1 Mie Ayam + 1 Es Jeruk.',
                'price' => 24000,
                'category' => 'paket',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Teh',
                'description' => 'Es teh manis segar.',
                'price' => 5000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
            [
                'name' => 'Es Jeruk',
                'description' => 'Es jeruk segar.',
                'price' => 6000,
                'category' => 'minuman',
                'image' => null,
                'status' => 'active',
            ],
        ];

        foreach ($items as $item) {
            Menu::create($item);
        }
    }

    public function home()
    {
        $this->ensureDummyMenus();
        $menus = Menu::where('status', 'active')->get();
        $pakets = Paket::where('status', 'active')->get();
        $recommendedItems = Menu::where('status', 'active')->latest()->take(3)->get();
        $testimonials = Testimonial::orderByDesc('created_at')->take(12)->get();

        return view('home', [
            'menus' => $menus,
            'pakets' => $pakets,
            'recommendedItems' => $recommendedItems,
            'testimonials' => $testimonials,
        ]);
    }

    public function publicIndex()
    {
        $this->ensureDummyMenus();
        $menus = Menu::where('status', 'active')->get();
        return view('pages.menu', [
            'menus' => $menus,
        ]);
    }

    public function filterMenu(Request $request)
    {
        $this->ensureDummyMenus();
        $category = $request->query('category', 'all');

        $query = Menu::query()->where('status', 'active');
        if ($category !== 'all') {
            $query->where('category', $category);
        }

        $menus = $query->get();

        if (!View::exists('partials.menu-items')) {
            return response()->json([
                'html' => '',
            ]);
        }

        $html = view('partials.menu-items', ['menus' => $menus])->render();

        return response()->json([
            'html' => $html,
        ]);
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $this->ensureDummyMenus();
        $menus = Menu::all();
        $pakets = Paket::all();
        return view('admin.menu.index', compact('menus', 'pakets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.menu.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|in:bakso,mie,paket,minuman',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/menu'), $imageName);
            $validated['image'] = 'images/menu/' . $imageName;
        }

        Menu::create($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil ditambahkan');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        return view('admin.menu.edit', compact('menu'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'category' => 'required|in:bakso,mie,paket,minuman',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|in:active,inactive'
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            // Delete old image if exists
            if ($menu->image && file_exists(public_path($menu->image))) {
                unlink(public_path($menu->image));
            }
            
            $image = $request->file('image');
            $imageName = time() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images/menu'), $imageName);
            $validated['image'] = 'images/menu/' . $imageName;
        }

        $menu->update($validated);

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil diubah');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $menu = Menu::findOrFail($id);
        
        // Delete image if exists
        if ($menu->image && file_exists(public_path($menu->image))) {
            unlink(public_path($menu->image));
        }
        
        $menu->delete();

        return redirect()->route('admin.menu.index')->with('success', 'Menu berhasil dihapus');
    }
}
