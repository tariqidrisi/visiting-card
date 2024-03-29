<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Company extends Model
{
    use HasFactory, SoftDeletes;

    public $timestamps = false;
    protected $table = 'companies';
    protected $fillable = ['company', 'username', 'desc', 'theme'];
    protected $dates = ['deleted_at'];

    public function info()
    {
        return $this->hasOne(CutomerInformation::class);
    }

}
