<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /**
     * Show the admin dashboard.
     */
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    /**
     * Show the reservation management page.
     */
    public function reservations()
    {
        $personnel = User::where('TypeCompte', 'personnel')->get();
        return view('admin.reservations', compact('personnel'));
    }

    /**
     * Store a new reservation.
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'matricule' => 'required|exists:compte,Matricule',
            'date_reservation' => 'required|date',
            'repas1' => 'boolean',
            'repas2' => 'boolean',
            'repas3' => 'boolean',
        ]);

        // Vérifier si une réservation existe déjà pour cette date et cet utilisateur
        $existingReservation = Reservation::where('Matricule', $request->matricule)
            ->where('DateReservation', $request->date_reservation)
            ->first();

        if ($existingReservation) {
            // Mettre à jour la réservation existante
            $existingReservation->update([
                'Repas1' => $request->has('repas1'),
                'Repas2' => $request->has('repas2'),
                'Repas3' => $request->has('repas3'),
                'Annulation' => false,
            ]);
        } else {
            // Créer une nouvelle réservation
            Reservation::create([
                'Matricule' => $request->matricule,
                'DateReservation' => $request->date_reservation,
                'Repas1' => $request->has('repas1'),
                'Repas2' => $request->has('repas2'),
                'Repas3' => $request->has('repas3'),
                'Annulation' => false,
            ]);
        }

        return redirect()->back()->with('success', 'Réservation enregistrée avec succès.');
    }

    /**
     * Show the statistics page.
     */
    public function statistics()
    {
        // Statistiques par type de repas (à partir d'aujourd'hui)
        $today = Carbon::today();
        $repasStats = Reservation::where('DateReservation', '>=', $today)
            ->where('Annulation', false)
            ->select(
                DB::raw('SUM(Repas1) as petit_dejeuner'),
                DB::raw('SUM(Repas2) as dejeuner'),
                DB::raw('SUM(Repas3) as diner')
            )
            ->first();

        // Statistiques par jour (pour les 7 prochains jours)
        $dailyStats = [];
        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->addDays($i);
            $stats = Reservation::where('DateReservation', $date)
                ->where('Annulation', false)
                ->select(
                    DB::raw('SUM(Repas1) as petit_dejeuner'),
                    DB::raw('SUM(Repas2) as dejeuner'),
                    DB::raw('SUM(Repas3) as diner')
                )
                ->first();
            
            $dailyStats[] = [
                'date' => $date->format('Y-m-d'),
                'petit_dejeuner' => $stats->petit_dejeuner ?? 0,
                'dejeuner' => $stats->dejeuner ?? 0,
                'diner' => $stats->diner ?? 0,
            ];
        }

        // Statistiques par mois (pour l'année en cours)
        $monthlyStats = [];
        for ($i = 1; $i <= 12; $i++) {
            $month = Carbon::create(Carbon::now()->year, $i, 1);
            $stats = Reservation::whereYear('DateReservation', $month->year)
                ->whereMonth('DateReservation', $month->month)
                ->where('Annulation', false)
                ->select(
                    DB::raw('SUM(Repas1) as petit_dejeuner'),
                    DB::raw('SUM(Repas2) as dejeuner'),
                    DB::raw('SUM(Repas3) as diner')
                )
                ->first();
            
            $monthlyStats[] = [
                'month' => $month->format('F'),
                'petit_dejeuner' => $stats->petit_dejeuner ?? 0,
                'dejeuner' => $stats->dejeuner ?? 0,
                'diner' => $stats->diner ?? 0,
            ];
        }

        return view('admin.statistics', compact('repasStats', 'dailyStats', 'monthlyStats'));
    }
}
