<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BloodRequest extends Model {
    use HasFactory;

    protected $fillable = [
        'user_id','patient_name','blood_group','units_required',
        'priority','status','hospital_name','contact_number',
        'required_date','notes'
    ];

    protected $casts = ['required_date' => 'date'];

    public function user() { return $this->belongsTo(User::class); }
}
