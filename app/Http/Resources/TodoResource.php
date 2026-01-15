<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

/**
 * Cette classe transforme un modèle Todo en une structure
 * de données destinée au frontend.
 *
 * Les JsonResources permettent de :
 * - contrôler précisément les données exposées
 * - éviter de renvoyer des informations sensibles
 * - garantir un format stable pour le frontend
 *
 * Le même Resource peut être utilisé pour :
 * - Inertia
 * - une API REST
 * - une application mobile
 */
class TodoResource extends JsonResource
{
    /**
     * Transforme le Todo en tableau.
     *
     * Cette méthode est appelée automatiquement par Laravel
     * lorsque le Resource est retourné depuis un controller.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            // Identifiant du Todo
            'id' => (int) $this->id,

            // Titre du Todo
            'title' => $this->title,

            // Description (peut être null)
            'description' => $this->description,

            // Statut du Todo (enum PHP)
            'status' => $this->status,

            /*
             |--------------------------------------------------------------
             | Utilisateur propriétaire du Todo
             |--------------------------------------------------------------
             |
             | Ici, on expose uniquement l'identifiant de l'utilisateur.
             | Cela évite d'envoyer l'intégralité du modèle User
             | et limite les données partagées avec le frontend.
             |
             */
            'user' => [
                'id' => $this->user_id,
            ],

            // Dates de création et de mise à jour
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
