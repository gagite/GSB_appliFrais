<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'getChoixVisiteur':
        $lesVisiteurs = $pdo->getChoixVisiteurs();
        $lesCles[] = array_keys($lesVisiteurs);
        $visiteurASelectionner = $lesCles[0];
        $mois = getMois(date('d/m/Y'));
        $listMois = getLesDouzeDerniersMois($mois);
        $lesCles1[] = array_keys($listMois);
        $moisASelectionner = $lesCles1[0];

        include 'vues/v_listeVisiteur.php';
        break;
    case 'detailFichefrais':
        $idVisiteur = filter_input(INPUT_POST, 'lstVisiteur', FILTER_SANITIZE_STRING);
        $leMois = filter_input(INPUT_POST, 'lstMois', FILTER_SANITIZE_STRING);
        $condition = $pdo->estPremierFraisMois($idVisiteur, $leMois);

        if (!$condition) {
            $lesVisiteurs = $pdo->getChoixVisiteurs();
            $visiteurASelectionner = $idVisiteur;
            $mois = getMois(date('d/m/Y'));
            $listMois = getLesDouzeDerniersMois($mois);
            $moisASelectionner = $leMois;
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
        $montant = filter_input(INPUT_POST, 'montant', FILTER_VALIDATE_FLOAT);
        $libelle = filter_input(INPUT_POST, 'libelle', FILTER_SANITIZE_STRING);
        $date = filter_input(INPUT_POST, 'date', FILTER_SANITIZE_STRING);
        $lesFraisForfait = filter_input(INPUT_POST, 'lesFrais', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $lesFraisHorsForfait = filter_input(INPUT_POST, 'leFraisHorsForfait', FILTER_DEFAULT, FILTER_FORCE_ARRAY);
        $id = filter_input(INPUT_POST, 'id', FILTER_SANITIZE_STRING);
        if (isset($_POST['corrigerFrais'])) {
            echo 'La mise a jour a été éffectuée';
            var_dump($idVisiteur, $leMois, $lesFraisForfait);
            $pdo->majFraisForfait($idVisiteur, $leMois, $lesFraisForfait);
            header("Refresh: 2;index.php?uc=valideFiche&action=detailFichefrais&idVisiteur=<?php echo $idVisiteur ?>&leMois=<?php echo $leMois ?>");
        } else if (isset($_POST['validerFrais'])) {
            var_dump($id, $idVisiteur, $leMois, $montant, $date, $libelle);

            echo 'La mise a jour a été éffectuée';
            $test = $pdo->majFraisHorsForfait($id, $idVisiteur, $leMois, $libelle, $date, $montant);
            var_dump($test);
            //ajouterErreur('La modification a été effectueéé');
            //include 'vues/v_erreurs.php';
            header("Refresh: 1;index.php?uc=valideFiche&action=detailFichefrais&idVisiteur=<?php echo $idVisiteur ?>&leMois=<?php echo $leMois ?>");
        } else if (isset($_POST['reporter'])) {

            $idFrais = $id;
            $libelle = 'refusé' . $libelle;
            //$pdo->supprimerFraisHorsForfait($idFrais);
            $mois = getMois(date('d/m/Y'));
            var_dump($idVisiteur, $mois, $libelle, $date, $montant);
            $pdo->creeNouveauFraisHorsForfait($idVisiteur, $mois, $libelle, $date, $montant);
            ajouterErreur('La modification a été effectueéé');
            include 'vues/v_erreurs.php';
            header("Refresh: 1;index.php?uc=valideFiche&action=detailFichefrais&idVisiteur=<?php echo $idVisiteur ?>&leMois=<?php echo $leMois ?>");
        } else if (isset($_POST['validerFiche'])) {
            echo 'salut nous';
            $mois = $leMois;
            var_dump($montant, $idVisiteur, $leMois,$mois, $etat);
            $$etat = 'VA';
           //$montantValide=$pdo->majMontant($idVisiteur, $leMois, $montant);
           //$pdo-> majEtatFicheFrais($idVisiteur, $mois, $etat);
        }

        break;
    
}
