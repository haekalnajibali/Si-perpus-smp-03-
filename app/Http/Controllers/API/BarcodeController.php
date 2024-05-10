<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Book;
use Illuminate\Http\Request;
use Milon\Barcode\Facades\DNS1DFacade as DNS1D;

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

        // Check if a book with the given barcode exists
        if ($book) {
            return response()->json(['message' => 'Barcode exists in the database.', 'type'=> 'success', 'book' => $book->id], 200);
        } else {
            return response()->json(['message' =>'Barcode does not exist in the database.', 'type' =>'error'], 200);
        }
    }
}
