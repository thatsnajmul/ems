<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Event.php';?>
<?php
    if (!isset($_GET['eventid']) || $_GET['eventid'] == NuLL) {
        echo "<script>window.location = 'eventlist.php'; </script>";
    } else {
        $id = preg_replace('/[^-a-zA-Z0-9_]/', '', $_GET['eventid']);
    }

    $ev = new Event();
	if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['submit'])) {     
        $updateEvent = $ev->eventUpdate($_POST, $_FILES, $id);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Update Event</h2>
        <div class="block">
        <?php
            if (isset($updateEvent)) {
                echo $updateEvent;
            }
        ?>   
        
        <?php
            $getEvent = $ev->getEventById($id);
            if ($getEvent) {
                while ($value = $getEvent->fetch_assoc()) {
        ?>
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Event Title</label>
                    </td>
                    <td>
                        <input type="text" name="eventName" value="<?php echo $value['eventName']?>" class="medium" />
                    </td>
                </tr>				
				 <tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce">
                            <?php echo $value['body']; ?>
                        </textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Image</label>
                    </td>
                    <td>
                    <img src="<?php echo $value['image']; ?>" height="80px" width="200px"><br/>
                        <input name="image" type="file" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Event Location</label>
                    </td>
                    <td>
                        <input type="text" name="location" value="<?php echo $value['location']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Address</label>
                    </td>
                    <td>
                        <input type="text" name="address" value="<?php echo $value['address']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Date</label>
                    </td>
                    <td>
                        <input type="date" name="date" value="<?php echo $value['date']; ?>" class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Time</label>
                    </td>
                    <td>
                        <input type="time" name="time" value="<?php echo $value['time']; ?>" class="medium" />
                    </td>
                </tr>		
				<tr>
                    <td>
                        <label>Event Status</label>
                    </td>
                    <td>
                        <select id="select" name="type">
                            <option>Select Status</option>
                            <option value="0">Active</option>
                            <option value="1">Inactive</option>
                        </select>
                    </td>
                </tr>

				<tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" Value="Update" />
                    </td>
                </tr>
            </table>
            </form>
           <?php } } ?> 
        </div>
    </div>
</div>
<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<!-- Load TinyMCE -->
<?php include 'inc/footer.php';?>


