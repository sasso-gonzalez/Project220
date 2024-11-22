<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Patient extends Model
{
    use HasFactory;
    protected $fillable = [
        'patient_id',
        'user_id',
        'family_code',
        'caregroup',
        'amount_due',
        'payment_date'
    ];







// Relationship with User model
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
