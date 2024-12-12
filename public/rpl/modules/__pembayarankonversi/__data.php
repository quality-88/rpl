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
                    Pembayaran Biaya Konversi
                </a>
            </li>
        </ol>
    </nav>
</div>
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

                <input type="hidden" name="__Biaya" class="form-control"
                    value="<?= $__record_data_biayakonversi__->Biaya + 0; ?>" required readonly>

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
                                                Pembayaran Biaya Konversi
                                            </strong>
                                        </p>
                                        <p class="mb-2">
                                            <?= $__authlogin__->Nama; ?>
                                        </p>
                                        <p class="mb-2">
                                            <?= $__authlogin__->IdFakultas; ?> - <?= $__authlogin__->Prodi; ?>
                                        </p>
                                        <p class="mb-3">
                                            <?= $__authlogin__->IdKampus; ?> - <?= $__authlogin__->NamaKampus; ?>
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
                                                    placeholder="<?= date('d-m-Y H:i:s'); ?>"
                                                    value="<?= date('d-m-Y H:i:s'); ?>" readonly>
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
                                                            Biaya Konversi
                                                        </td>
                                                        <td class="text-center">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__record_data_biayakonversi__->Biaya + 0 ); ?>
                                                        </td>
                                                        <td class="text-left">
                                                            Rp.
                                                            <?= $__helpers->Uang( $__record_data_biayakonversi__->Biaya + 0 ); ?>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-warning text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            Subtotal
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp.
                                                                <?= $__helpers->Uang( $__record_data_biayakonversi__->Biaya + 0 ); ?>
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-info text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            Diskon
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp. 0
                                                            </strong>
                                                        </td>
                                                    </tr>
                                                    <tr class="bg-primary text-white">
                                                        <td class="text-center"></td>
                                                        <td class="text-center">
                                                            Total
                                                        </td>
                                                        <td class="text-left">
                                                            <strong>
                                                                Rp.
                                                                <?= $__helpers->Uang( $__record_data_biayakonversi__->Biaya + 0 ); ?>
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
                                    <option value="BNI">
                                        BNI
                                    </option>
                                </select>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12">
                                <div class="d-grid gap-2 col-lg-12 mx-auto">
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
            </form>
        </div>
    </div>
</div>