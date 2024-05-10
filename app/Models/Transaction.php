<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;

class Transaction extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    protected $with = ['book', 'member', 'user'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['search'] ?? false, function ($query, $search) {
            $query->whereHas('book', function ($query) use ($search) {
                $query->where('judul', 'like', '%' . $search . '%');
            })->orWhereHas('member', function ($query) use ($search) {
                $query->where('nama', 'like', '%' . $search . '%');
            });
        });
    }
    
    public function book()
    {
        return $this->belongsTo(Book::class, 'book_id');
    }

    public function member()
    {
        return $this->belongsTo(Member::class,'member_id');
    }
    
    public function user()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}
