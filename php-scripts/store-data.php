<?php
// This will be the backbone of the app, as it is where the inforamtion is saved and sotred.
// So, first of all: let's check whether the necessary information is present:

if (!empty($_REQUEST["root"]) && !empty($_REQUEST["action"])) {
    // Possible actions for the data storing:
    // [1] Creating a new board
    // [2] Updating a board with new information
    // [3] Adding new components to a board
    $root = $_REQUEST["root"];
    $action = $_REQUEST["action"];

    // 1
    if ($action == "create") {
        // The structure of the information is as follows:
        // root is the representation of the new main board being created, which means
        // it has the name, size of the board, background information
        if (!empty($root["name"]) && !empty($root["size"]) && !empty($root["bg"]) && !empty($root["bg"]["type"])) {
            $name = $root["name"];
            mkdir("../db/$name/", 0777, true);
            $json_file = fopen("../db/$name/main.json", "w"); // remove one ../ and put the php-script folder out of the www/htdocs folder
            fwrite($json_file, json_encode($root, JSON_PRETTY_PRINT));
            fclose($json_file);
        } else error_log("Parameters are missing");
    } else error_log("Unrecognised action.");
} else error_log("No root or action defined.");
?>
