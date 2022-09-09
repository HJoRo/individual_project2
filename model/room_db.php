<?php 
function get_rooms() {
    global $db;
    $query = 'SELECT * FROM rooms 
              ORDER BY room_id';
    try {
        $statement = $db->prepare($query);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function total_plants($roomID) {
    global $db;
    $query = 'SELECT count(*) FROM plants 
    WHERE room_id = :roomID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':roomID', $roomID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_room_name($roomID) {
    global $db;
    $query = 'SELECT room_name FROM rooms WHERE room_id = :roomID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':roomID', $roomID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        $roomName = $result[0][0];
        return $roomName;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function add_new_room($roomName) {
    global $db;
    $query = 'INSERT INTO rooms (room_id, room_name) 
    VALUES (default, :roomName)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':roomName', $roomName);
        $statement->execute();
        $statement->closeCursor();
        // Get the last room ID that was automatically generated
        $roomID = $db->lastInsertId();
        return $roomID;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function delete_room($roomID){
    global $db;
    $query = 'DELETE FROM rooms where room_id = :roomID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':roomID', $roomID);
        $statement->execute();
        $statement->closeCursor();
        return $roomID;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function update_room_name($roomID, $roomName){
    global $db;
    $query = 'UPDATE rooms SET room_name = :roomName WHERE room_id = :roomID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':roomID', $roomID);
        $statement->bindValue(':roomName', $roomName);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}