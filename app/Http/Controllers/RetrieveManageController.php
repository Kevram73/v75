<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\RetrieveRequest; // Utilisation du modèle RetrieveRequest

class RetrieveManageController extends Controller
{
    /**
     * Affiche une liste des enregistrements.
     */
    public function list()
    {
        $retrieveRequests = RetrieveRequest::all(); // Récupère tous les enregistrements du modèle RetrieveRequest
        return view('admin.retrieve_requests.index', compact('retrieveRequests')); // Passe les données à la vue
    }

    /**
     * Supprime un enregistrement spécifique par ID.
     */
    public function delete($id)
    {
        $item = RetrieveRequest::find($id);
        if ($item) {
            $item->delete();
            return redirect()->back()->with('success', 'Enregistrement supprimé avec succès');
        }
        return redirect()->back()->with('error', 'Enregistrement non trouvé');
    }

    /**
     * Met à jour le statut d'un enregistrement spécifique.
     */
    public function update_status(Request $request, $id)
    {
        $item = RetrieveRequest::find($id);
        if ($item) {
            $item->status = $request->status;
            $item->save();
            return redirect()->back()->with('success', 'Statut mis à jour avec succès');
        }
        return redirect()->back()->with('error', 'Enregistrement non trouvé');
    }
}
