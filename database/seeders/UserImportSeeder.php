<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserImportSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            ['Iin Suartini, S.Pd., M.M', 'SIMARUK010', '197308181994032001', 'Kepala Seksi Pendidikan dan Kemahasiswaan'],
            ['Yulianti Sartika, S.E.', 'SIMARUK011', '198807282014042001', 'Kepala Seksi Administrasi Umum dan Sumber Daya'],
            ['Mahdalena Zahir, A.Ma.', 'SIMARUK012', '197708132009102001', 'Pengadministrasi Program Studi Administrasi Bisnis'],
            ['Dedi', 'SIMARUK013', '198406102008101001', 'Pengadministrasi Keuangan'],
            ['Rohmat', 'SIMARUK014', '196811192009101001', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Adang Sopian', 'SIMARUK015', '197001012009101001', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Agus Gunawan', 'SIMARUK016', '196909252009101001', 'Pengadministrasi Akademik Fakultas'],
            ['Samsidi', 'SIMARUK017', '197106242009101001', 'Pengadministrasi Kemahasiswaan dan Alumni'],
            ['Ronny Daulay', 'SIMARUK018', '197210142009101001', 'Pengadministrasi Akademik Fakultas'],
            ['Ai Imas', 'SIMARUK019', '197301112009102001', 'Pengadministrasi Sarana dan Prasarana'],
            ['Ikeu Rositawati', 'SIMARUK020', '198203302009102002', 'Pengadministrasi Sarana dan Prasarana'],
            ['Rullyanti Lestari, S.Pd.', 'SIMARUK021', '920171219831223201', 'Pengelola Perbendaharaan dan Pelayanan / BPP'],
            ['Iwan Setiawan', 'SIMARUK022', '920171219780314101', 'Pranata Kearsipan/Arsiparis'],
            ['Depi Suwarna', 'SIMARUK023', '920171219890307101', 'Pengadministrasi Program Studi Pendidikan Teknologi dan Kejuruan'],
            ['Hendriyana, S.Pd', 'SIMARUK024', '920190219790128101', 'Pengadministrasi Keuangan'],
            ['Johan Mulyana, S.Pd', 'SIMARUK025', '920190219800208101', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Noviyanti Hamdani, S.Pd', 'SIMARUK026', '920190219850924201', 'Pengelola Gaji / PPABP'],
            ['Usep Muharam, S.Pd', 'SIMARUK027', '920190219870909101', 'Pengadministrasi Kepegawaian'],
            ['Rina Lia Nurlaela, A.Md.', 'SIMARUK028', '920200119730303201', 'Pengadministrasi Program Studi Pendidikan Umum dan Karakter'],
            ['Gilang Nugraha, A.Md.', 'SIMARUK029', '920200119900329101', 'Pengadministrasi Program Studi Guru'],
            ['Ivan Sudrajat', 'SIMARUK030', '920200119870915101', 'Pengadministrasi Akademik Fakultas'],
            ['Gina Aprilita Susanty, S.Pd.', 'SIMARUK031', '920231019860417201', 'Pengadministrasi Keuangan'],
            ['Mujzi Rasandi Supriadi, S.Pd.', 'SIMARUK032', '920231019850506101', 'Pengadministrasi Akademik Fakultas'],
            ['Nuludin Saepudin, S.Kom.', 'SIMARUK033', '920231019900525101', 'Pengadministrasi Program Studi Pendidikan Profesi Guru'],
            ['Acep Suryadi Fatoni, S.Pd.', 'SIMARUK034', '920231019830329101', 'Pengadministrasi Program Studi Pendidikan Profesi Guru'],
            ['Didi Wahyudin', 'SIMARUK035', '920231019791231101', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Irwan Shapandi, S.E., M.M', 'SIMARUK036', '920200119810110101', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Fitrah Afritesya, M.Pd', 'SIMARUK037', '920241019910428201', 'Staf Pimpinan'],
            ['Nizar Imam Rianto', 'SIMARUK038', '920241020010214101', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Rini Hendrawati, S.Pd.', 'SIMARUK039', '920241019760714201', 'Pengadministrasi Program Studi Pendidikan Seni'],
            ['Yuanita Triastuti', 'SIMARUK040', '920241019810406201', 'Pengadministrasi Program Studi Pendidikan Olahraga'],
            ['Widi Anggraeni, S.Pd.', 'SIMARUK041', '020231019960126201', 'Pengadministrasi Program Studi Pendidikan Profesi Guru'],
            ['Dwi Yunita Utami, S.Pd', 'SIMARUK042', '020230619990602201', 'Pengadministrasi Program Studi Psikologi Pendidikan'],
            ['Gani Ginanjar', 'SIMARUK043', '020241019750727101', 'Teknisi Pemelihara Sarana dan Prasarana'],
            ['Rasyidan Aufar Dagustani, S.A.', 'SIMARUK044', '020241119990603101', 'Pengadministrasi Akademik Fakultas'],
            ['Muhammad Rifaldy Herdiatna, S.Pd', 'SIMARUK045', '020241119990209101', 'Pengadministrasi Akademik'],
            ['Raditya Pratama Setiadi, S.Pd', 'SIMARUK046', '020250920010823101', 'Pengadministrasi Kepegawaian'],
            ['Alvhira Monique Pratiwi Nuralam', 'SIMARUK047', '020250920010809201', 'Pengadministrasi Program Studi Pariwisata'],
            ['Alvhira Monique Pratiwi Nuralam', 'SIMARUK048', '020250920010809201', 'Pengadministrasi Program Studi Bahasa Indonesia bagi Penutur Asing'],
        ];

        // Kita pastikan semua Unit Kerja/Prodi tersimpan juga di daftar Unit
        $units = array_unique(array_column($users, 3));
        foreach ($units as $unit) {
            DB::table('study_programs')->updateOrInsert(
                ['name' => trim($unit)]
            );
        }

        foreach ($users as $u) {
            User::updateOrCreate(
                ['username' => trim($u[1])],
                [
                    'name' => trim($u[0]),
                    'nim_nip' => trim($u[2]),
                    'study_program' => trim($u[3]),
                    'password' => Hash::make('password123'),
                    'role' => 'user',
                ]
            );
        }
    }
}
