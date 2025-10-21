<?php
/**
 * controlleur accueil
 *
 * PHP Version 7
 *
 * @category  PPE
 * @package   GSB
 * @author    beth sefer, HG, Guez Haguith
 */

if ($estConnecte) {
    if (isset($_SESSION['idComptable'])){
     include 'vues/v_accueilc.php';
    }else  {
    include 'vues/v_accueilv.php';
    }
} else {
    include 'vues/v_connexion.php';
}
