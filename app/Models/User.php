<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable {
    use HasFactory, Notifiable;

    protected $fillable = ['name','email','password','role','phone','blood_group','address'];

    protected $hidden = ['password','remember_token'];

    protected $casts = ['email_verified_at' => 'datetime', 'password' => 'hashed'];

    public function isAdmin(): bool    { return $this->role === 'admin'; }
    public function isDonor(): bool    { return $this->role === 'donor'; }
    public function isHospital(): bool { return $this->role === 'hospital'; }

    public function donor()   { return $this->hasOne(Donor::class); }
    public function hospital(){ return $this->hasOne(Hospital::class); }
    public function bloodRequests() { return $this->hasMany(BloodRequest::class); }
}
