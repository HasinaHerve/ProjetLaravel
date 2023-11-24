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
        //Récupérer les données du tableau envoyées depuis React
        $request->validate([
            'titre' => 'required|string',
            'descriptionActualite' => 'required|string',
            'dateEvenement' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
        ]);
        // Enregistrement du fichier dans un répertoire dédié (par exemple, storage/app/fichiers)
        $path = $request->file('fichier')->store('images', 'public');

        // Stockez l'image dans le dossier de stockage Laravel
        $actualite = new Actualite([
            'titre' => $request->input('titre'),
            'descriptionActualite' => $request->input('descriptionActualite'),
            'dateEvenement' => $request->input('dateEvenement'),
            'photosActualite' => $path,
        ]);
        $actualite->save();
        return response()->json($actualite, 201);
    }
    //Modifier une actualité
    public function modifierActualite(Request $request, $id)
    {
        $request->validate([
            'titre' => 'required|string',
            'descriptionActualite' => 'required|string',
            'dateEvenement' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
        ]);
        // Enregistrement du fichier dans un répertoire dédié (par exemple, storage/app/fichiers)
        $path = $request->file('fichier')->store('images', 'public');

        // Récupérer l'instance d'Actualite existante
        $actualite = Actualite::findOrFail($id);

        // Mettre à jour les propriétés individuelles de l'instance
        $actualite->titre = $request->input('titre');
        $actualite->descriptionActualite = $request->input('descriptionActualite');
        $actualite->dateEvenement = $request->input('dateEvenement');
        $actualite->photosActualite = $path;

        // Sauvegarder les modifications
        $actualite->save();

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
    //Afficher une actualitée par son id
    public function afficherActualiteId($id)
    {
        $actualite = Actualite::find($id);
        if($actualite){
            return response()->json([
                'status' => 200,
                'actualite' => $actualite
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => "Aucun actualité trouvé"
            ], 404);
        }
    }


    //Ajouter un portfolio
    public function ajouterPortfolio(Request $request)
    {
        //Récupérer les données du tableau envoyées depuis React
        $request->validate([
            'nomEntreprise' => 'required|string',
            'descriptionPortfolio' => 'required|string',
            'lien' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
        ]);
        // Enregistrement du fichier dans un répertoire dédié (par exemple, storage/app/fichiers)
        $path = $request->file('fichier')->store('images', 'public');

        // Stockez l'image dans le dossier de stockage Laravel
        $portfolio = new Portfolio([
            'nomEntreprise' => $request->input('nomEntreprise'),
            'descriptionPortfolio' => $request->input('descriptionPortfolio'),
            'lien' => $request->input('lien'),
            'photosPortfolio' => $path,
        ]);
        $portfolio->save();
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
    //Afficher une portfolio par son id
    public function afficherPortfolioId($id)
    {
        $portfolio = Portfolio::find($id);
        if($portfolio){
            return response()->json([
                'status' => 200,
                'portfolio' => $portfolio
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => "Aucun portfolio trouvé"
            ], 404);
        }
    }


    //Ajouter un personnel
    public function ajouterPersonnel(Request $request)
    {
        //Récupérer les données du tableau envoyées depuis React
        $request->validate([
            'nom' => 'required|string',
            'prenoms' => 'required|string',
            'poste' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
        ]);
        // Enregistrement du fichier dans un répertoire dédié (par exemple, storage/app/fichiers)
        $path = $request->file('fichier')->store('images', 'public');

        // Stockez l'image dans le dossier de stockage Laravel
        $personnel = new Personnel([
            'nom' => $request->input('nom'),
            'prenoms' => $request->input('prenoms'),
            'poste' => $request->input('poste'),
            'photoPersonnel' => $path,
        ]);
        $personnel->save();
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
    //Afficher une portfolio par son id
    public function afficherPersonnelId($id)
    {
        $personnel = Personnel::find($id);
        if($personnel){
            return response()->json([
                'status' => 200,
                'personnel' => $personnel
            ], 200);
        }
        else{
            return response()->json([
                'status' => 404,
                'message' => "Aucun personnel trouvé"
            ], 404);
        }
    }
}
