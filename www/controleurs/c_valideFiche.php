<?php

/*
 * 
 *$mois= mois et annee du jour
 * $leMois= mois et annee   du visiteur selectionne
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
$lesVisiteurs = $pdo->getChoixVisiteurs();
$mois = getMois(date('d/m/Y'));
$listMois = getLesDouzeDerniersMois($mois);

switch ($action) {
    case 'getChoixVisiteur':

        $lesCles[] = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles[0];
        $lesCles1[] = array_keys($listMois);
        $moisASelectionner = $lesCles1[0];

        include 'vues/v_listeVisiteur.php';
        break;

    case 'detailFichefrais':
        
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $condition = $pdo->estPremierFraisMois($idVisiteur, $leMois);

        if (!$condition) {

            $visiteurASelectionner = $idVisiteur;
            $moisASelectionner = $leMois;
            $nombreJustificatif = $pdo->getNbjustificatifs($idVisiteur, $leMois);
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);

            include 'vues/v_valideFiche.php';
        } else {
            ajouterErreur('le visiteur à selectionné ne possède aucune information pour le mois séléctionné');
            include 'vues/v_erreurs.php';
            header("Refresh: 1;index.php?uc=valideFiche&action=getChoixVisiteur");
        }
        break;
    case 'modifierFicheFrais':

        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $montant = filter_input(INPUT_POST, 'montant', FILTER_SANITIZE_STRING);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $lesFraisF = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);

        $visiteurASelectionner = $idVisiteur;
        $moisASelectionner = $leMois;
        $nombreJustificatif = $pdo->getNbjustificatifs($idVisiteur, $leMois);
        $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
        $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);

        if (isset($_POST['corrigerFrais'])) {

            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFraisF);
            ajouterErreur('la mise a jour a ete effectuee.');
            include 'vues/v_erreurs.php';
            $lesFraisForfait = $pdo->getLesFraisForfait($idVisiteur, $leMois);
            include 'vues/v_valideFiche.php';
        } else if (isset($_POST['validerFrais'])) {
            valideInfosFrais($date, $libelle, $montant);
            if (nbErreurs() != 0) {
                include 'vues/v_erreurs.php';
            } else {
                 $pdo->majFraisHorsForfait($idVisiteur,$leMois,$libelle,$date, $montant);
            }
           
           
            ajouterErreur('La modification a été effectueéé');
            include 'vues/v_erreurs.php';
            $lesFraisHorsForfait = $pdo->getLesFraisHorsForfait($idVisiteur, $leMois);
            include 'vues/v_valideFiche.php';
            
        } else if (isset($_POST['reporter'])) {

           $condition= $pdo-> estPremierFraisMois($idVisiteur, $mois);
            
            if ($condition) {
                $pdo->creeNouvellesLignesFrais($idVisiteur, $mois);
            }
            $libelle = 'refusé' . $libelle;
            //$pdo->supprimerFraisHorsForfait($idFrais);

            var_dump($idVisiteur, $mois, $libelle, $date, $montant);
           $pdo->creeNouveauFraisHorsForfait($idVisiteur,$mois, $libelle,$date,$montant);
            // $pdo->creeFHFReporté($idVisiteur,$mois,$libelle,$date,$montant);
            ajouterErreur('La modification a été effectueéé');
            include 'vues/v_erreurs.php';
            include 'vues/v_valideFiche.php';
        } else if (isset($_POST['validerFiche'])) {

            $etat = 'VA';
            $pdo->majEtatFicheFrais($idVisiteur, $leMois, $etat);
            $sommeHF = $pdo->getMontantHF($idVisiteur, $leMois);
            $totalHF = $sommeHF[0][0];
            $sommeFF = $pdo->getMontantFF($idVisiteur, $leMois);
            $totalFF = $sommeFF[0][0];
            $montantTotal = $totalHF + $totalFF;
            $pdo->majTotal($idVisiteur, $leMois, $montantTotal);
            include 'vues/v_retourAccueil.php';
        }

        break;
}
