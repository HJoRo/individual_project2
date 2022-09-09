<?php
function get_plants_by_room($roomID) {
    global $db;
    $query = 'SELECT * FROM plants WHERE room_id = :roomID order by plant_name';
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
function get_single_plant($plantID) {
    global $db;
    $query = 'SELECT * FROM plants WHERE plant_id = :plantID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        $statement->execute();
        $result = $statement->fetch();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function get_single_care_details($plantID){
    global $db;
    $query = 'SELECT * FROM care_details WHERE plant_id = :plantID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        $statement->execute();
        $result = $statement->fetchAll();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function add_new_plant($plantName, $roomID) {
    global $db;
    $query = 'INSERT INTO plants (plant_id, plant_name, room_id)
    VALUES (default, :plantName, :roomID)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantName', $plantName);
        $statement->bindValue(':roomID', $roomID);
        $statement->execute();
        $statement->closeCursor();
        // Get the last plant ID that was automatically generated
        $plantID = $db->lastInsertId();
        return $plantID;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function add_plant_details($plantID, $sunLevel, $waterLevel, $careNotes){
    global $db;
    $query = 'INSERT INTO care_details (care_id, plant_id, sun_level, water_level, notes) 
    VALUES (default, :plantID, :sunLevel, :waterLevel, :careNotes)';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        $statement->bindValue(':sunLevel', $sunLevel);
        $statement->bindValue(':waterLevel', $waterLevel);
        $statement->bindValue(':careNotes', $careNotes);
        $statement->execute();
        $statement->closeCursor();
        // Get the last plant ID that was automatically generated
        $detailsID = $db->lastInsertId();
        return $detailsID;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function delete_plant($plantID) {
    global $db;
    $query = 'delete from care_details where plant_id = :plantID; 
    delete from plants where plant_id = :plantID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        $statement->execute();
        $statement->closeCursor();
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function update_plant_name($plantID, $plantName) {
    global $db;
    $query = 'UPDATE plants SET plant_name = "'.$plantName.'" where plant_id = :plantID '; 
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        //$statement->bindValue(':plantName', $plantName);
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}
function update_plant_details($plantID, $sunLevel, $waterLevel, $careNotes,) {
    global $db;
    $query = 'UPDATE care_details SET sun_level = "'.$sunLevel.'", water_level = "'.$waterLevel.'", notes = "'.$careNotes.'" WHERE plant_id = :plantID';
    try {
        $statement = $db->prepare($query);
        $statement->bindValue(':plantID', $plantID);
        /* $statement->bindValue(':sunLevel', $sunLevel);
        $statement->bindValue(':waterLevel', $waterLevel);
        $statement->bindValue(':careNotes', $careNotes); */
        $result = $statement->execute();
        $statement->closeCursor();
        return $result;
    } catch (PDOException $e) {
        display_db_error($e->getMessage());
    }
}