<?php


include 'config.php';
// Enregistrement des données de la facture dans la base de données
if (isset($_POST['valider'])) {
    $article = $_POST['article'];
    $prix = $_POST['prix'];
    $idfacture = $_POST["facture_id"];

    try {
        $stmt = $conn->prepare("INSERT INTO lignefacture (article, prix, idfacture) VALUES (:article, :prix, :idfacture)");
        $stmt->bindParam(':article', $article);
        $stmt->bindParam(':prix', $prix);
        $stmt->bindParam(':idfacture', $idfacture);
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
    <title>Liste des factures</title>
    <!-- Inclusion de Bootstrap pour la mise en forme -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</head>
<body>
    <div class="container mt-5">
        <h1>Ligne  factures</h1>
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Numéro de facture</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <!-- Récupération et affichage des factures depuis la base de données -->
                <?php
include 'config.php';
$stmt = $conn->prepare("SELECT * FROM lignefacture");
$stmt->execute();
$factures = $stmt->fetchAll();
foreach ($factures as $facture) {
    ?>
                <tr>
                    <td><?php echo $facture["id"]; ?></td>
                    <td>
                        <!-- Bouton pour afficher les détails de la facture -->
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#factureDetailsModal-<?php echo $facture["id"]; ?>">
                            Détails
                        </button>

                        <!-- Modal pour afficher les détails de la facture -->
                        <div class="modal fade" id="factureDetailsModal-<?php echo $facture["id"]; ?>" tabindex="-1" role="dialog" aria-labelledby="factureDetailsModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="factureDetailsModalLabel">Détails de la facture</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <p><strong>Article : </strong><?php echo $facture["article"]; ?></p>
                                        <p><strong>prix : </strong><?php echo $facture["prix"]; ?></p>
                                        <p><strong>id facture : </strong><?php echo $facture["idfacture"]; ?></p>    
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </td>
                </tr>
                <?php }?>
            </tbody>
        </table>
        <a href="index.php"><button type="button" class="btn btn-primary">Retourner au formulaire</button></a>

    </div>
 
</div>
</body>
</html>
