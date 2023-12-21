import React from 'react';
import './Admin.css';

const Admin = () => {
    // Vérifier si l'utilisateur est un administrateur
    const isAdmin = true; // Remplacez par votre logique de vérification d'administrateur

    if (!isAdmin) {
        return <h1>Accès refusé</h1>;
    }

    // Afficher la page de gestion des voitures pour les administrateurs
    return (
        <div>
            <h1>Gestion des voitures</h1>
            {/* Ajoutez ici votre code pour la gestion des voitures */}
        </div>
    );
};

export default Admin;
