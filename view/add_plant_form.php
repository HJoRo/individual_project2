<?php include 'view/header.php'; ?>

<h2>Add New Plant</h2>
<div class="message">
    <p><?php if(isset($message)){ echo htmlspecialchars($message); } ?></p>
</div>
<form action="." method="POST">
    <lable>In Room: <?php echo ucfirst($roomName); ?></lable> 
    <br>
    <label>Plant Name:</label>
        <input type="text" name="plantName" required>
        <br>
    <label for="sun">Sunlight Level: </label>
        <select id="sun" name="sunLevel" >
            <option value="LOW">Low</option>
            <option value="MEDIUM">Medium</option>
            <option value="HIGH">High</option>
        </select>
        <br>
    <label for="water">Water Level: </label>
        <select id="water" name="waterLevel" >
            <option value="LOW">Low</option>
            <option value="MEDIUM">Medium</option>
            <option value="HIGH">High</option>
        </select>
        <br>
    <label for="notes">Care Notes: </label>
        <input name="notes" type="text"><br>
        <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
    <input type="hidden" name="action" value="submit_add_plant_form">
    <button type="submit" class="btn btn-outline-primary">Add Plant</button>
</form>
<?php include 'view/footer.php'; ?>