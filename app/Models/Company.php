<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    use HasFactory;

    protected $table = 'companies';

    protected $fillable = [
        'name',
        'address'
    ];

    public function clients() {
        return $this->belongsToMany(Client::class, 'client_companies', 'company_id', 'client_id');
    }
}
