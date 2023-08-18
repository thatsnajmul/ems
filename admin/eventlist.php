<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Event.php';?>
<?php include_once '../helpers/Format.php';?>

<?php
	$ev = new Event();
	$fm = new Format();
?>
<?php
	if (isset($_GET['delevent'])) {
		$id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['delevent']);
		$delEvent = $ev->delEventById($id);
	}
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Post List</h2>
        <div class="block"> 
		<?php
				if (isset($delEvent)) {
					echo $delEvent;
				}
			?> 
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>SL</th>
					<th>Event Title</th>
					<th>Description</th>
					<th>Image</th>
					<th>Event Location</th>
					<th>Event Address</th>
					<th>Event Date</th>
					<th>Event Time</th>
					<th>Event Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
			<?php
					$getev = $ev->getAllEvent();
					if ($getev) {
						$i = 0;
						while ($result = $getev->fetch_assoc()) {
							$i++;
				?>
				<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $result['eventName']; ?></td>
					<td><?php echo $fm->textShorten($result['body'], 50); ?></td>
					<td><img src="<?php echo $result['image']; ?>" height="40px" width="60px"></td>
					<td><?php echo $result['location']; ?></td>
					<td><?php echo $result['address']; ?></td>					
					<td><?php echo $result['date']; ?></td>
					<td><?php echo $result['time']; ?></td>				
					<td>
						<?php
							if ($result['type'] == 0) {
								echo "Active";
							} else {
								echo "Inactive";
							}
						?>
					</td>
					<td><a href="eventedit.php?eventid=<?php echo $result['eventId'];?>">Edit</a> || <a onclick="return confirm('Are You Sure to delete?')" href="?delevent=<?php echo $result['eventId'];?>">Delete</a></td>
				</tr>
				<?php } } ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php include 'inc/footer.php';?>
