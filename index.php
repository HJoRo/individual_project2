<?php 
require_once('model/database.php');
require_once('model/room_db.php');
require_once('model/plants_db.php');
$action = filter_input(INPUT_POST, 'action');
if ($action == NULL) {
    $action = filter_input(INPUT_GET, 'action');
    if ($action == NULL) {
        $action = 'view_all_rooms';
    }
}
//NEED TO GET DATE_ADDED COLUMN TO SHOW UP IN DETAILS ARRAY

switch($action) {
    case 'view_all_rooms':
        //TEST AREA TEST TEST
        global $db;
        $query = 'SELECT * FROM plants';
        $stm = $db->prepare($query);
        $result = $stm->execute();
        //get array of room data
        $rooms = get_rooms();
        include('view/list_rooms.php');
        break;
    case 'view_single_room':
        //input form data
        $roomID = filter_input(INPUT_POST, 'roomID');
        //functions to get room and plant data
        $roomName = get_room_name($roomID);
        $plants = get_plants_by_room($roomID);
        //display plants in room
        include('view/list_plants.php');
        break;
    case 'view_single_plant':
        //input form data
        $roomID = filter_input(INPUT_POST, 'roomID');
        $roomName = get_room_name($roomID);
        $plantID = filter_input(INPUT_POST, 'plantID');
        $plantName = filter_input(INPUT_POST, 'plantName');
        $dateAdded = filter_input(INPUT_POST, 'dateAdded');
        //functions to get data about care details
        $details = get_single_care_details($plantID);
        if (empty($details)) {
            $sunLevel = 'No entry found!';
            $waterLevel = 'No entry found!';
            $careNotes = 'No entry found!';
            $dateAdded = 'No entry found!';
            include('view/plant_detail.php');
            break;
        } elseif (!empty($details)) {
            $sunLevel = $details[0][2];
            $waterLevel = $details[0][3];
            $careNotes = $details[0][4];
            $dateAdded = 'No entry found!';
            include('view/plant_detail.php');
            break;
        }
        /* include('view/plant_detail.php');
        break; */
    case 'go_to_add_room_form':
        //get add room form
        include('view/add_room_form.php');
        break;
    case 'submit_add_room_form':
        $roomName = htmlspecialchars(filter_input(INPUT_POST, 'roomName', FILTER_SANITIZE_SPECIAL_CHARS));
        //room name can't be empty
        if($roomName == '') {
            $message = 'Please enter a name for the new room.';
            include('view/add_room_form.php');
            break;
        } //room name can't be a number
        else if(is_numeric($roomName)) {
            $message = 'Please enter a word or short phrase. No numbers!';
            include('view/add_room_form.php');
            break;
        } else {
            //add new room
            $roomID = add_new_room($roomName);
            //functions to get room and plant data
            $roomName = get_room_name($roomID);
            $plants = get_plants_by_room($roomID);
            include('view/list_plants.php');
            break;
        }
        
    case 'go_to_add_plant_form':
        $roomID = filter_input(INPUT_POST, 'roomID');
        $roomName = get_room_name($roomID);
        include('view/add_plant_form.php');
        break;
    case 'submit_add_plant_form':
        //input plant details and room id from form
        $plantName = htmlspecialchars(filter_input(INPUT_POST, 'plantName', FILTER_SANITIZE_SPECIAL_CHARS));
        $roomID = filter_input(INPUT_POST, 'roomID');
        $sunLevel = filter_input(INPUT_POST, 'sunLevel');
        $waterLevel = filter_input(INPUT_POST, 'waterLevel');
        $careNotes = filter_input(INPUT_POST, 'notes');
        if($plantName == '') {
            $message = 'Please enter a name for the new plant.';
            include('view/add_plant_form.php');
            break;
        } 
        $plantID = add_new_plant($plantName, $roomID);
        //if any care detail fields contain data, insert data into care_details table
        if(!empty($sunLevel || $waterLevel || $careNotes)) {
            //call function to add plant to db and return id of new row in plants table
            $careDetails = add_plant_details($plantID, $sunLevel, $waterLevel, $careNotes);
        } 
        //get data to display on plant detail page
        $roomName = get_room_name($roomID);
        //functions to get data about care details
        $details = get_single_care_details($plantID);
        if (empty($details)) {
            $sunLevel = 'No entry found!';
            $waterLevel = 'No entry found!';
            $careNotes = 'No entry found!';
            include('view/plant_detail.php');
            break;
        } elseif (!empty($details)) {
            $sunLevel = $details[0][2];
            $waterLevel = $details[0][3];
            $careNotes = $details[0][4];
            include('view/plant_detail.php');
            break;
        }
        //include('view/plant_detail.php');
        //break;
    case 'delete_plant':
        
        $roomID = filter_input(INPUT_POST, 'roomID');
        $plantID = filter_input(INPUT_POST, 'plantID');
        delete_plant($plantID);
        $roomName = get_room_name($roomID);
        $plants = get_plants_by_room($roomID);
        include('view/list_plants.php');
        break;
    case 'delete_room':
        $roomID = filter_input(INPUT_POST, 'roomID');
        $totals = total_plants($roomID);
        $count = $totals[0][0];
        if($count == 0) {
            delete_room($roomID);
            $rooms = get_rooms();
            include('view/list_rooms.php');
            break;
        } else {
            $message = 'Room must be empty before you can delete it.';
            $rooms = get_rooms();
            include('view/list_rooms.php');
            break;
        }
    case 'edit_plant_details':
        $plantID = filter_input(INPUT_POST, 'plantID');
        $roomID = filter_input(INPUT_POST, 'roomID');
        $roomName = get_room_name($roomID);
        $plant = get_single_plant($plantID);
        $plantName = $plant['plant_name'];
        $dateAdded = $plant['date_added'];
        $details = get_single_care_details($plantID);
        if(count($details) > 0) {
            $sunLevel = $details[0][2];
            $waterLevel = $details[0][3];
            $careNotes = $details[0][4];
            include('view/edit_plant_form.php');
            break;
        } else {
            $careNotes = '';
            include('view/edit_plant_form.php');
            break;
        }
    case 'edit_room':
        //TODO ADD EDIT ROOM NAME FUNCTIONALITY
        //THEN ADD STYLING THRU BOOTSTRAP
        $roomID = filter_input(INPUT_POST, 'roomID');
        $roomName = get_room_name($roomID);
        include('view/edit_room_form.php');
        break;
    case 'submit_edit_room_form':
        $roomID = filter_input(INPUT_POST, 'roomID');
        $roomName = htmlspecialchars(filter_input(INPUT_POST, 'roomName'));
        if($roomName == ''){
            $message = 'Room must have a name!';
            $roomName = get_room_name($roomID);
            include('view/edit_room_form.php');
            break;
        }
        
        //function to update room_name in db
        $update = update_room_name($roomID, $roomName);
        if($update == true){
            $message = 'Room name updated successfully!';
            $rooms = get_rooms();
            include('view/list_rooms.php');
            break;
        } else {
            $message = 'Room name could not be update. Please check your entry and try again.';
            $rooms = get_rooms();
            include('view/list_rooms.php');
            break;
        }
        
    case 'submit_edit_plant_form':
        //input form data
        $plantName = htmlspecialchars(filter_input(INPUT_POST, 'plantName'));
        $sunLevel = filter_input(INPUT_POST, 'sunLevel');
        $waterLevel = filter_input(INPUT_POST, 'waterLevel');
        $careNotes = filter_input(INPUT_POST, 'notes');
        $plantID = filter_input(INPUT_POST, 'plantID');
        $roomID = filter_input(INPUT_POST, 'roomID');
        //update plants and care_details tables
        $updatePlant = update_plant_name($plantID, $plantName);
        $updateDetails = update_plant_details($plantID, $sunLevel, $waterLevel, $careNotes);
        //get info to display after updating
        $roomName = get_room_name($roomID);
        $details = get_single_care_details($plantID);
        $plant = get_single_plant($plantID);
        $dateAdded = $plant['date_added'];
        if (empty($details)) {
            $sunLevel = 'No entry found!';
            $waterLevel = 'No entry found!';
            $careNotes = 'No entry found!';
            include('view/plant_detail.php');
            break;
        } elseif (!empty($details)) {
            $sunLevel = $details[0][2];
            $waterLevel = $details[0][3];
            $careNotes = $details[0][4];
            include('view/plant_detail.php');
            break;
        }
        //redirect if update successful
        if (($updatePlant == true) && ($updateDetails == true)){
            include('view/plant_detail.php');
            break;
            //if update unsuccessful display message
            } elseif(($updatePlant == false) || ($updateDetails == false)){
            $message = 'Plant could not be updated. Please check your entries and try again.';
            include('view/plant_detail.php');
            break;
        }
    default:
        include('errors/error.php');
        break;
}

?>