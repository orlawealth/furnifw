<?php 
	include"../core/init.php";
	verify_login($_SESSION['admin_id']);

		$event_id =(int)$_GET['id'] ?? '1';
		$event = find_event_by_id($event_id);

	include "admin_header.php";

?>
	<div class="container">	
		<img src="	">
		<div class="fr-view pb-5 mt-5">
			
			 <?php 	
				echo '	
				<div class ="d-flex justify-content-center"><img class ="" style="max-width:50%; height:auto;" src ="' .$event['event_image'].'"> </div>
				<h2 class=" text-center p-4">'.$event['event_title'].' </h2>
				<div>'.$event['event_content'].' </div>

				';
			 ?>
		</div>
	</div>
	
	
<?php 
	include "admin_footer.php";
?>