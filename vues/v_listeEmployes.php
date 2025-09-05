<div class="container my-4">
    <!-- Page title -->
    <h2>
        <?php
            $services = [
                'all' => 'Tous les services',
                's01' => 'Fabrication',
                's02' => 'Emballage',
                's03' => 'Commercial',
                's04' => 'Administration'
            ];

            // Get the current service code if object exists
            $currentService = 'all';
            if (!empty($this->data['leService'])) {
                // Assuming $this->data['leService'] is a Service object with GetCode()
                $currentService = $this->data['leService']->GetCode();
            }

            echo $currentService === 'all'
                ? 'Tous les services'
                : 'Service ' . ($services[$currentService] ?? 'Inconnu');
        ?>
    </h2>

    <!-- Employee table -->
    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>Matricule</th>
                <th>Nom</th>
                <th>Prénom</th>
                <th>Service</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
                foreach ($this->data['lesEmployes'] as $unEmploye) 
                {
                    // Map service code to Bootstrap color
                    switch ($unEmploye->GetService()) {
                        case 's01': // Fabrication
                            $btnClass = 'btn-primary'; // blue
                            break;
                        case 's02': // Emballage
                            $btnClass = 'btn-warning'; // orange
                            break;
                        case 's03': // Commercial
                            $btnClass = 'btn-success'; // green
                            break;
                        case 's04': // Administration
                            $btnClass = 'btn-danger'; // red
                            break;
                        default:
                            $btnClass = 'btn-dark'; // fallback
                            break;
                    }

                    echo '<tr>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetMatricule()) . '</td>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetNom()) . '</td>';
                    echo '<td>' . htmlspecialchars($unEmploye->GetPrenom()) . '</td>';

                    // Service button with custom color
                    echo '<td>';
                    echo '<a href="index.php?service=' . htmlspecialchars($unEmploye->GetService()) . '&page=listeEmployes" ';
                    echo 'class="btn btn-sm ' . $btnClass . '">';
                    echo htmlspecialchars($unEmploye->GetServiceName());
                    echo '</a> (' . htmlspecialchars($unEmploye->GetService()) . ')';
                    echo '</td>';
                    echo '<td>';
                    echo "<a href=\"index.php?page=modifierEmploye&matricule=" . $unEmploye->GetMatricule() . "\"
                            class=\"btn btn-info btn-sm me-2\">Modifier</a>";
                    echo "<a href=\"index.php?page=supprimerEmploye&matricule=" . $unEmploye->GetMatricule() . "\"
                            class=\"btn btn-danger btn-sm\"
                            onclick=\"return confirm('Voulez-vous vraiment supprimer cet employé ?');\"> Supprimer
                            </a>";
                    echo '</td>';
                    echo '</tr>';
                }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="5">Total: <?php echo count($this->data['lesEmployes']); ?> employés</td>
            </tr>
        </tfoot>
    </table>
</div>
