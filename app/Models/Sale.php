<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;
    protected $guarded;

    public function materials() {
        return $this->hasMany(SaleMaterial::class);
    }

    public function deliveries() {
        return $this->hasMany(SaleDelivery::class);
    }
}
