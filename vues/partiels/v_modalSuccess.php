<!-- v_modalSuccess.php -->
<div class="modal fade" id="<?= $modalId ?? 'successModal' ?>" tabindex="-1" aria-labelledby="<?= $modalId ?? 'successModal' ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-success">
      <div class="modal-header bg-success text-white">
        <h5 class="modal-title" id="<?= $modalId ?? 'successModal' ?>Label">
          <i class="bi bi-check-circle-fill me-2"></i>
          <?= $title ?? 'Succès' ?>
        </h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <?= !empty($body)
            ? nl2br(htmlspecialchars($body, ENT_QUOTES, 'UTF-8'))
            : 'Opération effectuée avec succès.' ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
          <?= $cancelText ?? 'Fermer' ?>
        </button>
      </div>
    </div>
  </div>
</div>
