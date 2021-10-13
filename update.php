<?php
    include "config/connect.php";
    include "config/foo.php";
    $table = $_GET['table'];
    $id = array('id' => $_GET['id']);
    $updateQuery = selectOne($table, $id);
    $tableAttributes = showTableAttributes($table);
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Update</title>
  </head>
  <body>

    <div class="container">
        <h2>Edit <?= $table;?> table data</h2>
        <form action="app/update.php?table=<?= $table; ?>&id=<?= $id['id']; ?>" method="POST">
          <?php
            $i = 0;
            foreach ($tableAttributes as $key) {
              if ($key === 'description') {
                echo "<p>$tableAttributes[$i]</p>";
                echo "<textarea name='$key' rows='5' cols='50'>$updateQuery[$key]</textarea></br></br>";
                $i++;
                continue;
              };
              echo "<p>$tableAttributes[$i]</p>";
              echo "<input type='text' name='$key' value='$updateQuery[$key]'></br></br>";
              $i++;
            };
          ?>
          <button type='submit'>Update</button>
        </form>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

  </body>
</html>