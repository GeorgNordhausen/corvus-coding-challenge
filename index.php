<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <title></title>

    <link rel="stylesheet" type="text/css" href="js/themes/blue/style.css" />

    <script type="text/javascript" src="https://code.jquery.com/jquery-1.12.4.min.js"></script>
    <script type="text/javascript" src="js/jquery.tablesorter.js"></script>

    <script type="text/javascript">
    $(document).ready(function()
      {
          $("#logtable").tablesorter();

          $("#filterInput").keyup(function () {
          //split the current value of searchInput
          var data = this.value.split(" ");
          //create a jquery object of the rows
          var tableRows = $("tbody").find("tr");
          if (this.value == "") {
              tableRows.show();
              return;
          }
          //hide all rows
          tableRows.hide();

          //Recusively filter the jquery object to get results.
          tableRows.filter(function (i, v) {
              var $t = $(this);
              for (var d = 0; d < data.length; ++d) {
                  console.log($t.innerHTML);
                  if ($t.is(":contains('" + data[d] + "')")) {
                      return true;
                  }
              }
              return false;
          })
          //show the rows that match.
          .show();
        }).focus(function () {
              this.value = "";
              $(this).unbind('focus');
          });




          // geolocation

          $.getJSON('https://ipapi.co/217.92.141.212/json', function(data){
            console.log(data.country)
          })
      }
    );
    </script>
  </head>
  <body>
    <input id="filterInput" value="Type To Filter">
    <table id="logtable" class="tablesorter">
<thead>
    <th>Adresse</th>
    <th>Server Name</th>
    <th>User</th>
    <th>Datum</th>
    <th>Zeitstempel</th>
    <th>UTC</th>
    <th>Request Type</th>
    <th>Request</th>
    <th>HTTP Version</th>
    <th>Statuscode</th>
    <th>Bytes send</th>
    <th>Referer</th>
    <th>User Agent</th>
</thead>

      <tbody>
    <?php
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

      $fh = fopen('http://localhost/corvus-challenge/nginx-access.log','r');
      while ($line = fgets($fh)) {
        print '<tr>';

         $regex = '/^(\S+) (\S+) (\S+) \[([^:]+):(\d+:\d+:\d+) ([^\]]+)\] \"(\S+) (.*?) (\S+)\" (\S+) (\S+) "([^"]*)" "([^"]*)"$/';
         preg_match($regex ,$line, $matches);

         for ($i=1; $i < 14; $i++) {
             echo('<td>'.$matches[$i].'</td>');
         }
         print '</tr>';
      }
      fclose($fh);
     ?>
   </tbody>
   </table>
  </body>
</html>
