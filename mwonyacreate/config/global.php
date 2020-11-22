<?php
session_start();
$artistname = $_SESSION['name'] ?? '';
$artistid = $_SESSION["id"] ?? '';
$contenttag = $_SESSION["tag"] ?? '';