@extends('layout')
@section('konten')

<div class="d-flex">
    <h4>List Data</h4>
    <div class="ms-auto">
        <a class="btn btn-primary" href="{{ route('siswa.tambah')}}">Tambah</a>
    </div>
</div>
<table class="table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Absen</th>
        <th>Aksi</th>
    </tr>
    @foreach ($siswa as $no=>$data)
    <tr>
        <td>{{$no+1}}</td>
        <td>{{$data->nama}}</td>
        <td>{{$data->kelas}}</td>
        <td>{{$data->absen}}</td>
        <td>
            <a href="{{ route('siswa.edit', $data->id)}}" class="btn btn-warning btn-sm">Edit</a>
            <form action="{{ route('siswa.delete', $data->id)}}" method="post">
                @csrf
                <button class="btn btn-danger btn-sm">Hapus</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

@endsection