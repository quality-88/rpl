<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= $__routes; ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>">
                    Berkas
                </a>
            </li>
        </ol>
    </nav>
</div>
<div class="container-xxl">
    <div class="row">
        <div class="col-xxl col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="nav-align-top mb-6">
                <ul class="nav nav-pills mb-4 nav-fill" role="tablist">
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod_back; ?>" class="nav-link">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-user bx-sm me-1_5 align-text-bottom"></i>
                                Berkas Penting
                            </span>
                            <i class="bx bx-user bx-sm d-sm-none"></i>
                        </a>
                    </li>
                    <li class="nav-item mb-1 mb-sm-0">
                        <a href="<?= $__routes_mod; ?>/2" class="nav-link active">
                            <span class="d-none d-sm-block">
                                <i class="tf-icons bx bx-buildings bx-sm me-1_5 align-text-bottom"></i>
                                Berkas Pendukung
                            </span>
                            <i class="bx bx-buildings bx-sm d-sm-none"></i>
                        </a>
                    </li>
                </ul>
                <div class="tab-content">
                    <div class="tab-pane fade show active" role="tabpanel">
                        <div class="row g-6 mb-4">
                            <div class="col-lg-12 col-md-12 col-sm-12 mb-2">
                                <div class="table-responsive">
                                    <table class="table table-striped text-center" id="table1">
                                        <thead>
                                            <tr>
                                                <th class="text-center">Nomor</th>
                                                <th class="text-center">Upload</th>
                                                <th class="text-center">Judul</th>
                                                <th class="text-center">Format</th>
                                                <th class="text-center">Ukuran</th>
                                                <th class="text-center">Berkas</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php 

                                                $__nomor = '1';

                                                    foreach ( $__data_keterangandokumen__ AS $data => $__berkas ) :

                                                        $__datarpl_berkas = $__db->queryid(" SELECT Id_Rpl_Pendaftaran_Berkas AS Id, Judul_Rpl_Pendaftaran_Berkas AS Judul, File_Rpl_Pendaftaran_Berkas AS Files, Format_Rpl_Pendaftaran_Berkas AS Format, Log_Rpl_Pendaftaran_Berkas AS Logs, Id_Rpl_Pendaftaran, Id_Cms_KeteranganDokumen FROM Tbl_Rpl_Pendaftaran_Berkas WHERE Id_Rpl_Pendaftaran = '". $__authlogin__->Id ."' AND Id_Cms_KeteranganDokumen = '". $__berkas->Id ."' AND Data = 'Y' ORDER BY Judul_Rpl_Pendaftaran_Berkas ASC ");

                                            ?>
                                            <tr>
                                                <td>
                                                    <?= @$__nomor++; ?>
                                                </td>
                                                <td>
                                                    <form name="frmInput" action="<?= $__routes_mod; ?>/pendukung"
                                                        method="POST" enctype="multipart/form-data">

                                                        <input type="hidden" name="__Token" class="form-control"
                                                            value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                                                            required readonly>

                                                        <input type="hidden" name="__Url" class="form-control"
                                                            value="<?= $__routes_mod; ?>" required readonly>

                                                        <input type="hidden" name="__Url_Success" class="form-control"
                                                            value="<?= $__routes_mod; ?>" required readonly>

                                                        <input type="hidden" name="__Id" class="form-control"
                                                            value="<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>"
                                                            required readonly>

                                                        <input type="hidden" name="__IdBerkas" class="form-control"
                                                            value="<?= $__helpers->SecretEncrypt( $__berkas->Id ); ?>"
                                                            required readonly>

                                                        <input type="hidden" name="__IdUpload" class="form-control"
                                                            value="<?= $__helpers->SecretEncrypt( $__datarpl_berkas->Id ); ?>"
                                                            required readonly>

                                                        <input type="file" name="__File" required
                                                            onchange="this.form.submit()">

                                                    </form>
                                                </td>
                                                <td>
                                                    <?= @$__berkas->Judul; ?>
                                                </td>
                                                <td>
                                                    <?= @$__berkas->Format; ?>
                                                </td>
                                                <td>
                                                    <?= @$__berkas->Ukuran; ?> MB
                                                </td>
                                                <td>
                                                    <?php if ( isset($__datarpl_berkas->Id) AND $__datarpl_berkas->Id == TRUE AND $__datarpl_berkas->Id_Cms_KeteranganDokumen == $__berkas->Id ) { ?>
                                                    <div>
                                                        <?php if ( $__datarpl_berkas->Format != 'URL' ) { ?>
                                                        <a href="<?= $__url_file_penunjang . $__datarpl_berkas->Files; ?>"
                                                            class="btn btn-success" target="_Blank">
                                                            Lihat
                                                        </a>
                                                        <?php } else { ?>
                                                        <a href="<?= $__datarpl_berkas->Files; ?>"
                                                            class="btn btn-danger" target="_Blank">
                                                            Lihat
                                                        </a>
                                                        <?php } ?>
                                                        <a href="#" class="btn btn-danger __session_delete_data"
                                                            data-bs-toggle="tooltip" data-bs-offset="0,4"
                                                            data-bs-placement="top" data-bs-html="true" title="Hapus"
                                                            __slugs="Apakah Yakin Untuk Hapus Data <?= $__berkas->Judul; ?> Ini ?"
                                                            __url="<?= $__routes_mod; ?>/hapus?__IdRpl=<?= $__helpers->SecretEncrypt( $__authlogin__->Id ); ?>&__IdBerkas=<?= $__helpers->SecretEncrypt( $__datarpl_berkas->Id ); ?>">
                                                            Hapus
                                                        </a>
                                                    </div>
                                                    <?php } else { ?>
                                                    <div>
                                                        <span class="text-danger">
                                                            Kosong
                                                        </span>
                                                    </div>
                                                    <?php } ?>
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
            </div>
        </div>
    </div>
</div>