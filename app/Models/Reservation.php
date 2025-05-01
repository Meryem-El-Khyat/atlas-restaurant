<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'reservation';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'ID';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'DateReservation',
        'Repas1',
        'Repas2',
        'Repas3',
        'Matricule',
        'Annulation',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'DateReservation' => 'date',
        'Repas1' => 'boolean',
        'Repas2' => 'boolean',
        'Repas3' => 'boolean',
        'Annulation' => 'boolean',
    ];

    /**
     * Get the user that owns the reservation.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'Matricule', 'Matricule');
    }
}
