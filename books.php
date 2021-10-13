<?php
    include "config/connect.php";
    include "config/foo.php";

    $table = 'books';

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

    <title>Books table</title>
  </head>
  <body>

    <?= include "app/include/header.php"; ?>

    
    <div class="container">
      <h1>Books</h1>
      <table class="table table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Book title</th>
            <th>Date writing</th>
            <th>Description</th>
            <th>Author ID</th>
            <th>Genre ID</th>
            <!-- <th scope="col">Action</th> -->
          </tr>
        </thead>
        <tbody>
          <?php
              $books = selectAll($table);
              foreach ($books as $book)
              {
          ?>

            <tr>
                <td><?= $book['id']; ?></th>
                <td><?= $book['title']; ?></td>
                <td><?= $book['date_writing']; ?></td>
                <td><?= $book['description']; ?></td>
                <td><?= $book['id_author']; ?></td>
                <td><?= $book['id_genre']; ?></td>
                <td><a href="update.php?table=<?= $table; ?>&id=<?= $book[0]; ?>">Edit</a></td>
                <td><a style="color: red" href="app/delete.php?table=<?= $table; ?>&id=<?= $book[0]; ?>">Delete</a></td>
            </tr>

          <?php
              };
          ?>
          
          
        </tbody>
      </table>
      <div class="row justify-content-center">
        <div class="col-8">
          <h2>Add new author in the table</h2>
          <form action="app/create.php?table=<?= $table;?>" method="POST">
            <p>Book title</p>
            <input type='text' name='title' size="30"></br></br>
            <p>Date writing</p>
            <input type='text' name='date_writing' size="30"></br></br>
            <p>Description</p>
            <input type='text' name='description' size="30"></br></br>

            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">ID автора</label>
              <input type='text' id='id_author' name='id_author' size="30" readonly></br></br>
              <select onchange="show(event.target, 'id_author')" class="form-select" id="inputGroupSelect01">
                <?php
                  $authors = selectAll('authors');
                  foreach ($authors as $author) { 
                ?>
                  <option value="<?= $author[0]; ?>"><?= $author[1];?></option>
                <?php  } ?>
              </select>
            </div>

            <div class="input-group mb-3">
              <label class="input-group-text" for="inputGroupSelect01">ID жанра</label>
              <input type='text' id='id_genre' name='id_genre' size="30" readonly></br></br>
              <select onchange="show(event.target, 'id_genre')" class="form-select" id="inputGroupSelect01">
                <?php
                  $genres = selectAll('genre');
                  foreach ($genres as $genre) { 
                ?>
                <option value="<?= $genre[0];?>"><?= $genre[1];?></option>
                <?php  } ?>
              </select>
            </div>
            <button type='submit'>Add new book</button></br></br>
          </form>
        </div>
      </div>
    </div>


    <?= include "app/include/footer.php"; ?>
  </body>
</html>