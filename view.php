<?php
require "./guard.php";
$filename = htmlspecialchars($_GET['name']);
$file = "/var/simplefileserver/$user/$filename";
// We display different file types differently. Find out the
// type and make a decision here
switch(pathinfo($file, PATHINFO_EXTENSION)) {
  case "txt":
    $filetype = "text";
    break;
  case "gif":
    $filetype = "image";
    break;
  case "mp3":
    $filetype = "audio";
    break;
  case "csv":
    $filetype = "csv";
    $fin = fopen($file, "r");
    $rows = array();
    $row = fgetcsv($fin);
    while($row != FALSE) {
      $rows[] = $row;
      $row = fgetcsv($fin);
    }
    fclose($fin);
    break;
  default:
    $filetype = "unknown";
}
?>
<!DOCTYPE html>
<html>
  <?php require "./header.php" ?>
<body>
<h1 class="view"> Here is what we found: </h1>
<div class="border">
  <?php if ($filetype == "text") { ?>
    <pre><?php echo htmlspecialchars(file_get_contents($file)); ?></pre>
  <?php } elseif($filetype == "image") { ?>
      <img src="image.php?name=<?php echo $filename ?>" />
  <?php } elseif($filetype == "audio") { ?>
        <audio controls>
          <source src="<?php echo "./audio.php?name=$filename" ?>" type="audio/mp3">
        </audio>
  <?php } elseif($filetype == "csv") { ?>
        <table>
          <?php
          foreach($rows as $row) {
            echo "<tr>";
            foreach($row as $col) {
              $val = htmlspecialchars($col);
              echo "<td>$val</td>";
            }
            echo "</tr>";
        }?>
        </table>
  <?php } else { ?>
    <p>Sorry, we cannot open this type of file.</p>
  <?php }
  ?>
  </div>
  </body>
</html>
