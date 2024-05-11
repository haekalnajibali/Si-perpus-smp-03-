<?php

namespace App\Helpers;

use App\Models\Book;
use App\Models\Member;

class BarcodeHelper
{
    public static function findBookOrMember($inputBarcode)
    {
        // Query the database to find a match
        $book = Book::where('no_barcode', $inputBarcode)->first();
        $member = Member::where('nisn', $inputBarcode)->first();

        // Check if a book or member with the given barcode exists
        if ($book) {
            return ['type' => 'book', 'item' => $book];
        } elseif ($member) {
            return ['type' => 'member', 'item' => $member];
        } else {
            return ['type' => 'error', 'message' => 'Buku atau member tidak ditemukan.'];
        }
    }
}
