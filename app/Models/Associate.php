<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Associate extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'surname',
        'address',
        'neighborhood',
        'identity',
        'cpf',
        'admission_date',
        'contact',
        'family_contact',
    ];

     /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'admission_date' => 'datetime',
    ];

    public function setContactAttribute($value)
    {
        $this->attributes['contact'] = preg_replace('/\D/', '', $value);
    }

    public function setFamilyContactAttribute($value)
    {
        $this->attributes['family_contact'] = preg_replace('/\D/', '', $value);
    }
}
