<div class="wrap">

<h1>Events Manager Extensions settings</h1>

<form method="post" action="options.php">
<?  settings_fields( 'emex' ); ?>
<? do_settings_sections( 'emex' ); ?>

<?php submit_button(); ?>

</form>
</div>

