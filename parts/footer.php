
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/alertify/alertify.min.js"></script>
    <script>
    function myFunction() {
        var x = document.getElementById("password");
        if (x.type === "password") {
            x.type = "text";
        } else {
            x.type = "password";
        }
    }
</script>
    <?php
    if (isset($_SESSION["success"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION["success"]; ?>');
            setTimeout(function() {
                window.location.href = "patient-login.php";
            }, 3000);
        </script>
    <?php
        unset($_SESSION["success"]);
    }
    ?>
      <?php
    if (isset($_SESSION['patient_login_success'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['patient_login_success']; ?>');
            setTimeout(function() {
                window.location.href = "patient/index.php";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['patient_login_success']);
    }
    ?>
    <?php
    if (isset($_SESSION['admin_login_success'])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION['admin_login_success']; ?>');
            setTimeout(function() {
                window.location.href = "admin/index.php";
            }, 3000);
        </script>
    <?php
        unset($_SESSION['admin_login_success']);
    }
    ?>
    <?php
    if (isset($_SESSION["dlogin_success"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.success('<?= $_SESSION["dlogin_success"]; ?>');
            setTimeout(function() {
                window.location.href = "doctor/index.php";
            }, 3000);
        </script>
    <?php
        unset($_SESSION["dlogin_success"]);
    }
    ?>
    <?php
    if (isset($error["error"])) {
    ?>
        <script>
            alertify.set('notifier', 'position', 'top-right');
            alertify.error('<?= $error["error"]; ?>');
        </script>
    <?php
    }
    ?>
    <script>
        document.addEventListener("DOMContentLoaded", function(){
            el_autohide = document.querySelector('.autohide');

            if(el_autohide){
                var last_scroll_top = 0;
            window.addEventListener('scroll', function(){
                let scroll_top = window.scrollY;
                if(scroll_top < last_scroll_top){
                    el_autohide.classList.remove('scrolled-down');
                    el_autohide.classList.add('scrolled-up');
                }else{
                    el_autohide.classList.remove('scrolled-up');
                    el_autohide.classList.add('scrolled-down');
                }
                last_scroll_top = scroll_top;
            });
            }

        });
    </script>
</body>

</html>