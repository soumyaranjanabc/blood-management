<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodInventory extends Model {
    use HasFactory;

    protected $table = 'blood_inventory';

    protected $fillable = [
        'blood_group','units_available','units_reserved','last_updated'
    ];

    protected $casts = ['last_updated' => 'date'];
}
