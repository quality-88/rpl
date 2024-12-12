<?php


    class __Keuangan
    {
        private $__db;

        public function __construct( $db )
        {
            $this->__db = $db;
        }
        
        public function __Nomor_Debet__()
        {
            $data = [
                'Kode'  => '1-112.16',
                'Kode1' => '1-121.1',
                'Table' => 'JurnalTTSementaraD',
                'Diskon' => '4-118.5',
            ];

            return $data;
        }

        public function __Nomor_Kredit__()
        {
            $data = [
                'Kode'  => '3-110.1',
                'Kode1' => '1-121.1',
                'Table' => 'JurnalPiutMhsSppK',
                'Diskon' => '1-121.1',
            ];

            return $data;
        }

        public function __Bri_Bayar__( $__id )
        {
            $data = $this->__db->queryid(" SELECT Id_Bri_Bayar AS Id, UserId_Bri_Bayar AS UserId, Ta_Bri_Bayar AS Ta, Semester_Bri_Bayar AS Semester, InstitutionCode_Bri_Bayar AS InstitutionCode, BrivaNo_Bri_Bayar AS BrivaNo, CustCode_Bri_Bayar AS CustCode, Nama_Bri_Bayar AS Nama, Amount_Bri_Bayar AS Amount, Diskon_Bri_Bayar AS Diskon, Nominal_Bri_Bayar AS Nominal, Keterangan_Bri_Bayar AS Keterangan, StatusBayar_Bri_Bayar AS StatusBayar, AccessToken_Bri_Bayar AS AccessToken, TanggalBuat_Bri_Bayar AS TglBuat, TanggalExpired_Bri_Bayar AS TglExp, TanggalBayar_Bri_Bayar AS TglBayar, JenisBayar_Bri_Bayar AS JenisBayar, Bank_Bri_Bayar AS Bank, Tujuan_Bri_Bayar AS Tujuan, User_Bri_Bayar AS Users, Log_Bri_Bayar AS Logs, IdKampus, Kampus, KeteranganDeskripsi_Bri_Bayar AS KeteranganDesk, Deskripsi_Bri_Bayar AS Desk, NominalDeskripsi_Bri_Bayar AS NominalDesk, TotalDeskripsi_Bri_Bayar AS TotalDesk FROM Tbl_Bri_Bayar WHERE Id_Bri_Bayar = '". $__id ."' ORDER BY Id_Bri_Bayar DESC ");

            return $data;
        }

        public function __Jurnal_Piutang__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO JurnalPiutang
                            (
                                Ref, 
                                Tgl, 
                                NoUrut, 
                                Ta, 
                                Semester, 
                                Npm, 
                                Kode, 
                                Debet, 
                                Kredit, 
                                Keterangan, 
                                Status, 
                                IdKampus, 
                                Tabel, 
                                UserId, 
                                Bank
                            )
                        VALUES
                            (
                                :Ref,
                                :Tgl,
                                :NoUrut,
                                :Ta,
                                :Semester,
                                :Npm,
                                :Kode,
                                :Debet,
                                :Kredit,
                                :Keterangan,
                                :Status,
                                :IdKampus,
                                :Tabel,
                                :UserId,
                                :Bank
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Success_Bri_Bayar__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        UPDATE Tbl_Bri_Bayar SET
                            StatusBayar_Bri_Bayar       = :Y,
                            TanggalBayar_Bri_Bayar      = :TanggalBayar_Bri_Bayar,
                            User_Bri_Bayar              = :User_Bri_Bayar,
                            Log_Bri_Bayar               = :Log_Bri_Bayar
                        WHERE Id_Bri_Bayar              = :Id_Bri_Bayar
                        AND UserId_Bri_Bayar            = :UserId_Bri_Bayar
                        AND Ta_Bri_Bayar                = :Ta_Bri_Bayar
                        AND Semester_Bri_Bayar          = :Semester_Bri_Bayar
                        AND CustCode_Bri_Bayar          = :CustCode_Bri_Bayar
                        AND StatusBayar_Bri_Bayar       = :StatusBayar_Bri_Bayar
                        AND Data                        = :Data
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_Mahasiswa__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                "
                    INSERT INTO Mahasiswa
                    (
                        Npm,
                        NpmAsal,
                        Nama,
                        TempatLahir,
                        TglMasuk,
                        TglLahir,
                        Telepon,
                        Hp,
                        Agama,
                        Warga,
                        SumberBiaya,
                        JenisKelamin,
                        Status,
                        Pindahan,
                        Alamat,
                        AlamatAsal,
                        Kecamatan,
                        KecamatanAsal,
                        Kabupaten,
                        KabupatenAsal,
                        LoginUsername,
                        LoginPassword,
                        EmailMahasiswa,
                        NoPeserta,
                        Kurikulum,
                        IdKampus,
                        Idfakultas,
                        Prodi,
                        Stambuk,
                        Semester,
                        SemesterTipe,
                        Ta,
                        Spp,
                        LunasSpp,
                        TotalSks,
                        MaxSks,
                        Cuti,
                        UserId,
                        InputDate,
                        LastUpdate,
                        UpdateUserId,
                        AccPiutangAwal,
                        AccPiutang,
                        AccPenerimaan,
                        AccPendapatan,
                        JenisSekolah,
                        NamaSekolah,
                        AlamatSekolah,
                        KecamatanSekolah,
                        KabupatenSekolah,
                        PropinsiSekolah,
                        JurusanSekolah,
                        NoIjazah,
                        Nem,
                        TglIjazah,
                        NamaAyah,
                        NamaIbu,
                        AlamatOrtu,
                        KecamatanOrtu,
                        KabupatenOrtu,
                        PropinsiOrtu,
                        PekerjaanOrtu,
                        PenghasilanOrtu,
                        FormulirPmb,
                        FormulirIjazah,
                        FormulirAkteLahir,
                        FormulirIdentitas,
                        PasFoto4x6,
                        PasFoto2x3,
                        PtAsal,
                        SksSelesai,
                        NoVoucher,
                        Printed,
                        IdMahasiswa,
                        UkuranJaket,
                        IdDosen,
                        TipeKelas,
                        StatusMhs,
                        SkStatusMhs,
                        TglSkStatusMhs,
                        SmtNow,
                        NpmBaru,
                        NilaiSkripsi,
                        JudulSkripsi,
                        IdDosenSkripsi,
                        IdDosenSkripsi2,
                        IdDosenPenguji1,
                        IdDosenPenguji2,
                        IdDosenPenguji3,
                        TglMejaHijau,
                        TglLulusMh,
                        Bekerja,
                        AlamatKerja,
                        KecamatanKerja,
                        KabupatenKerja,
                        Hobi,
                        TglSkripsi2,
                        TglAccJudul,
                        NamaOutput,
                        ProdiAsal,
                        KdPtAsal,
                        KdProdiAsal,
                        IdLembaga,
                        IdMkSkripsi,
                        KodePos,
                        IdWil,
                        Universitas,
                        Id_Reg_Pd,
                        Id_Pd,
                        MingguKe,
                        HeaderMingguTotal,
                        BulanKe,
                        StatusMinggu,
                        StatusMahasiswa,
                        KetStatus,
                        ThnLulusMejaHijau,
                        MahasiswaKip,
                        ProdiAsal2
                    )
                    VALUES
                    (
                        :Npm,
                        :NpmAsal,
                        :Nama,
                        :TempatLahir,
                        :TglMasuk,
                        :TglLahir,
                        :Telepon,
                        :Hp,
                        :Agama,
                        :Warga,
                        :SumberBiaya,
                        :JenisKelamin,
                        :Status,
                        :Pindahan,
                        :Alamat,
                        :AlamatAsal,
                        :Kecamatan,
                        :KecamatanAsal,
                        :Kabupaten,
                        :KabupatenAsal,
                        :LoginUsername,
                        :LoginPassword,
                        :EmailMahasiswa,
                        :NoPeserta,
                        :Kurikulum,
                        :IdKampus,
                        :Idfakultas,
                        :Prodi,
                        :Stambuk,
                        :Semester,
                        :SemesterTipe,
                        :Ta,
                        :Spp,
                        :LunasSpp,
                        :TotalSks,
                        :MaxSks,
                        :Cuti,
                        :UserId,
                        :InputDate,
                        :LastUpdate,
                        :UpdateUserId,
                        :AccPiutangAwal,
                        :AccPiutang,
                        :AccPenerimaan,
                        :AccPendapatan,
                        :JenisSekolah,
                        :NamaSekolah,
                        :AlamatSekolah,
                        :KecamatanSekolah,
                        :KabupatenSekolah,
                        :PropinsiSekolah,
                        :JurusanSekolah,
                        :NoIjazah,
                        :Nem,
                        :TglIjazah,
                        :NamaAyah,
                        :NamaIbu,
                        :AlamatOrtu,
                        :KecamatanOrtu,
                        :KabupatenOrtu,
                        :PropinsiOrtu,
                        :PekerjaanOrtu,
                        :PenghasilanOrtu,
                        :FormulirPmb,
                        :FormulirIjazah,
                        :FormulirAkteLahir,
                        :FormulirIdentitas,
                        :PasFoto4x6,
                        :PasFoto2x3,
                        :PtAsal,
                        :SksSelesai,
                        :NoVoucher,
                        :Printed,
                        :IdMahasiswa,
                        :UkuranJaket,
                        :IdDosen,
                        :TipeKelas,
                        :StatusMhs,
                        :SkStatusMhs,
                        :TglSkStatusMhs,
                        :SmtNow,
                        :NpmBaru,
                        :NilaiSkripsi,
                        :JudulSkripsi,
                        :IdDosenSkripsi,
                        :IdDosenSkripsi2,
                        :IdDosenPenguji1,
                        :IdDosenPenguji2,
                        :IdDosenPenguji3,
                        :TglMejaHijau,
                        :TglLulusMh,
                        :Bekerja,
                        :AlamatKerja,
                        :KecamatanKerja,
                        :KabupatenKerja,
                        :Hobi,
                        :TglSkripsi2,
                        :TglAccJudul,
                        :NamaOutput,
                        :ProdiAsal,
                        :KdPtAsal,
                        :KdProdiAsal,
                        :IdLembaga,
                        :IdMkSkripsi,
                        :KodePos,
                        :IdWil,
                        :Universitas,
                        :Id_Reg_Pd,
                        :Id_Pd,
                        :MingguKe,
                        :HeaderMingguTotal,
                        :BulanKe,
                        :StatusMinggu,
                        :StatusMahasiswa,
                        :KetStatus,
                        :ThnLulusMejaHijau,
                        :MahasiswaKip,
                        :ProdiAsal2
                    )
                "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_MhsKrsJadwalDetail__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO MhsKRSJadwalDetail
                        (
                            Npm,
                            IdKampus,
                            IdFakultas,
                            Prodi,
                            Kurikulum,
                            Ta,
                            Semester,
                            ItemNo,
                            Hari,
                            IdMk,
                            IdRuang,
                            JamMasuk,
                            JamKeluar,
                            Sks,
                            Kelas,
                            UserId,
                            Validasi
                        )
                        VALUES
                        (
                            :Npm,
                            :IdKampus,
                            :IdFakultas,
                            :Prodi,
                            :Kurikulum,
                            :Ta,
                            :Semester,
                            :ItemNo,
                            :Hari,
                            :IdMk,
                            :IdRuang,
                            :JamMasuk,
                            :JamKeluar,
                            :Sks,
                            :Kelas,
                            :UserId,
                            :Validasi
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_MhsKrsDetail__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO MhsKRSDetail
                        (
                            Npm,
                            Ta,
                            Semester,
                            Kurikulum,
                            IdKampus,
                            IdFakultas,
                            Prodi,
                            ItemNo,
                            IdMk,
                            Sks,
                            UserId,
                            Universitas
                        )
                        VALUES
                        (
                            :Npm,
                            :Ta,
                            :Semester,
                            :Kurikulum,
                            :IdKampus,
                            :IdFakultas,
                            :Prodi,
                            :ItemNo,
                            :IdMk,
                            :Sks,
                            :UserId,
                            :Universitas
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_KrsDetail__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO KRSDetail
                        (
                            NPM, TA, SEMESTER, KURIKULUM, IDKAMPUS, IDFAKULTAS, PRODI, ITEMNO, IDMK, SKS, USERID, KELAS, IDRUANG, JAM1, JAM2, HARI
                        )
                        (
                            SELECT NPM, TA, SEMESTER, KURIKULUM, IDKAMPUS, IDFAKULTAS, PRODI, ITEMNO, IDMK, SKS, USERID, KELAS, IDRUANG, JAMMASUK, JAMKELUAR, HARI 
                            FROM MhsKrsJadwalDetail
                            WHERE Npm       = :Npm 
                            AND IdKampus    = :IdKampus
                            AND IdFakultas  = :IdFakultas
                            AND Ta          = :Ta
                            AND Semester    = :Semester
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_KrsAlokasiBiayaKuliah__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO KRSAlokasiBiayaKuliah
                        (
                            Npm,
                            Ta,
                            Semester,
                            Kurikulum,
                            IdKampus,
                            IdFakultas,
                            Prodi,
                            ItemNo,
                            Alokasi,
                            AccountPendapatan,
                            AccDebet,
                            Jumlah,
                            UserId
                        )
                        VALUES
                        (
                            :Npm,
                            :Ta,
                            :Semester,
                            :Kurikulum,
                            :IdKampus,
                            :IdFakultas,
                            :Prodi,
                            :ItemNo,
                            :Alokasi,
                            :AccountPendapatan,
                            :AccDebet,
                            :Jumlah,
                            :UserId
                        )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Jurnal_Piutang_1__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO JurnalPiutang
                        (
                            Ref, Tgl, NoUrut, Ta, Semester, Npm, Kode, Debet, Kredit, Keterangan, Status, Tabel, UserId, IdKampus, Bank
                        )
                        SELECT 
                            '". $data['Npm'] .".". $data['Ta'] . $data['Semester'] ."' AS Ref, 
                            '". date('Y-m-d') ."' AS Tgl,
                            1 AS NoUrut,
                            '". $data['Ta'] ."' AS Ta,
                            '". $data['Semester'] ."' AS Semester, 
                            '". $data['Npm'] ."' AS Npm,
                            AccPendapatan AS Kode,
                            0 AS Debet, 
                            Nominal AS Kredit,
                            Alokasi AS Keterangan,
                            'I' AS Status,
                            'JurnalPiutMhsSppK' AS Tabel,
                            '". $data['Npm'] ."' AS UserId, 
                            '". $data['IdKampus'] ."' AS IdKampus, 
                            '". $data['Bank'] ."' AS Bank 
                        FROM AlokasiBiayaKuliah1 
                        WHERE Stambuk   = '". $data['Stambuk'] ."' 
                        AND TipeKelas   = '". $data['TipeKelas'] ."' 
                        AND Ta          = '". $data['Ta'] ."' 
                        AND IdKampus    = '". $data['IdKampus'] ."' 
                        AND IdFakultas  = '". $data['IdFakultas'] ."' 
                        AND Prodi       = '". $data['Prodi'] ."'
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_MhsKrsTempSpp__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO MhsKRSTempSPP
                        (
                            Npm, Ta, Semester, IdKampus, IdFakultas, Prodi, TipeKelas, Alokasi, Biaya, UserId, ItemNo
                        )
                        SELECT 
                            '". $data['Npm'] ."' AS Npm,
                            '". $data['Ta'] ."' AS Ta,
                            '". $data['Semester'] ."' AS Semester,
                            '". $data['IdKampus'] ."' AS IdKampus,
                            '". $data['IdFakultas'] ."' AS IdFakultas,
                            '". $data['Prodi'] ."' AS Prodi,
                            '". $data['TipeKelas'] ."' AS TipeKelas,
                            Alokasi,
                            Nominal AS Biaya,
                            '". $data['Npm'] ."' AS UserId,
                            ItemNo
                        FROM AlokasiPer1 
                        WHERE Stambuk   = '". $data['Stambuk'] ."' 
                        AND TipeKelas   = '". $data['TipeKelas'] ."' 
                        AND Ta          = '". $data['Ta'] ."' 
                        AND IdKampus    = '". $data['IdKampus'] ."' 
                        AND IdFakultas  = '". $data['IdFakultas'] ."' 
                        AND Prodi       = '". $data['Prodi'] ."'
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_KrsAlokasiPer__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO KrsAlokasiPer
                        (
                            Npm, Ta, Semester, Kurikulum, IdKampus, IdFakultas, Prodi, ItemNo, Alokasi, AccPendapatan, AccDebet, Nominal, UserId
                        )
                        SELECT 
                            '". $data['Npm'] ."' AS Npm,
                            '". $data['Ta'] ."' AS Ta,
                            '". $data['Semester'] ."' AS Semester,
                            '". $data['Kurikulum'] ."' AS Kurikulum,
                            '". $data['IdKampus'] ."' AS IdKampus,
                            '". $data['IdFakultas'] ."' AS IdFakultas,
                            '". $data['Prodi'] ."' AS Prodi,
                            ItemNo,
                            Alokasi,
                            AccPendapatan,
                            AccDebet,
                            Nominal,
                            '". $data['Npm'] ."' AS UserId
                        FROM AlokasiPer1 
                        WHERE Stambuk   = '". $data['Stambuk'] ."' 
                        AND TipeKelas   = '". $data['TipeKelas'] ."' 
                        AND Ta          = '". $data['Ta'] ."' 
                        AND IdKampus    = '". $data['IdKampus'] ."' 
                        AND IdFakultas  = '". $data['IdFakultas'] ."' 
                        AND Prodi       = '". $data['Prodi'] ."'
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_JurnalPiutang_2__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO JurnalPiutang
                        (
                            Ref, Tgl, NoUrut, Ta, Semester, Npm, Kode, Debet, Kredit, Keterangan, Status, Tabel, UserId, IdKampus, Bank
                        )
                        SELECT 
                            '". $data['Npm'] .".". $data['Ta'] . $data['Semester'] ."' AS Ref, 
                            '". date('Y-m-d') ." 00:00:00.000' AS Tgl,
                            1 AS NoUrut,
                            ". $data['Ta'] ." AS Ta,
                            ". $data['Semester'] ." AS Semester, 
                            ". $data['Npm'] ." AS Npm,
                            AccPendapatan AS Kode,
                            0 AS Debet, 
                            Nominal AS Kredit,
                            Alokasi AS Keterangan,
                            'I' AS Status,
                            'JurnalPiutMhsPerK' AS Tabel,
                            ". $data['Npm'] ." AS UserId, 
                            '". $data['IdKampus'] ."' AS IdKampus, 
                            ". $data['Bank'] ." AS Bank 
                        FROM AlokasiPer1 
                        WHERE Stambuk   = '". $data['Stambuk'] ."' 
                        AND TipeKelas   = '". $data['TipeKelas'] ."' 
                        AND Ta          = '". $data['Ta'] ."' 
                        AND IdKampus    = '". $data['IdKampus'] ."' 
                        AND IdFakultas  = '". $data['IdFakultas'] ."' 
                        AND Prodi       = '". $data['Prodi'] ."'
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_Spptrans__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO SPPTrans
                            (
                                NoTT,
                                NoBuktiBank,
                                Npm, 
                                Tgl,
                                ItemNo, 
                                KodeTrans,
                                Jumlah, 
                                UserId
                            )
                        VALUES
                            (
                                :NoTT,
                                :NoBuktiBank,
                                :Npm, 
                                :Tgl,
                                :ItemNo, 
                                :KodeTrans,
                                :Jumlah, 
                                :UserId
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_TtBuktiSetoran__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO TTBUKTISETORAN
                            (
                                NoBuktiBank, 
                                NoTT, 
                                Npm,
                                Tgl, 
                                TglSetor, 
                                Bank,
                                Jumlah, 
                                AccBank, 
                                UserId,
                                InputDate, 
                                LastUpdate, 
                                UpdateUserId,
                                Printed, 
                                SksDiambil, 
                                Semester,
                                Ta, 
                                Kurikulum, 
                                Prodi,
                                IdFakultas, 
                                Beasiswa, 
                                NoVoucher,
                                TglVoucher, 
                                JumlahSetor, 
                                AccDebet,
                                AccKredit, 
                                NoSeri, 
                                JumlahCash,
                                JumlahVoucher, 
                                Keterangan, 
                                Idk,
                                DiscCash, 
                                DiscBank, 
                                JumlahRedeemVoucher,
                                Discount, 
                                BayarPiutangSks, 
                                bayarPiutangBpp,
                                BayarPiutangBpu, 
                                BayarPiutangKemahasiswaan, 
                                BayarPiutangJacket,
                                BayarPiutangKtm, 
                                BayarPiutangLeges, 
                                BayarPiutangLain,
                                BayarPiutangWisuda, 
                                BayarPiutangPkl, 
                                BayarPiutangMejaHijau, 
                                BayarPiutangUjian,
                                BayarPiutangCuti
                            )
                        VALUES
                            (
                                :NoBuktiBank, 
                                :NoTT, 
                                :Npm,
                                :Tgl, 
                                :TglSetor, 
                                :Bank,
                                :Jumlah, 
                                :AccBank, 
                                :UserId,
                                :InputDate, 
                                :LastUpdate, 
                                :UpdateUserId,
                                :Printed, 
                                :SksDiambil, 
                                :Semester,
                                :Ta, 
                                :Kurikulum, 
                                :Prodi,
                                :IdFakultas, 
                                :Beasiswa, 
                                :NoVoucher,
                                :TglVoucher, 
                                :JumlahSetor, 
                                :AccDebet,
                                :AccKredit, 
                                :NoSeri, 
                                :JumlahCash,
                                :JumlahVoucher, 
                                :Keterangan, 
                                :Idk,
                                :DiscCash, 
                                :DiscBank, 
                                :JumlahRedeemVoucher,
                                :Discount, 
                                :BayarPiutangSks, 
                                :BayarPiutangBpp,
                                :BayarPiutangBpu, 
                                :BayarPiutangKemahasiswaan, 
                                :BayarPiutangJacket,
                                :BayarPiutangKtm, 
                                :BayarPiutangLeges, 
                                :BayarPiutangLain,
                                :BayarPiutangWisuda, 
                                :BayarPiutangPkl, 
                                :BayarPiutangMejaHijau, 
                                :BayarPiutangUjian,
                                :BayarPiutangCuti
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }

        public function __Insert_Krs__( array $data )
        {
            try {

                $__sql = $this->__db->prepare( 
                    "
                        INSERT INTO Krs
                            (
                                Npm,
                                Tgl,
                                Ta,
                                Semester,
                                NoReferensi,
                                IdKampus,
                                IdFakultas,
                                Prodi,
                                Kurikulum,
                                Total,
                                MaxSks,
                                TotalSks,
                                TotalSksAdjust,
                                PerSks,
                                TotalSpp,
                                SksPaket,
                                SksOptional,
                                IdDosen,
                                JenisKrs,
                                BiayaKk,
                                ChkExtra,
                                UangUjian,
                                Cuti,
                                TipeKelas,
                                StatusMhs,
                                Sks_Kumulatif,
                                Ip_Kumulatif,
                                KrsKe,
                                DiscountKrs,
                                PiutangSks,
                                PiutangBpu,
                                PiutangBpp,
                                PiutangKemahasiswaan,
                                PiutangJacket,
                                PiutangKtm,
                                PiutangLeges,
                                PiutangLain,
                                PiutangWisuda,
                                PiutangPkl,
                                PiutangMejaHijau,
                                PiutangUjian,
                                BayarPiutangSks,
                                BayarPiutangBpu,
                                BayarPiutangBpp,
                                BayarPiutangKemahasiswaan,
                                BayarPiutangJacket,
                                BayarPiutangKtm,
                                BayarPiutangLeges,
                                BayarPiutangLain,
                                BayarPiutangWisuda,
                                BayarPiutangPkl,
                                BayarPiutangMejaHijau,
                                BayarPiutangUjian,
                                JumlahSetor,
                                JumlahCash,
                                JumlahVoucher,
                                DiscCash,
                                DiscBank,
                                JumlahRedeemVoucher,
                                Discount,
                                IpMhs,
                                AccountDiscount,
                                StatusPersen,
                                PiutangUs,
                                BayarPiutangUs,
                                PiutangUpn,
                                BayarPiutangUpn,
                                PiutangDiksar,
                                BayarDiksar
                            )
                        VALUES
                            (
                                :Npm,
                                :Tgl,
                                :Ta,
                                :Semester,
                                :NoReferensi,
                                :IdKampus,
                                :IdFakultas,
                                :Prodi,
                                :Kurikulum,
                                :Total,
                                :MaxSks,
                                :TotalSks,
                                :TotalSksAdjust,
                                :PerSks,
                                :TotalSpp,
                                :SksPaket,
                                :SksOptional,
                                :IdDosen,
                                :JenisKrs,
                                :BiayaKk,
                                :ChkExtra,
                                :UangUjian,
                                :Cuti,
                                :TipeKelas,
                                :StatusMhs,
                                :Sks_Kumulatif,
                                :Ip_Kumulatif,
                                :KrsKe,
                                :DiscountKrs,
                                :PiutangSks,
                                :PiutangBpu,
                                :PiutangBpp,
                                :PiutangKemahasiswaan,
                                :PiutangJacket,
                                :PiutangKtm,
                                :PiutangLeges,
                                :PiutangLain,
                                :PiutangWisuda,
                                :PiutangPkl,
                                :PiutangMejaHijau,
                                :PiutangUjian,
                                :BayarPiutangSks,
                                :BayarPiutangBpu,
                                :BayarPiutangBpp,
                                :BayarPiutangKemahasiswaan,
                                :BayarPiutangJacket,
                                :BayarPiutangKtm,
                                :BayarPiutangLeges,
                                :BayarPiutangLain,
                                :BayarPiutangWisuda,
                                :BayarPiutangPkl,
                                :BayarPiutangMejaHijau,
                                :BayarPiutangUjian,
                                :JumlahSetor,
                                :JumlahCash,
                                :JumlahVoucher,
                                :DiscCash,
                                :DiscBank,
                                :JumlahRedeemVoucher,
                                :Discount,
                                :IpMhs,
                                :AccountDiscount,
                                :StatusPersen,
                                :PiutangUs,
                                :BayarPiutangUs,
                                :PiutangUpn,
                                :BayarPiutangUpn,
                                :PiutangDiksar,
                                :BayarDiksar
                            )
                    "
                ) -> execute ( $data );
                
                return ['Error' => '000'];

            } catch ( PDOException $e ) {
                
                return ['Error' => '999'];

            }
        }
    }