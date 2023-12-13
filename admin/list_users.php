<?php
require_once '../isAdmin.php';
include_once '../connection.php';
global $connect;
$users_query = 'SELECT name,username,email,roles,id FROM users';
$users_result = mysqli_query($connect, $users_query);
$users = mysqli_fetch_all($users_result, MYSQLI_ASSOC);
include_once '../template/header.php'; ?>
    <div class="container container-boxed main-content">
        <div class="container-header fw-semibold">Data Pengguna Website</div>
        <div class="row">
            <?php foreach ($users as $user) { ?>
                <div class="col-md-6">
                    <div class="card-pengajar">
                        <div class="row">
                            <div class="col-md-8 d-flex flex-column justify-content-start">
                                <h4 class="fw-bold"><?php echo $user['name']; ?></h4>
                                <h6><?php echo $user['username']; ?></h6>
                            </div>
                            <div class="col-md-4 d-flex flex-column justify-content-end overflow-hidden">
                                <p><?php echo $user['email']; ?></p>
                            </div>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
<?php
include_once '../template/footer.php';