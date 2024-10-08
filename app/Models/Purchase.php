<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;
    protected $guarded;

    public function materials() {
        return $this->hasMany(PurchaseMaterial::class);
    }

    public function deliveries() {
        return $this->hasMany(PurchaseDelivery::class);
    }
}
