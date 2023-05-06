<?php echo('<br><hr><br>'); 
echo('Conditional Tags');
echo('<br><br>'); ?>


<?php 
echo("is front_page "); 
var_dump( is_front_page() ); 

echo("is single "); 
var_dump( is_single() ); 

echo("is page "); 
var_dump( is_page() ); 

echo("is archive "); 
var_dump( is_archive() ); 

echo("is user logged in "); 
var_dump( is_user_logged_in() );
 ?>

<?php echo('<br><hr><br>'); ?>