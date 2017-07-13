<?php
session_start(); // harus ada di bagian paling atas kode
$path_to_root = "";
include $path_to_root . 'database.php';

//object database class
$db = new database();

$user = strip_tags(trim($_POST['username'])); #echo $user;
$pass = strip_tags(trim($_POST['password'])); #echo $pass;

$sql = get_sql_login_admin_page($user, $pass);

$result = $db->db_query($sql);
$num_rows = $db->db_num_rows($result);

if ($num_rows > 0) {
    $rows = $db->db_fetch_array($result);
    
        unset($_POST); // hapus post form
        $_SESSION['topsis_kontraktor_id'] = $rows['id']; // mengisi session
        $_SESSION['topsis_kontraktor_username'] = $rows['username'];
        $_SESSION['topsis_kontraktor_nama'] = $rows['nama'];
        $_SESSION['topsis_kontraktor_level'] = $rows['akses'];

        $level_name = ($_SESSION['topsis_kontraktor_level']==1)?"admin":"kepala";
        $_SESSION['topsis_kontraktor_level_name'] = $level_name;
        $_SESSION['topsis_kontraktor_key'] = sha1(date("Y-m-d H:i:s") . $rows['id']);
        $_SESSION['topsis_kontraktor_last_login'] = date("d-m-Y H:i:s");
        header("location:index.php");
} else {
     header("location:login.php?login=1");
}


/**
 * query get login 
 * @param string $user username
 * @param string $pass password
 * @return string
 */
function get_sql_login_admin_page($user, $pass){
    $sql = "SELECT * FROM users"
        . " WHERE username = '" . $user . "' AND password = MD5('" . $pass . "')";
        echo $sql;
    return $sql;
}

?>
