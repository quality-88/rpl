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
                    PUMB
                </a>
            </li>
        </ol>
    </nav>
</div>

<?php if ( $__data_mahasiswa__->Npm == FALSE ) { ?>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
            <form name="frmInput" action="<?= $__routes_mod; ?>/simpan" method="POST" enctype="multipart/form-data">

                <input type="hidden" name="__Token" class="form-control"
                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . date('YmdH') . '|\|' . time() , 221 , 5 ); ?>"
                    required readonly>

                <input type="hidden" name="__Url" class="form-control" value="<?= $__routes_mod; ?>" required readonly>

                <input type="hidden" name="__Id" class="form-control"
                    value="<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__authlogin__->Id . '|\|' . time() , 221 , 5 ); ?>"
                    required readonly>

                <div class="row invoice-add">
                    <div class="col-lg-9 col-12 mb-lg-0 mb-6">
                        <div class="card">
                            <div class="card-header">
                                <center>
                                    <img src="<?= $__universitas->__Detail_Universitas()['Logo']; ?>" alt=""
                                        class="img-fluid img-thumbnail" width="15%">
                                    <h4 class="app-brand-text demo fw-bold ms-50">
                                        <?= $__universitas->__Detail_Universitas()['Nama']; ?>
                                    </h4>
                                </center>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-lg-5 col-md-6 col-sm-12">
                                        <p class="mb-2">
                                            <strong>
                                                Pembayaran Pendaftaran Ulang
                                            </strong>
                                        </p>
                                        <p class="mb-2">
                                            <?= $__authlogin__->Nama; ?>
                                        </p>
                                        <p class="mb-2">
                                            <?= $__authlogin__->IdFakultas; ?>
                                        </p>
                                        <p class="mb-3">
                                            <?= $__helpers->HurufBesar( $__universitas->__Konversi_Prodi(['Prodi' => $__authlogin__->Prodi]) ); ?>
                                        </p>
                                    </div>
                                    <div class="col-lg-7 col-md-6 col-sm-12">
                                        <dl class="row mb-0 gx-4">
                                            <dt class="col-sm-5 mb-2 d-md-flex align-items-center justify-content-end">
                                                <span class="h5 text-capitalize mb-0 text-nowrap">
                                                    No. Pembayaran
                                                </span>
                                            </dt>
                                            <dd class="col-sm-7">
                                                <input type="text" class="form-control" disabled
                                                    placeholder="#<?= date('dmY') . rand(0,9999); ?>"
                                                    value="#<?= date('dmY') . rand(0,9999); ?>" readonly>
                                            </dd>
                                            <dt class="col-sm-5 mb-1 d-md-flex align-items-center justify-content-end">
                                                <span class="fw-normal">
                                                    Tanggal Buat
                                                </span>
                                            </dt>
                                            <dd class="col-sm-7">
                                                <input type="text" class="form-control invoice-date" disabled
                                                    placeholder="<?= date('d-m-Y H:i:s'); ?>"
                                                    value="<?= date('d-m-Y H:i:s'); ?>" readonly>
                                            </dd>
                                            <dt class="col-sm-5 d-md-flex align-items-center justify-content-end">
                                                <span class="fw-normal">
                                                    Tanggal Expired
                                                </span>
                                            </dt>
                                            <dd class="col-sm-7 mb-0">
                                                <input type="text" class="form-control due-date" disabled
                                                    placeholder="<?= $__helpers->__TambahTanggal( date('d-m-Y H:i:s') ); ?>"
                                                    value="<?= $__helpers->__TambahTanggal( date('d-m-Y H:i:s') ); ?>"
                                                    readonly>
                                            </dd>
                                        </dl>
                                    </div>
                                </div>
                                <div class="row mt-lg-4">
                                    <div class="col-lg-12 col-md-12 col-sm-12 mb-4 mb-md-0">
                                        <div class="table-responsive">
                                            <table class="datatables-order-details table table-hover border-top">
                                                <thead>
                                                    <tr>
                                                        <th class="text-center">
                                                            <strong>
                                                                Keterangan
                                                            </strong>
                                                        </th>
                                                        <th class="text-center">
                                                            <strong>
                                                                Biaya
                                                            </strong>
                                                        </th>
                                                        <th class="text-left">
                                                            <strong>
                                                                Nominal
                                                            </strong>
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td class="text-center">
                                                            BIAYA PENDAFTARAN
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__data_biaya_pmb__->Biaya + 0 ); ?>
                                                        </td>
                                                        <td class="text-left">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__data_biaya_pmb__->Biaya + 0 ); ?>
                                                        </td>
                                                    </tr>

                                                    <?php 
                                                        foreach ( $__data_biaya_alokasibiayakuliah1__ AS $data => $__alokasibiayakuliah1__) : 

                                                            $__total_biaya__ += $__alokasibiayakuliah1__->Biaya + 0;
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?= $__helpers->HurufBesar( $__alokasibiayakuliah1__->Alokasi ); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__alokasibiayakuliah1__->Biaya + 0 ); ?>
                                                        </td>
                                                        <td class="text-left">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__alokasibiayakuliah1__->Biaya + 0 ); ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>

                                                    <?php 
                                                        foreach ( $__data_biaya_alokasiper1 AS $data => $__alokasiper1__) : 

                                                            $__total_biaya__ += $__alokasiper1__->Biaya + 0;
                                                    ?>
                                                    <tr>
                                                        <td class="text-center">
                                                            <?= $__helpers->HurufBesar( $__alokasiper1__->Alokasi ); ?>
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__alokasiper1__->Biaya + 0 ); ?>
                                                        </td>
                                                        <td class="text-left">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__alokasiper1__->Biaya + 0 ); ?>
                                                        </td>
                                                    </tr>
                                                    <?php endforeach; ?>

                                                    <tr>
                                                        <td class="text-center">
                                                            BIAYA MARKETING & OPERASIONAL
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__data_biaya_rpl__->Biaya + 0 ); ?>
                                                        </td>
                                                        <td class="text-left">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__data_biaya_rpl__->Biaya + 0 ); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-warning text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            SUBTOTAL
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp.
                                                                <?= $__helpers->Uang( $__total_biaya__ + 0 ); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-info text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            DISKON
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp.
                                                                <?= $__helpers->Uang( $__diskon__ + 0 ); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-primary text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            TOTAL
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp.
                                                                <?= $__helpers->Uang( $__total_biaya__ - $__diskon__ ); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-lg-4">
                                    <div class="col-lg-12 col-md-12 col-sm-12">
                                        <div>
                                            <label class="text-heading mb-1 fw-medium">
                                                <strong>
                                                    Catatan :
                                                </strong>
                                            </label>
                                            <textarea class="form-control" rows="2" id="note" disabled
                                                placeholder="Invoice note"
                                                readonly>Harap melakukan pembayaran sesuai dengan jumlah nominal yang ada!</textarea>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 col-12 invoice-actions">
                        <div class="card mb-6">
                            <div class="card-body">
                                <button class="btn btn-primary d-grid w-100 mb-4" data-bs-toggle="offcanvas" disabled
                                    data-bs-target="#sendInvoiceOffcanvas">
                                    <span class="d-flex align-items-center justify-content-center text-nowrap">
                                        <i class="bx bx-paper-plane bx-xs me-2"></i>
                                        Cetak Pembayaran
                                    </span>
                                </button>
                                <label class="form-label">
                                    Pilih Bank Pembayaran
                                </label>
                                <select name="__Bank" class="form-select mb-6" required>
                                    <option value="" selected disabled>
                                        Bank Account
                                    </option>
                                    <option value="BRI">
                                        BRI
                                    </option>
                                    <option value="BNI" disabled>
                                        BNI
                                    </option>
                                    <option value="MANDIRI" disabled>
                                        MANDIRI
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
                                    <a href="<?= url('/homerpl/pumb/cicilan'); ?>" class="btn btn-info btn-lg">
                                        Buat Cicilan
                                    </a>
                                    <button type="button" class="btn btn-danger btn-lg" data-bs-toggle="modal"
                                        data-bs-target="#__Modal_NomorPembayaran">
                                        Buat Nomor Pembayaran
                                    </button>
                                </div>
                                <div class="modal fade" id="__Modal_NomorPembayaran" tabindex="-1" aria-hidden="true">
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
                            </div>
                        </div>
                    </div>
                </div>

                <input type="hidden" name="__Biaya" class="form-control" value="<?= $__total_biaya__ - $__diskon__; ?>"
                    required readonly>

                <input type="hidden" name="__Diskon" class="form-control" value="<?= $__diskon__; ?>" required readonly>

            </form>
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
                        <a href="<?= url('/homerpl/pumb/kwitansi?__Id=' . $__helpers->SecretEncrypt($__data_pembayaran_pumb_success__->Id)); ?>"
                            target="_Blank" class="btn btn-success deactivate-account">
                            Download Kwitansi Pembayaran
                        </a>
                        <hr>
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