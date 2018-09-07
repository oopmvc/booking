<?php
if(isset($_POST["Export"])){

     header('Content-Type: text/csv; charset=utf-8');
     header('Content-Disposition: attachment; filename=data.csv');
     $output = fopen("php://output", "w");
     fputcsv($output, array('ID', 'Username', 'First Name', 'Last Name', 'Email', 'Phone'));
     $query = "SELECT * FROM members ORDER BY email";
     $result = mysqli_query($con, $query);
     while($row = mysqli_fetch_assoc($result)) {
          fputcsv($output, $row);
     }
     fclose($output);
}
?>
