<?php
/**
 * Vue Liste des mois
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    Réseau CERTA <contact@reseaucerta.org>
 * @author    José GIL <jgil@ac-nice.fr>
 * @copyright 2017 Réseau CERTA
 * @license   Réseau CERTA
 * @version   GIT: <0>
 * @link      http://www.reseaucerta.org Contexte « Laboratoire GSB »
 */
?>
<form action="index.php?uc=valideFiche&action=detailFichefrais"
      method = "post" role = "from">
    <div class="col-md-4">
        <div class="form-group">
            <label for="lstVisiteur" accesskey="n">Choisir un Visiteur : </label>
            <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                <?php
                foreach ($lesVisiteurs as $unVisiteur) {
                    $id = $unVisiteur['id'];
                    $nom = $unVisiteur['nom'];
                    $prenom = $unVisiteur['prenom'];
                    if ($Visiteur == $VisiteurASelectionner) {
                        ?>
                        <option selected value="<?php echo $id ?>">
                            <?php echo $prenom . ' ' . $nom ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $id ?>">
                            <?php echo $prenom . ' ' . $nom ?> </option>
                        <?php
                    }
                }
                ?>    
            </select>
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label for="lstMois" accesskey="n">Mois : </label>
            <select id="lstMois" name="lstMois" class="form-control">
                <?php
                foreach ($listMois as $unMois) {
                    $mois = $unMois['mois'];
                    $numAnnee = $unMois['numAnnee'];
                    $numMois = $unMois['numMois'];
                    if ($mois == $moisASelectionner) {
                        ?>
                        <option selected value="<?php echo $mois ?>">
                            <?php echo $numMois. '/'.$numAnnee ?> </option>
                        <?php
                    } else {
                        ?>
                        <option value="<?php echo $mois ?>">
                            <?php echo $numMois. '/'.$numAnnee ?> </option>
                        <?php
                    }
                }
                ?>    

            </select>
        </div>

    </div>
    <br>
    <input  id="ok" type="submit" value="Valider" class="btn btn-success" 
            role="button">
    <input id="annuler" type="reset" value="Effacer" class="btn btn-danger" 
           role="button">
    </div>
</form>


