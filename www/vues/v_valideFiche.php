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
<form method="post"   action="index.php?uc=valideFiche&action=modifierFicheFrais" 
      role="form">
    <div class ="row">

        <div class="col-md-4">
            <div class="form-group">
                <label for="lstVisiteur" accesskey="n">Choisir un Visiteur : </label>
                <select id="lstVisiteur" name="lstVisiteur" class="form-control">
                    <?php
                    foreach ($lesVisiteurs as $unVisiteur) {
                        $id = $unVisiteur['id'];
                        $nom = $unVisiteur['nom'];
                        $prenom = $unVisiteur['prenom'];
                        if ($id == $visiteurASelectionner) {
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
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        } else {
                            ?>
                            <option value="<?php echo $mois ?>">
                                <?php echo $numMois . '/' . $numAnnee ?> </option>
                            <?php
                        }
                    }
                    ?>     

                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div style="color:orangered">
            <br> <h2>Valider la fiche de frais </h2>
        </div>
        <h3>Eléments forfaitisés</h3>
        <div class="col-md-4"> 
            <fieldset>       
                <?php
                foreach ($lesFraisForfait as $unFrais) {
                    $idFrais = $unFrais['idfrais'];
                    $libelle = htmlspecialchars($unFrais['libelle']);
                    $quantite = $unFrais['quantite'];
                    ?>
                    <div class="form-group">
                        <label for="idFrais"><?php echo $libelle ?></label>
                        <input type="text" id="idFrais" 
                               name="lesFrais[<?php echo $idFrais ?>]"
                               size="10" maxlength="5" 
                               value="<?php echo $quantite ?>" 
                               class="form-control">
                    </div>
                    <?php
                }
                ?>
                <input class="btn btn-success" id="corrigerFrais" name="corrigerFrais" type="submit" value="Corriger" />
                <input class="btn btn-danger" id="reinitialiser" name="reinitialiser" type="reset" value="Réinitialiser" />
                <!--<button class="btn btn-success" type="submit">Corriger</button>
                <button class="btn btn-danger" type="reset">Réinitialiser</button>-->
            </fieldset>
        </div>
    </div>
    <hr>
    <div class="row">

        <div class="panel" style="border-color:#ec971f; color:#fff">
            <div class="panel-heading" style="background-color:#ec971f">Descriptif des éléments hors forfait</div>
            <table class="table table-bordered table-responsive" style="color:#000">
                <thead>
                    <tr>
                        <th class="date">Date</th>
                        <th class="libelle">Libellé</th>  
                        <th class="montant">Montant</th>  
                        <th class="action">&nbsp;</th> 
                    </tr>
                </thead>  
                <tbody>
                    <?php
                    foreach ($lesFraisHorsForfait as $unFraisHorsForfait) {
                        $libelle = htmlspecialchars($unFraisHorsForfait['libelle']);
                        $date=$unFraisHorsForfait['date'];
                        $montant = $unFraisHorsForfait['montant'];
                        $id = $unFraisHorsForfait['id'];
                        ?>           
                        <tr>
                            <td> <input type="text" id="date" name="date"size="16" value="<?php echo $date ?>"></td>
                            <td> <input type="text" id="libelle" name ="libelle" size="16" value="<?php echo $libelle ?>"></td>
                            <td> <input type="text" id="montant" name="montant" size="6" value="<?php echo $montant ?>"></td>
                
                            <td> <input type="hidden" id="id" name="id" value="<?php echo $id ?>" >
                                 <input class="btn btn-success" id="validerFrais" name="validerFrais" type="submit" value="Corriger" />
                                 <input class="btn btn-danger" id="reporter" name="reporter" type="submit" value="Reporter" /></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>  
            </table>
        </div>
    </div>
    <div class="row">

        <div class="col-md-4">

            <div class="form-group">
                <label>Nombre de justificatifs</label>             
                <input type="text" size="4" maxlenght="5" value="<?php echo   $nombreJustificatif ?>">
                <br><input class="btn btn-success" id="validerFiche" name="validerFiche" type="submit" value="Valider" /><br>
            </div> 
        </div>
    </div>
</form>