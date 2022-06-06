<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'last_name',
        'email',
        'phone'
    ];

    public function companies() {
        return $this->belongsToMany(
            Company::class,
            'client_companies',
            'client_id',
            'company_id'
        );
    }
}
