<?php
/*
# =================================================
# sidebar.php
#
# The sidebar template.
# =================================================
*/
?>

<?php
    if ( is_active_sidebar( 'main-sidebar' ) ) {
        dynamic_sidebar( 'main-sidebar' );
    }
?>
