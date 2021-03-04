<?php
session_start();
require_once 'functions.php';
logout();
$path = 'page_login.php';
redirect_to($path);