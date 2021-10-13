<?php
    include "config/connect.php";
    include "config/foo.php";

    $table = 'authors';
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Authors table</title>
  </head>
  <body>

    <?= include "app/include/header.php"; ?>
    
    <div class="container">
      <h1>Authors</h1>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Author name</th>
            <th>Date of birth</th>
            <th>Date of death</th>
            <!-- <th scope="col">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
              $authors = selectAll($table);
              foreach ($authors as $author)
              {
          ?>

            <tr>
                <td><?= $author['id']; ?></th>
                <td><?= $author['name']; ?></td>
                <td><?= $author['date_of_birth']; ?></td>
                <td><?= $author['date_of_death']; ?></td>
                <td><a href="update.php?table=<?= $table; ?>&id=<?= $author[0]; ?>">Edit</a></td>
                <td><a style="color: red" href="app/delete.php?table=<?= $table; ?>&id=<?= $author[0]; ?>">Delete</a></td>
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
            <p>Author name</p>
            <input type='text' name='name' size="30"></br></br>
            <p>Date of birth</p>
            <input type='text' name='birth' size="30"></br></br>
            <p>Date of death</p>
            <input type='text' name='death' size="30"></br></br>
            <button type='submit'>Add new author</button>
          </form>
        </div>
      </div>
    </div>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <?= include "app/include/footer.php"; ?>
  </body>
</html>