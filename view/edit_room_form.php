<?php include 'view/header.php'; ?>
<h2>Edit Room Name</h2>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<form action="." method="POST">
    <label>Room Name:</label>
        <input type="text" name="roomName" value="<?php echo ucfirst($roomName); ?>">
        <br>
    <input type="hidden" name="action" value="submit_edit_room_form">
    <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
    <button type="submit" class="btn btn-outline-primary">Edit Room</button>
</form>
<?php include 'view/footer.php'; ?>