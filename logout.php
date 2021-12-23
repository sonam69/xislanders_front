<?php
include_once($_SERVER['DOCUMENT_ROOT'] . "/../external/header.php");
sessionStart();
session_destroy();
header('location: index.php');