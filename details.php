<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Connexion à la base de données
    include 'config.php';         
    // Récupération des détails de la facture
    $query = $conn->prepare('SELECT * FROM facturetest WHERE id = :id');
    $query->execute(['id' => $id]);
    $facture = $query->fetch();
    // Affichage des détails de la facture
    echo '<table class="table">';
    echo '<tr><th>Numéro</th><td>' . $facture['numero_facture'] . '</td></tr>';
    echo '<tr><th>Date</th><td>' . $facture['date_facture'] . '</td></tr>';
    echo '<tr><th>Client</th><td>' . $facture['nom_client'] . '</td></tr>';
    echo '</table>';
}
?>