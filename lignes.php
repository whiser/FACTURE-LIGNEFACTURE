<?php
if (isset($_POST['id'])) {
    $id = $_POST['id'];
    // Connexion à la base de données
    include 'config.php'; 
    // Récupération des lignes de facture pour la facture sélectionnée
    $query = $conn->prepare('SELECT * FROM lignefacture WHERE idfacture = :id');
    $query->execute(['id' => $id]);
    $lignes = $query->fetchAll();
    // Affichage des lignes de facture
    echo '<table class="table">';
    echo '<tr><th>Produit</th><th>Prix</th></tr>';
    foreach ($lignes as $ligne) {
        echo '<tr>';
        echo '<td>' . $ligne['article'] . '</td>';
        echo '<td>' . $ligne['prix'] . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
?>