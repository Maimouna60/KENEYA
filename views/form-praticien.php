<?php
// je stocke dans la variable '$patternName' ma regex pour les noms !
$patternName = '%^([A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+)([- ]{1}[A-Z]{1}[a-zÀ-ÖØ-öø-ÿ]+){0,1}$%';
// je créé un tableau qui va contenir mes erreurs.
$formErrors = array();

// On vérifie le nombre de lignes dans le tableau POST qui contient toutes les données saisies dans le formulaire.
if (count($_POST) > 0) {
  // on vérifie que la variable $_POST['lastName'] existe ET n'est pas vide.
  if (!empty($_POST['lastName'])) {
    // Je vérifie bien que ma variable $_POST['lastName'] correspond à ma patternName.
    if (preg_match($patternName, $_POST['lastName'])) {
      // On stocke dans la variable lastName la variable $_POST['lastName'] dont on a désactivé les balises HTML.
      $lastName = htmlspecialchars($_POST['lastName']);
    } else {
      // Si la saisie utilisateur ne correspond pas à la regex on va stocker une erreur lastName dans notre tableau d'erreurs.
      $formErrors['lastName'] = 'Vôtre nom de famille est incorrect';
    }
  } else {
    // On va réutiliser notre erreur lastName parce que les deux ne peuvent pas exister en même temps.
    $formErrors['lastName'] = 'Veuillez renseigner votre nom de famille';
  }

  if (!empty($_POST['firstName'])) {
    if (preg_match($patternName, $_POST['firstName'])) {
      $firstName = htmlspecialchars($_POST['firstName']);
    } else {
      $formErrors['firstName'] = 'Vôtre prénom est incorrect';
    }
  } else {
    $formErrors['firstName'] = 'Veuillez renseigner votre prénom';
  }

  
  // On verifie que le fichier a bien été envoyé.
  if (!empty($_FILES['file']) && $_FILES['file']['error'] == 0) {
    // On stock dans $fileInfos les informations concernant le chemin du fichier.
    $fileInfos = pathinfo($_FILES['file']['name']);
    // On crée un tableau contenant les extensions autorisées.
    $fileExtension = ['pdf', 'PDF', 'Pdf'];
    // On verifie si l'extension de notre fichier est dans le tableau des extension autorisées.
    if (in_array($fileInfos['extension'], $fileExtension)) {
      //On définit le chemin vers lequel uploader le fichier
      $path = 'uploads/';
      //On crée une date pour différencier les fichiers
      $date = date('Y-m-d_H-i-s');
      //On crée le nouveau nom du fichier (celui qu'il aura une fois uploadé)
      $fileNewName = $lastName . $firstName . '_' . $date;
      //On stocke dans une variable le chemin complet du fichier (chemin + nouveau nom + extension une fois uploadé) Attention : ne pas oublier le point
      $fileFullPath = $path . $fileNewName . '.' . $fileInfos['extension'];
      //move_uploaded_files : déplace le fichier depuis son emplacement temporaire ($_FILES['file']['tmp_name']) vers son emplacement définitif ($fileFullPath)
      if (move_uploaded_file($_FILES['file']['tmp_name'], $fileFullPath)) {
        //On définit les droits du fichiers uploadé (Ici : écriture et lecture pour l'utilisateur apache, lecture uniquement pour le groupe et tout le monde)
        chmod($fileFullPath, 0644);


        

      } else {
        $formErrors['file'] = 'Votre fichier ne s\'est pas téléversé correctement';
      }
    } else {
      $formErrors['file'] = 'Votre fichier n\'est pas du format attendu';
    }
  } else {
    $formErrors['file'] = 'Veuillez selectionner un fichier';
  }
}
?>

