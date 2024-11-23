<?php
  //api to return heatmap when month and year selected from the dropdown
  error_reporting(0);
  require 'functions.php';

  $assignedUsers = assignedUsers();
  $rid=1;
  while($row = mysqli_fetch_assoc($assignedUsers)){
    echo('<tr>');
    echo('<td>'.$rid.'</td>');
    echo('<td>'.$row['name'].'</td>');
    echo('<td>');
      $source = sourceByUser($row['id']);
      while($s_row = mysqli_fetch_assoc($source)){
        if(ifContributed($s_row['sid'], $_POST['month'], $_POST['year'])){
          echo('<span class="badge badge-pill badge-success m-b-5 m-r-5 hit">');
          echo($s_row['sname']);
          echo('</span>');
        }
        else{
          echo('<span class="badge badge-pill badge-danger m-b-5 m-r-5 miss">');
          echo($s_row['sname']);
          echo('</span>');
        }
      }
    echo('</td>');
    echo('</tr>');
    $rid++;
  }
?>
