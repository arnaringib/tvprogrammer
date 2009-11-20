<?php 
session_start();
include('functions.php');

        
        for($i = 0; $i != 7; $i++){
               // if(strlen($_GET[date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$i, date('Y')))]) != 0){
                	addToCalender($_GET['date'],$_GET[date('Y-m-d', mktime(0, 0, 0, date('m'), date('d')+$i, date('Y')))],$_SESSION['calender'],$_GET['cal']);
                //}
        }
?>