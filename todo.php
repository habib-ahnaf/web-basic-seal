<?php

    // buat koneksi dengan MySQL
    $conn = mysqli_connect("localhost", "root", "", "todo_list");

    // cek koneksi dengan MySQL
    if (mysqli_connect_errno()){
        echo "Koneksi gagal".mysqli_connect_error();
        exit();
    }else{
        // echo "Koneksi berhasil";
    }

    // membaca data dari table MySQL
    $query = "SELECT * FROM task";

    // tampilkan data, dengan menjalankan sql query
    $items = [];
    if ($result = mysqli_query($conn, $query)){
        // ambil data satu persatu
        while ($row = mysqli_fetch_assoc($result)){
            $items[] = $row;
        }

        mysqli_free_result($result);
    }

    // section insert item
    // tangkap data item dari form method post
    if (isset($_POST['item'])){
        $item = $_POST['item'];

        // buat query untuk memasukkan item
        $query = "INSERT INTO task (item) values ('$item')";

        // jalankan query
        if (mysqli_query($conn, $query)){
            echo "Data berhasil disimpan";
            header("Refresh:0");
        }else{
            echo "Error ".mysqli_error($conn);
        }
    }

    // tutup koneksi MySQL
    mysqli_close($conn);

?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Contact Me</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/style.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.2/font/bootstrap-icons.css">
    <!-- Font -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet"> 
  </head>
  <body>

    <!-- navbar -->
    <nav class="navbar navbar-expand-lg bg-light shadow-sm sticky-top">
      <div class="container-fluid">
        <div class="collapse navbar-collapse" id="navbarNav">
          <ul class="navbar-nav mx-auto">
            <li class="nav-item">
              <a class="nav-link fw-bold text-dark" aria-current="page" href="index.html">About Me</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-dark" aria-current="page" href="portofolio.html">Portfolio</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold text-dark" aria-current="page" href="todo.php">Todo App</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- todo app -->
    <section class="vh-100">
        <div class="container py-5 h-100">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col col-lg-9 col-xl-7">
                    <div class="card rounded-3">
                        <div class="card-body p-4">

                        <h2 class="title fw-semibold text-center mb-3">To Do App</h2>

                            <form class="row row-cols-lg-auto g-3 justify-content-center align-items-center mb-4 pb-2" action="" method="post">
                                <div class="col-12">
                                    <div class="form-outline">
                                        <input type="text" id="form1" class="form-control" name="item" placeholder="Enter a task here" />
                                    </div>
                                </div>

                                <div class="col-12">
                                    <button type="submit" class="btn btn-primary">Save</button>
                                </div>
                            </form>

                            <table class="table mb-4">
                                <thead>
                                    <tr>
                                        <th scope="col">No.</th>
                                        <th scope="col">Todo item</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php foreach ($items as $key=>$value) : ?>
                                    <tr>
                                        <th scope="row"><?php echo $key+1; ?></th>
                                        <td><?php echo $value['item']; ?></td>
                                        <td><?php echo ($value['status'] == 0) ? "in progress" : "finished"; ?></td>
                                        <td>
                                            <a href="<?php echo 'delete.php?id='.$value['id']; ?>" type="submit" class="btn btn-danger">Delete</a>
                                            <a href="<?php echo 'update.php?id='.$value['id']; ?>" type="submit" class="btn btn-success ms-1">Finished</a>
                                        </td>
                                    </tr>
                                    <?php endforeach; ?>
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- footer -->
    <div class="container-fluid">
      <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
        <div class="col-md-4 d-flex align-items-center">
          <a href="/" class="mb-3 me-2 mb-md-0 text-muted text-decoration-none lh-1">
            <svg class="bi" width="30" height="24"><use xlink:href="#bootstrap"/></svg>
          </a>
          <span class="mb-3 mb-md-0 text-muted">&copy; 2022 Habib Ahnaf</span>
        </div>
    
        <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
          <li class="ms-3"><a class="text-muted" href="https://www.linkedin.com/in/muhammad-habib-ahnaf-al-baihaqi-981438228/"><i class="bi bi-linkedin"></i></a></li>
          <li class="ms-3"><a class="text-muted" href="https://www.instagram.com/muhhabib_ahnaf/"><i class="bi bi-instagram"></i></a></li>
          <li class="ms-3"><a class="text-muted" href="https://web.facebook.com/muh.h.ahnaf"><i class="bi bi-facebook"></i></a></li>
        </ul>
      </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3" crossorigin="anonymous"></script>
  </body>
</html>
