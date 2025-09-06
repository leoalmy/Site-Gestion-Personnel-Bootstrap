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
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_matricule&direction=<?php echo ($orderBy === 'emp_matricule' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Matricule
                        <?php if ($orderBy === 'emp_matricule'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_nom&direction=<?php echo ($orderBy === 'emp_nom' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Nom
                        <?php if ($orderBy === 'emp_nom'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_prenom&direction=<?php echo ($orderBy === 'emp_prenom' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Prénom
                        <?php if ($orderBy === 'emp_prenom'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
                <th>
                    <a href="index.php?page=listeEmployes&service=<?php echo urlencode($currentService); ?>&orderBy=emp_service&direction=<?php echo ($orderBy === 'emp_service' && $direction === 'ASC') ? 'DESC' : 'ASC'; ?>"
                    class="text-light">
                        Service
                        <?php if ($orderBy === 'emp_service'): ?>
                            <i class="bi bi-caret-<?php echo ($direction === 'ASC') ? 'up' : 'down'; ?>-fill"></i>
                        <?php endif; ?>
                    </a>
                </th>
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
