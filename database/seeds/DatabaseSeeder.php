<?php

use Illuminate\Database\Seeder;
use App\Models\Institution;
use App\Models\Competition;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('CompetitionSeeder');
        $this->call('InstitutionSeeder');
    }
}

class CompetitionSeeder extends Seeder {
    public function run()
    {
        Competition::create([
            'competition_name' => 'Business IT',
            'competition_description' => ''
        ]);

        Competition::create([
            'competition_name' => 'Game',
            'competition_description' => ''
        ]);

        Competition::create([
            'competition_name' => 'App Innovation',
            'competition_description' => ''
        ]);

        Competition::create([
            'competition_name' => 'Programming',
            'competition_description' => ''
        ]);

        Competition::create([
            'competition_name' => 'Smart Device',
            'competition_description' => ''
        ]);

        Competition::create([
            'competition_name' => 'CTF',
            'competition_description' => ''
        ]);
    }
}

class InstitutionSeeder extends Seeder {
    
    public function run()
    {
        Institution::create( [
            'institution_id'=>1,
            'institution_name'=>'Universitas Syiah Kuala, Banda Aceh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>2,
            'institution_name'=>'Universitas Malikussaleh, Lhokseumawe\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>3,
            'institution_name'=>'Politeknik Negeri Lhokseumawe, Lhokseumawe\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>4,
            'institution_name'=>'Politeknik Negeri Aceh, Banda Aceh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>5,
            'institution_name'=>'Universitas Samudra, Langsa\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>6,
            'institution_name'=>'Universitas Teuku Umar, Meulaboh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>7,
            'institution_name'=>'Politeknik Aceh, Banda Aceh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>8,
            'institution_name'=>'UIN Ar-Raniry, Banda Aceh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>9,
            'institution_name'=>'STAIN Malikussaleh, Lhokseumawe\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>10,
            'institution_name'=>'STAIN Zawiyah Cot Kala, Langsa\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>11,
            'institution_name'=>'Akademi Komunitas Negeri (AKN) Aceh Barat Daya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>12,
            'institution_name'=>'STAIN Gajah Putih Takengon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>13,
            'institution_name'=>'IAIN Langsa, Langsa\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>14,
            'institution_name'=>'STAIN Malikussaleh, Lhokseumawe\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>15,
            'institution_name'=>'STAIN Gajah Putih Takengon, Takengon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>16,
            'institution_name'=>'STAIN Teungku Dirundeng, Melabuh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>17,
            'institution_name'=>'Politeknik Kesehatan Banda Aceh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>18,
            'institution_name'=>'Universitas Serambi Mekkah\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>19,
            'institution_name'=>'Universitas Sumatera Utara, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>20,
            'institution_name'=>'Universitas Negeri Medan, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>21,
            'institution_name'=>'Politeknik Negeri Medan, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>22,
            'institution_name'=>'Politeknik Negeri Media Kreatif, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>23,
            'institution_name'=>'Institut Agama Islam Negeri Sumatera utara, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>24,
            'institution_name'=>'Poltekes Depkes Medan, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>25,
            'institution_name'=>'STAIN Padang Sidempuan, Padang Sidempuan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>26,
            'institution_name'=>'UIN Sumatera Utara, Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>27,
            'institution_name'=>'IAIN Padang Sidempuan, Tapanuli Selatan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>28,
            'institution_name'=>'Akademi Teknik Keselamatan Penerbangan (ATKP) Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>29,
            'institution_name'=>'Sekolah Tinggi Agama Kristen Protestan Negeri Tarutung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>30,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>31,
            'institution_name'=>'Politeknik Negeri Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>32,
            'institution_name'=>'kademi Tek. Kes. Penerbangan (ATKP), Medan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>33,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian Medan \r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>34,
            'institution_name'=>'Universitas Andalas, Padang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>35,
            'institution_name'=>'Universitas Negeri Padang, Padang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>36,
            'institution_name'=>'Politeknik Negeri Padang, Padang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>37,
            'institution_name'=>'Politeknik Pertanian, Payakumbuh\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>38,
            'institution_name'=>'STSI (Sekolah Tinggi Seni Indonesia Padang Panjang), Padang Panjang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>39,
            'institution_name'=>'IAIN Imam Bonjol, Padang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>40,
            'institution_name'=>'STAIN Batusangkar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>41,
            'institution_name'=>'STAIN Bukittinggi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>42,
            'institution_name'=>'ISI Padang Panjang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>43,
            'institution_name'=>'IAIN Imam Bonjol, Padang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>44,
            'institution_name'=>'STAIN Sjech M. Djamil Djambek , Bukittinggi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>45,
            'institution_name'=>'Politeknik Negeri Sriwijaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>46,
            'institution_name'=>'Universitas Riau, Pekanbaru\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>47,
            'institution_name'=>'UIN Sultan Syarif Kasim (SUSKA), Pekanbaru\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>48,
            'institution_name'=>'Politeknik Negeri Bengkalis\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>49,
            'institution_name'=>'Universitas Maritim Raja Ali Haji\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>50,
            'institution_name'=>'Politeknik Negeri Batam\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>51,
            'institution_name'=>'UIN Sultan Syarif Kasim, Riau\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>52,
            'institution_name'=>'STAIN Bengkalis, Riau (Riau)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>53,
            'institution_name'=>'Universitas Jambi, Jambi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>54,
            'institution_name'=>'STAIN Kerinci\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>55,
            'institution_name'=>'IAIN Sultan Thaha Saifuddin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>56,
            'institution_name'=>'Politeknik Kesehatan Jambi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>57,
            'institution_name'=>'Universitas Bengkulu, Bengkulu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>58,
            'institution_name'=>'IAIN Bengkulu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>59,
            'institution_name'=>'STAIN CURUP\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>60,
            'institution_name'=>'Poltekkes Kemenkes Bengkulu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>61,
            'institution_name'=>'STAIN Curup, Rejang Lebong\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>62,
            'institution_name'=>'Universitas Sriwijaya, Palembang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>63,
            'institution_name'=>'Politeknik Negeri Sriwijaya, Palembang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>64,
            'institution_name'=>'Poltekkes depkes Palembang, Palembang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>65,
            'institution_name'=>'Akademi Komunitas Negeri Prabumulih, Prabumulih\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>66,
            'institution_name'=>'IAIN Raden Fatah\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>67,
            'institution_name'=>'Universitas Lampung, Bandar Lampung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>68,
            'institution_name'=>'Politeknik Negeri Lampung, Bandar Lampung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>69,
            'institution_name'=>'Poltekkes Kemenkes Tanjungkarang, Bandar Lampung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>70,
            'institution_name'=>'STIM (Sekolah Tinggi Olahraga Metro), Kota Metro\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>71,
            'institution_name'=>'Institut Agama Islam Negeri Raden Intan, Bandar Lampung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>72,
            'institution_name'=>'STAIN Jurai Siwo Metro\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>73,
            'institution_name'=>'IAIN Raden Intan, Bandar Lampung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>74,
            'institution_name'=>'Universitas Bangka Belitung, Bangka Belitung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>75,
            'institution_name'=>'Politeknik Manufaktur, Bangka Belitung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>76,
            'institution_name'=>'Poltekkes Kemenkes Pangkal Pinang, Bangka Belitung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>77,
            'institution_name'=>'STAIN Syekh Abdurrahman Siddik, Bangka Belitung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>78,
            'institution_name'=>'Universitas Sultan Ageng Tirtayasa, Serang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>79,
            'institution_name'=>'Perguruan Tinggi Buddhi, Karawaci\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>80,
            'institution_name'=>'IAIN Sultan Maulana Hasanuddin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>81,
            'institution_name'=>'Universitas Pendidikan Indonesia, Kampus Daerah Serang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>82,
            'institution_name'=>'Universitas Terbuka Pondok Cabe\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>83,
            'institution_name'=>'Sekolah Tinggi Agama Buddha Negeri Sriwijaya Tangerang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>84,
            'institution_name'=>'Akademi Meteorologi dan Geofisika (AMG) Tangerang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>85,
            'institution_name'=>'Institut Agama Islam Banten (IAIB)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>86,
            'institution_name'=>'Universitas Indonesia\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>87,
            'institution_name'=>'Universitas Pertahanan Indonesia (UNHAN)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>88,
            'institution_name'=>'Universitas Negeri Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>89,
            'institution_name'=>'Universitas Terbuka\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>90,
            'institution_name'=>'Politeknik Negeri Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>91,
            'institution_name'=>'Politeknik Negeri Media Kreatif, Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>92,
            'institution_name'=>'UIN Syarif Hidayatullah Jakartaâ€Ž\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>93,
            'institution_name'=>'Sekolah Tinggi Ilmu Pelayaran Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>94,
            'institution_name'=>'Sekolah Tinggi Manajemen Industri Indonesia\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>95,
            'institution_name'=>'Akademi Pimpinan Perusahaan (APP), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>96,
            'institution_name'=>'Institut Ilmu Pemerintahan, IIP, Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>97,
            'institution_name'=>'Sekolah Tinggi Akuntansi Negara, STAN\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>98,
            'institution_name'=>'Sekolah Tinggi Hukum Militer, STHM\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>99,
            'institution_name'=>'Sekolah Tinggi Ilmu Administrasi, LAN Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>100,
            'institution_name'=>'Sekolah Tinggi Ilmu Kepolisian (PTIK), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>101,
            'institution_name'=>'Sekolah Tinggi Ilmu Pelayaran (STIP), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>102,
            'institution_name'=>'Sekolah Tinggi Ilmu Statistik (STIS), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>103,
            'institution_name'=>'Sekolah Tinggi Manajemen Industri(STMI), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>104,
            'institution_name'=>'Sekolah Tinggi Penerbangan Indonesia (PI), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>105,
            'institution_name'=>'Sekolah Tinggi Perikanan (STP), Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>106,
            'institution_name'=>'Politeknik Kesehatan Jakarta I   \r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>107,
            'institution_name'=>'Politeknik Kesehatan Jakarta II\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>108,
            'institution_name'=>'Politeknik Negeri Jakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>109,
            'institution_name'=>'Politeknik Manufaktur Negeri Bandung, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>110,
            'institution_name'=>'Universitas Pendidikan Indonesia, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>111,
            'institution_name'=>'Universitas Padjadjaran, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>112,
            'institution_name'=>'Universitas Jenderal Achmad Yani, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>113,
            'institution_name'=>'Institut Pertanian Bogor, Bogor\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>114,
            'institution_name'=>'Institut Teknologi Bandung, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>115,
            'institution_name'=>'Politeknik Negeri Bandung, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>116,
            'institution_name'=>'Politeknik Indramayu, Indramayu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>117,
            'institution_name'=>'Universitas Siliwangi (UNSIL), Tasikmalaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>118,
            'institution_name'=>'niversitas Singaperbangsa (UNSIKA), Kampus Daerah Karawang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>119,
            'institution_name'=>'Universitas Swadaya Gunung Jati (Unswagati) di Kota Cirebon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>120,
            'institution_name'=>'Universitas Pendidikan Indonesia, Kampus Daerah Cibiru\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>121,
            'institution_name'=>'Universitas Pendidikan Indonesia, Kampus Daerah Tasikmalaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>122,
            'institution_name'=>'Universitas Pendidikan Indonesia, Kampus Daerah Sumedang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>123,
            'institution_name'=>'Universitas Pendidikan Indonesia, Kampus Daerah Purwakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>124,
            'institution_name'=>'Akademi Ilmu Pemasyarakatan (AKIP), Depok\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>125,
            'institution_name'=>'Akademi Imigrasi (AIM) Depok\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>126,
            'institution_name'=>'Akademi Kimia Analis (AKA) Bogor\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>127,
            'institution_name'=>'Sekolah Tinggi Ilmu Administrasi, Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>128,
            'institution_name'=>'Sekolah Tinggi Sandi Negara (STSN), Bogor\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>129,
            'institution_name'=>'Sekolah Tinggi Seni Indonesia (STSI), Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>130,
            'institution_name'=>'Sekolah Tinggi Transportasi Darat (STTD), Bekasi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>131,
            'institution_name'=>'Sekolah Tinggi Kesejahteraan Sosial (STKS), Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>132,
            'institution_name'=>'Sekolah Tinggi Pemerintahan Dalam Negeri (STPDN), Sumedang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>133,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Bogor\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>134,
            'institution_name'=>'STAIN Cirebon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>135,
            'institution_name'=>'Politeknik Kesehatan Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>136,
            'institution_name'=>'Politeknik Manufaktur Bandung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>137,
            'institution_name'=>'Politeknik Negeri Bali, Badung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>138,
            'institution_name'=>'Universitas Diponegoro, Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>139,
            'institution_name'=>'Universitas Negeri Semarang, Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>140,
            'institution_name'=>'Universitas Jenderal Soedirman, Purwokerto\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>141,
            'institution_name'=>'Universitas Negeri Surakarta Sebelas Maret, Surakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>142,
            'institution_name'=>'Politeknik Negeri Semarang, Semarang \r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>143,
            'institution_name'=>'Politeknik Maritim Negeri Indonesia, Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>144,
            'institution_name'=>'Institut Seni Indonesia Surakarta, Surakarta (ISI Solo, dahulu STSI)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>145,
            'institution_name'=>'Universitas Tidar Magelang, Magelang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>146,
            'institution_name'=>'UIN Walisongo, Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>147,
            'institution_name'=>'IAIN Surakarta, Surakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>148,
            'institution_name'=>'STAIN Kudus, Kudus\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>149,
            'institution_name'=>'STAIN Pekalongan, Pekalongan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>150,
            'institution_name'=>'IAIN Salatiga, Salatiga\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>151,
            'institution_name'=>'IAIN Purwokerto, Purwokerto\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>152,
            'institution_name'=>'Akademi Kepolisian (AKPOL),Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>153,
            'institution_name'=>'Akademi Militer (AKMIL) TNI AD, Magelang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>154,
            'institution_name'=>'Akademi Minyak dan Gas Bumi (AKAMIGAS), Blora\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>155,
            'institution_name'=>'Akademi Sanitasi dan Kesehatan Lingkungan (ASKK), Purwokerto\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>156,
            'institution_name'=>'Sekolah Tinggi Seni Indonesia (STSI), Surakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>157,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Magelang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>158,
            'institution_name'=>'Politeknik Ilmu Pelayaran Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>159,
            'institution_name'=>'Politeknik Kesehatan Semarang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>160,
            'institution_name'=>'Politeknik Kesehatan Surakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>161,
            'institution_name'=>'Universitas Gadjah Mada\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>162,
            'institution_name'=>'Universitas Negeri Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>163,
            'institution_name'=>'Institut Seni Indonesia Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>164,
            'institution_name'=>'Universita Terbuka  UPBJJ Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>165,
            'institution_name'=>'Akademi Teknologi Kulit Yogyakarta (ATK)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>166,
            'institution_name'=>'Universitas Pembangunan Nasional Veteran (UPN), Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>167,
            'institution_name'=>'UIN Sunan Kalijaga\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>168,
            'institution_name'=>'Akademi Angkatan Udara (AAU), Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>169,
            'institution_name'=>'Sekolah Tinggi Pertanahan Nasional (STPN), Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>170,
            'institution_name'=>'Sekolah Tinggi Teknologi Nuklir (STTN), Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>171,
            'institution_name'=>'Politeknik Kesehatan Yogyakarta\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>172,
            'institution_name'=>'Universitas Airlangga, Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>173,
            'institution_name'=>'Universitas Negeri Surabaya, Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>174,
            'institution_name'=>'Universitas Brawijaya, Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>175,
            'institution_name'=>'Universitas Negeri Malang, Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>176,
            'institution_name'=>'Universitas Jember, Jember\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>177,
            'institution_name'=>'Universitas Trunojoyo, Bangkalan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>178,
            'institution_name'=>'Politeknik Elektronika Negeri Surabaya, Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>179,
            'institution_name'=>'Politeknik Perkapalan Negeri Surabaya, Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>180,
            'institution_name'=>'Politeknik Negeri Madura, Sampang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>181,
            'institution_name'=>'Politeknik Negeri Malang, Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>182,
            'institution_name'=>'Politeknik Negeri Madiun, Madiun\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>183,
            'institution_name'=>'Politeknik Negeri Jember, Jember\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>184,
            'institution_name'=>'Institut Teknologi Sepuluh Nopember, Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>185,
            'institution_name'=>'Akademi Komunitas Negeri, Bojonegoro\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>186,
            'institution_name'=>'Akademi Komunitas Negeri, Pacitan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>187,
            'institution_name'=>'Universitas Pembangunan Nasional Veteran (UPN), Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>188,
            'institution_name'=>'Politeknik Negeri Banyuwangi, Banyuwangi\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>189,
            'institution_name'=>'Akademi Komunitas Negeri Lamongan, Lamongan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>190,
            'institution_name'=>'Akademi Komunitas Negeri Sumenep. Sumenep\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>191,
            'institution_name'=>'Akademi Komunitas Negeri Bojonegoro, Bojonegoro\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>192,
            'institution_name'=>'Universitas Islam Negeri Maulana Malik Ibrahim, Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>193,
            'institution_name'=>'STAIN Kediri\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>194,
            'institution_name'=>'STAIN Ponorogo\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>195,
            'institution_name'=>'UIN Sunan Ampel\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>196,
            'institution_name'=>'IAIN Tulungagung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>197,
            'institution_name'=>'UIN Maulana Malik Ibrahim, Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>198,
            'institution_name'=>'STAIN Pamekasan, Pamekasan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>199,
            'institution_name'=>'Akademi Angkatan Laut (AAL), Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>200,
            'institution_name'=>'Teknik Keselamatan Penerbangan (ATKP) Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>201,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>202,
            'institution_name'=>'IAIN Jember, Jember\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>203,
            'institution_name'=>'Politeknik Elektronika Negeri Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>204,
            'institution_name'=>'Politeknik Kesehatan Malang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>205,
            'institution_name'=>'Politeknik Kesehatan Surabaya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>206,
            'institution_name'=>'Politeknik Pertanian Negeri Jember\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>207,
            'institution_name'=>'Akademi TKP â€“ Surabaya \r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>208,
            'institution_name'=>'Universitas Mataram, Mataram\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>209,
            'institution_name'=>'IAIN Mataram, Lombok\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>210,
            'institution_name'=>'Sekolah Tinggi Agama Hindu Negeri (STAHN) Gde Puja, Mataram\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>211,
            'institution_name'=>'Universitas Nusa Cendana, Kupang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>212,
            'institution_name'=>'Politeknik Negeri Kupang, Kupang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>213,
            'institution_name'=>'Politeknik Pertanian Negeri Kupang, Kupang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>214,
            'institution_name'=>'Universitas Udayana, Denpasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>215,
            'institution_name'=>'Universitas Pendidikan Ganesha, Singaraja\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>216,
            'institution_name'=>'Politeknik Negeri Bali, Kuta-Badung\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>217,
            'institution_name'=>'Institut Seni Indonesia Denpasar, Denpasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>218,
            'institution_name'=>'Politeknik Negeri Tanah Lot\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>219,
            'institution_name'=>'Institut Hindu Dharma Negeri (IHDN) Denpasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>220,
            'institution_name'=>'Akademi Kebidanan Pemprov Bali singaraja\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>221,
            'institution_name'=>'Sekolah Tinggi Pariwisata Bali\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>222,
            'institution_name'=>'Sekolah Tinggi Agama Kristen Negeri (STAKN) Denpasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>223,
            'institution_name'=>'Politeknik Kesehatan Denpasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>224,
            'institution_name'=>'Universitas Tanjungpura, Pontianak\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>225,
            'institution_name'=>'Politeknik Negeri Pontianak, Pontianak\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>226,
            'institution_name'=>'Politeknik Kesehatan Kementerian Kesehatan, Pontianak\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>227,
            'institution_name'=>'Politeknik Terpikat Sambas\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>228,
            'institution_name'=>'Politeknik Tonggak Equator\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>229,
            'institution_name'=>'Politeknik Ketapang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>230,
            'institution_name'=>'Politeknik Tunas Bangsa\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>231,
            'institution_name'=>'IAIN Pontianak sebelumnya STAIN Pontianak\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>232,
            'institution_name'=>'Universitas Palangka Raya, Palangka Raya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>233,
            'institution_name'=>'IAIN Palangkaraya, Palangkaraya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>234,
            'institution_name'=>'Sekolah Tinggi Agama Hindu Negeri Tampung Peyang, Palangka Raya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>235,
            'institution_name'=>'Sekolah Tinggi Agama Kristen Negeri (STAKN) Palangkaraya\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>236,
            'institution_name'=>'Universitas Lambung Mangkurat, Banjarmasin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>237,
            'institution_name'=>'Politeknik Negeri Banjarmasin, Banjarmasin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>238,
            'institution_name'=>'IAIN ANTASARI, Banjarmasin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>239,
            'institution_name'=>'Poltekkes Banjarmasin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>240,
            'institution_name'=>'Ooliteknik Pertanian Negeri Samarinda\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>241,
            'institution_name'=>'Universitas Mulawarman, Samarinda\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>242,
            'institution_name'=>'Politeknik Negeri Samarinda, Samarinda\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>243,
            'institution_name'=>'Politeknik Pertanian Negeri Samarinda, Samarinda\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>244,
            'institution_name'=>'Universitas Borneo Tarakan, Tarakan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>245,
            'institution_name'=>'Politeknik Balikpapan, Balikpapan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>246,
            'institution_name'=>'IAIN Samarinda, Samarinda\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>247,
            'institution_name'=>'Universitas Borneo Tarakan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>248,
            'institution_name'=>'Universitas Sam Ratulangi, Manado\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>249,
            'institution_name'=>'Universitas Negeri Manado, Manado\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>250,
            'institution_name'=>'Politeknik Negeri Manado, Manado\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>251,
            'institution_name'=>'Politeknik Negeri Nusa Utara, Tahuna\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>252,
            'institution_name'=>'IAIN Manado, Manado (Sulawesi Utara)\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>253,
            'institution_name'=>'Politeknik Kesehatan Manado\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>254,
            'institution_name'=>'Politeknik Negeri Manado\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>255,
            'institution_name'=>'Universitas Negeri Gorontalo, Gorontalo\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>256,
            'institution_name'=>'IAIN Sultan Amai, Gorontalo\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>257,
            'institution_name'=>'Universitas Tadulako, Palu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>258,
            'institution_name'=>'Sekolah Tinggi Ilmu Ekonomi (YPP Mujahidin), Tolitoli\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>259,
            'institution_name'=>'IAIN Dato Karamau, Palu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>260,
            'institution_name'=>'STAIN Datokarama, Palu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>261,
            'institution_name'=>'Politeknik Kesehatan Kemenkes Makassar, Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>262,
            'institution_name'=>'Universitas Hasanuddin, Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>263,
            'institution_name'=>'Universitas Negeri Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>264,
            'institution_name'=>'Politeknik Pertanian Negeri Pangkajene Kepulauan, Pangkajene Kepulauan\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>265,
            'institution_name'=>'Politeknik Negeri Ujung pandang, Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>266,
            'institution_name'=>'Universitas Maiwa Enrekang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>267,
            'institution_name'=>'Politeknik Negeri Media Kreatif, Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>268,
            'institution_name'=>'Universitas Islam Negeri Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>269,
            'institution_name'=>'UIN Alauddin, Makassar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>270,
            'institution_name'=>'STAIN Watampone, Bone\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>271,
            'institution_name'=>'STAIN Parepare, Parepare\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>272,
            'institution_name'=>'IAIN Palopo, Palopo\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>273,
            'institution_name'=>'Akademi Teknik Keselamatan Penerbangan (ATKP) Makasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>274,
            'institution_name'=>'Sekolah Tinggi Ilmu Adm, Ujung Pandang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>275,
            'institution_name'=>'Sekolah Tinggi Seni Indonesia, Padang Panjang\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>276,
            'institution_name'=>'Sekolah Tinggi Agama Kristen Negeri (STAKN) Toraja\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>277,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Gowa\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>278,
            'institution_name'=>'Akademi Teknik Keselamatan Penerbangan Makasar\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>279,
            'institution_name'=>'Universitas Haluoleo, Kendari\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>280,
            'institution_name'=>'Sekolah Tinggi Pertanian (STIP) Muna Kampus Baru, Muna\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>281,
            'institution_name'=>'STAIN Kendari\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>282,
            'institution_name'=>'Universitas 19 November Kolaka\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>283,
            'institution_name'=>'Universitas Muhammadiyah Kendari\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>284,
            'institution_name'=>'Universitas Lakidende\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>285,
            'institution_name'=>'Universitas Dayanu Iksanudin\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>286,
            'institution_name'=>'Universitas Muhammadiyah Buton\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>287,
            'institution_name'=>'Universitas Sulawesi Tenggara\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>288,
            'institution_name'=>'IAIN Kendari, Palu\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>289,
            'institution_name'=>'Universitas Negeri Sulawesi Barat\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>290,
            'institution_name'=>'Universitas Pattimura, Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>291,
            'institution_name'=>'Universitas Darussalam, Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>292,
            'institution_name'=>'Politeknik Negeri Ambon, Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>293,
            'institution_name'=>'Politeknik Perikanan Negeri Tual, Tual\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>294,
            'institution_name'=>'STAKPN Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>295,
            'institution_name'=>'IAIN Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>296,
            'institution_name'=>'Sekolah Tinggi Agama Kristen Protestan Negeri Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>297,
            'institution_name'=>'STAIN Ambon\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>298,
            'institution_name'=>'Universitas Khairun, Ternate\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>299,
            'institution_name'=>'IAIN Ternate, Ternate\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>300,
            'institution_name'=>'Universitas Cendrawasih, Jayapura\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>301,
            'institution_name'=>'Universitas Musamus Merauke, Merauke\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>302,
            'institution_name'=>'STAIN Al-Fatah, Jayapura\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>303,
            'institution_name'=>'Sekolah Tinggi. Agama Kristen Negeri (STAKN) Jayapura\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>304,
            'institution_name'=>'Universitas Negeri Papua, Manokwari \r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>305,
            'institution_name'=>'STAIN Sorong, Sorong\r\n'
            ] );
                        
            Institution::create( [
            'institution_id'=>306,
            'institution_name'=>'Sekolah Tinggi Penyuluhan Pertanian (STTP) Manokwari'
            ] );
    }
}
