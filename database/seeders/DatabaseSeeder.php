<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer un compte admin
        User::create([
            'Matricule' => 'A001',
            'login' => 'admin',
            'motdepasse' => Hash::make('admin123'),
            'nom' => 'Admin',
            'Prenom' => 'Super',
            'Email' => 'admin@atlasrestaurant.com',
            'photo' => 'admin.jpg',
            'TypeCompte' => 'admin',
        ]);

        // Créer quelques comptes personnel
        User::create([
            'Matricule' => 'P001',
            'login' => 'user1',
            'motdepasse' => Hash::make('user123'),
            'nom' => 'Utilisateur',
            'Prenom' => 'Un',
            'Email' => 'user1@atlasrestaurant.com',
            'photo' => 'user1.jpg',
            'TypeCompte' => 'personnel',
        ]);

        User::create([
            'Matricule' => 'P002',
            'login' => 'user2',
            'motdepasse' => Hash::make('user123'),
            'nom' => 'Utilisateur',
            'Prenom' => 'Deux',
            'Email' => 'user2@atlasrestaurant.com',
            'photo' => 'user2.jpg',
            'TypeCompte' => 'personnel',
        ]);
        User::create([
    'Matricule' => 'TEST1',
    'login' => 'testuser',
    'motdepasse' => Hash::make('password123'),
    'nom' => 'Test',
    'Prenom' => 'User',
    'Email' => 'test@example.com',
    'photo' => null,
    'TypeCompte' => 'personnel',
]);

User::create([
    'Matricule' => 'TEST2',
    'login' => 'test',
    'motdepasse' => Hash::make('test123'),
    'nom' => 'Test',
    'Prenom' => 'User',
    'Email' => 'test2@example.com',
    'photo' => null,
    'TypeCompte' => 'personnel',
]);

        
    }
}
