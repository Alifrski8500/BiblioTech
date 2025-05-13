<script type="text/javascript">
    function validasi(form) {
        if (form.nis.value == "") {
            alert("NIS Tidak Boleh Kosong");
            form.nis.focus();
            return false;
        }
        if (form.nama.value == "") {
            alert("Nama Tidak Boleh Kosong");
            form.nama.focus();
            return false;
        }
        if (form.tmpt_lahir.value == "") {
            alert("Tempat Lahir Tidak Boleh Kosong");
            form.tmpt_lahir.focus();
            return false;
        }
        if (form.tgl_lahir.value == "") {
            alert("Tanggal Lahir Tidak Boleh Kosong");
            form.tgl_lahir.focus();
            return false;
        }
        if (form.kelas.value == "" || form.kelas.value == "== Pilih Kelas ==") {
            alert("Kelas Tidak Boleh Kosong");
            form.kelas.focus();
            return false;
        }
        if (!form.jk.value) {
            alert("Jenis Kelamin Harus Dipilih");
            return false;
        }
        return true;
    }
</script>

<div class="panel panel-default">
    <div class="panel-heading">
        Tambah Data Anggota
    </div> 
    <div class="panel-body">
        <div class="row">
            <div class="col-md-12">
                <form method="POST" onsubmit="return validasi(this)">
                    <div class="form-group">
                        <label>NIS</label>
                        <input class="form-control" name="nis" id="nis" />
                    </div>

                    <div class="form-group">
                        <label>Nama</label>
                        <input class="form-control" name="nama" id="nama" />
                    </div>

                    <div class="form-group">
                        <label>Tempat Lahir</label>
                        <input class="form-control" name="tmpt_lahir" id="tmpt_lahir" />
                    </div>

                    <div class="form-group">
                        <label>Tanggal Lahir</label>
                        <input class="form-control" type="date" name="tgl_lahir" id="tgl_lahir" />
                    </div>

                    <div class="form-group">
                        <label>Jenis Kelamin</label><br/>
                        <label class="radio-inline">
                            <input type="radio" name="jk" value="l"> Laki-laki
                        </label>
                        <label class="radio-inline">
                            <input type="radio" name="jk" value="p"> Perempuan
                        </label>
                    </div>

                    <div class="form-group">
                        <label>Kelas</label>
                        <select class="form-control" name="kelas" id="kelas">
                            <option value="">== Pilih Kelas ==</option>
                            <option value="I">I</option>
                            <option value="II">II</option>
                            <option value="III">III</option>
                            <option value="IV">IV</option>
                            <option value="V">V</option>
                            <option value="VI">VI</option>
                        </select>
                    </div>

                    <div>
                        <input type="submit" name="simpan" value="Simpan" class="btn btn-primary">
                    </div>
                </form>
            </div>
        </div>
    </div>  
</div>

<?php
if (isset($_POST['simpan'])) {
    $nis = $_POST['nis'];
    $nama = $_POST['nama'];
    $tmpt_lahir = $_POST['tmpt_lahir'];
    $tgl_lahir = $_POST['tgl_lahir'];
    $jk = $_POST['jk'];
    $kelas = $_POST['kelas'];

    $sql = $koneksi->query("INSERT INTO tb_anggota (nis, nama, tempat_lahir, tgl_lahir, jk, kelas) 
                            VALUES ('$nis', '$nama', '$tmpt_lahir', '$tgl_lahir', '$jk', '$kelas')");

    if ($sql) {
        echo "<script>
            alert('Data Berhasil Disimpan');
            window.location.href='?page=anggota';
        </script>";
    } else {
        echo "<script>
            alert('Data Gagal Disimpan');
        </script>";
    }
}
?>
