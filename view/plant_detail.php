<?php include 'view/header.php'; ?>
<h2><?php echo ucfirst($plantName); ?> Details</h2>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<div class="container-sm">
<table class="table table-striped">
    <thead><tr>
        <td>Room: </td>
        <td><?php echo ucfirst($roomName); ?></td>
    </tr></thead>
    <tr>
        <td>Date Added: </td>
        <td><?php echo $dateAdded ; ?></td>
    </tr>
    <tr>
        <td>Sunlight Level: </td>
        <td><?php echo ucfirst($sunLevel); ?></td>
    </tr>
    <tr>
        <td>Water Level: </td>
        <td><?php echo ucfirst($waterLevel); ?></td>
    </tr>
    <tr>
        <td>Notes: </td>
        <td><?php echo $careNotes; ?></td>
    </tr>
</table>
    <form action="." method="POST" id="edit_single_plant_form">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="plantID" value="<?php echo $plantID; ?>">
            <input type="hidden" name="dateAdded" value="<?php echo $dateAdded; ?>">
            <input type="hidden" name="action" value="edit_plant_details">
            <button type="submit" class="btn btn-outline-success">Edit Details</button>
    </form>
    </div>
<?php include 'view/footer.php'; ?>