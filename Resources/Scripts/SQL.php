<?php
    // This page contains functions pertaining to SQL Queries

    // Function for connecting to the Server
    function connectToServer(){ 
        // Returns TRUE if successful, FALSE if not 
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"]  // The Host Password
        );
    }
    
    // Function for connecting to the Database
    function connectToDatabase(){ 
        // Returns TRUE if successful, FALSE if not 
        return mysqli_connect(
            settings["server"]["host"],     // The Host Name
            settings["server"]["user"],     // The Host username
            settings["server"]["password"], // The Host Password
            settings['server']["database"]  // The Host Database
        );
    }

    // Function for connecting to the database
    function checkConnection(){
        if (connectToServer()){   
            // If the connection to the server is good, check for the database
            if (connectToDatabase()){
                return TRUE;
            } else {
                return "sql_db";
            }
        } else {
            return "sql_server";
        }
    }

    // Function for running queries and directly returning results
    function runQuery($query){
        // Picking the correct query for when the database exists
        if (checkConnection() === TRUE){
            $fetched = connectToDatabase() -> query($query);
        } else {
            $fetched = connectToServer() -> query($query);
        }
        
        // Outputting a boolean or associative array when necessary
        if (is_bool($fetched)){
            $result = $fetched;
        } else {
            $result = mysqli_fetch_all($fetched, MYSQLI_ASSOC);
        }
        return $result;
    }
?>