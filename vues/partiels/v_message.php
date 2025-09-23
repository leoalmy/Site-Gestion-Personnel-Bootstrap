<?php
// Redirect if no message
if (empty($this->data['typeMessage'])) {
    header("Location: index.php?page=accueil");
    exit();
}
?>

<div class="container mt-3">
    <?php if ($this->data['typeMessage'] === 'error'): ?>
        <div class="alert alert-danger" role="alert">
            <?php echo htmlspecialchars($this->data['leMessage'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php elseif ($this->data['typeMessage'] === 'success'): ?>
        <div class="alert alert-success" role="alert">
            <?php echo htmlspecialchars($this->data['leMessage'], ENT_QUOTES, 'UTF-8'); ?>
        </div>
    <?php endif; ?>
</div>
