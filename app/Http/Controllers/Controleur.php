<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Portfolio;
use App\Models\Personnel;
use Illuminate\Http\Request;

class Controleur extends Controller
{
    //Ajouter un actualité
    public function ajouterActualite(Request $request)
    {
        $data = $request->validate([
            'titre' => 'required',
            'descriptionActualite' => 'required',
            'dateEvenement' => 'required',
            'photosActualite' => 'required',
        ]);

        $actualite = Actualite::create($data);
        return response()->json($actualite, 201);
    }
    //Modifier une actualité
    public function modifierActualite(Request $request, $id)
    {
        $data = $request->validate([
            'titre' => 'required',
            'descriptionActualite' => 'required',
            'dateEvenement' => 'required',
            'photosActualite' => 'required',
        ]);
        $actualite = Actualite::findOrFail($id);
        $actualite->update($data);

        return response()->json($actualite, 200);
    }
    //Supprimer une actualité
    public function supprimerActualite($id)
    {
        $actualite = Actualite::findOrFail($id);
        $actualite->delete();

        return response()->json($actualite, 204);
    }
    //Afficher les actualités
    public function afficherActualite()
    {
        return Actualite::all();
    }


    //Ajouter un portfolio
    public function ajouterPortfolio(Request $request)
    {
        $data = $request->validate([
            'nomEntreprise' => 'required',
            'descriptionPortfolio' => 'required',
            'photosPortfolio' => 'required',
            'lien' => 'required',
        ]);

        $portfolio = Portfolio::create($data);
        return response()->json($portfolio, 201);
    }
    //Modifier une portfolio
    public function modifierPortfolio(Request $request, $id)
    {
        $data = $request->validate([
            'nomEntreprise' => 'required',
            'descriptionPortfolio' => 'required',
            'photosPortfolio' => 'required',
            'lien' => 'required',
        ]);

        $portfolio = Portfolio::findOrFail($id);
        $portfolio->update($data);

        return response()->json($portfolio, 200);
    }
    //Supprimer une portfolio
    public function supprimerPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);
        $portfolio->delete();

        return response()->json($portfolio, 204);
    }
    //Afficher les portfolios
    public function afficherPortfolio()
    {
        return Portfolio::all();
    }


    //Ajouter un personnel
    public function ajouterPersonnel(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'photoPersonnel' => 'required',
            'poste' => 'required',
        ]);

        $personnel = Personnel::create($data);
        return response()->json($personnel, 201);
    }
    //Modifier une personnel
    public function modifierPersonnel(Request $request, $id)
    {
        $data = $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'photoPersonnel' => 'required',
            'poste' => 'required',
        ]);

        $personnel = Personnel::findOrFail($id);
        $personnel->update($data);

        return response()->json($personnel, 200);
    }
    //Supprimer un personnel
    public function supprimerPersonnel($id)
    {
        $personnel = Personnel::findOrFail($id);
        $personnel->delete();

        return response()->json($personnel, 204);
    }
    //Afficher les personnels
    public function afficherPersonnel()
    {
        return Personnel::all();
    }
}
