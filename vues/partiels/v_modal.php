<?php
// Defaults
$modalId     = $modalId     ?? 'appModal';
$title       = $title       ?? 'Message';
$body        = $body        ?? '';
$cancelText  = $cancelText  ?? 'Fermer';
$confirmText = $confirmText ?? null; // only for confirm dialogs
$type        = $type        ?? 'info'; // error | confirm | success | info
$showModal   = $showModal   ?? false;
$redirectUrl = $redirectUrl ?? null;
$redirectDelay = $redirectDelay ?? 3000; // ms

// Pick styling based on type
switch ($type) {
    case 'error':
        $headerClass = 'bg-danger text-white';
        $btnClass    = 'btn-danger';
        $icon        = '<i class="bi bi-exclamation-triangle-fill me-2"></i>';
        break;
    case 'success':
        $headerClass = 'bg-success text-white';
        $btnClass    = 'btn-success';
        $icon        = '<i class="bi bi-check-circle-fill me-2"></i>';
        break;
    case 'confirm':
        $headerClass = 'bg-warning text-dark';
        $btnClass    = 'btn-warning';
        $icon        = '<i class="bi bi-question-circle-fill me-2"></i>';
        break;
    default: // info
        $headerClass = 'bg-primary text-white';
        $btnClass    = 'btn-primary';
        $icon        = '<i class="bi bi-info-circle-fill me-2"></i>';
}
?>

<div class="modal fade" id="<?= $modalId ?>" tabindex="-1" aria-labelledby="<?= $modalId ?>Label" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content border-0 shadow-lg">
      <div class="modal-header <?= $headerClass ?>">
        <h5 class="modal-title" id="<?= $modalId ?>Label"><?= $icon ?><?= $title ?></h5>
        <button type="button" class="btn-close <?= $type === 'error' ? 'btn-close-white' : '' ?>" data-bs-dismiss="modal" aria-label="Fermer"></button>
      </div>
      <div class="modal-body">
        <?= nl2br(htmlspecialchars($body, ENT_QUOTES, 'UTF-8')) ?>
      </div>
      <div class="modal-footer">
        <?php if ($type === 'confirm' && $confirmText): ?>
            <button type="button" class="btn <?= $btnClass ?>" id="<?= $modalId ?>ConfirmBtn">
                <?= $confirmText ?>
            </button>
        <?php endif; ?>
        <button type="button" class="btn <?= $btnClass ?>" data-bs-dismiss="modal"><?= $cancelText ?></button>
      </div>
    </div>
  </div>
</div>

<?php if ($showModal || $type === 'confirm' || $redirectUrl): ?>
<script>
  document.addEventListener("DOMContentLoaded", function () {
    var modalEl = document.getElementById("<?= $modalId ?>");
    var modal   = new bootstrap.Modal(modalEl);

    <?php if ($showModal): ?>
      modal.show();
    <?php endif; ?>

    <?php if ($redirectUrl): ?>
      // Auto-redirect after delay
      modalEl.addEventListener('shown.bs.modal', function () {
        setTimeout(function () {
          window.location.href = "<?= $redirectUrl ?>";
        }, <?= $redirectDelay ?>);
      });

      // Redirect immediately if user closes
      modalEl.addEventListener('hidden.bs.modal', function () {
        window.location.href = "<?= $redirectUrl ?>";
      });
    <?php endif; ?>

    <?php if ($type === 'confirm'): ?>
      var confirmBtn = document.getElementById("<?= $modalId ?>ConfirmBtn");
      if (confirmBtn) {
        confirmBtn.addEventListener("click", function() {
          if (typeof window.confirmAction === "function") {
            window.confirmAction();
          }
          modal.hide();
        });
      }
    <?php endif; ?>
  });
</script>
<?php endif; ?>
