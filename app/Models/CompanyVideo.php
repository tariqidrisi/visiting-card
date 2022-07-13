<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CompanyVideo extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'table_company_video';
    protected $guarded = ['id'];
    protected $dates = ['deleted_at'];
}
