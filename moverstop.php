<?php
/* moverstop.php
 * Adds a "Stop Mover" button to the Unraid Main tab
 */

$docroot = $docroot ?? $_SERVER['DOCUMENT_ROOT'] ?: '/usr/local/emhttp';
require_once "$docroot/webGui/include/Helpers.php";

// Hook into Unraid header to inject JS
add_hook('Main', 'addStopMoverButton');

function addStopMoverButton() {
?>
<script type="text/javascript">
$(function() {
    let moverBtn = $('button:contains("Move")').first()

    if (moverBtn.length && $('#stopMoverBtn').length === 0) {
        $('<button id="stopMoverBtn" class="btn">Stop Mover</button>')
            .insertAfter(moverBtn)
            .on('click', function() {
                $.post('/update.php', { cmd: 'mover stop' }, function(data) {
                    alert("Mover stop command sent!");
                });
            });
    }
});
</script>
<?php
}
?>
