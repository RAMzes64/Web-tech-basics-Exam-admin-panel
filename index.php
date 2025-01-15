<?php 
    define('DB_HOST', 'localhost:3306'); //Адрес
    define('DB_USER', 'root'); //Имя пользователя
    define('DB_PASSWORD', ''); //Пароль
    define('DB_NAME', 'adminPanel'); //Имя БД
    $mysql = new mysqli(DB_HOST,DB_USER,DB_PASSWORD,DB_NAME);
    
    
    ?>





<!DOCTYPE html>
<html lang="en">
    
    <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Ишкильдин Р.Ф. | Лабораторная работа 12</title>
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
<body>
    <nav class="navbar navbar-expand-lg navbar-light bg-secondary fs-2">Административная панель</nav>
    <div id="alert-container">
        <!-- Пример успешного уведомления -->
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            Это успешное уведомление!
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    </div>   
    <div class="container mt-5">
        <h2>Форма поиска записей</h2>
        <form method="POST">
            <div class="form-group">
                <label for="name">Наименование</label>
                <input type="text" class="form-control" id="name" placeholder="Введите наименование">
            </div>
            <div class="form-group">
                <label for="district">Округ</label>
                <select class="form-control" id="district">
                <?php
                    $result = mysqli_query($mysql, "SELECT * FROM districts");
            
                    if (!$result) {
                        die("Ошибка выполнения запроса: " . mysqli_error($mysql));
                    }
                    $mysql->close();

                    while($row =$result->fetch_assoc()){
                        echo "<option>".$row["name"]."</option>";
                    }
                ?>
                </select>
            </div>
            <div class="form-group">
                <label for="region">Район</label>
                <select class="form-control" id="region">
                    <option>Выберите район</option>
                    <option>Район 1</option>
                    <option>Район 2</option>
                    <option>Район 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="objectType">Вид объекта</label>
                <select class="form-control" id="objectType">
                    <option>Выберите вид объекта</option>
                    <option>Тип 1</option>
                    <option>Тип 2</option>
                    <option>Тип 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="isNetwork">Является сетевым</label>
                <select class="form-control" id="isNetwork">
                    <option>Выберите статус</option>
                    <option>Да</option>
                    <option>Нет</option>
                </select>
            </div>
            <div class="form-group">
                <label for="benefits">Льготы</label>
                <select class="form-control" id="benefits">
                    <option>Выберите льготы</option>
                    <option>Льгота 1</option>
                    <option>Льгота 2</option>
                    <option>Льгота 3</option>
                </select>
            </div>
            <div class="form-group">
                <label for="seatingCapacityFrom">Количество посадочных мест от</label>
                <input type="number" class="form-control" id="seatingCapacityFrom" placeholder="От">
            </div>
            <div class="form-group">
                <label for="seatingCapacityTo">Количество посадочных мест до</label>
                <input type="number" class="form-control" id="seatingCapacityTo" placeholder="До">
            </div>
            <div class="form-group">
                <label for="creationDateFrom">Дата создания от</label>
                <input type="date" class="form-control" id="creationDateFrom">
            </div>
            <div class="form-group">
                <label for="creationDateTo">Дата создания до</label>
                <input type="date" class="form-control" id="creationDateTo">
            </div>
            <button type="submit" class="btn btn-primary">Поиск</button>
        </form>
         

    <div class="container mt-5">
        <h2>Предприятия общественного питания в Москве</h2>
        <button class="btn btn-primary mb-3" data-toggle="modal" data-target="#createModal">Добавить запись</button>
        <table class="table table-bordered">
            <thead>
                <tr>
                <th>Наименование</th>
                <th>Вид объекта</th>
                <th>Адрес</th>
                <th>Действия</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $result = mysqli_query($mysql, "SELECT * FROM table_lab WHERE");
            
            if (!$result) {
                die("Ошибка выполнения запроса: " . mysqli_error($mysql));
            }
            $mysql->close();
            ?>
            <tr>
                <td>Ресторан "Пример"</td>
                <td>Ресторан</td>
                <td>Москва, ул. Примерная, д. 1</td>
                <td>
                    <button class="btn btn-warning" data-toggle="modal" data-target="#editModal">Редактировать</button>
                    <button class="btn btn-danger" data-toggle="modal" data-target="#deleteModal">Удалить</button>
                </td>
            </tr>
        </tbody>
    </table>

    <div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="createModalLabel">Добавить запись</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="name">Наименование</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>
                        <div class="form-group">
                            <label for="type">Вид объекта</label>
                            <input type="text" class="form-control" id="type" required>
                        </div>
                        <div class="form-group">
                            <label for="address">Адрес</label>
                            <input type="text" class="form-control" id="address" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="editModal" tabindex="-1" role="dialog" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editModalLabel">Редактировать запись</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form>
                        <div class="form-group">
                            <label for="edit-name">Наименование</label>
                            <input type="text" class="form-control" id="edit-name" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-type">Вид объекта</label>
                            <input type="text" class="form-control" id="edit-type" required>
                        </div>
                        <div class="form-group">
                            <label for="edit-address">Адрес</label>
                            <input type="text" class="form-control" id="edit-address" required>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Закрыть</button>
                    <button type="button" class="btn btn-primary">Сохранить изменения</button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="deleteModalLabel">Подтверждение удаления</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    Вы уверены, что хотите удалить эту запись?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Отмена</button>
                    <button type="button" class="btn btn-danger">Удалить</button>
                </div>
            </div>
        </div>
    </div>

    </div>  
    <footer class="bg-light text-center text-lg-start mt-5">
        <div class="text-center p-3">
            ООО "Компания"<br>
            +7(999)999-99-99<br>
            mail@mail.com    
        </div>
    </footer>  
</body>


</html>