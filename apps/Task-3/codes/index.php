<!DOCTYPE html>
<html>
    <head>
        <title>Банкомат</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="css/style.css">
    </head>
    <body>
        <section class="mt-5">
            <div class="container">
                <div class="row no-gutters justify-content-center">
                    <h1>Банкомат</h1>
                </div>
                <div class="row justify-content-center">
                        <form id="main-form">
                            <div class="form-group ">
                                <label for="rated">Номинал в наличии</label>
                                <input type="text" class="form-control" id="rated" name="rated" placeholder="Укажите номиналы...">
                            </div>
                            <div class="form-group">
                                <label for="summa">Ваша сумма</label>
                                <input type="number" class="form-control" id="summa" name="summa" placeholder="Введите сумма...">
                            </div>
                            <div class="text-right">
                                <button type="submit" class="btn btn-primary">Отправить</button>
                            </div>
                        </form>
                        
                    <div class="msg">
                        
                    </div>
                </div>
            </div>
        </section>
        
        <script  src="js/jquery-3.2.1.min.js"></script>
        <script  src="js/bootstrap.min.js"></script>
        <script  src="js/jquery-validation.min.js"></script>
        <script  src="js/main.js"></script>
    </body>
</html>

