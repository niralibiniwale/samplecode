<?php
  session_start();
  session_regenerate_id(true);
  
  $host = 'localhost';
  $username = 'root';
  $password = 'root';
  $dbname = 'sample_admin';

  $conn = new mysqli($host, $username, $password,$dbname);
?>