<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyLogo extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'company_logos';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
