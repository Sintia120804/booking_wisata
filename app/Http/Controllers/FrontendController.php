<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SintiaDestination;
use App\Models\SintiaBooking;
use App\Models\User;
use Illuminate\Support\Facades\Redirect;
use App\Models\SintiaReview;
use Illuminate\Support\Facades\Log;

class FrontendController extends Controller
{
    public function destinations()
    {
        $destinations = SintiaDestination::with('category')->get();
        return view('frontend.destinations', compact('destinations'));
    }

    public function destinationDetail($id)
    {
        $destination = SintiaDestination::with(['category', 'reviews'])->findOrFail($id);
        return view('frontend.destination_detail', compact('destination'));
    }

    public function booking(Request $request)
    {
        // Proteksi: hanya user login yang bisa booking
        if (!session('user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Anda harus login untuk booking.']);
        }
        $user = \App\Models\User::find(session('user_id'));
        $request->validate([
            'destination_id' => 'required|exists:sintia_destinations,id',
            'booking_date' => 'required|date|after_or_equal:today',
            'total_person' => 'required|integer|min:1',
            'payment_proof' => 'nullable|file|mimes:jpg,jpeg,png,pdf|max:2048',
        ]);
        $data = [
            'user_id' => $user->id,
            'destination_id' => $request->destination_id,
            'booking_date' => $request->booking_date,
            'total_person' => $request->total_person,
            'status' => 'pending',
        ];
        try {
            if ($request->hasFile('payment_proof')) {
                $file = $request->file('payment_proof');
                if ($file->isValid()) {
                    $data['payment_proof'] = $file->store('payment_proofs', 'public');
                } else {
                    return back()->withErrors(['payment_proof' => 'File bukti pembayaran tidak valid.']);
                }
            }
        } catch (\Exception $e) {
            \Log::error('Upload payment proof error: '.$e->getMessage());
            return back()->withErrors(['payment_proof' => 'Gagal upload bukti pembayaran.']);
        }
        \App\Models\SintiaBooking::create($data);
        return \Illuminate\Support\Facades\Redirect::route('destinations.detail', $request->destination_id)
            ->with('success', 'Booking berhasil! Silakan tunggu konfirmasi admin.');
    }

    public function addReview(Request $request)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Anda harus login untuk menulis review.']);
        }
        $request->validate([
            'destination_id' => 'required|exists:sintia_destinations,id',
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required',
        ]);
        SintiaReview::create([
            'user_id' => session('user_id'),
            'destination_id' => $request->destination_id,
            'rating' => $request->rating,
            'comment' => $request->comment,
        ]);
        return redirect()->route('destinations.detail', $request->destination_id)
            ->with('success', 'Review berhasil ditambahkan!');
    }

    public function reviews($destination_id)
    {
        // Tampilkan review destinasi
    }

    public function myBookings()
    {
        if (!session('user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Anda harus login untuk melihat booking.']);
        }
        $bookings = \App\Models\SintiaBooking::with('destination')
            ->where('user_id', session('user_id'))
            ->orderBy('created_at', 'desc')
            ->get();
        return view('frontend.my_bookings', compact('bookings'));
    }

    public function cancelBooking($id)
    {
        if (!session('user_id')) {
            return redirect()->route('login')->withErrors(['email' => 'Anda harus login.']);
        }
        $booking = \App\Models\SintiaBooking::where('id', $id)
            ->where('user_id', session('user_id'))
            ->where('status', 'pending')
            ->firstOrFail();
        $booking->update(['status' => 'cancelled']);
        return redirect()->route('my.bookings')->with('success', 'Booking berhasil dibatalkan.');
    }

    public function showBookingForm($id)
    {
        $destination = \App\Models\SintiaDestination::findOrFail($id);
        return view('frontend.booking_create', compact('destination'));
    }

    public function showReviewForm($id)
    {
        $destination = \App\Models\SintiaDestination::findOrFail($id);
        return view('frontend.review_create', compact('destination'));
    }
}
