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

    <script src="assets/js/script.js"></script>

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
                continue;
              };
              if ($key === 'id_author') { 
                $id_a = ['id' => $_GET['id_author']];
                $author = selectOne('authors', $id_a);
              ?>
                <p>id_author</p>
                <input type="hidden" id="id_author" name="id_author" value="<?= $_GET['id_author'];?>">
                <select onchange="show(event.target, 'id_author')">
                  <?php
                    $authors = selectAll('authors');
                    foreach ($authors as $author) { 
                      if ($author[0] === $_GET['id_author'])
                      {
                        echo "<option selected value=" . $author[0] . ">$author[1]</option>";
                        continue;
                      }
                  ?>
                  <option value="<?= $author[0];?>"><?= $author[1];?></option>
                  <?php  } ?>
                </select>
              <?php 
                continue;
              };
              if ($key === 'id_genre') {
              ?>
                <p>id_genre</p>
                <input type="hidden" id="id_genre" name="id_genre" value="<?= $_GET['id_genre'];?>">
                <select onchange="show(event.target, 'id_genre')">
                  <?php
                    $genres = selectAll('genre');
                    foreach ($genres as $genre) { 
                      if ($genre[0] === $_GET['id_genre'])
                      {
                        echo "<option selected value=" . $genre[0] . ">$genre[1]</option>";
                        continue;
                      }
                  ?>
                  <option value="<?= $genre[0];?>"><?= $genre[1];?></option>
                  <?php  } ?>
                </select>
              <?php
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