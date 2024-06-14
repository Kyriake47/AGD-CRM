<?php
    include("../includes/accesories-header.php");
?>
<!doctype html>
<html lang="pl">
    <head>
        <title>AGD</title>
        <meta charset="utf-8"> 
    </head>
    <body>
        <div class="topbar clr ctb">
            <img src="../assets/images/logo.png" alt="strona AGD">
            <div>
                AGDNaprawa.pl
            </div>
        </div>
        <video class="my-video" id="my-video" src="../assets/videos/loginPageVideo.mp4" autoplay muted loop></video>
        <div class="row">
            
            <div class="col-sm-4 clr ctb">

                <div class="border col-sm login">
                    <div class="login-content"> 
                        <!-- zakladki-->
                        <div class="tab-content" id="myTabContent">
                            <!--zawartosc pierwszej zakladki -->
                            <div class="tab-pane fade show active" id="home-tab-pane" role="tabpanel" aria-labelledby="home-tab" tabindex="0">
                                <form action="login.php" method="POST">
                                    <br>
                                    <div class="form-floating">
                                        <input type="text" name="login" class="form-control" placeholder="Login" required><br>
                                        <label for="floatingInput">Login</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" placeholder="Hasło"required><br>
                                        <label for="floatingInput">Hasło</label>
                                    </div>
                                    <button type="submit" class="button" type="submit">Zaloguj się</button>
                                </form>
                            </div>
          
                            <!-- zawartosc drugiej zakladki-->
                            <div class="tab-pane fade" id="profile-tab-pane" role="tabpanel" aria-labelledby="profile-tab" tabindex="0">
                                <form action="nowy_uzytkownik.php" method="POST">
                                    <br>
                                    <div class="form-floating">
                                        <input type="text" name="email" class="form-control" placeholder="name@email.pl" required><br>
                                        <label for="floatingInput">Podaj adres e-mail</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="text" name="login" class="form-control" placeholder="Login" required><br>
                                        <label for="floatingInput">Utwórz nazwę użytkownika</label>
                                    </div>
                                    <div class="form-floating">
                                        <input type="password" name="password" class="form-control" placeholder="Hasło"required><br>
                                        <label for="floatingInput">Utwórz hasło</label>
                                    </div>
                                    <button type="submit"  class="button" type="submit">Zarejestruj się</button>
                                </form>  
                            </div>
                        </div>
                    </div>
          
                    <!-- menu-zakladki-->
                    <ul class="nav nav-tabs " id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                          <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home-tab-pane" type="button" role="tab" aria-controls="home-tab-pane" aria-selected="true">Zaloguj się</button>
                        </li>
                        <li class="nav-item" role="presentation">
                          <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile-tab-pane" type="button" role="tab" aria-controls="profile-tab-pane" aria-selected="false">Nowy użytkownik</button>
                        </li>
                    </ul>
                </div>
            
            </div>
            <div class="col-sm-8 ctb gradient">
                <div class="word"></div>        
            </div>
        </div>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-HwwvtgBNo3bZJJLYd8oVXjrBZt8cqVSpeBNS5n7C8IVInixGAoxmnlMuBnhbgrkm" crossorigin="anonymous"></script>
        <?php
            include("../includes/accesories-footer.php");
        ?>
    </body>
</html>