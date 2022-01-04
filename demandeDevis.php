<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/style_index.css">
</head>
<body>
    <?php
    //stockage variable
         if (!empty($_POST['age']))
         {
            if (!empty($_POST['Civilite']))
            {
                $_Civilite=filter_var($_POST['Civilite'], FILTER_SANITIZE_STRING);
            }
            if (!empty($_POST['nom']))
            {
                $_nom=filter_var($_POST['nom'], FILTER_SANITIZE_STRING);
            }
            if (!empty($_POST['prenom']))
            {
                $_prenom=filter_var($_POST['prenom'], FILTER_SANITIZE_STRING);
            }
            if (!empty($_POST['age'])||$_POST['accidents']=='0')
            {
                $_age=filter_var($_POST['age'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (!empty($_POST['accidents'])||$_POST['accidents']=='0')
            {
                $_accidents=(int)filter_var($_POST['accidents'], FILTER_SANITIZE_NUMBER_INT);
            }
            if (!empty($_POST['anciennete_permis'])||$_POST['anciennete_permis']=='0')
            {
                $_anciennete_permis=(int)filter_var($_POST['anciennete_permis'], FILTER_SANITIZE_NUMBER_INT);            
            }
            if (!empty($_POST['anciennete_assurance'])||$_POST['anciennete_assurance']=='0')
            {
                $_anciennete_assurance=(int)filter_var($_POST['anciennete_assurance'], FILTER_SANITIZE_NUMBER_INT);
            }
         }
    ?>
    
    <h1 id="title">Assurances Sa Roule</h1>
    <h1 class="bg typo pad bord">Evaluez votre tarif</h1>

    <form class="bg typo pad bord" action="" method="POST">
        <div class="form-example">
            <label for="Civilite">Civilité : </label>
            <input type="radio" name="Civilite" id="monsieur" value='Monsieur'>
            <label for="monsieur">Monsieur</label>
            <input type="radio" name="Civilite" id="madame" value='Madame'>
            <label for="madame">Madame</label>
        </div>
        <div class="form_assurance">
            <label for="nom">Renseignez votre nom : </label>
            <input type="text" name="nom" id="nom">
        </div>
        <div class="form_assurance">
            <label for="prenom">Renseignez votre prenom : </label>
            <input type="text" name="prenom" id="prenom">
        </div>
        <div class="form_assurance">
            <label for="age">Renseignez votre age : </label>
            <input type="number" min="0" name="age" id="age" required>
        </div>
        <div class="form_assurance">
            <label for="anciennete_permis">Depuis combien d'année avez-vous le permis de conduire ? : </label>
            <input type="number" min="0" name="anciennete_permis" id="anciennete_permis" required>
        </div>        
        <div class="form_assurance">
            <label for="accidents">Combien  d'accidents responsables avez-vous eu ? : </label>
            <input type="number" min="0" name="accidents" id="accidents" required>
        </div>
        <div class="form_assurance">
            <label for="anciennete_assurance">Depuis combien d'année êtes-vous assurez ? : </label>
            <input type="number" min="0" name="anciennete_assurance" id="anciennete_assurance" required>
        </div> 

        <div class="button">
            <input type="submit" value="Estimez votre tarif">
        </div>

    
     <?php

      //algo tarif
        if (!empty($_POST['age'])&&$_POST['age']>=18)
        {
            $_palier=1-$_accidents;
            if($_anciennete_permis>=2)
            {
                $_palier++;
            }
            if($_age>=25)
            {
                $_palier++;
            }
            if($_palier>0)
            {
                if($_anciennete_assurance>=5)
                {
                    $_palier++;
                }
            }
            switch($_palier)
            {
                case 1:
                    $_tarif='Vous avez droit au tarif Rouge</p>';
                    break;
                case 2:
                    $_tarif='Vous avez droit au tarif Orange</p>';
                    break;
                case 3:
                    $_tarif='Vous avez droit au tarif Vert</p>';
                    break;
                case 4:
                    $_tarif='Vous avez droit au tarif Bleu</p>';
                    break;
                default:
                    $_tarif='Vous êtes refusez</p>';
                    break;
            }
            echo '<p class="pad">'.((empty($_POST['Civilite']))?:$_Civilite.' ').((empty($_POST['nom']))?:$_nom.' ').((empty($_POST['prenom']))?:$_prenom.', ').$_tarif;
        }
        else if(!empty($_POST['age'])&&$_POST['age']<18)
        {
            ?>
            <p>Désolé, nous ne pouvons pas vous proposez de devis, vous êtes mineur.</p>

            <?php
        }
?>



    </form>
</body>
</html>