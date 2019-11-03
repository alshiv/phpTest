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
                        <?php if (!empty($_SESSION['id'])):?>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Profile
                            </a>
                            <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <a class="dropdown-item" href="admin.php">Admin</a>
                            <a class="dropdown-item" href="/controlRev/logout.php">Logout</a>
                            </div>
                        </li>
                        <?php endif;?>
                        <?php if (empty($_SESSION['id'])):?>
                        <li class="nav-item">
                            <a class="nav-link" href="login.php">Login</a>
                        </li>
                        <?php endif;?>
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
                        <div class="card-header">
                            <h3>Отзывы</h3>
                            <a href="index.php?sort=1" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">По дате</a>
                            <a href="index.php?sort=2" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">По имени</a>
                            <a href="index.php?sort=3" class="btn btn-secondary btn-sm" role="button" aria-pressed="true">По email</a>
                        </div>
                        <div class="card-body">
                            <?php foreach ($reviews as $review) : ?>
                            <div class="media" style="margin-bottom: 40px;">
                                <div class="media-body">
                                    <h5 class="mt-0"><?= $review['userName']; ?></h5>
                                    <p><?= $review['userMail']; ?></p>
                                    <p><?= $review['userReview']; ?></p>
                                    <span><small><?= $review['reviewDate']; ?></small></span>
                                </div>
                                <?php if (!empty($review['userImage'])):?>
                                    <img src="/img/<?=$review['userImage'];?>" class="mr-3" alt="..." width="320" height="240">
                                <?php endif;?>
                            </div>
                            <?php endforeach;  ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12" style="margin-top: 20px;">
                    <div class="card">
                        <div class="card-header"><h3>Оставить отзыв</h3></div>
                        <div class="card-body">
                            <form action="controlRev/addRev.php" method = "post" enctype="multipart/form-data">
                                <div class="form-group">
                                    <?php
                                        $isValid = '';
                                        $msg = '';
                                        $validCheck = $_SESSION['validCheck']['userName'];
                                        if (!empty($validCheck['msg']))
                                        {
                                            $isValid = 'is-invalid';
                                            $msg = $validCheck['msg'];
                                        }
                                    ?>
                                    <label for="exampleFormControlTextarea1">Имя</label>
                                    <input type="text" name="userName" id="userName" class="form-control <?=$isValid;?>" id="exampleFormControlTextarea1" placeholder="Ваше имя">
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?=$msg;?></strong>
                                    </span><br>
                                    <label for="exampleFormControlTextarea1">E-mail</label>
                                    <?php
                                        $isValid = '';
                                        $msg = '';
                                        $validCheck = $_SESSION['validCheck']['userMail'];
                                        if (!empty($validCheck['msg']))
                                        {
                                            $isValid = 'is-invalid';
                                            $msg = $validCheck['msg'];
                                        }
                                    ?>
                                    <input type="text" name="userMail" id="userMail" class="form-control <?=$isValid;?>" id="exampleFormControlTextarea1" placeholder="Ваш email">
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?=$msg;?></strong>
                                    </span><br>
                                    <label for="exampleFormControlTextarea1">Отзыв</label>
                                    <?php
                                        $isValid = '';
                                        $msg = '';
                                        $validCheck = $_SESSION['validCheck']['userReview'];
                                        if (!empty($validCheck['msg']))
                                        {
                                            $isValid = 'is-invalid';
                                            $msg = $validCheck['msg'];
                                        }
                                    ?>
                                    <textarea name="userReview" id="userReview" class="form-control <?=$isValid;?>" id="exampleFormControlTextarea1" placeholder="Ваш отзыв"></textarea>
                                    <span class="invalid-feedback" role="alert">
                                        <strong><?=$msg;?></strong>
                                    </span><br>
                                    <label for="exampleFormControlTextarea1">Изображение</label><br>
                                    <input type="file" id="files" name="userImage" multiple accept=".gif,.jpg,.png"><br><br>
                                    <button type ="submit" class="btn btn-dark">Отправить</button>
                                    <button type ="button" onclick="preview()" class="btn btn-info">Предпросмотр</button>
                                </div>
                            </form>
                            <output id="preview">
                            <div class="media">
                                <div class="media-body" style="margin-top: 20px;">
                                    <h5 id="namePrev" class="mt-0"></h5>
                                    <p id="mailPrev"></p>
                                    <p id="revPrev"></p>
                                    <span><small id="datePrev"></small></span>
                                </div>
                                <!-- как-то вывести картинку -->
                            </div>
                            </output>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>
<script>
    let preview = function() {
        let userName = document.getElementById('userName').value;
        let userMail = document.getElementById('userMail').value;
        let userReview = document.getElementById('userReview').value;
        let d = new Date();
        let curDate = d.getDate();
        let curMonth = d.getMonth()+1;
        let curYear = d.getFullYear();
        let curHour = d.getHours();
        let curMin = d.getMinutes();
        let curSec = d.getSeconds();
        document.getElementById('namePrev').innerHTML = userName;
        document.getElementById('mailPrev').innerHTML = userMail;
        document.getElementById('revPrev').innerHTML = userReview;
        document.getElementById('datePrev').innerHTML = curYear+"-"+curMonth+"-"+curDate+" "+curHour+":"+curMin+":"+curSec;
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>