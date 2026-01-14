<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AduanImage extends Model
{
    use HasFactory;

    protected $table = 'aduan_images';

    protected $fillable = [
        'aduan_id',
        'image_path',
    ];

    public function aduan()
    {
        return $this->belongsTo(Aduan::class);
    }
}
