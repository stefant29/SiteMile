function activateTooltips() {
    const $tooltips = $(".has-tooltip");
    if ($tooltips.length) {
        $tooltips.tooltip();
    }
}

$(document).ready(function () {
    activateTooltips();
});