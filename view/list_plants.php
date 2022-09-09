<?php include 'view/header.php'; ?>
<h2>Plants</h2>
<h4>In <?php echo ucfirst($roomName) ; ?></h4>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<table class="table table-striped">
    <tr>
        <th>Plant Name</th>
        <!-- <th>Plant ID</th> -->
        <th>Date Added</th>
        <th></th>
        <th></th>
    </tr>
    <?php  foreach ($plants as $plant) :
        $plantName = $plant['plant_name'];
        $plantID = $plant['plant_id'];
        $dateAdded = $plant['date_added'];
    ?>
    <tr>
        <td><?php echo ucfirst($plantName) ?></td>
        <!-- <td><?php //echo $plantID ?></td> -->
        <td><?php echo $dateAdded; ?></td>
        <td><form action="." method="POST" id="view_single_plant_form">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="plantID" value="<?php echo $plantID; ?>">
            <input type="hidden" name="plantName" value="<?php echo $plantName; ?>">
            <input type="hidden" name="dateAdded" value="<?php echo $dateAdded; ?>">
            <input type="hidden" name="action" value="view_single_plant">
            <button type="submit" class="btn btn-outline-primary">View Plant</button>
        </form></td>
        <td><form action="." method="POST">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="plantID" value="<?php echo $plantID; ?>">
            <input type="hidden" name="action" value="delete_plant">
            <button type="submit" class="btn btn-outline-primary">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<form action="." method="POST">
    <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
    <input type="hidden" name="action" value="go_to_add_plant_form">
    <button type="submit" class="btn btn-outline-primary">Add Plant</button>
</form>
<?php include 'view/footer.php'; ?>