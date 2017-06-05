<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?> 

<!DOCTYPE html>
<html>
  <head>
    <title>wi-test-php</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="templates/css/main.css"/>
  </head>
  <body>
      <div class="layout">
          <h1>
            Небольшой приветственный текст
          </h1>
          <div class="button">
            Добавить запись
          </div>
          <div class="table">
              <div class="table__row">
                  <div class="table__col table__col_id">
                    ID
                  </div>
                  <div class="table__col table__col_name">
                    Наименование
                  </div>
                  <div class="table__col table__col_cat">
                    Категория
                  </div>
                  <div class="table__col table__col_price">
                    Цена
                  </div>
                  <div class="table__col">
                  </div>
                  <div class="table__col">
                  </div>
              </div>
              <?PHP FOREACH ($products as $product) : ?>
              
                <div class="table__row">
                  <div class="table__col table__col_id">
                    <?= $product["id"] ?>
                  </div>
                  <div class="table__col table__col_name">
                    <?= $product["name"] ?>
                  </div>
                  <div class="table__col table__col_cat">
                    <?= $product["cat"] ?>
                  </div>
                  <div class="table__col table__col_price">
                    <?= $product["price"] ?>
                  </div>
                  <div class="table__col table__col_config" data-id="<?= $product["id"] ?>">
                    Редактировать
                  </div>
                  <div class="table__col table__col_delete" data-id="<?= $product["id"] ?>">
                    Удалить
                  </div>
                </div>
              
              <?PHP ENDFOREACH ?>
          </div>
      </div>
      
      <div class="popup">
          <div class="popup__box">
              <div class="popup__close">
                x
              </div>
              <h1 class="popup__title">
                Редактировать
              </h1>
              <form class="popup__form">
                  <input class="form__input" type="hidden" name="id" value="">
                  <input class="form__input" type="text" name="name" placeholder="Наименование" value="">
                  <select name="cat" class="form__input">
                      <?PHP FOREACH ($cats as $cat): ?>
                        <option value="<?= $cat["id"] ?>">
                          <?= $cat["name"] ?>
                        </option>
                      <?PHP ENDFOREACH ?>
                  </select>
                  <input class="form__input" type="text" name="price" placeholder="Цена" value="">
                  <input type="submit" value="Отправить">
              </form>
          </div>
      </div>
      
      
      <script src="templates/js/jquery-3.2.0.min.js"></script>
      <script src="templates/js/main.js"></script>
  </body>
</html>
