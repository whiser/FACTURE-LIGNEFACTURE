<?php


include 'config.php';         
// Enregistrement des données de la facture dans la base de données
if (isset($_POST['valider'])) {
    $numero_facture  = $_POST['numero_facture'];
    $fournisseur = $_POST['fournisseur'];
    $date_facture  = $_POST['date_facture'];
    $montant = $_POST['montant'];
    $nom_client = $_POST['nom_client'];

    try {
        $stmt = $conn->prepare("INSERT INTO facturetest (numero_facture, fournisseur, date_facture, montant,nom_client) VALUES (:numero_facture, :fournisseur, :date_facture, :montant, :nom_client)");
        $stmt->bindParam(':numero_facture', $numero_facture);
        $stmt->bindParam(':fournisseur', $fournisseur);
        $stmt->bindParam(':date_facture', $date_facture);
        $stmt->bindParam(':montant', $montant);
        $stmt->bindParam(':nom_client', $nom_client);
        $stmt->execute();
        header('Location: liste_factures.php');
    } catch (PDOException $e) {
        echo "Erreur d'enregistrement : " . $e->getMessage();
        die();
    }
}

?>

<html>
<head>
    <title>Enregistrer une facture</title>
    <!-- Inclusion de Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
</head>
<body>
 
<!-- Formulaire pour enregistrer une facture -->
<div class="container">
    <h1>Enregistrer une facture</h1>
    <form action="" method="post">
        <div class="form-group">
            <label for="numero_facture">Numéro de facture</label>
            <input type="text" class="form-control" id="numero_facture" name="numero_facture" required>
        </div>
        <div class="form-group">
            <label for="numero_facture">Le fournisseur</label>
            <input type="text" class="form-control" id="fournisseur" name="fournisseur" required>
        </div>
        <div class="form-group">
            <label for="date_facture">Date de facture</label>
            <input type="date" class="form-control" id="date_facture" name="date_facture" required>
        </div>
        <div class="form-group">
            <label for="nom_client">Nom du client</label>
            <input type="text" class="form-control" id="nom_client" name="nom_client" required>
        </div>
        <div class="form-group">
            <label for="montant">Montant</label>
            <input type="number" class="form-control" id="montant" name="montant" required>
        </div>
        <button class="btn btn-primary" name="valider" type="submit">Valider</button>
    </form>
    <a href="liste_factures.php"><button type="button" class="btn btn-primary">Voir la liste des factures</button></a>
</div>

