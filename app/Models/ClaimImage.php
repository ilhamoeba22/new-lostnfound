<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClaimImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'claim_id',
        'image_path',
    ];

    public function claim()
    {
        return $this->belongsTo(Claim::class);
    }
}
