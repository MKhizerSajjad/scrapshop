<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Data extends Model
{
    use HasFactory;
    protected $table = 'data';
    public static $snakeAttributes = false;
    protected $guarded;

    public function employee() {
        return $this->belongsTo(User::class);
    }
}
