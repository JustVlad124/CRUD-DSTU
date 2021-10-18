<?php
    include "config/connect.php";
    include "config/foo.php";
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-uWxY/CJNBR+1zjPWmfnSnVxwRheevXITnMqoEIeG1LJrdI0GlVs/9cVSyPYXdcSF" crossorigin="anonymous">

    <title>Query page</title>

    <script src="assets/js/script.js"></script>

  </head>
  <body>

    <?= include "app/include/header.php"; ?>

    <div class="container">
      <h1>Query</h1>
      <form action="app/result.php" method="post">
        <table class="table table-hover">
          <thead>
            <tr>
              <th>Столбец</th>
              <th>Тип</th>
              <th>Оператор</th>
              <th>Значение</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>id</td>
              <td>INT</td>
              <td>
                <select onchange="show(event.target, 'id_operator')" class="form-select" id="id_select">
                  <option selected value="=">=</option>
                  <option value="!=">!=</option>
                  <option value=">">></option>
                  <option value=">=">>=</option>
                  <option value="<"><</option>
                  <option value="<="><=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                </select>
                <input type="hidden" name="id_operator" id="id_operator" value="=">
              </td>
              <td><input name="id"></td>
            </tr>
            <tr>
              <td>title</td>
              <td>VARCHAR(50)</td>
              <td>
                <select onchange="show(event.target, 'title_operator')" class="form-select" id="title_select">
                  <option value="LIKE" selected>LIKE</option>
                  <option value="NOT LIKE">NOT LIKE</option>
                  <option value="=">=</option>
                  <option value="!=">!=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                  <option value="IS NULL">IS NULL</option>
                  <option value="IS NOT NULL">IS NOT NULL</option>
                </select>
                <input type="hidden" name="title_operator" id="title_operator" value="LIKE">
              </td>
              <td><input name="title"></td>
            </tr>
            <tr>
              <td>date_writing</td>
              <td>CHAR(4)</td>
              <td>
                <select onchange="show(event.target, 'date_writing_operator')" class="form-select" id="date_writing_select">
                  <option value="LIKE" selected>LIKE</option>
                  <option value="NOT LIKE">NOT LIKE</option>
                  <option value="=">=</option>
                  <option value="!=">!=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                  <option value="IS NULL">IS NULL</option>
                  <option value="IS NOT NULL">IS NOT NULL</option>
                </select>
                <input type="hidden" name="date_writing_operator" id="date_writing_operator" value="LIKE">
              </td>
              <td><input name="date_writing"></td>
            </tr>
            <tr>
              <td>description</td>
              <td>VARCHAR(255)</td>
              <td>
                <select onchange="show(event.target, 'description_operator')" class="form-select" id="description_select">
                  <option value="LIKE" selected>LIKE</option>
                  <option value="NOT LIKE">NOT LIKE</option>
                  <option value="=">=</option>
                  <option value="!=">!=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                  <option value="IS NULL">IS NULL</option>
                  <option value="IS NOT NULL">IS NOT NULL</option>
                </select>
                <input type="hidden" name="description_operator" id="description_operator" value="LIKE">
              </td>
              <td><input name="description"></td>
            </tr>
            <tr>
              <td>id_author</td>
              <td>INT</td>
              <td>
                <select onchange="show(event.target, 'id_author_operator')" class="form-select" id="id_author_select">
                  <option value="=" selected>=</option>
                  <option value="!=">!=</option>
                  <option value=">">></option>
                  <option value=">=">>=</option>
                  <option value="<"><</option>
                  <option value="<="><=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                </select>
                <input type="hidden" name="id_author_operator" id="id_author_operator" value="=">
              </td>
              <td><input name="id_author"></td>
            </tr>
            <tr>
              <td>id_genre</td>
              <td>INT</td>
              <td>
                <select onchange="show(event.target, 'id_genre_operator')" class="form-select" id="id_genre_select">
                  <option value="=" selected>=</option>
                  <option value="!=">!=</option>
                  <option value=">">></option>
                  <option value=">=">>=</option>
                  <option value="<"><</option>
                  <option value="<"><=</option>
                  <option value="IN">IN</option>
                  <option value="NOT IN">NOT IN</option>
                  <option value="BETWEEN">BETWEEN</option>
                  <option value="NOT BETWEEN">NOT BETWEEN</option>
                </select>
                <input type="hidden" name="id_genre_operator" id="id_genre_operator" value="=">
              </td>
              <td><input name="id_genre"></td>
            </tr>
          </tbody>
        </table>
        <div class="row">
          <h4 class="mb-4">Сортировка</h4>
          <select onchange="show(event.target, 'order')" class="form-select mb-4" style="width: 300px">
            <option selected>Выберите поле сортировки</option>
            <option value="id">id</option>
            <option value="title">title</option>
            <option value="date_writing">date_writing</option>
            <option value="description">description</option>
            <option value="id_author">id_author</option>
            <option value="id_genre">id_genre</option>
          </select>
          <input type="hidden" name="order" id="order">
          <P>Режим сортировки</P>
          <div class="form-check ms-4">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault2" value="ASC" checked>
            <label class="form-check-label" for="flexRadioDefault2">
              По возрастанию
            </label>
          </div>
          <div class="form-check ms-4">
            <input class="form-check-input" type="radio" name="flexRadioDefault" id="flexRadioDefault1" value="DESC">
            <label class="form-check-label" for="flexRadioDefault1">
              По убыванию
            </label>
          </div>
        </div>
        <button class="btn btn-outline-primary mt-3" type="submit">Выполнить запрос</button>
      </form>

    </div>


    

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-kQtW33rZJAHjgefvhyyzcGF3C5TFyBQBA13V1RKPf4uH+bwyzQxZ6CmMZHmNBEfJ" crossorigin="anonymous"></script>

    <?= include "app/include/footer.php"; ?>
  </body>
</html>