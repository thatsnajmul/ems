<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php include '../classes/Event.php';?>
<?php
    $ev = new Event();
	if ($_SERVER['REQUEST_METHOD'] ==  'POST' && isset($_POST['submit'])) {
        $insertEvent = $ev->eventInsert($_POST, $_FILES);
    }
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Add New Event</h2>
        <div class="block">
        <?php
            if (isset($insertEvent)) {
                echo $insertEvent;
            }
        ?>                   
         <form action="" method="post" enctype="multipart/form-data">
            <table class="form">
               
                <tr>
                    <td>
                        <label>Event Title</label>
                    </td>
                    <td>
                        <input type="text" name="eventName" placeholder="Enter Event Title..." class="medium" />
                    </td>
                </tr>				
				<tr>
                    <td style="vertical-align: top; padding-top: 9px;">
                        <label>Description</label>
                    </td>
                    <td>
                        <textarea name="body" class="tinymce"></textarea>
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Upload Image</label>
                    </td>
                    <td>
                        <input name="image" type="file" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Location</label>
                    </td>
                    <td>
                        <input type="text" name="location" placeholder="Enter Event Location..." class="medium" />
                    </td>
                </tr>
				<tr>
                    <td>
                        <label>Event Address</label>
                    </td>
                    <td>
                        <input type="text" name="address" placeholder="Enter Event Address..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Date</label>
                    </td>
                    <td>
                        <input type="date" name="date" placeholder="Enter Event Date..." class="medium" />
                    </td>
                </tr>
                <tr>
                    <td>
                        <label>Event Time</label>
                    </td>
                    <td>
                        <input type="time" name="time" placeholder="Enter Event Time..." class="medium" />
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
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
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


