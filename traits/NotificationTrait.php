<?php
    trait NotificationTrait {
        public function showToast($type, $message) {
            return '
            <div class="toast show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <strong class="me-auto">'.$type.'</strong>
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                '.$message.'
                </div>
            </div>';
        }
    }
?>