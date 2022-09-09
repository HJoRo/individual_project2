<?php /* 
require_once('model/database.php');
require_once('model/room_db.php'); */
include 'view/header.php'; ?>

<h2>Rooms</h2>
<div class="message">
    <p><?php if(isset($message)){ echo $message; } ?></p>
</div>
<div class="container-md"><table class="table table-striped">
    <thead><tr>
        <th>Room Name</th>
        <th>Total Plants</th>
        <th></th>
        <th></th>
    </tr></thead>
    <?php foreach ($rooms as $room) :
        $roomName = ucfirst($room['room_name']);
        $roomID = $room['room_id'];
        $totals = total_plants($roomID);
        $count = $totals[0][0];
    ?>
    <tr>
        <td><?php echo $roomName ?></td>
        <td><?php echo $count ?></td>
        <td><form action="." method="POST" id="view_room_form">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="action" value="view_single_room">
            <button type="submit" class="btn btn-outline-primary">View Room</button>
        </form></td>
        <td><form action="." method="POST">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="action" value="edit_room">
            <button type="submit" class="btn btn-outline-primary">Rename</button>
            </form>
        </td>
        <td><form action="." method="POST">
            <input type="hidden" name="roomID" value="<?php echo $roomID; ?>">
            <input type="hidden" name="action" value="delete_room">
            <button type="submit" class="btn btn-outline-primary">Delete</button>
            </form>
        </td>
    </tr>
    <?php endforeach; ?>
</table>
<form action="." method="POST">
    <input type="hidden" name="action" value="go_to_add_room_form">
    <button type="submit" class="btn btn-outline-primary">Add Room</button>
</form></div>
<?php include 'view/footer.php'; ?>