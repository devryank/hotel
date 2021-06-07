<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Room;
use Database\Seeders\BookingSeeder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('booking.index', [
            'bookings' => Booking::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('booking.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $bookingDate = Booking::whereDate('start_date', $request->start_date)->get();
        $rooms = Room::where('bed', $request->bed)->get();

        $allRooms = [];
        foreach ($rooms as $room) {
            $allRooms[] = $room->no;
        }

        $busy = [];
        foreach ($bookingDate as $booking) {
            $busy[] = $booking->room;
        }
        $no = array_values(array_diff($allRooms, $busy));

        if ($no == NULL) {
            return redirect()->route('dashboard.booking.create')->with('warning', 'Semua kamar sudah diboking pada tanggal tersebut');
        } else {
            $no = $no['0'];
            $booking = new Booking();
            $booking->room = $no;
            $booking->amount = $request->amount;
            $booking->start_date = $request->start_date;
            $booking->end_date = $request->end_date;

            $priceRoom = Room::where('no', $no)->firstOrFail()->price;
            $end_date = $request->end_date;
            echo $request->end_date;
            echo $request->start_date;
            $dateDiff   = strtotime($request->end_date) - strtotime($request->start_date);
            $numOfDays  = $dateDiff / 86400;

            $booking->price = $priceRoom * $numOfDays;

            $booking->save();

            return redirect()->route('dashboard.booking.index')->with('success', 'Booking kamar berhasil. No kamar: ' . $no);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Booking::findOrFail($id)->delete();

        return redirect()->route('dashboard.booking.index')->with('success', 'Booking kamar berhasil dihapus');
    }

    public function paid($id)
    {
        DB::table('bookings')->where('id', $id)->update(['paid' => '1']);

        return redirect()->route('dashboard.booking.index')->with('success', 'Pembayaran dikonfirmasi');
    }
}
