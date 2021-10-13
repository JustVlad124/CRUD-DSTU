<?php
    include "../config/connect.php";
    include "../config/foo.php";

    $table = 'books';
    $sortAttr = $_POST['order'];
    $sortMode = $_POST['flexRadioDefault'];

    $params = [
        'id' => $_POST['id'],
        'title' => $_POST['title'],
        'date_writing' => $_POST['date_writing'],
        'description' => $_POST['description'],
        'id_author' => $_POST['id_author'],
        'id_genre' => $_POST['id_genre']
    ];

    $operators = [
        'id' => $_POST['id_operator'],
        'title' => $_POST['title_operator'],
        'date_writing' => $_POST['date_writing_operator'],
        'description' => $_POST['description_operator'],
        'id_author' => $_POST['id_author_operator'],
        'id_genre' => $_POST['id_genre_operator']
    ];

    $books = queryBooks($params, $operators, $sortAttr, $sortMode); 

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Query result</title>
  </head>
  <body style="min-height: 600px">

    
    <div class="container">
      <H1 class="m-3">Результат запроса</H1>
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
          </tr>

          <?php
            };
          ?>
          
        </tbody>
      </table>
      <a href="../query.php" class="btn btn-primary stretched-link">Вернуться к конструктору запросов</a>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

  </body>
</html>