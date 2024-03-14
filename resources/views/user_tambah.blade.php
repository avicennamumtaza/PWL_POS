<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tambah User</title>
</head>
<body>
    <h1>Form Tambah Data User</h1>
    <form action="http://localhost/PWL_POS/public/user/tambah_simpan" method="post">
        {{ csrf_field() }}
        <label for="username">Username</label>
        <input type="text" name="username" placeholder="Masukkan Username"></input>
        <br>
        <label for="nama">Nama</label>
        <input type="text" name="nama" placeholder="Masukkan Nama"></input>
        <br>
        <label for="password">Password</label>
        <input type="password" name="password" placeholder="Masukkan Password"></input>
        <br>
        <label for="level_id">Level ID</label>
        <input type="number" name="level_id" placeholder="Masukkan Level ID"></input>
        <br>
        <br>
        <input type="submit" value="Simpan" class="btn btn-success">
    </form>
</body>
</html>