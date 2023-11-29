<?php
if (!function_exists('koneksi')) {
    function koneksi()
    {
        $conn = mysqli_connect("localhost", "root", "", "futsal");
        return $conn;
    }
}

if (!function_exists('query')) {
    function query($sql, $params = [])
    {
        $conn = koneksi();
        $stmt = mysqli_prepare($conn, $sql);

        if ($stmt === false) {
            return false;
        }

        if (!empty($params)) {
            $types = str_repeat('s', count($params));
            mysqli_stmt_bind_param($stmt, $types, ...$params);
        }

        $result = mysqli_stmt_execute($stmt);

        if ($result === false) {
            return false;
        }

        $rows = [];
        $result_set = mysqli_stmt_get_result($stmt);
        while ($row = mysqli_fetch_assoc($result_set)) {
            $rows[] = $row;
        }

        mysqli_stmt_close($stmt);

        return $rows;
    }
}

if (!function_exists('cleaner')) {
    function cleaner($data)
    {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);
        return $data;
    }
}
