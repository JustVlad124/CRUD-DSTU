<?php
    include "config/connect.php";
    include "config/foo.php";

    $table = 'genre';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Genre table</title>
  </head>
  <body>

    <?= include "app/include/header.php"; ?>

    
    <div class="container">
      <h1>Genre</h1>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Genre</th>
          </tr>
        </thead>
        <tbody>
          <?php
              $genres = selectAll($table);
              foreach ($genres as $genre)
              {
          ?>

            <tr>
                <td><?= $genre['id']; ?></th>
                <td><?= $genre['genre']; ?></td>
                <td><a href="update.php?table=<?= $table; ?>&id=<?= $genre[0]; ?>">Edit</a></td>
                <td><a style="color: red" href="app/delete.php?table=<?= $table; ?>&id=<?= $genre[0]; ?>">Delete</a></td>
            </tr>

          <?php
              };
          ?>
          
          
        </tbody>
      </table>

      <div class="row justify-content-center">
        <div class="col-8">
          <h2>Add new author in the table</h2>
          <form action="app/create.php?table=<?= $table; ?>" method="POST">
            <p>Genre name</p>
            <input type='text' name='name' size="30"></br></br>
            <button type='submit'>Add new genre</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <?= include "app/include/footer.php"; ?>
  </body>
</html>