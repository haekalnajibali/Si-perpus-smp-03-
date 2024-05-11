<?php

namespace App\Http\Controllers\API;

use App\Helpers\BarcodeHelper;
use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Member;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function peminjaman(Request $request)
    {
        // Validate the input barcode
        $request->validate([
            'barcode' => 'required',
        ]);

        // Retrieve the barcode from the request
        $inputBarcode = $request->input('barcode');

        // Use the helper function to find the book or member
        $result = BarcodeHelper::findBookOrMember($inputBarcode);

        // Respond based on the result
        if ($result['type'] === 'book') {
            $book = $result['item'];
            return response()->json(['message' => 'Buku ' . $book->judul . ' ditemukan.', 'type' => 'success', 'book' => $book->id], 200);
        } elseif ($result['type'] === 'member') {
            $member = $result['item'];
            return response()->json(['message' => 'Member ' . $member->nama . ' ditemukan.', 'type' => 'success', 'member' => $member->nisn], 200);
        } else {
            return response()->json(['message' => $result['message'], 'type' => 'error'], 200);
        }
    }
}
