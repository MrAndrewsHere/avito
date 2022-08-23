<?php

namespace App\Models;

use App\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $table = 'photo';
    protected $fillable = ['url', 'ad_id'];
    public $timestamps = false;

    public function ad()
    {
        return $this->belongsTo(Ad::class, 'id', 'ad_id');
    }
}
