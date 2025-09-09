function showConfirmModal({ modalId, bodyText, onConfirm }) {
    const modalEl = document.getElementById(modalId);
    modalEl.querySelector(".modal-body").textContent = bodyText;

    const confirmBtn = modalEl.querySelector(".btn-success");

    // Reset listeners to avoid stacking
    const newBtn = confirmBtn.cloneNode(true);
    confirmBtn.parentNode.replaceChild(newBtn, confirmBtn);

    newBtn.addEventListener("click", () => {
        onConfirm();
        const modalInstance = bootstrap.Modal.getInstance(modalEl);
        modalInstance.hide();
    });

    const modal = new bootstrap.Modal(modalEl);
    modal.show();
}