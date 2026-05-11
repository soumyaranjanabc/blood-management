<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hospital extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id','name','license_number','phone','address','city','status'
    ];

    public function user() { return $this->belongsTo(User::class); }
}
