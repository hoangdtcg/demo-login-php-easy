<?php
session_start();
include_once "Auth.php";
$auth = new Auth();

if (isset($_SESSION['user'])) {
    $user = $_SESSION["user"]; //super global
    $users = $auth->getAllUser();
    if(isset($_GET["chat"])){
        $fileName = "chats/chat".$_GET["chat"].".json";
        $data = $auth->getDataChat($fileName);
    }
} else {
    header("location:login.php");
}

?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css"
          integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
</head>
<style>
    .chat-of-me{
        background-color:cornflowerblue;
        color:white;
        text-align:right;
    }
</style>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <a class="navbar-brand" href="#">Navbar</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <ul class="navbar-nav mr-auto">
            <li class="nav-item active">
                <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">Link</a>
            </li>
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-expanded="false">
                    Dropdown
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Action</a>
                    <a class="dropdown-item" href="#">Another action</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="#">Something else here</a>
                </div>
            </li>
            <li class="nav-item">
                <a class="nav-link disabled">Disabled</a>
            </li>
        </ul>
        <div class="form-inline my-2 my-lg-0">
            <div class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown"
                   aria-expanded="false">
                    <?php echo $user->name ?? "" ?>
                </a>
                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                    <a class="dropdown-item" href="#">Profile</a>
                    <a class="dropdown-item" href="#">Settings</a>
                    <div class="dropdown-divider"></div>
                    <a class="dropdown-item" href="logout.php">Logout</a>
                </div>
            </div>
        </div>
    </div>
</nav>

<div class="container mt-3 col-12">
    <div class="row">
        <div class="col-3">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    Danh sach nguoi dung
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($users as $_user): ?>
                        <?php if ($_user->id != $user->id): ?>
                            <a href="index.php?chat=<?php echo ($_user->id > $user->id) ? $user->id . "_" . $_user->id : $_user->id . "_" . $user->id; ?>">
                                <li class="list-group-item"><?php echo $_user->name ?></li>
                            </a>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>
        <div class="col-9">
            <div class="card" style="width: 100%;">
                <div class="card-header">
                    Chat cung Friend
                </div>
                <ul class="list-group list-group-flush">
                    <?php foreach ($data as $item): ?>
                        <?php if($user->id == $item->user_id): ?>
                            <li class="list-group-item chat-of-me"><?php echo $item->content ?></li>
                        <?php else: ?>
                            <li class="list-group-item"><?php echo $item->content ?></li>
                        <?php endif; ?>

                    <?php endforeach; ?>
                </ul>
            </div>

<!--            --><?php //echo "<pre>";print_r($data);echo "</pre>";?>
        </div>
    </div>

</div>

<script src="https://cdn.jsdelivr.net/npm/jquery@3.5.1/dist/jquery.slim.min.js"
        integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
        integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.min.js"
        integrity="sha384-VHvPCCyXqtD5DqJeNxl2dtTyhF78xXNXdkwX1CZeRusQfRKp+tA7hAShOK/B/fQ2"
        crossorigin="anonymous"></script>
</body>
</html>