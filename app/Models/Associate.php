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

    protected $dates = ['admission_date']; // Garante que seja tratado como um objeto Carbon

    public function getDataFormatadaAttribute()
    {
        return $this->admission_date ? $this->admission_date->format('d/m/Y') : null;
    }

    public function getContactFormatadoAttribute()
    {
        $contact = preg_replace('/\D/', '', $this->contact);

        if (strlen($contact) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $contact);
        } 

        return $this->contact; // Retorna o original se não for compatível
    }

    public function getFamilyContactFormatadoAttribute()
    {
        $family_contact = preg_replace('/\D/', '', $this->family_contact);

        if (strlen($family_contact) === 11) {
            return preg_replace('/(\d{2})(\d{5})(\d{4})/', '($1) $2-$3', $family_contact);
        } 

        return $this->family_contact; // Retorna o original se não for compatível
    }
}
