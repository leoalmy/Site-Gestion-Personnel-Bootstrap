<div class="container">
<?php
if (is_null($this->data['leService'])) {
    echo '<h2>Tous les services</h2>';
} else {
    echo '<h2>Service ' . $this->data['leService']->GetDesignation() . '</h2>';
}
?>

<table class="table table-striped table-bordered">
    <thead>
        <tr>
            <th>Matricule</th>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Service</th>
        </tr>
    </thead>
    <tbody>
    <?php
    foreach ($this->data['lesEmployes'] as $unEmploye) {
        echo '<tr>';
        echo '<td>' . $unEmploye->GetMatricule() . '</td>';
        echo '<td>' . $unEmploye->GetNom() . '</td>';
        echo '<td>' . $unEmploye->GetPrenom() . '</td>';
        echo '<td>' . $unEmploye->GetService() . '</td>';
        echo '</tr>';
    }
    ?>
    </tbody>
</table>
</div>