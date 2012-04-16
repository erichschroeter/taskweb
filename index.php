<html>
<head>
  <title>Erich's Tasks</title>

  <link rel="stylesheet" href="css/reset.css">
  <link rel="stylesheet" href="css/960.css">
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
<!-- Grab Google CDN's jQuery, with a protocol relative URL; fall back to local if offline -->
<script src="//ajax.googleapis.com/ajax/libs/jquery/1.7.2/jquery.min.js"></script>
<script>window.jQuery || document.write('<script src="js/vendor/jquery-1.7.2.min.js"><\/script>')</script>

<!-- Tasks customizations -->
<script src="js/tasks.js"></script>
<script>
  $('.task').task();
</script>
</body>
</html>
