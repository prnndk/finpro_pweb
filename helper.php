<?php
function toIndonesiaDate()
{
    $current_date_day = date('D');
    switch ($current_date_day) {
        case 'Mon':
            $current_date_day = 'Senin';
            break;
        case 'Tue':
            $current_date_day = 'Selasa';
            break;
        case 'Wed':
            $current_date_day = 'Rabu';
            break;
        case 'Thu':
            $current_date_day = 'Kamis';
            break;
        case 'Fri':
            $current_date_day = 'Jumat';
            break;
        case 'Sat':
            $current_date_day = 'Sabtu';
            break;
        case 'Sun':
            $current_date_day = 'Minggu';
            break;
    }

    return $current_date_day;
}
function getUserData(){
    include 'connection.php';
    $user_id = getUserId();
    $query = "SELECT * FROM users WHERE id = '$user_id'";
    $result = mysqli_query($connect, $query);
    $user = mysqli_fetch_assoc($result);
    return $user;
}

function getSiswaId(){
    include 'connection.php';
    $user_id = getUserId();
    $query = "SELECT * FROM siswas WHERE user_id = '$user_id'";
    $result = mysqli_query($connect, $query);
    $siswa = mysqli_fetch_assoc($result);
    return $siswa['id'];
}

// static function to get user_id
function getUserId()
{
    return $_SESSION['user_id'];
}

/**
 * Convert a date to Indonesian format.
 *
 * @param string $date the date to convert
 *
 * @return string the converted date
 */
function indonesiaDate(string $date)
{
    switch ($date) {
        case 'Monday':
            $date = 'Senin';
            break;
        case 'Tuesday':
            $date = 'Selasa';
            break;
        case 'Wednesday':
            $date = 'Rabu';
            break;
        case 'Thursday':
            $date = 'Kamis';
            break;
        case 'Friday':
            $date = 'Jumat';
            break;
        case 'Saturday':
            $date = 'Sabtu';
            break;
        case 'Sunday':
            $date = 'Minggu';
            break;
    }

    return $date;
}
