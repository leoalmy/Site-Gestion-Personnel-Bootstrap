<?php 
  $modalId    = $modalId    ?? 'errorModal';
  $title      = $title      ?? 'Erreur';
  $body       = $body       ?? $this->data['leMessage'] ?? 'Une erreur est survenue.';
  $cancelText = $cancelText ?? 'Fermer';
  $showModal  = true; // always auto-show when required directly
?>
<!-- v_modalError.php -->
<div class="modal fade" id="<?= $modalId ?? 'errorModal' ?>" tabindex="-1" aria-labelledby="<?= $modalId ?? 'errorModal' ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-danger">
      <div class="modal-header bg-danger text-white">
        <h5 class="modal-title" id="<?= $modalId ?? 'errorModal' ?>Label">
          <i class="bi bi-exclamation-triangle-fill me-2"></i>
          <?= $title ?? 'Erreur' ?>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
      <?= !empty($body)
          ? nl2br(htmlspecialchars($body, ENT_QUOTES, 'UTF-8'))
          : 'Une erreur est survenue. Veuillez réessayer plus tard.' ?>
    </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <?= $cancelText ?? 'Fermer' ?>
        </button>
      </div>
    </div>
  </div>
</div>

<?php if (!empty($showModal) && $showModal): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var modalEl = document.getElementById("<?= $modalId ?>");
    var modal = new bootstrap.Modal(modalEl);
    modal.show();

    // Optional redirect after X seconds
    <?php if (!empty($redirectUrl)): ?>
      modalEl.addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
          window.location.href = "<?= $redirectUrl ?>";
        }, <?= $redirectDelay ?? 3000 ?>); // default 3s
      });
    <?php endif; ?>
  });
</script>
<?php endif; ?>

