

<form action="index.php?uc=classement&action=leclassement" 
      method="post" role="form">
    <table class="table">
        <thead>
            <tr>
                <th scope="col">rang</th>
                <th scope="col">nom</th>
                <th scope="col">prenom</th>
                <th scope="col">Frais forfais</th>
                <th scope="col">frais Hors forfais</th>
                <th scope="col">somme totale</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($infovisiteur as $uninfovisiteur) {
                $nom = $uninfovisiteur['nom'];
                $prenom = $uninfovisiteur['prenom'];
                $ff  = $uninfovisiteur['quantite'];
                $fhf  = $uninfovisiteur['montant'];
                $montant = $uninfovisiteur['montantValide'];
                ?>           
                <tr>
                    <td> <?php echo $i ?></td>
                    <td> <?php echo $nom ?></td>
                    <td> <?php echo $prenom ?></td>
                    
                    <td> <?php echo $ff ?></td>
                    <td> <?php echo $fhf ?></td>
                    <td><?php echo $montant ?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
</form>