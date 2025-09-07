<div class="container my-4">
    <h2 class="mb-4">Liste des Services</h2>
    <table class="table table-striped">
        <thead>
            <tr>
                <th>Code</th>
                <th>Nom</th>
                <th>Nombre d'employés</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($this->data['lesServices'] as $service): ?>
                <tr>
                    <td><?php echo htmlspecialchars($service->GetCode()); ?></td>
                    <td><?php echo htmlspecialchars($service->GetDesignation()); ?></td>
                    <td><?php echo htmlspecialchars($service->GetNbEmployes()); ?></td>
                    <td>
                        <a href="index.php?page=modifierService&code=<?php echo urlencode($service->GetCode()); ?>" class="btn btn-primary btn-sm">Modifier</a>
                        <a href="index.php?page=supprimerService&code=<?php echo urlencode($service->GetCode()); ?>" class="btn btn-danger btn-sm" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce service ?');">Supprimer</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>