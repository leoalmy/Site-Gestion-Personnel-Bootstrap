<!-- v_modalConfirm.php -->
<div class="modal fade" id="<?= $modalId ?? 'confirmModal' ?>" tabindex="-1" aria-labelledby="<?= $modalId ?? 'confirmModal' ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="<?= $modalId ?? 'confirmModal' ?>Label"><?= $title ?? 'Confirmer l’action' ?></h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <?= $body ?? 'Voulez-vous continuer ?' ?>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><?= $cancelText ?? 'Annuler' ?></button>
        <button type="button" class="btn btn-success" id="<?= $confirmBtnId ?? 'confirmBtn' ?>"><?= $confirmText ?? 'Oui' ?></button>
      </div>
    </div>
  </div>
</div>