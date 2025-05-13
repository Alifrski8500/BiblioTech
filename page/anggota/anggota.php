<div class="row">
    <div class="col-md-12">
        <!-- Advanced Tables -->
        <div class="panel panel-default">
            <div class="panel-heading">
                Data Anggota
            </div>
            <div class="panel-body">
                <div class="table-responsive">
                    <div>
                        <a href="?page=anggota&aksi=tambah" class="btn btn-success" style="margin-bottom: 10px;"><i class="fa fa-plus"></i> Tambah Data</a>
                    </div>
                    <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                        <thead class="text-center">
                            <tr>
                                <th>No</th>
                                <th>NIS</th>
                                <th>Nama</th>
                                <th>Tempat Lahir</th>
                                <th>Tanggal Lahir</th>
                                <th>Jenis Kelamin</th>
                                <th>Kelas</th>
                                <th width="20%">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $no = 1;
                            $sql = $koneksi->query("SELECT * FROM tb_anggota");
                            while ($data = $sql->fetch_assoc()) {
                                $jk = ($data['jk'] == 'l') ? "Laki-laki" : "Perempuan";
                            ?>
                                <tr class="text-center">
                                    <td><?php echo $no++; ?></td>
                                    <td><?php echo htmlspecialchars($data['nis']); ?></td>
                                    <td><?php echo htmlspecialchars($data['nama']); ?></td>
                                    <td><?php echo htmlspecialchars($data['tempat_lahir']); ?></td>
                                    <td><?php echo htmlspecialchars($data['tgl_lahir']); ?></td>
                                    <td><?php echo htmlspecialchars($jk); ?></td>
                                    <td><?php echo htmlspecialchars($data['kelas']); ?></td>
                                    <td>
                                        <a href="?page=anggota&aksi=ubah&id=<?php echo $data['nis']; ?>" class="btn btn-warning btn-sm"><i class="fa fa-edit"></i> Ubah</a>
                                        <a onclick="return confirm('Apakah Anda yakin ingin menghapus?')" href="?page=anggota&aksi=hapus&id=<?php echo $data['nis']; ?>" class="btn btn-danger btn-sm"><i class="fa fa-trash"></i> Hapus</a>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
