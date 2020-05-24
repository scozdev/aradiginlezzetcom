<?php 
session_start();

session_destroy();
header("Location:../index?durum=exit");

 ?>