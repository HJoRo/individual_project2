<?php include 'view/header.php'; ?>
<h2>Add New Room</h2>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<form action="." method="POST">
    <label>Room Name:</label>
        <input type="text" name="roomName" >
        <br>
    <input type="hidden" name="action" value="submit_add_room_form">
    <button type="submit" class="btn btn-outline-primary">Add Room</button>
</form>
<?php include 'view/footer.php'; ?>