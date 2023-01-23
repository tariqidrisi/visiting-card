<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SocialMedia extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'social_media';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Set the social media
     *
     */
    public function setClosedAttribute($value)
    {
        $this->attributes['social-media'] = json_encode($value);
    }

    /**
     * Get the social media
     *
     */
    public function getClosedAttribute($value)
    {
        return $this->attributes['social-media'] = json_decode($value);
    }
}
