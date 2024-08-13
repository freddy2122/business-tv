<?php

namespace App\Http\Controllers;

use App\Mail\ContactMail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }


    public function envoyerEmail(Request $request)
    {
        // Valider les données du formulaire
        $validate = $request->validate([
            'name' => 'required',
            'prenom' => 'required',
            'objet' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);
       
        // Créer un nouveau contact
        $contact = Contact::create($validate);
    
        // Si la validation échoue, rediriger avec les erreurs
        if (!$contact) {
            return redirect()->back()->withErrors(['message' => 'Erreur lors de l\'enregistrement du contact.'])->withInput();
        }
    
        // Envoyer l'e-mail
        Mail::to('freddy.akouta@expertitlab.com')->send(new ContactMail($request->all()));
    
        // Rediriger avec un message de succès
        return redirect()->back()->with('message', 'E-mail envoyé avec succès!');
    }
}
