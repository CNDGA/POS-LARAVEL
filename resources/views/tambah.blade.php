<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Belajar Laravel</title>
</head>

<body>
  <h1>Form Tambah</h1>
  <form action="/action-tambah" method="POST">
    <!-- crft untuk sebuah token -->
    @csrf
    <label for="">Angka1</label>
    <input type="number" name="angka1">
    <br><br>
    <label for="">Angka2</label>
    <input type="number" name="angka2">
    <br>
    <button type="submit">Proses</button>
  </form>
  <br>
  <br>
  <h3>Totalnya Adalah : {{ $jumlah }} </h3>
</body>

</html>