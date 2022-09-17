<?php
if (!isset($sunLevel)) {
    $sunSetting = '';
} else {
    $sunSetting = ' <label>Current setting is '.ucfirst(strtolower($sunLevel)).'.</label>';
}
if (!isset($waterLevel)) {
    $waterSetting = '';
} else {
    $waterSetting = ' <label>Current setting is '.ucfirst(strtolower($waterLevel)).'.</label>';
}
include 'view/header.php'; ?>

<h2>Edit Plant Details</h2>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<form action="." method="POST"><div class="mb-3">
    <lable>In Room: <?php echo ucfirst($roomName[0][0]); ?></lable> 
    <br>
    <label for="plantName">Plant Name:</label>
        <input type="text" name="plantName" value="<?php echo $plantName; ?>" required>
        <br>
    <label for="sun">Sunlight Level: </label>
        <select id="sun" name="sunLevel" required>
            <option value="LOW">Low</option>
            <option value="MEDIUM">Medium</option>
            <option value="HIGH">High</option>
        </select><?php echo $sunSetting;?>
        <br>
    <label for="water">Water Level: </label>
        <select id="water" name="waterLevel" required>
            <option value="LOW">Low</option>
            <option value="MEDIUM">Medium</option>
            <option value="HIGH">High</option>
        </select><?php echo $waterSetting;?>
        <br>
    <label for="notes">Care Notes: </label>
        <input name="notes" type="text" value="<?php echo $careNotes; ?>"><br>
        <input type="hidden" name="plantID" value="<?php echo $plantID; ?>">
        <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
    <input type="hidden" name="action" value="submit_edit_plant_form">
    <input type="submit" value="Update Plant">
</form><form action="." method="POST">
    <input type="hidden" name="action" value="view_single_room">
    <input type="hidden" name="roomID" value="<?php echo $roomID ?>">
    <button type="submit" class="btn btn-outline-success">Edit Details</button>
    </div></form>
<?php include 'view/footer.php'; ?>