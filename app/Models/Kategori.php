<?php

namespace App\Models;
use App\Models\Aspiras;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $table = 'kategori';  
    public function aspirasis()
    {
        return $this->hasMany(Aspiras::class, 'kategori_id');
    }
}
