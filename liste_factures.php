<?php

include 'config.php';

?>
<html>

<head>
    <title>Liste des factures</title>
    <!-- Inclusion de Bootstrap pour la mise en forme -->
    <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha384-ZvpUoO/+PpLXR1lu4jmpXWu80pZlYUAfxl5NsBMWOEPSjUn/6Z/hRTt8+pR6L4N2" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <!--<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script> -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <!-- Inclusion de jQuery pour les appels AJAX -->
    
</head>

<body>

    <table class="table">
        <thead>
            <tr>
                <th>Numéro de facture</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Récupération de toutes les factures
            $query = $conn->prepare('SELECT * FROM facturetest');
            $query->execute();
            $factures = $query->fetchAll();
            // Boucle pour afficher les factures
            foreach ($factures as $facture) {
                echo '<tr>';
                echo '<td>' . $facture['numero_facture'] . '</td>';
                echo '<td>';
                echo '<button class="btn btn-primary btn-detail" data-id="' . $facture['id'] . '">Détails</button> ';
                echo '<button class="btn btn-secondary btn-lignes" data-id="' . $facture['id'] . '">Lignes de facture</button>';
                echo '</td>';
                echo '</tr>';
            }
            ?>
            <!-- Modal pour afficher les détails de la facture -->
            <div class="modal fade" id="modalDetails" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Détails de la facture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="factureDetails">
                            <!-- Contenu de la facture sera affiché ici -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Modal pour afficher les lignes de la facture -->
            <div class="modal fade" id="modalLignes" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Lignes de la facture</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body" id="factureLignes">
                            <!-- Contenu des lignes de la facture sera affiché ici -->
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Script pour ouvrir les modals -->
            <script>
                $(document).ready(function() {
                    // Ouvrir le modal pour afficher les détails de la facture
                    $('.btn-detail').click(function() {
                        $.ajax({
                            url: 'details.php',
                            type: 'POST',
                            data: { id: $(this).data('id') },
                            success: function(response) {
                                console.log(response);
                                $('#factureDetails').html(response);
                                $('#modalDetails').modal('show');
                            }
                        });
                    });

                    // Ouvrir le modal pour afficher les lignes  de la facture correspondante
                    $('.btn-lignes').click(function() {
                        $.ajax({
                            url: 'lignes.php',
                            type: 'POST',
                            data: {
                                id: $(this).data('id')
                            },
                            success: function(response) {
                                $('#factureLignes').html(response);
                                $('#modalLignes').modal('show');
                            }
                        });
                    });
                });
            </script>

            <!-- Modal pour afficher les détails de la facture -->
            

</body>

</html>