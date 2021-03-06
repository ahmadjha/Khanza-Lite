<?php
    namespace Plugins\Master;

    use Systems\AdminModule;
    use Plugins\Master\Src\Dokter;
    use Plugins\Master\Src\Petugas;
    use Plugins\Master\Src\Poliklinik;
    use Plugins\Master\Src\Bangsal;
    use Plugins\Master\Src\Kamar;
    use Plugins\Master\Src\DataBarang;
    use Plugins\Master\Src\JnsPerawatan;
    use Plugins\Master\Src\JnsPerawatanInap;
    use Plugins\Master\Src\JnsPerawatanLab;
    use Plugins\Master\Src\JnsPerawatanRadiologi;
    use Plugins\Master\Src\Bahasa;
    use Plugins\Master\Src\Cacat;
    use Plugins\Master\Src\Suku;
    use Plugins\Master\Src\Perusahaan;
    use Plugins\Master\Src\Penjab;
    use Plugins\Master\Src\GolonganBarang;
    use Systems\Lib\Fpdf\PDF_MC_Table;

    class Admin extends AdminModule
    {

        public function init()
        {
            $this->dokter = new Dokter();
            $this->petugas = new Petugas();
            $this->poliklinik = new Poliklinik();
            $this->bangsal = new Bangsal();
            $this->kamar = new Kamar();
            $this->databarang = new DataBarang();
            $this->jnsperawatan = new JnsPerawatan();
            $this->jnsperawataninap = new JnsPerawatanInap();
            $this->jnsperawatanlab = new JnsPerawatanLab();
            $this->jnsperawatanradiologi = new JnsPerawatanRadiologi();
            $this->bahasa = new Bahasa();
            $this->cacat = new Cacat();
            $this->suku = new Suku();
            $this->perusahaan = new Perusahaan();
            $this->penjab = new Penjab();
            $this->golonganbarang = new GolonganBarang();
        }

        public function navigation()
        {
            return [
                'Manage' => 'manage',
                'Dokter' => 'dokter',
                'Petugas' => 'petugas',
                'Poliklinik' => 'poliklinik',
                'Bangsal' => 'bangsal',
                'Kamar' => 'kamar',
                'Data Barang' => 'databarang',
                'Perawatan Ralan' => 'jnsperawatan',
                'Perawatan Ranap' => 'jnsperawataninap',
                'Perawatan Laboratorium' => 'jnsperawatanlab',
                'Perawatan Radiologi' => 'jnsperawatanradiologi',
                'Bahasa' => 'bahasa',
                'Cacat Fisik' => 'cacat',
                'Suku Bangsa' => 'suku',
                'Perusahaan Pasien' => 'perusahaan',
                'Penanggung Jawab' => 'penjab',
                'Golongan Barang' => 'golonganbarang',
                'Industri Farmasi' => 'industrifarmasi',
                'Jenis Barang' => 'jenisbarang',
                'Kategori Barang' => 'kategoribarang',
                'Kategori Penyakit' => 'kategoripenyakit',
                'Kategori Perawatan' => 'kategoriperawatan',
                'Kode Satuan' => 'kodesatuan',
                'Master Aturan Pakai' => 'masteraturanpakai',
                'Master Berkas Digital' => 'masterberkasdigital',
                'Spesialis' => 'spesialis',
                'Bank' => 'bank',
                'Bidang' => 'bidang',
                'Departemen' => 'departemen',
                'Emergency Index' => 'emergencyindex',
                'Jabatan' => 'jabatan',
                'Jenjang Jabatan' => 'jenjangjabatan',
                'Kelompok Jabatan' => 'kelompokjabatan',
                'Pendidikan' => 'pendidikan',
                'Resiko Kerja' => 'resikokerja',
                'Status Kerja' => 'statuskerja',
                'Status WP' => 'statuswajibpajak',
            ];
        }

        public function getManage()
        {
          $sub_modules = [
            ['name' => 'Dokter', 'url' => url([ADMIN, 'master', 'dokter']), 'icon' => 'cubes', 'desc' => 'Master dokter'],
            ['name' => 'Petugas', 'url' => url([ADMIN, 'master', 'petugas']), 'icon' => 'cubes', 'desc' => 'Master petugas'],
            ['name' => 'Poliklinik', 'url' => url([ADMIN, 'master', 'poliklinik']), 'icon' => 'cubes', 'desc' => 'Master poliklinik'],
            ['name' => 'Bangsal', 'url' => url([ADMIN, 'master', 'bangsal']), 'icon' => 'cubes', 'desc' => 'Master bangsal'],
            ['name' => 'Kamar', 'url' => url([ADMIN, 'master', 'kamar']), 'icon' => 'cubes', 'desc' => 'Master kamar'],
            ['name' => 'Data Barang', 'url' => url([ADMIN, 'master', 'databarang']), 'icon' => 'cubes', 'desc' => 'Master data barang'],
            ['name' => 'Perawatan Rawat Jalan', 'url' => url([ADMIN, 'master', 'jnsperawatan']), 'icon' => 'cubes', 'desc' => 'Master jenis perawatan rawat jalan'],
            ['name' => 'Perawatan Rawat Inap', 'url' => url([ADMIN, 'master', 'jnsperawataninap']), 'icon' => 'cubes', 'desc' => 'Master jenis perawatan rawat inap'],
            ['name' => 'Perawatan Laboratorium', 'url' => url([ADMIN, 'master', 'jnsperawatanlab']), 'icon' => 'cubes', 'desc' => 'Master jenis perawatan laboratorium'],
            ['name' => 'Perawatan Radiologi', 'url' => url([ADMIN, 'master', 'jnsperawatanradiologi']), 'icon' => 'cubes', 'desc' => 'Master jenis perawatan radiologi'],
            ['name' => 'Bahasa', 'url' => url([ADMIN, 'master', 'bahasa']), 'icon' => 'cubes', 'desc' => 'Master bahasa'],
            ['name' => 'Cacat Fisik', 'url' => url([ADMIN, 'master', 'cacat']), 'icon' => 'cubes', 'desc' => 'Master cacat fisik'],
            ['name' => 'Suku Bangsa', 'url' => url([ADMIN, 'master', 'suku']), 'icon' => 'cubes', 'desc' => 'Master suku bangsa'],
            ['name' => 'Perusahaan Pasien', 'url' => url([ADMIN, 'master', 'perusahaan']), 'icon' => 'cubes', 'desc' => 'Master perusahaan pasien'],
            ['name' => 'Penanggung Jawab', 'url' => url([ADMIN, 'master', 'penjab']), 'icon' => 'cubes', 'desc' => 'Master penanggung jawab'],
            ['name' => 'Golongan Barang', 'url' => url([ADMIN, 'master', 'golonganbarang']), 'icon' => 'cubes', 'desc' => 'Master golongan barang'],
            ['name' => 'Industri Farmasi', 'url' => url([ADMIN, 'master', 'industrifarmasi']), 'icon' => 'cubes', 'desc' => 'Master industri farmasi'],
            ['name' => 'Jenis Barang', 'url' => url([ADMIN, 'master', 'dokter']), 'icon' => 'cubes', 'desc' => 'Master dokter'],
            ['name' => 'Kategori Barang', 'url' => url([ADMIN, 'master', 'kategoribarang']), 'icon' => 'cubes', 'desc' => 'Master kategori barang'],
            ['name' => 'Kategori Penyakit', 'url' => url([ADMIN, 'master', 'kategoripenyakit']), 'icon' => 'cubes', 'desc' => 'Master kategori penyakit'],
            ['name' => 'Kategori Perawatan', 'url' => url([ADMIN, 'master', 'kategoriperawatan']), 'icon' => 'cubes', 'desc' => 'Master kategori perawatan'],
            ['name' => 'Kode Satuan', 'url' => url([ADMIN, 'master', 'kodesatuan']), 'icon' => 'cubes', 'desc' => 'Master kode satuan'],
            ['name' => 'Master Aturan Pakai', 'url' => url([ADMIN, 'master', 'masteraturanpakai']), 'icon' => 'cubes', 'desc' => 'Master master aturan pakai'],
            ['name' => 'Master Berkas Digital', 'url' => url([ADMIN, 'master', 'masterberkasdigital']), 'icon' => 'cubes', 'desc' => 'Master berkas digital'],
            ['name' => 'Spesialis', 'url' => url([ADMIN, 'master', 'spesialis']), 'icon' => 'cubes', 'desc' => 'Master spesialis'],
            ['name' => 'Bank', 'url' => url([ADMIN, 'master', 'bank']), 'icon' => 'cubes', 'desc' => 'Master bank'],
            ['name' => 'Bidang', 'url' => url([ADMIN, 'master', 'bidang']), 'icon' => 'cubes', 'desc' => 'Master bidang'],
            ['name' => 'Departemen', 'url' => url([ADMIN, 'master', 'departemen']), 'icon' => 'cubes', 'desc' => 'Master departemen'],
            ['name' => 'Emergency Index', 'url' => url([ADMIN, 'master', 'emergencyindex']), 'icon' => 'cubes', 'desc' => 'Master emergency index'],
            ['name' => 'Jabatan', 'url' => url([ADMIN, 'master', 'jabatan']), 'icon' => 'cubes', 'desc' => 'Master jabatan'],
            ['name' => 'Jenjang Jabatan', 'url' => url([ADMIN, 'master', 'jenjangjabatan']), 'icon' => 'cubes', 'desc' => 'Master jenjang jabatan'],
            ['name' => 'Kelompok Jabatan', 'url' => url([ADMIN, 'master', 'kelompokjabatan']), 'icon' => 'cubes', 'desc' => 'Master kelompok jabatan'],
            ['name' => 'Pendidikan', 'url' => url([ADMIN, 'master', 'pendidikan']), 'icon' => 'cubes', 'desc' => 'Master pendidikan'],
            ['name' => 'Resiko Kerja', 'url' => url([ADMIN, 'master', 'resikokerja']), 'icon' => 'cubes', 'desc' => 'Master resiko kerja'],
            ['name' => 'Status Kerja', 'url' => url([ADMIN, 'master', 'statuskerja']), 'icon' => 'cubes', 'desc' => 'Master status kerja'],
            ['name' => 'Status Wajib Pajak', 'url' => url([ADMIN, 'master', 'statuswajibpajak']), 'icon' => 'cubes', 'desc' => 'Master status wajib pajak'],
          ];
          return $this->draw('manage.html', ['sub_modules' => $sub_modules]);
        }

        /* Start Dokter Section */
        public function getDokter()
        {
          $this->_addHeaderFiles();
          $this->core->addJS(url([ADMIN, 'master', 'dokterjs']), 'footer');
          $return = $this->dokter->getIndex();
          return $this->draw('dokter.html', [
            'dokter' => $return
          ]);

        }

        public function anyDokterForm()
        {
            $return = $this->dokter->anyForm();
            echo $this->draw('dokter.form.html', ['dokter' => $return]);
            exit();
        }

        public function anyDokterDisplay()
        {
            $return = $this->dokter->anyDisplay();
            echo $this->draw('dokter.display.html', ['dokter' => $return]);
            exit();
        }

        public function postDokterSave()
        {
          $this->dokter->postSave();
          exit();
        }

        public function postDokterHapus()
        {
          $this->dokter->postHapus();
          exit();
        }

        public function getDokterJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/dokter.js');
            exit();
        }
        /* End Dokter Section */

        /* Start Petugas Section */
        public function getPetugas()
        {
          $this->_addHeaderFiles();
          $this->core->addJS(url([ADMIN, 'master', 'petugasjs']), 'footer');
          $return = $this->petugas->getIndex();
          return $this->draw('petugas.html', [
            'petugas' => $return
          ]);

        }

        public function anyPetugasForm()
        {
            $return = $this->petugas->anyForm();
            echo $this->draw('petugas.form.html', ['petugas' => $return]);
            exit();
        }

        public function anyPetugasDisplay()
        {
            $return = $this->petugas->anyDisplay();
            echo $this->draw('petugas.display.html', ['petugas' => $return]);
            exit();
        }

        public function postPetugasSave()
        {
          $this->petugas->postSave();
          exit();
        }

        public function postPetugasHapus()
        {
          $this->petugas->postHapus();
          exit();
        }

        public function getPetugasJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/petugas.js');
            exit();
        }
        /* End Petugas Section */

        /* Start Poliklinik Section */
        public function getPoliklinik()
        {
          $this->_addHeaderFiles();
          $this->core->addJS(url([ADMIN, 'master', 'poliklinikjs']), 'footer');
          $return = $this->poliklinik->getIndex();
          return $this->draw('poliklinik.html', [
            'poliklinik' => $return
          ]);

        }

        public function anyPoliklinikForm()
        {
            $return = $this->poliklinik->anyForm();
            echo $this->draw('poliklinik.form.html', ['poliklinik' => $return]);
            exit();
        }

        public function anyPoliklinikDisplay()
        {
            $return = $this->poliklinik->anyDisplay();
            echo $this->draw('poliklinik.display.html', ['poliklinik' => $return]);
            exit();
        }

        public function postPoliklinikSave()
        {
          $this->poliklinik->postSave();
          exit();
        }

        public function postPoliklinikHapus()
        {
          $this->poliklinik->postHapus();
          exit();
        }

        public function getPoliklinikJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/poliklinik.js');
            exit();
        }
        /* End Poliklinik Section */

        /* Start Bangsal Section */
        public function getBangsal()
        {
          $this->_addHeaderFiles();
          $this->core->addJS(url([ADMIN, 'master', 'bangsaljs']), 'footer');
          $return = $this->bangsal->getIndex();
          return $this->draw('bangsal.html', [
            'bangsal' => $return
          ]);

        }

        public function anyBangsalForm()
        {
            $return = $this->bangsal->anyForm();
            echo $this->draw('bangsal.form.html', ['bangsal' => $return]);
            exit();
        }

        public function anyBangsalDisplay()
        {
            $return = $this->bangsal->anyDisplay();
            echo $this->draw('bangsal.display.html', ['bangsal' => $return]);
            exit();
        }

        public function postBangsalSave()
        {
          $this->bangsal->postSave();
          exit();
        }

        public function postBangsalHapus()
        {
          $this->bangsal->postHapus();
          exit();
        }

        public function getBangsalJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/bangsal.js');
            exit();
        }
        /* End Bangsal Section */

        /* Start Kamar Section */
        public function getKamar()
        {
          $this->core->addJS(url([ADMIN, 'master', 'kamarjs']), 'footer');
          $return = $this->kamar->getIndex();
          return $this->draw('kamar.html', [
            'kamar' => $return
          ]);

        }

        public function anyKamarForm()
        {
            $return = $this->kamar->anyForm();
            echo $this->draw('kamar.form.html', ['kamar' => $return]);
            exit();
        }

        public function anyKamarDisplay()
        {
            $return = $this->kamar->anyDisplay();
            echo $this->draw('kamar.display.html', ['kamar' => $return]);
            exit();
        }

        public function postKamarSave()
        {
          $this->kamar->postSave();
          exit();
        }

        public function postKamarHapus()
        {
          $this->kamar->postHapus();
          exit();
        }

        public function getKamarJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/kamar.js');
            exit();
        }
        /* End Kamar Section */

        /* Start DataBarang Section */
        public function getDataBarang()
        {
          $this->_addHeaderFiles();
          $this->core->addJS(url([ADMIN, 'master', 'databarangjs']), 'footer');
          $return = $this->databarang->getIndex();
          return $this->draw('databarang.html', [
            'databarang' => $return
          ]);

        }

        public function anyDataBarangForm()
        {
            $return = $this->databarang->anyForm();
            echo $this->draw('databarang.form.html', ['databarang' => $return]);
            exit();
        }

        public function anyDataBarangDisplay()
        {
            $return = $this->databarang->anyDisplay();
            echo $this->draw('databarang.display.html', ['databarang' => $return]);
            exit();
        }

        public function postDataBarangSave()
        {
          $this->databarang->postSave();
          exit();
        }

        public function postDataBarangHapus()
        {
          $this->databarang->postHapus();
          exit();
        }

        public function getDataBarangJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/databarang.js');
            exit();
        }
        /* End DataBarang Section */

        /* Start JnsPerawatan Section */
        public function getJnsPerawatan()
        {
          $this->core->addJS(url([ADMIN, 'master', 'jnsperawatanjs']), 'footer');
          $return = $this->jnsperawatan->getIndex();
          return $this->draw('jnsperawatan.html', [
            'jnsperawatan' => $return
          ]);

        }

        public function anyJnsPerawatanForm()
        {
            $return = $this->jnsperawatan->anyForm();
            echo $this->draw('jnsperawatan.form.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function anyJnsPerawatanDisplay()
        {
            $return = $this->jnsperawatan->anyDisplay();
            echo $this->draw('jnsperawatan.display.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function postJnsPerawatanSave()
        {
          $this->jnsperawatan->postSave();
          exit();
        }

        public function postJnsPerawatanHapus()
        {
          $this->jnsperawatan->postHapus();
          exit();
        }

        public function getJnsPerawatanJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/jnsperawatan.js');
            exit();
        }
        /* End JnsPerawatan Section */

        /* Start JnsPerawatanInap Section */
        public function getJnsPerawatanInap()
        {
          $this->core->addJS(url([ADMIN, 'master', 'jnsperawataninapjs']), 'footer');
          $return = $this->jnsperawataninap->getIndex();
          return $this->draw('jnsperawataninap.html', [
            'jnsperawatan' => $return
          ]);

        }

        public function anyJnsPerawatanInapForm()
        {
            $return = $this->jnsperawataninap->anyForm();
            echo $this->draw('jnsperawataninap.form.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function anyJnsPerawatanInapDisplay()
        {
            $return = $this->jnsperawataninap->anyDisplay();
            echo $this->draw('jnsperawataninap.display.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function postJnsPerawatanInapSave()
        {
          $this->jnsperawataninap->postSave();
          exit();
        }

        public function postJnsPerawatanInapHapus()
        {
          $this->jnsperawataninap->postHapus();
          exit();
        }

        public function getJnsPerawatanInapJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/jnsperawataninap.js');
            exit();
        }
        /* End JnsPerawatanInap Section */

        /* Start JnsPerawatanLab Section */
        public function getJnsPerawatanLab()
        {
          $this->core->addJS(url([ADMIN, 'master', 'jnsperawatanlabjs']), 'footer');
          $return = $this->jnsperawatanlab->getIndex();
          return $this->draw('jnsperawatanlab.html', [
            'jnsperawatan' => $return
          ]);

        }

        public function anyJnsPerawatanLabForm()
        {
            $return = $this->jnsperawatanlab->anyForm();
            echo $this->draw('jnsperawatanlab.form.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function anyTemplateLaboratorium()
        {
            $return = $this->jnsperawatanlab->anyTemplateLaboratorium();
            echo $this->draw('jnsperawatanlab.template.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function anyJnsPerawatanLabDisplay()
        {
            $return = $this->jnsperawatanlab->anyDisplay();
            echo $this->draw('jnsperawatanlab.display.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function postJnsPerawatanLabSave()
        {
          $this->jnsperawatanlab->postSave();
          exit();
        }

        public function postJnsPerawatanLabHapus()
        {
          $this->jnsperawatanlab->postHapus();
          exit();
        }

        public function anyTemplateLaboratoriumForm($kd_jenis_prw)
        {
          echo $this->draw('jnsperawatanlab.template.form.html', ['kd_jenis_prw' => $kd_jenis_prw]);
          exit();
        }

        public function postJnsPerawatanLabTemplateSave()
        {
          $this->db('template_laboratorium')->save($_POST);
          exit();
        }

        public function postJnsPerawatanLabTemplateHapus()
        {
          $this->db('template_laboratorium')->where('id_template', $_POST['id_template'])->delete();
          exit();
        }

        public function getJnsPerawatanLabJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/jnsperawatanlab.js');
            exit();
        }
        /* End JnsPerawatanLab Section */

        /* Start JnsPerawatanRadiologi Section */
        public function getJnsPerawatanRadiologi()
        {
          $this->core->addJS(url([ADMIN, 'master', 'jnsperawatanradiologijs']), 'footer');
          $return = $this->jnsperawatanradiologi->getIndex();
          return $this->draw('jnsperawatanradiologi.html', [
            'jnsperawatan' => $return
          ]);

        }

        public function anyJnsPerawatanRadiologiForm()
        {
            $return = $this->jnsperawatanradiologi->anyForm();
            echo $this->draw('jnsperawatanradiologi.form.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function anyJnsPerawatanRadiologiDisplay()
        {
            $return = $this->jnsperawatanradiologi->anyDisplay();
            echo $this->draw('jnsperawatanradiologi.display.html', ['jnsperawatan' => $return]);
            exit();
        }

        public function postJnsPerawatanRadiologiSave()
        {
          $this->jnsperawatanradiologi->postSave();
          exit();
        }

        public function postJnsPerawatanRadiologiHapus()
        {
          $this->jnsperawatanradiologi->postHapus();
          exit();
        }

        public function getJnsPerawatanRadiologiJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/jnsperawatanradiologi.js');
            exit();
        }
        /* End JnsPerawatanRadiologi Section */

        /* Start Bahasa Section */
        public function getBahasa()
        {
          $this->core->addJS(url([ADMIN, 'master', 'bahasajs']), 'footer');
          $return = $this->bahasa->getIndex();
          return $this->draw('bahasa.html', [
            'bahasa' => $return
          ]);

        }

        public function anyBahasaForm()
        {
            $return = $this->bahasa->anyForm();
            echo $this->draw('bahasa.form.html', ['bahasa' => $return]);
            exit();
        }

        public function anyBahasaDisplay()
        {
            $return = $this->bahasa->anyDisplay();
            echo $this->draw('bahasa.display.html', ['bahasa' => $return]);
            exit();
        }

        public function postBahasaSave()
        {
          $this->bahasa->postSave();
          exit();
        }

        public function postBahasaHapus()
        {
          $this->bahasa->postHapus();
          exit();
        }

        public function getBahasaJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/bahasa.js');
            exit();
        }
        /* End Bahasa Section */

        /* Start Cacat Fisik Section */
        public function getCacat()
        {
          $this->core->addJS(url([ADMIN, 'master', 'cacatjs']), 'footer');
          $return = $this->cacat->getIndex();
          return $this->draw('cacat.html', [
            'cacat' => $return
          ]);

        }

        public function anyCacatForm()
        {
            $return = $this->cacat->anyForm();
            echo $this->draw('cacat.form.html', ['cacat' => $return]);
            exit();
        }

        public function anyCacatDisplay()
        {
            $return = $this->cacat->anyDisplay();
            echo $this->draw('cacat.display.html', ['cacat' => $return]);
            exit();
        }

        public function postCacatSave()
        {
          $this->cacat->postSave();
          exit();
        }

        public function postCacatHapus()
        {
          $this->cacat->postHapus();
          exit();
        }

        public function getCacatJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/cacat.js');
            exit();
        }
        /* End Cacat Section */

        /* Start Suku Section */
        public function getSuku()
        {
          $this->core->addJS(url([ADMIN, 'master', 'sukujs']), 'footer');
          $return = $this->suku->getIndex();
          return $this->draw('suku.html', [
            'suku' => $return
          ]);

        }

        public function anySukuForm()
        {
            $return = $this->suku->anyForm();
            echo $this->draw('suku.form.html', ['suku' => $return]);
            exit();
        }

        public function anySukuDisplay()
        {
            $return = $this->suku->anyDisplay();
            echo $this->draw('suku.display.html', ['suku' => $return]);
            exit();
        }

        public function postSukuSave()
        {
          $this->suku->postSave();
          exit();
        }

        public function postSukuHapus()
        {
          $this->suku->postHapus();
          exit();
        }

        public function getSukuJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/suku.js');
            exit();
        }
        /* End Suku Section */

        /* Start Perusahaan Section */
        public function getPerusahaan()
        {
          $this->core->addJS(url([ADMIN, 'master', 'perusahaanjs']), 'footer');
          $return = $this->perusahaan->getIndex();
          return $this->draw('perusahaan.html', [
            'perusahaan' => $return
          ]);

        }

        public function anyPerusahaanForm()
        {
            $return = $this->perusahaan->anyForm();
            echo $this->draw('perusahaan.form.html', ['perusahaan' => $return]);
            exit();
        }

        public function anyPerusahaanDisplay()
        {
            $return = $this->perusahaan->anyDisplay();
            echo $this->draw('perusahaan.display.html', ['perusahaan' => $return]);
            exit();
        }

        public function postPerusahaanSave()
        {
          $this->perusahaan->postSave();
          exit();
        }

        public function postPerusahaanHapus()
        {
          $this->perusahaan->postHapus();
          exit();
        }

        public function getPerusahaanJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/perusahaan.js');
            exit();
        }
        /* End Perusahaan Section */

        /* Start Penjab Section */
        public function getPenjab()
        {
          $this->core->addJS(url([ADMIN, 'master', 'penjabjs']), 'footer');
          $return = $this->penjab->getIndex();
          return $this->draw('penjab.html', [
            'penjab' => $return
          ]);

        }

        public function anyPenjabForm()
        {
            $return = $this->penjab->anyForm();
            echo $this->draw('penjab.form.html', ['penjab' => $return]);
            exit();
        }

        public function anyPenjabDisplay()
        {
            $return = $this->penjab->anyDisplay();
            echo $this->draw('penjab.display.html', ['penjab' => $return]);
            exit();
        }

        public function postPenjabSave()
        {
          $this->penjab->postSave();
          exit();
        }

        public function postPenjabHapus()
        {
          $this->penjab->postHapus();
          exit();
        }

        public function getPenjabJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/penjab.js');
            exit();
        }
        /* End Penjab Section */

        /* Start GolonganBarang Section */
        public function getGolonganBarang()
        {
          $this->core->addJS(url([ADMIN, 'master', 'golonganbarangjs']), 'footer');
          $return = $this->golonganbarang->getIndex();
          return $this->draw('golonganbarang.html', [
            'golonganbarang' => $return
          ]);

        }

        public function anyGolonganBarangForm()
        {
            $return = $this->golonganbarang->anyForm();
            echo $this->draw('golonganbarang.form.html', ['golonganbarang' => $return]);
            exit();
        }

        public function anyGolonganBarangDisplay()
        {
            $return = $this->golonganbarang->anyDisplay();
            echo $this->draw('golonganbarang.display.html', ['golonganbarang' => $return]);
            exit();
        }

        public function postGolonganBarangSave()
        {
          $this->golonganbarang->postSave();
          exit();
        }

        public function postGolonganBarangHapus()
        {
          $this->golonganbarang->postHapus();
          exit();
        }

        public function getGolonganBarangJS()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/golonganbarang.js');
            exit();
        }
        /* End GolonganBarang Section */

        public function getCSS()
        {
            header('Content-type: text/css');
            echo $this->draw(MODULES.'/master/css/admin/master.css');
            exit();
        }

        public function getJavascript()
        {
            header('Content-type: text/javascript');
            echo $this->draw(MODULES.'/master/js/admin/master.js');
            exit();
        }

        private function _addHeaderFiles()
        {
            // CSS
            $this->core->addCSS(url('assets/css/bootstrap-datetimepicker.css'));
            $this->core->addJS(url('assets/jscripts/moment-with-locales.js'));
            $this->core->addJS(url('assets/jscripts/bootstrap-datetimepicker.js'));

            // MODULE SCRIPTS
            $this->core->addCSS(url([ADMIN, 'master', 'css']));
            $this->core->addJS(url([ADMIN, 'master', 'javascript']), 'footer');
        }

    }
