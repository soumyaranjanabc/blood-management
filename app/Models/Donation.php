<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id', 'donor_id', 'blood_group',
        'units_donated', 'donation_date', 'status', 'notes'
    ];

    protected $casts = ['donation_date' => 'date'];

    public function user()  { return $this->belongsTo(User::class); }
    public function donor() { return $this->belongsTo(Donor::class); }
}
