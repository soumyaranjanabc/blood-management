<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donor extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id',
        'name',
        'blood_group',
        'age',
        'gender',
        'phone',
        'address',
        'city',
        'last_donation_date',
        'status'
    ];

    protected $casts = [
        'last_donation_date' => 'date'
    ];

    // Donor belongs to a User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Donor has many Donations
    public function donations()
    {
        return $this->hasMany(Donation::class);
    }
}
