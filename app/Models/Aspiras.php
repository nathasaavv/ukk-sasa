<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Aspiras extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'kategori_id',
        'feedback'
    ];
    public function kategori()
    {
        return $this->belongsTo(Ketegori::class, 'kategori_id');
    }
}
