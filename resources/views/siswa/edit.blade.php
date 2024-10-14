@extends('layout')
@section('konten')

<h4>Edit</h4>
<form action="{{ route('siswa.update', $siswa->id)}}" method="post">
    @csrf
    <label>Nama</label>
    <input type="text" name="nama" value="{{ $siswa->nama }}" class="form-control mb-2">
    <label>Kelas</label>
    <input type="number" name="kelas" value="{{ $siswa->kelas }}" class="form-control mb-2">
    <label>Absen</label>
    <input type="number" name="absen" value="{{ $siswa->absen }}" class="form-control mb-2">

    <button class="btn btn-primary">Edit</button>
</form>

@endsection