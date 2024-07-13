<!doctype html>
<html lang="pl">
    <head>
        <title>Klient</title>
        <meta charset="utf-8"> 
        <?php
            include("../../includes/accesories-header.php");
        ?>
    </head>
    <body>

        <section class="topbar ctb">
            <img class ="me-auto ml-10" src="../../assets/images/logo.png" alt="strona AGD">
            <div class="navbar-menu">
                <button onclick="loadContent('order-repair')">Zamów naprawę</button>
                <button onclick="loadContent('my-data')">Moje dane</button>
                <button onclick="loadContent('repair-history')">Historia zamówień</button>
                <button onclick="loadContent('logout')">Wyloguj</button>
            </div>
        </section>

        <section>
            <div id="content"></div>
        </section>


        
<!-- Modal -->
<div class="modal fade" id="modal" aria-labelledby="exampleModalCenterTitle">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
     
    </div>
  </div>
</div>

        
        <?php
            include("../../includes/accesories-footer.php");
        ?> 

        <script>
            $(document).ready(function() {
                loadContent('order-repair');
            });
        </script>

    </body>
</html>