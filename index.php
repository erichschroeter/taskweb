<html>
<head>
  <title>Erich's Tasks</title>

  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/tasks.css">
</head>
<body>
<?php
$r = null;
if (file_exists("tasks.json")) {
    include 'JSONRenderer.php';
    $f = @fopen("tasks.json", "r");
    $r = new JSONRenderer($f);
} else if (file_exists("tasks.csv")) {
    include 'CSVRenderer.php';
    $f = @fopen("tasks.csv", "r");
    $r = new CSVRenderer($f);
}

if ($r) {
    $r->render();
} else {
    echo "No tasks file found";
}

?>
</body>
</html>
