<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Book extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['rak'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            return $query->where('judul', 'like', '%' . $search . '%')
            ->orWhere('no_barcode', 'like', '%' . $search . '%')
            ->orWhere('pengarang', 'like', '%' . $search . '%')
            ->orWhere('thn_terbit', 'like', '%' . $search . '%')
            ->orWhere('eksemplar', 'like', '%' . $search . '%')
            ->orWhere('penerbit', 'like', '%' . $search . '%');
        });

        $query->when($filters['barcode'] ?? false, function ($query, $barcode) {
            return $query->where('no_barcode', 'like', '%' . $barcode . '%')
            ->orWhere('judul', 'like', '%' . $barcode . '%')
            ->orWhere('pengarang', 'like', '%' . $barcode . '%')
            ->orWhere('thn_terbit', 'like', '%' . $barcode . '%')
            ->orWhere('eksemplar', 'like', '%' . $barcode . '%')
            ->orWhere('penerbit', 'like', '%' . $barcode . '%');
        });
    }

    public function rak()
    {
        return $this->belongsTo(Rak::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
