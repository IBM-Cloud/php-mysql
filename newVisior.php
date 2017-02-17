<!--
/**
* Copyright 2015 IBM Corp. All Rights Reserved.
*
* Licensed under the Apache License, Version 2.0 (the “License”);
* you may not use this file except in compliance with the License.
* You may obtain a copy of the License at
*
* https://www.apache.org/licenses/LICENSE-2.0
*
* Unless required by applicable law or agreed to in writing, software
* distributed under the License is distributed on an “AS IS” BASIS,
* WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied.
* See the License for the specific language governing permissions and
* limitations under the License.
*/
->

<?php include 'db.php';?>
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") { //if new message is being added
    $inputJSON = file_get_contents('php://input');
    $input= json_decode( $inputJSON, TRUE ); //convert JSON into array

    $cleaned_message = preg_replace('/[^a-zA-Z0-9.\s]/', '', $input["name"]); //remove invalid chars from input.

    $strsq0 = "INSERT INTO MESSAGES_TABLE ( NAME) VALUES ('" . $cleaned_message . "');"; //query to insert new message
    if ($mysqli->query($strsq0)) {
        echo "Hello " . $input["name"] . "! I've added you to the database.";
    } else {
        echo "Hello " . $input["name"] . "!";
    }
}
?>
