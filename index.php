<?php
require('scripts/conn.php');
?>
<!DOCTYPE html>
<html lang="en">
<head>

  <!-- Basic Page Needs
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta charset="utf-8">
  <title>ABSA Tracker</title>
  <meta name="description" content="">
  <meta name="author" content="">

  <!-- Mobile Specific Metas
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- FONT
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link href="//fonts.googleapis.com/css?family=Raleway:400,300,600" rel="stylesheet" type="text/css">

  <!-- CSS
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="stylesheet" href="css/normalize.css">
  <link rel="stylesheet" href="css/skeleton.css">
  <link rel="stylesheet" href="css/layout.css">

  <!-- Favicon
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <link rel="icon" type="image/png" href="images/favicon.png">

</head>
<body>

  <!-- Primary Page Layout
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
  <div class="container">
    <div class="row">
      <div class="one-half column" style="margin-top: 5%">
        <h2>Al-Barrak Container Tracking Application</h2>
        <h5>BL Number Search</h5>
        <p>Please enter the BL Number Here</p>
          <form action="#" method="post">
              <div class="row">
                  <div class="six columns">
                      <label for="exampleEmailInput">BL Number</label>
                      <input type="text" name="bl_number" class="u-full-width" placeholder="0" id="exampleEmailInput">
                  </div>
<!--                  <div class="six columns">-->
<!--                      <label for="exampleRecipientInput">DB Table</label>-->
<!--                      <select class="u-full-width" name="selectedTable" id="exampleRecipientInput">-->
<!--                          <option value="SHP_T_BL_HDR">HDR</option>-->
<!--                          <option value="SHP_T_BL_CNTR">CNTR</option>-->
<!--                      </select>-->
<!--                  </div>-->
              </div>
              <input class="blueBleed" type="submit" value="Submit">
          </form>
          <h5>Your Details</h5>
          <p>Your Data will pop here</p>
          <?php
              echo "<table class='u-full-width' border='0'>\n";
              echo "<thead> <tr> <th>BL NUMBER</th> <th>BLN ID</th> <th>CNTR NUM</th> </tr> </thead>\n";
              while ($row = oci_fetch_array($sqlParse, OCI_ASSOC+OCI_RETURN_NULLS)) {
                  echo "<tr>\n";
                  foreach ($row as $item) {
                      echo "    <td>" . ($item !== null ? htmlentities($item, ENT_QUOTES) : "&nbsp;") . "</td>\n";
                  }
                  echo "</tr>\n";
              }
              echo "</table>\n";
          ?>
      </div>
    </div>
  </div>

<!-- End Document
  –––––––––––––––––––––––––––––––––––––––––––––––––– -->
</body>
</html>
