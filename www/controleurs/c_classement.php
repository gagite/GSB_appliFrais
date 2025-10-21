<?php

/* 
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/EmptyPHP.php to edit this template
 */

echo 'classement';

$action = filter_input(INPUT_GET, 'action', FILTER_SANITIZE_STRING);
switch ($action) {
    case 'leclassement':
        $infovisiteur = $pdo->getInfosClassemnt();
         //var_dump($infovisiteur);
         $quantite = $pdo-> getmontantfraisforfais();
         var_dump($quantite);
        include 'vues/v_classement.php';
break;

}