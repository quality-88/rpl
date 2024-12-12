<div class="container-xxl">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="<?= $__routes; ?>">
                    <i class="bx bx-home-circle fs-4 lh-0"></i>
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= url('/homerpl/pembayarankonversi'); ?>">
                    Pembayaran Biaya Konversi
                </a>
            </li>
            <li class="breadcrumb-item active">
                <a href="<?= $__routes_mod; ?>">
                    Sukses Pembayaran
                </a>
            </li>
        </ol>
    </nav>
</div>
<div class="container-xxl">
    <div class="row mb-4">
        <div class="col-xl-12 col-md-12 col-sm-12 mb-4 mb-md-0">
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
                                                placeholder="#<?= $__data_pembayaran__->BrivaNo . $__data_pembayaran__->CustCode; ?>"
                                                value="#<?= $__data_pembayaran__->BrivaNo . $__data_pembayaran__->CustCode; ?>"
                                                readonly>
                                        </dd>
                                        <dt class="col-sm-5 mb-1 d-md-flex align-items-center justify-content-end">
                                            <span class="fw-normal">
                                                Tanggal Bayar
                                            </span>
                                        </dt>
                                        <dd class="col-sm-7">
                                            <input type="text" class="form-control invoice-date" disabled
                                                placeholder="<?= $__helpers->TanggalWaktu( $__data_pembayaran__->TglBayar ); ?>"
                                                value="<?= $__helpers->TanggalWaktu( $__data_pembayaran__->TglBayar ); ?>"
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
                                                        <?= $__data_pembayaran__->Keterangan; ?>
                                                    </td>
                                                    <td class="text-center">
                                                        Rp.
                                                        <?= $__helpers->Uang( $__data_pembayaran__->Amount + 0 ); ?>
                                                    </td>
                                                    <td class="text-left">
                                                        Rp.
                                                        <?= $__helpers->Uang( $__data_pembayaran__->Amount + 0 ); ?>
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
                                                            <?= $__helpers->Uang( $__data_pembayaran__->Amount + 0 ); ?>
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
                                                            <?= $__helpers->Uang( $__data_pembayaran__->Amount + 0 ); ?>
                                                        </strong>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-12 invoice-actions">
                    <div class="card mb-6">
                        <div class="card-body">
                            <a href="<?= $__routes_mod; ?>/pdf?__Id=<?= @$__secret_key->Encrypt( date('sHis') . '|\|' . $__data_pembayaran__->Id . '|\|' . time() , 221 , 5 ); ?>"
                                target="_Blank" class="btn btn-primary d-grid w-100 mb-4">
                                <span class="d-flex align-items-center justify-content-center text-nowrap">
                                    <i class="bx bx-paper-plane bx-xs me-2"></i>
                                    Cetak Pembayaran
                                </span>
                            </a>
                            <label class="form-label">
                                Bank Pembayaran
                            </label>
                            <br>
                            <strong>
                                <?= $__data_pembayaran__->Bank; ?>
                                <br>
                                <span class="badge bg-label-success">
                                    SUKSES BAYAR
                                </span>
                            </strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>