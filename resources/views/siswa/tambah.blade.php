@extends('layout')
@section('konten')

<h4>Tambah</h4>
<form action="{{ route('siswa.submit')}}" method="post">
    @csrf
    <label>Nama</label>
    <input type="text" name="nama" class="form-control mb-2">
    <label>Kelas</label>
    <input type="number" name="kelas" class="form-control mb-2">
    <label>Absen</label>
    <input type="number" name="absen" class="form-control mb-2">

    <button class="btn btn-primary">Tambah</button>
</form>

@endsection