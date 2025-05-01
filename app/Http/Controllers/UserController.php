<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    /**
     * Show the user dashboard.
     */
    public function dashboard()
    {
        return view('user.dashboard');
    }

    /**
     * Show the user profile.
     */
    public function profile()
    {
        $user = Auth::user();
        
        // Récupérer les réservations du mois en cours
        $startOfMonth = Carbon::now()->startOfMonth();
        $endOfMonth = Carbon::now()->endOfMonth();
        
        $reservations = Reservation::where('Matricule', $user->Matricule)
            ->whereBetween('DateReservation', [$startOfMonth, $endOfMonth])
            ->orderBy('DateReservation')
            ->get();
        
        return view('user.profile', compact('user', 'reservations'));
    }

    /**
     * Show the reservation form.
     */
    public function showReservationForm()
    {
        $user = Auth::user();
        
        // Récupérer les réservations futures de l'utilisateur
        $today = Carbon::today();
        $reservations = Reservation::where('Matricule', $user->Matricule)
            ->where('DateReservation', '>=', $today)
            ->orderBy('DateReservation')
            ->get();
        
        return view('user.reservation', compact('user', 'reservations'));
    }

    /**
     * Store a new reservation.
     */
    public function storeReservation(Request $request)
    {
        $request->validate([
            'date_reservation' => 'required|date',
            'repas1' => 'boolean',
            'repas2' => 'boolean',
            'repas3' => 'boolean',
        ]);

        $user = Auth::user();

        // Vérifier si une réservation existe déjà pour cette date
        $existingReservation = Reservation::where('Matricule', $user->Matricule)
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
                'Matricule' => $user->Matricule,
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
     * Cancel a reservation.
     */
    public function cancelReservation(Request $request, $id)
    {
        $reservation = Reservation::findOrFail($id);
        
        // Vérifier que la réservation appartient à l'utilisateur connecté
        if ($reservation->Matricule !== Auth::user()->Matricule) {
            return redirect()->back()->with('error', 'Vous n\'êtes pas autorisé à annuler cette réservation.');
        }
        
        $reservation->update(['Annulation' => true]);
        
        return redirect()->back()->with('success', 'Réservation annulée avec succès.');
    }
}
