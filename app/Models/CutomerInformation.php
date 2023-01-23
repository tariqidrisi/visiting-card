<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CutomerInformation extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'cutomer_information';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    /**
     * Set the closed days
     *
     */
    public function setClosedAttribute($value)
    {
        $this->attributes['closed'] = json_encode($value);
    }

    /**
     * Get the closed days
     *
     */
    public function getClosedAttribute($value)
    {
        return $this->attributes['closed'] = json_decode($value);
    }
}
