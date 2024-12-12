<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= url('/homerpl'); ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homerpl/pumb'); ?>">
                    PUMB
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homerpl/pumb/npm'); ?>">
                    Konversi NPM
                </a>
            </li>
        </ol>
    </nav>
</div>

<?php if ( $__check_sukses_pumb__ == FALSE ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-2">
            <div class="card">
                <div class="card-header">
                    <h4>
                        Matakuliah Konversi RPL
                    </h4>
                </div>
                <div class="card-body">
                    <form name="frmInput" action="<?= url('/homerpl/pumb/npm/simpan'); ?>" method="POST"
                        enctype="multipart/form-data">

                        <input type="hidden" name="__Token" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <input type="hidden" name="__Url" class="form-control" value="<?= url('/homerpl/pumb/npm'); ?>"
                            required readonly>

                        <input type="hidden" name="__Id" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <input type="hidden" name="__Npm" class="form-control"
                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Npm . '|\|' . time() , 221 , 5 ); ?>"
                            required readonly>

                        <div class="table-responsive">
                            <table class="table table-striped table-hover" style="width:100%">
                                <thead>
                                    <tr>
                                        <th class="text-center">Nomor</th>
                                        <th class="text-center">ID Matakuliah</th>
                                        <th class="text-center">Nama Matakuliah</th>
                                        <th class="text-center">SKS</th>
                                        <th class="text-center">Tahun Ajaran</th>
                                        <th class="text-center">Prodi</th>
                                        <th class="text-center">Jam Perkuliahan</th>
                                        <th class="text-center">Kelas</th>
                                        <th class="text-center">Hari</th>
                                    </tr>
                                </thead>
                                <tbody class=" table-border-bottom-0">

                                    <?php 
                                        
                                        $__nomor__ = '1';
                                        foreach ( $__data_jadwalprimary__ AS $data => $__datas__ ) : 
                                            
                                            $__total_sks__ += $__datas__->Sks;
                                        
                                    ?>

                                    <tr>

                                        <input type="hidden" name="__IdJadwal[]" class="form-control"
                                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__datas__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                            required readonly>

                                        <td class="text-center">
                                            <?= $__nomor__++; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->IdMk; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Matakuliah; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Sks; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Ta; ?>/<?= $__datas__->Semester; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Prodi; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->JamMasuk . '<br>' . $__datas__->JamKeluar; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Kelas; ?>
                                        </td>
                                        <td class="text-center">
                                            <?= $__datas__->Hari; ?>
                                        </td>
                                    </tr>

                                    <?php endforeach; ?>

                                </tbody>
                                <tbody class=" table-border-bottom-0">
                                    <tr>
                                        <td class="text-center" colspan="3">
                                            <strong>
                                                Total SKS
                                            </strong>
                                        </td>
                                        <td class="text-center">
                                            <strong>
                                                <?= $__total_sks__; ?>
                                            </strong>
                                        </td>
                                        <td class="text-center" colspan="5"></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <hr>
                        <div class="d-grid gap-2 col-lg-12 mx-auto">
                            <button type="button" class="btn btn-primary btn-lg" data-bs-toggle="modal"
                                data-bs-target="#__Modal_Validasi__">
                                Validasi
                            </button>
                        </div>
                        <div class="modal fade" id="__Modal_Validasi__" tabindex="-1" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel1">
                                            Informasi
                                        </h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        Apakah kamu yakin dengan pilihan nomor pembayaran kamu ?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">
                                            Tutup
                                        </button>
                                        <button type="submit" class="btn btn-primary">
                                            Simpan
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <input type="hidden" name="__Sks" class="form-control" value="<?= @$__total_sks__; ?>" required
                            readonly>

                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } else { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-2">
            <div class="card">
                <h5 class="card-header">
                    Informasi Selesai PUMB RPL
                </h5>
                <div class="card-body">
                    <div class="mb-6 col-12 mb-0">
                        <div class="alert alert-warning">
                            <h5 class="alert-heading mb-1">
                                Terimakasih kamu telah selesai melakukan PUMB RPL.
                            </h5>
                            <p class="mb-0">
                                Silahkan untuk melakukan login pada aplikasi Portal Mahasiswa
                            </p>
                        </div>
                    </div>
                    <div class="mb-6 col-12 mb-0">
                        <h5>
                            NPM : <?= $__data_mahasiswa__->Npm; ?>
                            <br>
                            Pass : <?= $__data_mahasiswa__->Loginpassword; ?>
                        </h5>
                    </div>
                    <div class="d-grid gap-2 col-lg-12 mx-auto">
                        <a href="<?= $__universitas->__Url_Universitas()['Portal']; ?>" target="_Blank"
                            class="btn btn-danger deactivate-account">
                            Login Portal Mahasiswa
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php } ?>