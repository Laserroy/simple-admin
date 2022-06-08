<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone'
    ];

    protected function getFullNameAttribute()
    {
        return "$this->first_name $this->last_name";
    }

    public function companies() {
        return $this->belongsToMany(
            Company::class,
            'client_companies',
            'client_id',
            'company_id'
        );
    }
}
