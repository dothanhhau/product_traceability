<?php 
    $conn = mysqli_connect("localhost", "root", "", "dbNguoidung") or die("Connect failed!");
    mysqli_query($conn, "SET NAMES 'utf-8'");
    
    function replace($input) {
		$output = str_replace("'","''",$input);
        return $output;
    }
?>