<?php

// check is user admin from login session
if ($_SESSION['isAdmin'] == 1) {
    echo 'You are admin';
} else {
    echo 'You are not admin';
}
