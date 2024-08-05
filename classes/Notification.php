<?php
    class Notification {
        public function __construct() {
            $this->showToast();
        }

        public function showToast() {
            echo '
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">Notification</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    This is a static toast message.
                </div>
            </div>';
        }
    }

?>