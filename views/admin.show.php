<html>
<header>
<link href="css/bootstrap.min.css" rel="stylesheet">
</header>
<body>
    <div id = "app">
            <nav class = "navbar navbar-expand-md navbar-dark bg-dark shadow-sm">
            <div class="container">
                    <a class="navbar-brand" href="index.php">
                        Гостевая книга
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <ul class="navbar-nav ml-auto">
                                <li class="nav-item">
                                    <a class="nav-link" href="/controlRev/logout.php">Logout</a>
                                </li>
                        </ul>
                    </div>
                </div>
            </nav>
    </div>
    <main class="py-4">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header"><h3>Панель администратора</h3></div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th>Имя</th>
                                        <th>Email</th>
                                        <th>Отзыв</th>
                                        <th>Дата</th>
                                        <th>Статус</th>
                                        <th>Картинка</th>
                                        <th>Действие</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($reviews as $review):?>
                                    <form action="controlRev/editRev.php?idModRev=<?=$review['id']?>" method="post">
                                    <tr>
                                        <td><?=$review['userName'];?></td>
                                        <td><?=$review['userMail'];?></td>
                                        <td>
                                            <textarea name="reviewMod"  class="form-control" id="exampleFormControlTextarea1"><?=$review['userReview'];?></textarea>
                                        </td>
                                        <td><?=$review['reviewDate'];?></td>
                                        <td><?if ($review['adminCheck']==0){
                                            $admChkStr = $review['adminCheck'];
                                            $admChkStr = "Отклонено";
                                            }
                                            else{
                                                $admChkStr = "Принято";
                                            };
                                            ?>
                                            <?=$admChkStr;?>
                                        </td>
                                        <td>
                                            <?php if (!empty($review['userImage'])):?>
                                                <img src="/img/<?=$review['userImage'];?>" width = "50">
                                            <?php endif;?>
                                        </td>
                                        <td>
                                            <?= $review['adminCheck'] == 0 ? '<a href="controlRev/editRev.php?idRev='.$review['id'].'&checked=1" class="btn btn-success">Разрешить</a>' : ''; ?>
                                            <?= $review['adminCheck'] == 1 ? '<a href="controlRev/editRev.php?idRev='.$review['id'].'&checked=0" class="btn btn-danger">Запретить</a>' : ''; ?>
                                            <br><button type="submit" class="btn btn-secondary" style="margin-top: 5px;">Изменить</button>
                                        </td>
                                    </tr>
                                    </form>
                                    <?php endforeach;?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>