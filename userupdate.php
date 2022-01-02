<?php
require_once "header.php";
require_once "navbar.php";
if ($_SESSION["user"]["user_role"] != 5||$_SESSION["user"]["user_role"] != 6) {

    header("Location:index");
    exit;
}
$id = $_GET["id"];

$getusers = $set->registerlist("user", $id);

$userdetails = $getusers->fetch(PDO::FETCH_ASSOC);



if (isset($_POST["updateuser"])) {

    $edit = $set->userupdate("user", $_POST, $_POST["user_id"]);
}
if ($_GET["update"] == "ok") {

    header("refresh:1;url=user");
}

?>
<div class="content-wrapper">
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Kullanıcı Düzenle</h1>
                </div>

            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content dosya-inputs-content">
        <div class="row dosya-inputs-row">
            <div class="dosya-inputs-wrap">
                <div class="dosya-inputs">
                    <form action="userupdate" method="post" role="form">
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Kullanıcı Adı</label>
                                <input type="text" name="user_name" class="form-control"
                                    value="<?php echo htmlspecialchars($userdetails["user_name"]) ?>" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Kullanıcı E-mail</label>
                                <input type="text" name="user_mail" class="form-control"
                                    value="<?php echo htmlspecialchars($userdetails["user_mail"]) ?>" required>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Şifre Değiştir</label>
                                <input type="password" name="user_password" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group ">

                            <div class="input-group">
                                <label>Şifre Tekrar</label>
                                <input type="password" name="user_password_1" class="form-control">
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->


                        <div class="form-group ">

                            <div class="input-group">
                                <label>Yetki</label>
                                <select name="user_role" class="form-control" required>



                                    <?php

                                    if ($userdetails["user_role"] == 5 || $_SESSION["user"]["user_role"] == 6) { ?>

                                    <option value="5" selected="">Yönetici</option>
                                    <option value="4">Bölge Sorumlusu</option>
                                    <option value="1">Avukat</option>

                                    <?php  } else if ($userdetails["user_role"] == 4) { ?>
                                    <option value="4" selected="">Bölge Sorumlusu</option>
                                    <option value="1">Avukat</option>
                                    <option value="5">Yönetici</option>

                                    <?php   } else if ($userdetails["user_role"] == 1) { ?>

                                    <option value="1" selected="">Avukat</option>
                                    <option value="4">Bölge Sorumlusu</option>

                                    <option value="5">Yönetici</option>
                                    <?php  } ?>







                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->
                        <div class="form-group">

                            <div class="input-group">
                                <label>Durum</label>
                                <select name="user_status" class="form-control" required>
                                    <?php
                                    if ($userdetails["user_status"] == 1) { ?>

                                    <option value="1">Aktif</option>
                                    <option value="2">Devre Dışı</option>

                                    <?php } else { ?>

                                    <option value="2">Devre Dışı</option>
                                    <option value="1">Aktif</option>


                                    <?php } ?>
                                </select>
                            </div>
                            <!-- /.input group -->
                        </div>
                        <!-- /.form group -->

                        <input type="hidden" name="user_id" value="<?php echo $userdetails["user_id"] ?>">

                        <div class="form-group ">

                            <button class="btn bg-gradient-success float-right" name="updateuser"
                                type="submit">Güncelle</button>
                            <a href="user" class="btn  btn-outline-primary mr-2 float-right">Geri</a>
                        </div>
                    </form>
                </div>
                <!-- /.col-md-6 -->
            </div>
        </div>
        <!-- /.row -->
    </section>
</div>

<?php require_once "footer.php";
?>
<script type="text/javascript">
<?php if ($_GET["update"] == "ok") { ?>

Swal.fire({
    position: 'top-end',
    icon: 'success',
    title: 'Güncelleme Başarılı',
    showConfirmButton: false,
    timer: 1500
});
/*    var url = 'user';
    $(location).prop('href', url); */
<?php } else if ($_GET["update"] == "no") { ?>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: 'Güncelleme Başarısız',
    showConfirmButton: false,
    timer: 1500
})
<?php } elseif ($_GET["pass"] == "same") { ?>
Swal.fire({
    position: 'top-end',
    icon: 'error',
    title: 'Şifreler eşleşmiyor',
    showConfirmButton: false,
    timer: 1500
})
<?php } ?>
</script>

</body>

</html>