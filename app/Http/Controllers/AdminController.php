<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SintiaCategory;
use App\Models\SintiaDestination;
use App\Models\SintiaBooking;
use App\Models\SintiaReview;
use App\Models\User;

class AdminController extends Controller
{
    public function dashboard()
    {
        // Statistik utama
        $totalBooking = \App\Models\SintiaBooking::count();
        $totalUser = \App\Models\User::count();
        $totalDestination = \App\Models\SintiaDestination::count();
        $totalReview = \App\Models\SintiaReview::count();
        $bookingPending = \App\Models\SintiaBooking::where('status', 'pending')->count();
        $bookingConfirmed = \App\Models\SintiaBooking::where('status', 'confirmed')->count();
        $bookingCancelled = \App\Models\SintiaBooking::where('status', 'cancelled')->count();

        // Booking per bulan (hanya tahun berjalan)
        $currentYear = date('Y');
        $bookingsPerMonth = \App\Models\SintiaBooking::whereYear('booking_date', $currentYear)
            ->selectRaw('MONTH(booking_date) as month, COUNT(*) as total')
            ->groupBy('month')
            ->orderBy('month')
            ->pluck('total', 'month')->toArray();
        $chartData = [];
        for ($i = 1; $i <= 12; $i++) {
            $chartData[] = $bookingsPerMonth[$i] ?? 0;
        }

        // Destinasi populer (berdasarkan jumlah booking)
        $popularDestinations = \App\Models\SintiaDestination::withCount('bookings')
            ->orderBy('bookings_count', 'desc')
            ->take(3)
            ->get();

        // Booking history (10 terbaru)
        $bookingHistory = \App\Models\SintiaBooking::with(['user', 'destination'])
            ->orderBy('created_at', 'desc')
            ->take(10)
            ->get();

        return view('admin.dashboard', compact(
            'totalBooking', 'totalUser', 'totalDestination', 'totalReview',
            'bookingPending', 'bookingConfirmed', 'bookingCancelled',
            'chartData', 'popularDestinations', 'bookingHistory'
        ));
    }

    // Kategori CRUD
    public function index()
    {
        $categories = SintiaCategory::all();
        return view('admin.categories.index', compact('categories'));
    }
    
    public function create()
    {
        return view('admin.categories.create');
    }
    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        SintiaCategory::create($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil ditambahkan!');
    }
    
    public function edit($id)
    {
        $category = SintiaCategory::findOrFail($id);
        return view('admin.categories.edit', compact('category'));
    }
    
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'description' => 'nullable',
        ]);
        $category = SintiaCategory::findOrFail($id);
        $category->update($request->only('name', 'description'));
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil diupdate!');
    }
    
    public function destroy($id)
    {
        $category = SintiaCategory::findOrFail($id);
        $category->delete();
        return redirect()->route('categories.index')->with('success', 'Kategori berhasil dihapus!');
    }
    
    public function show($id)
    {
        // Detail data (khusus booking)
    }

    // Destinasi CRUD
    public function destinationsIndex()
    {
        $destinations = SintiaDestination::with('category')->orderBy('created_at', 'desc')->get();
        return view('admin.destinations.index', compact('destinations'));
    }
    
    public function destinationsCreate()
    {
        $categories = SintiaCategory::all();
        return view('admin.destinations.create', compact('categories'));
    }
    
    public function destinationsStore(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:sintia_categories,id',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $data = $request->only('name', 'category_id', 'location', 'description', 'price');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }
        \App\Models\SintiaDestination::create($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil ditambahkan!');
    }
    
    public function destinationsEdit($id)
    {
        $destination = SintiaDestination::findOrFail($id);
        $categories = SintiaCategory::all();
        return view('admin.destinations.edit', compact('destination', 'categories'));
    }
    
    public function destinationsUpdate(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required|exists:sintia_categories,id',
            'location' => 'required',
            'description' => 'required',
            'price' => 'required|integer|min:0',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);
        $destination = \App\Models\SintiaDestination::findOrFail($id);
        $data = $request->only('name', 'category_id', 'location', 'description', 'price');
        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('destinations', 'public');
        }
        $destination->update($data);
        return redirect()->route('admin.destinations.index')->with('success', 'Destinasi berhasil diupdate!');
    }
    
    public function destinationsDestroy($id)
    {
        $destination = SintiaDestination::findOrFail($id);
        $destination->delete();
        return redirect()->route('destinations')->with('success', 'Destinasi berhasil dihapus!');
    }

    // Booking CRUD
    public function bookingsIndex()
    {
        $bookings = \App\Models\SintiaBooking::with(['user', 'destination'])->orderBy('created_at', 'desc')->get();
        return view('admin.bookings.index', compact('bookings'));
    }
    
    public function bookingsShow($id)
    {
        $booking = SintiaBooking::with(['user', 'destination'])->findOrFail($id);
        return view('admin.bookings.show', compact('booking'));
    }
    
    public function bookingsUpdate(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,confirmed,cancelled',
        ]);
        $booking = SintiaBooking::findOrFail($id);
        $booking->update(['status' => $request->status]);
        return redirect()->route('bookings.index')->with('success', 'Status booking berhasil diupdate!');
    }
    
    public function bookingsDestroy($id)
    {
        $booking = SintiaBooking::findOrFail($id);
        $booking->delete();
        return redirect()->route('bookings.index')->with('success', 'Booking berhasil dihapus!');
    }

    // Review CRUD
    public function reviewsIndex()
    {
        $reviews = SintiaReview::with(['user', 'destination'])->get();
        return view('admin.reviews.index', compact('reviews'));
    }
    
    public function reviewsDestroy($id)
    {
        $review = SintiaReview::findOrFail($id);
        $review->delete();
        return redirect()->route('reviews.index')->with('success', 'Review berhasil dihapus!');
    }

    // User CRUD (index, edit, update, destroy)
    public function usersIndex()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }
}
