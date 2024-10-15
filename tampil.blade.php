@extends('layout')
@section('konten')

<div class="d-flex">
    <h4>List Data</h4>
    <div class="ms-auto">
        <button class="btn btn-primary" id="btnTambah">Tambah</button>
    </div>
</div>

<!-- Modal -->
<div id="siswaModal" style="display:none;">
    <input type="hidden" id="siswaId">
    <div>
        <label>Nama:</label>
        <input type="text" id="nama" class="form-control">
    </div>
    <div>
        <label>Kelas:</label>
        <input type="text" id="kelas" class="form-control">
    </div>
    <div>
        <label>Absen:</label>
        <input type="number" id="absen" class="form-control">
    </div>
    <button id="btnSave">Simpan</button>
    <button id="btnClose">Batal</button>
</div>

<table class="table">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>Kelas</th>
        <th>Absen</th>
        <th>Aksi</th>
    </tr>
    <tbody id="siswaTable">
        @foreach ($siswa as $no=>$data)
        <tr id="row-{{$data->id}}">
            <td>{{$no+1}}</td>
            <td>{{$data->nama}}</td>
            <td>{{$data->kelas}}</td>
            <td>{{$data->absen}}</td>
            <td>
                <button class="btn btn-warning btn-sm edit-btn" data-id="{{ $data->id }}">Edit</button>
                <button class="btn btn-danger btn-sm delete-btn" data-id="{{ $data->id }}">Hapus</button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    $(document).ready(function() {
        // Tambah Data
        $('#btnTambah').click(function() {
            $('#siswaId').val('');
            $('#nama').val('');
            $('#kelas').val('');
            $('#absen').val('');
            $('#siswaModal').show();
        });

        // Simpan atau Update Data
        $('#btnSave').click(function() {
            var id = $('#siswaId').val();
            var nama = $('#nama').val();
            var kelas = $('#kelas').val();
            var absen = $('#absen').val();

            if(id) {
                // Update data via AJAX
                $.ajax({
                    url: '/siswa/updateAjax/' + id,
                    type: 'PUT',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: nama,
                        kelas: kelas,
                        absen: absen
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            var row = $('#row-' + id);
                            row.find('td').eq(1).text(response.data.nama);
                            row.find('td').eq(2).text(response.data.kelas);
                            row.find('td').eq(3).text(response.data.absen);
                            $('#siswaModal').hide();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            } else {
                // Simpan data baru via AJAX
                $.ajax({
                    url: '/siswa/storeAjax',
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        nama: nama,
                        kelas: kelas,
                        absen: absen
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            var newRow = `<tr id="row-${response.data.id}">
                                <td>#</td>
                                <td>${response.data.nama}</td>
                                <td>${response.data.kelas}</td>
                                <td>${response.data.absen}</td>
                                <td>
                                    <button class="btn btn-warning btn-sm edit-btn" data-id="${response.data.id}">Edit</button>
                                    <button class="btn btn-danger btn-sm delete-btn" data-id="${response.data.id}">Hapus</button>
                                </td>
                            </tr>`;
                            $('#siswaTable').append(newRow);
                            $('#siswaModal').hide();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

        // Edit Data
        $(document).on('click', '.edit-btn', function() {
            var id = $(this).data('id');
            $.ajax({
                url: '/siswa/editAjax/' + id,
                type: 'GET',
                success: function(response) {
                    if(response.status === 'success') {
                        $('#siswaId').val(response.data.id);
                        $('#nama').val(response.data.nama);
                        $('#kelas').val(response.data.kelas);
                        $('#absen').val(response.data.absen);
                        $('#siswaModal').show();
                    } else {
                        alert(response.message);
                    }
                }
            });
        });

        // Hapus Data
        $(document).on('click', '.delete-btn', function() {
            var id = $(this).data('id');
            if (confirm('Apakah anda yakin ingin menghapus data ini?')) {
                $.ajax({
                    url: '/siswa/deleteAjax/' + id,
                    type: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if(response.status === 'success') {
                            $('#row-' + id).remove();
                        } else {
                            alert(response.message);
                        }
                    }
                });
            }
        });

        // Tutup modal
        $('#btnClose').click(function() {
            $('#siswaModal').hide();
        });
    });
</script>

@endsection
