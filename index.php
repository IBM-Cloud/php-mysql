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

//Query the DB for messages
$strsql = "select * from VISITORS_TABLE ORDER BY ID DESC limit 100";
if ($result = $mysqli->query($strsql)) {
   // printf("<br>Select returned %d rows.\n", $result->num_rows);
} else {
        //Could be many reasons, but most likely the table isn't created yet. init.php will create the table.
//        echo "<b>Can't query the database, did you <a href = init.php>Create the table</a> yet?</b>";
    }
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Hello World</title>

    <!-- Bootstrap -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
    <link href="styles.css" rel="stylesheet">
</head>

<body>
    <div class="container">
        <h1>Welcome.</h1>
        <div id="nameInput" class="input-group-lg center-block helloInput">
            <p class="lead">What is your name?</p>
            <input id="user_name" type="text" class="form-control" placeholder="name" aria-describedby="sizing-addon1" value="" />
        </div>
        <p id="response" class="lead text-center"></p>

        <p id="databaseNames" class="lead text-center">
          <?php
              if($result){
                mysqli_data_seek ( $result, 0 );
                if($result->num_rows == 0){ //nothing in the table
                }

                while ( $row = mysqli_fetch_row ( $result ) ) {
                        echo '<li>' . "$row[2]" . '</li>';
                }

                $result->close();

              }
          ?>
        </p>
    </div>
    <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    <script>
    	//Submit data when enter key is pressed
        $('#user_name').keydown(function(e) {
        	var name = $('#user_name').val();
            if (e.which == 13 && name.length > 0) { //catch Enter key
            	//POST request to API to create a new visitor entry in the database
                $.ajax({
				  method: "POST",
				  url: "./newVisior.php",
				  contentType: "application/json",
				  data: JSON.stringify({name: name })
				})
                .done(function(data) {
                    $('#response').html(data);
                    $('#nameInput').hide();
                });
            }
        });



    </script>
</body>

</html>
