<?php include 'inc/header.php';?>
<?php
    if (!isset($_GET['eventid']) || $_GET['eventid'] == NuLL) {
        echo "<script>window.location = '404.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['eventid']);
    }

    


?>

 <div class="main">
    <div class="content">
    	<div class="section group">
				<div class="cont-desc span_1_of_2">	
				<?php
				$getEv= $ev->getSingleEvent($id);
				if ($getEv) {
					while ($result = $getEv->fetch_assoc()) {
				?>			
					<div class="grid images_3_of_2">
						<img src="admin/<?php echo $result['image']; ?>" alt="" />
					</div>
				<div class="desc span_3_of_2">
			<div class="">
			<h1>Event Details</h1>
			<h2><?php echo $result['eventName']; ?></h2>
			<p><?php echo $result['body']; ?></p>
			<p>Location: <span><?php echo $result['location']; ?></span></p>
			<p>Address: <span><?php echo $result['address']; ?></span></p>
			<p>Date: <span><?php echo $result['date']; ?></span></p>
			<p>Time: <span><?php echo $result['time']; ?></span></p>
			<p>Type: <span><?php if ($result['type'] == 0) {
								echo "Active";
							} else {
								echo "Inactive";
							} ?></span></p>
								
					
						
					
	    </div>
		<?php } } ?>		
	</div>
 		</div>
 	</div>
	</div>
	<?php include 'inc/footer.php';?>