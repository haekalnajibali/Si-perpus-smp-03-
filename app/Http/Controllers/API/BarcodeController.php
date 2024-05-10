<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function checkBarcode(Request $request)
    {
        // Validate the input barcode
        $request->validate([
            'barcode' => 'required',
        ]);

        // Retrieve the barcode from the request
        $inputBarcode = $request->input('barcode');

        // Query the database to find a match
        $book = Book::where('no_barcode', $inputBarcode)->first();
        $member = Member::where('nisn', $inputBarcode)->first();

        // Check if a book or member with the given barcode exists
        if ($book) {
            return response()->json(['message' => 'Buku ' . $book->judul . ' ditemukan.', 'type' => 'success', 'book' => $book->id], 200);
        } elseif ($member) {
            return response()->json(['message' => 'Member ' . $member->nama . ' ditemukan.', 'type' => 'success', 'member' => $member->nisn], 200);
        } else {
            return response()->json(['message' => 'Buku atau member tidak ditemukan.', 'type' => 'error'], 200);
        }
    }
}
