<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;

class BarcodeController extends Controller
{
    public function checkBarcode(Request $request)
    {
        // Validate the input barcode
        $request->validate([
            'barcode' => 'required|digits:13', // EAN13 barcode should be 13 digits long
        ]);

        // Retrieve the barcode from the request
        $inputBarcode = $request->input('barcode');

        // Pad the input barcode to 13 digits
        $paddedInputBarcode = str_pad($inputBarcode, 13, '0', STR_PAD_LEFT);

        // Query the database to find a match
        $book = Book::where('no_barcode', $paddedInputBarcode)->first();

        echo $book;

        // Check if a book with the given barcode exists
        if ($book) {
            return response()->json(['message' => 'Barcode exists in the database.', 'book' => $book], 200);
        } else {
            return response()->json(['message' => 'Barcode does not exist in the database.'], 404);
        }
    }
}
