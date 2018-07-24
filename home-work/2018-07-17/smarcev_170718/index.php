<?php
/**
 * Date: 17.07.18
 * @author Isaenko Alexey <info@oiplug.com>
 */

require 'functions.php';

init();

?>

<div class="clsinp">
	<form  action = "index.php" lass="clform">
		<input type="text" name="intext" value="<?php echo $_GET['intext']; ?>">
		<button>Ок</button>
		
	</form>
	<?php 
		stvalue($_GET['intext']); 
		?>
</div>
