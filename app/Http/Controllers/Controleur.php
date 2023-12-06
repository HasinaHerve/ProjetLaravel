<?php

namespace App\Http\Controllers;

use App\Models\Actualite;
use App\Models\Portfolio;
use App\Models\Personnel;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Storage;

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
            'fichier' => 'required|image|mimes:jpeg,png',
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
    public function modifierActualite(Request $request)
    {
        //Récupérer les données du tableau envoyées depuis React
        $validation= $request->validate([
            'titre' => 'required|string',
            'descriptionActualite' => 'required|string',
            'dateEvenement' => 'required',
            'fichier' => 'required|image|mimes:jpeg,png',
        ]);
        // Enregistrement du fichier dans un répertoire dédié
        $path = $request->file('fichier')->store('images', 'public');
        // Récupérer l'instance d'Actualite existante
        $actualite = Actualite::findOrFail($request->input('id'));
        //Suppréssion de l'image
        Storage::delete('public/'.$actualite->photosActualite);
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
        //Suppréssion de l'image
        Storage::delete('public/'.$actualite->photosActualite);
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
        // Enregistrement du fichier dans un répertoire dédié
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
    public function modifierPortfolio(Request $request)
    {
        //Récupérer les données du tableau envoyées depuis React
        $validation= $request->validate([
            'nomEntreprise' => 'required',
            'descriptionPortfolio' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
            'lien' => 'required',
        ]);
        // Enregistrement du fichier dans un répertoire dédié
        $path = $request->file('fichier')->store('images', 'public');
        // Récupérer l'instance de portfolio existant
        $portfolio = Portfolio::findOrFail($request->input('id'));
        //Suppréssion de l'image
        Storage::delete('public/'.$portfolio->photosPortfolio);
        // Mettre à jour les propriétés individuelles de l'instance
        $portfolio->nomEntreprise = $request->input('nomEntreprise');
        $portfolio->descriptionPortfolio = $request->input('descriptionPortfolio');
        $portfolio->lien = $request->input('lien');
        $portfolio->photosPortfolio = $path;

        // Sauvegarder les modifications
        $portfolio->save();

        return response()->json($portfolio, 200);
    }
    //Supprimer une portfolio
    public function supprimerPortfolio($id)
    {
        $portfolio = Portfolio::findOrFail($id);

        //Suppréssion de l'image
        //Storage::delete('public/'.$actualite->photosPortfolio);

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
    public function modifierPersonnel(Request $request)
    {
        $data = $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
            'poste' => 'required',
        ]);

        $personnel = Personnel::findOrFail($request->input('id'));
        $personnel->update($data);

        //Récupérer les données du tableau envoyées depuis React
        $validation= $request->validate([
            'nom' => 'required',
            'prenoms' => 'required',
            'fichier' => 'required|file|mimes:jpeg,png',
            'poste' => 'required',
        ]);
        // Enregistrement du fichier dans un répertoire dédié
        $path = $request->file('fichier')->store('images', 'public');
        // Récupérer l'instance de personnel existant
        $personnel = Personnel::findOrFail($request->input('id'));
        //Suppréssion de l'image
        Storage::delete('public/'.$personnel->photoPersonnel);
        // Mettre à jour les propriétés individuelles de l'instance
        $personnel->nom = $request->input('nom');
        $personnel->prenoms = $request->input('prenoms');
        $personnel->poste = $request->input('poste');
        $personnel->photoPersonnel = $path;

        // Sauvegarder les modifications
        $personnel->save();

        return response()->json($personnel, 200);
    }
    //Supprimer un personnel
    public function supprimerPersonnel($id)
    {
        $personnel = Personnel::findOrFail($id);
        Storage::delete('public/'.$personnel->photoPersonnel);
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


    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            return response()->json(['user' => $user]);
        }
        else{
            return response()->json(['message' => 'Invalid credentials'], 401);
        }

        
    }
    public function ajouterCompte(Request $request)
    {
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:6',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        return response()->json(['user' => $user]);
    }
}
