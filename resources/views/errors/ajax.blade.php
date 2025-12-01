<div class="modal-header bg-danger text-white">
    <h5 class="modal-title"><i class="fas fa-exclamation-triangle me-2"></i>Error</h5>
    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
</div>
<div class="modal-body">
    <div class="alert alert-danger">
        <h5 class="text-danger">{{ $error ?? 'An error occurred' }}</h5>

        @if(isset($details) && !empty($details))
        <p class="mt-3 mb-0">
            <strong>Details:</strong>
            <code class="d-block mt-2 p-2 bg-light">{{ $details }}</code>
        </p>
        @endif
    </div>

    <div class="d-flex justify-content-between mt-3">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary" onclick="retryLastAction()">
            <i class="fas fa-retry me-1"></i> Retry
        </button>
    </div>
</div>

<script>
function retryLastAction() {
    if (typeof window.lastAjaxOperation === 'function') {
        window.lastAjaxOperation();
    } else {
        const modal = bootstrap.Modal.getInstance(document.querySelector('.modal.show'));
        if (modal) modal.hide();
    }
}
</script>
