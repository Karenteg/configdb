<?php

function connectDB() {
  $con = mysqli_connect("localhost","nicolas","nicolas","configDB");

  if (mysqli_connect_errno()) {
    echo "Could not connect: ". mysqli_connect_error() ;
  }
  else {
    return $con;
  }
}

function queryDB($con,$query) {
  $result=mysqli_query($con,$query);
  if ( !$result) {
    echo "<span class='error'>Failed to Query the Database:<br>";
    echo mysqli_error($con);
    echo "</span>";
    return false;
  }
  else {
    return $result;
  }
}

function select2table1column($con,$query) {
  $result=queryDB($con,$query);
  if ( $result) {
    echo "<table>";
    $row=mysqli_fetch_array($result);
    for ($i=0;$i<4;$i++) {
      if (( $i % 2 ) == 0) {
        $fmt="odd";
      }
      else {
        $fmt="even";
      }
      $title=mysqli_fetch_field($result);
      echo "<tr class='".$fmt."'><td class='title'>".$title->name."</td><td class='value'>".$row[$i]."</td></tr>";
    }
    echo "</table>";
  }
}

function select2table($con,$query,$callback) {
  $result=queryDB($con,$query);
  if ( $result) {
    echo "<table>";
    $i=0;
    while ($row=mysqli_fetch_array($result)) {
      $i++;
      if (( $i % 2 ) == 0) {
        $fmt="odd";
      }
      else {
        $fmt="even";
      }
      echo "<tr><td ondblclick='javascript:${callback}(\"$row[0]\")' 
      style='cursor: pointer' class='".$fmt."'>
      <label><input class='CheckBox' name='$row[0]' 
      onclick='javascript:updtCheckboxes(this)' 
      type='checkbox'>".$row[0]."</label></td></tr>";
    }
    echo "</table>";
    if ( $i == 0 ) {
      echo "<span class='error'>Query:<br>".$query."<br>returns NO DATA</span>";
    }
  }
}

function addRecord($con,$query) {
  return queryDB($con,$query);
}
?>
