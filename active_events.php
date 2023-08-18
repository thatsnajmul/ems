<?php include 'inc/header.php';?>
 <div class="main">
    <div class="content">
    	<div class="content_top">
    		<div class="heading">
    		<h3>All Active Events</h3>
    		</div>
    		<div class="clear"></div>
    	</div>
	      <div class="section group">
			<?php
				$getFev = $ev->getFeatureEvent();
				if ($getFev) {
					while ($result = $getFev->fetch_assoc()) {
			?>
				<div class="grid_1_of_4 images_1_of_4">
					 <a href="details.php?eventid=<?php echo $result['eventId']; ?>"><img src="admin/<?php echo $result['image'];?>" alt="" /></a>
					 <h2><?php echo $result['eventName']; ?></h2>
					 <p><?php echo $fm->textShorten($result['body'], 60); ?></p>
					 <h4>Status: <?php if ($result['type'] == 0) {
								echo "Active";
							} else {
								echo "Inactive";
							} ?></h4>
				     <div class="button"><span><a href="details.php?eventid=<?php echo $result['eventId']; ?>" class="details">Details</a></span></div>
				</div>
				<?php } } ?>
			</div>
    </div>
 </div>
</div>
<?php include "inc/footer.php";?>	