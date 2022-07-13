<?php

namespace App\Models;


use App\Traits\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ads extends Model
{
    use HasFactory;


    protected $fillable = ['name', 'description', 'price', 'created_at','updated_at'];

    public function getPriceAttribute()
    {

        return floatval($this->attributes['price']);
    }

    public function preview(): \Illuminate\Database\Eloquent\Relations\HasOne
    {
        return $this->hasOne(Photo::class, 'ad_id', 'id');
    }

    public function photo(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Photo::class, 'ad_id', 'id');
    }

    public function scopeView($query)
    {
        return $query->select('id', 'name', 'price');
    }

    public function scopeSorted($query, $sortBy = null, $sortVal = 'asc')
    {
        if (!$sortBy) {
            return $query;
        }
        return $query->orderBy($sortBy, $sortVal);
    }

}
