<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Aspiras extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'kategori_id',
        'feedback',
        'user_id',
    ];
    protected $table = 'asprirasi';
    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'kategori_id');

    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }


}
