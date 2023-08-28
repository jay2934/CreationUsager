<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <h1>Creation Usager</h1>
    <?php
        $nom = $mdp = $cmdp = $courriel = $lienImgAvatar = $sexe = $dateNaissance = $transport = "";
        $nomErreur = $mdpErreur = $cmdpErreur = $courrielErreur = $lienImgAvatarErreur = $sexeErreur = $dateNaissanceErreur = $transportErreur = "";
        $erreur = false;

        if ($_SERVER['REQUEST_METHOD'] == "POST"){
            //CAS #2
            //On vient de recevoir le formulaire
            echo "<h1>POST == TRUE </h1>";
            
            if(empty($_POST['nom'])){
                $nomErreur = "Le nom ne peut pas être vide";
                $erreur  = true;
            }
            else{
                $nom = trojan($_POST['nom']);
            }

            if(empty($_POST['mdp'])){
                $mdpErreur = "Le mot de passe ne peut pas être vide";
                $erreur  = true;
            }
            else{
                $mdp = trojan($_POST['mdp']);
            }

            if($_POST['cmdp'] != $_POST['mdp']){
                $cmdpErreur = "Le mot de passe n'est pas pareil";
                $erreur  = true;
            }
            else{
                $cmdp = trojan($_POST['cmdp']);
            }
            
            if(empty($_POST['courriel'])){
                $courrielErreur = "Le courriel ne peut pas être vide";
                $erreur  = true;
            }
            else if((!filter_var($_POST['courriel'], FILTER_VALIDATE_EMAIL))){
                $courrielErreur = "Le courriel n'est pas valide";
                $erreur  = true;
            }
            else{
                $courriel = trojan($_POST['courriel']);
            }
            
            if(empty($_POST['lienImgAvatar'])){
                $lienImgAvatarErreur = "Le lien ne peut pas être vide";
                $erreur  = true;
            }
            else{
                $lienImgAvatar = trojan($_POST['lienImgAvatar']);
            }

            if(empty($_POST['sexe'])){
                $sexeErreur = "Vous devez cocher une option";
                $erreur  = true;
            }
            else{
                $sexe = trojan($_POST['sexe']);
            }

            //AFFICHER LE RÉSULTAT DE MON FORM
        }
        if ($_SERVER['REQUEST_METHOD'] != "POST" || $erreur == true){
            // Cas #1 On veut afficher le formulaire
            echo "<h1>On affiche le formulaire </h1>";
        ?>
            <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
                Nom : <input type="text" name="nom" maxLength="15" value="<?php echo $nom;?>"><br>
                <p style="color:red;"><?php echo $nomErreur; ?></p>

                mdp : <input type="password" name="mdp" value="<?php echo $mdp;?>"> <br>
                <p style="color:red;"><?php echo $mdpErreur; ?></p>

                cmdp : <input type="password" name="cmdp" value="<?php echo $cmdp;?>"> <br>
                <p style="color:red;"><?php echo $cmdpErreur; ?></p>

                courriel : <input type="text" name="courriel" value="<?php echo $courriel;?>"> <br>
                <p style="color:red;"><?php echo $courrielErreur; ?></p>

                lienImgAvatar : <input type="text" name="lienImgAvatar" value="<?php echo $lienImgAvatar;?>"> <br>
                <p style="color:red;"><?php echo $lienImgAvatarErreur; ?></p>

                sexe : <label for="masculin">masculin</label><input type="radio" name="sexe" <?php if($sexe == "masculin"){echo 'checked="checked"';} ?> value="masculin"><label for="">féminin</label><input type="radio" <?php if($sexe == "féminin"){echo 'checked="checked"';} ?> name="sexe" value="féminin"><label for="">non genré</label><input type="radio" <?php if($sexe == "non genré"){echo 'checked="checked"';} ?> name="sexe" value="non genré"> <br>
                <p style="color:red;"><?php echo $sexeErreur; ?></p>

                <input type="submit">
            </form>
        <?php
        }

        function trojan($data){
            $data = trim($data); //Enleve les caractères invisibles
            $data = addslashes($data); //Mets des backslashs devant les ' et les  "
            $data = htmlspecialchars($data); // Remplace les caractères spéciaux par leurs symboles comme ­< devient &lt;
            
            return $data;
        }

    ?>

    
    

</body>
</html>