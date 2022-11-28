<?php
    
    //tangkap id dari method GET
    $id = $_GET['id'];

    //buat koneksi dengan MySQL
    $conn = mysqli_connect("localhost", "root", "", "todo_list");

    // cek koneksi
    if (mysqli_connect_errno()){
        echo "Koneksi Gagal";
        exit();
    }else{
        echo "Koneksi Berhasil";
    }

    // buat query select semua todo list
    $query = "DELETE FROM task WHERE id='$id'";

    // jalankan query
    $sql = mysqli_query($conn, $query);
    mysqli_close($conn);

    if ($sql){
        echo "Data berhasil dihapus";
        header("Refresh:0; url=todo.php");
    }else{
        echo "Data tidak berhasil dihapus ".mysqli_error($conn);
    }

?>