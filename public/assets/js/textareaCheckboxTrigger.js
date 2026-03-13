document.addEventListener('DOMContentLoaded', function() {
    function bindToggle(checkboxId, showId, hideId) {
        var checkbox = document.getElementById(checkboxId);
        var showEl = document.getElementById(showId);
        var hideEl = hideId ? document.getElementById(hideId) : null;
        if (checkbox && showEl) {
            var apply = function() {
                var on = checkbox.checked;
                showEl.style.display = on ? 'block' : 'none';
                if (hideEl) {
                    hideEl.style.display = on ? 'none' : 'block';
                }
            };
            checkbox.addEventListener('change', apply);
            apply();
        }
    }

    // Generic handler via data attributes
    var toggles = document.querySelectorAll('[data-toggle-checkbox]');
    toggles.forEach(function(cb){
        var showId = cb.getAttribute('data-target-show');
        var hideId = cb.getAttribute('data-target-hide');
        if (showId) {
            bindToggle(cb.id, showId, hideId);
        }
    });

    // Legacy bindings (ReservationView)
    bindToggle('customVisitReasonEnable', 'customVisitReasonDiv', 'visitReasonIdDiv');
    // New binding for EditDoctorView
    bindToggle('customSpecEnable', 'customSpecDiv');
});

