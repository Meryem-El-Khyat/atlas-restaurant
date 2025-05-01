<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// Supprimez cette ligne : use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    // Supprimez HasApiTokens de cette ligne
    use HasFactory, Notifiable;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'compte';

    /**
     * The primary key for the model.
     *
     * @var string
     */
    protected $primaryKey = 'Matricule';

    /**
     * Indicates if the model's ID is auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = false;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'Matricule',
        'login',
        'motdepasse',
        'nom',
        'Prenom',
        'Email',
        'photo',
        'typecompte',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'motdepasse',
        'remember_token',
    ];

    

    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->motdepasse;
    }

    /**
     * Get the reservations for the user.
     */
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'Matricule', 'Matricule');
    }

    /**
     * Check if the user is an admin.
     */
    public function isAdmin()
    {
        return $this->TypeCompte === 'admin';
    }
}