<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Exercice 7 part 7 PHP</title>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootswatch/4.3.1/journal/bootstrap.min.css" />
</head>
<body>
  <div class="container">
    <?php
    // On affiche le formulaire si rien a été envoyé ou qu'il y a une erreur dans ce qui à été saisi.
    if (count($_POST) == 0 || count($formErrors) > 0) {
      ?>
      <form method="POST" action="index.php" enctype="multipart/form-data">
        <div class="form-group">
          <label for="lastName">Nom de famille</label>
          <?php
          /* On donne en valeur à notre input ce qui a été saisi par notre utilisateur . ça permet à l'utilisateur de ne pas ressaisir ses données en cas d'erreur
          * isset($_POST['lastName']) ? $_POST['lastName'] : ''
          * Si $_POST['lastName'] existe (?) alors on affiche $_POST['lastName'] (:) Sinon on affiche rien.
          */
          ?>
          <input type="text" value="<?= isset($_POST['lastName']) ? $_POST['lastName'] : '' ?>" name="lastName" class="form-control" id="lastName" placeholder="Dupont" required />
          <?php
          // On affiche un alerte rouge qui contient le texte de l'erreur s'il y en à une.
          if (isset($formErrors['lastName'])) {
            ?>
            <div class="alert-danger">
              <p><?= $formErrors['lastName'] ?></p>
            </div>
          <?php } ?>
        </div>
        <div class="form-group">
          <label for="firstName">Prénom</label>
          <input type="text" value="<?= isset($_POST['firstName']) ? $_POST['firstName'] : '' ?>" name="firstName" class="form-control" id="firstName" placeholder="Jean" required />
          <?php if (isset($formErrors['firstName'])) { ?>
            <div class="alert-danger">
              <p><?= $formErrors['firstName'] ?></p>
            </div>
          <?php } ?>
        </div>
        <div class="form-group">
          <label for="title">Civilité</label>
          <select name="title" class="form-control" id="title" required>
            <option disabled selected>Veuillez faire un choix !</option>
            <option value="Monsieur" <?= isset($_POST['title']) && $_POST['title'] == 'Monsieur' ? 'selected' : '' ?>>Monsieur</option>
            <option value="Madame" <?= isset($_POST['title']) && $_POST['title'] == 'Madame' ? 'selected' : '' ?>>Madame</option>
          </select>
          <?php if (isset($formErrors['title'])) { ?>
            <div class="alert-danger">
              <p><?= $formErrors['title'] ?></p>
            </div>
          <?php } ?>
          <div class="form-group">
            <label for="file">Fichier</label>
            <input class="form-control" type="file" name="file" id="file" />
          </div>
          <?php if (isset($formErrors['file'])) { ?>
            <div class="alert-danger">
              <p><?= $formErrors['file'] ?></p>
            </div>
          <?php } ?>
        </div>
        <input type="submit" name="submit" value="Envoyer" class="btn btn-primary" />
      </form>
      <?php
      /* Pour l'affichage des données si tout a été validé
      * On affiche une alerte verte pour prévenir que l'utilisateur que tout s'est bien passé:
      * On affiche les variables lastname , firstname et title car elle contiennent la saisie de l'utilisateur si tout s'est bien passée
      * On utilise la balises br uniquement dans un p
      * On a ajouté un bouton de retour au formulaire pour simplifier la navigation.
      */
    } else {
      ?>
      <div class="alert-success">
        <p>Vos données ont bien été envoyées et votre fichier a bien été transmis.</p>
      </div>
      <div class="well jumbotron">
        <p>
          Nom : <?= $lastName ?> <br />
          Prénom : <?= $firstName ?> <br />
          Lieu: <?= $practicePlace ?> <br />
          Spécialité: <?= $speciality ?> <br />
          Fichier : <?= $fileInfos['filename'] ?><br />
          Extension : <?= $fileInfos['extension'] ?> <br />
          Votre fichier : <a href="<?= $fileFullPath?>" title="Lien vers le fichier" target="_blank"><?= $fileNewName ?></a>
        </p>
        <a href="index.php" title="Retour vers le formulaire" class="btn btn-info">Ajouter un nouvel utilisateur</a>
      </div>
    <?php } ?>
  </div>
</body>
</html>
