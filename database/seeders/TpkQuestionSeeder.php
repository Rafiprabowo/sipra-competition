<?php

namespace Database\Seeders;

use App\Models\Exam;
use App\Models\TpkQuestion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TpkQuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
       public function run()
    {
         $exam = Exam::create([
            'name' => 'Tes Pengetahuan Kepramukaan',
            'description' => 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Architecto aut illo in minima molestias quaerat similique sint tempore totam voluptatibus.',
            'duration' => 60
         ]);

        $questions = [
            [
                'question' => 'Apa lambang utama dalam logo Gerakan Pramuka?',
                'answer_a' => 'Bunga mawar',
                'answer_b' => 'Pohon beringin',
                'answer_c' => 'Tunas kelapa',
                'answer_d' => 'Bunga melati',
                'answer_e' => 'Pohon pinus',
                'correct_answer' => 'c',
            ],
            [
                'question' => 'Apa kepanjangan dari Dasa Darma Pramuka?',
                'answer_a' => 'Sepuluh Tugas Pramuka',
                'answer_b' => 'Sepuluh Janji Pramuka',
                'answer_c' => 'Sepuluh Pedoman Pramuka',
                'answer_d' => 'Sepuluh Ciri Pramuka',
                'answer_e' => 'Sepuluh Sifat Pramuka',
                'correct_answer' => 'c',
            ],
            [
                'question' => 'Kapan Hari Pramuka diperingati setiap tahun?',
                'answer_a' => '14 Agustus',
                'answer_b' => '10 November',
                'answer_c' => '1 Juni',
                'answer_d' => '20 Mei',
                'answer_e' => '17 Agustus',
                'correct_answer' => 'a',
               ],
            [
                'question' => 'Siapa pendiri Gerakan Pramuka di dunia?',
                'answer_a' => 'Robert Baden-Powell',
                'answer_b' => 'Lord Stephenson',
                'answer_c' => 'William D. Boyce',
                'answer_d' => 'Ernest Thompson Seton',
                'answer_e' => 'Olave Baden-Powell',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Apa kepanjangan dari KMD dalam Gerakan Pramuka?',
                'answer_a' => 'Kursus Mahir Dasar',
                'answer_b' => 'Kursus Menengah Dasar',
                'answer_c' => 'Kursus Mandiri Dasar',
                'answer_d' => 'Kader Mahir Dasar',
                'answer_e' => 'Kompetensi Mahir Dasar',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Apa lambang tingkat siaga dalam Pramuka?',
                'answer_a' => 'Kupu-kupu',
                'answer_b' => 'Tunas kelapa',
                'answer_c' => 'Pohon beringin',
                'answer_d' => 'Ikan paus',
                'answer_e' => 'Lingkaran hijau',
                'correct_answer' => 'b',
            ],
            [
                'question' => 'Berapa jumlah Dasa Darma dalam Gerakan Pramuka?',
                'answer_a' => '5',
                'answer_b' => '8',
                'answer_c' => '10',
                'answer_d' => '12',
                'answer_e' => '15',
                'correct_answer' => 'c',
            ],
            [
                'question' => 'Apa arti dari Dasa Darma pertama, "Takwa kepada Tuhan Yang Maha Esa"?',
                'answer_a' => 'Melaksanakan ibadah sesuai agama masing-masing',
                'answer_b' => 'Hormat kepada orang tua',
                'answer_c' => 'Mencintai sesama manusia',
                'answer_d' => 'Melestarikan budaya lokal',
                'answer_e' => 'Bertanggung jawab dalam tugas',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Pada tanggal berapa Gerakan Pramuka Indonesia didirikan?',
                'answer_a' => '17 Agustus 1945',
                'answer_b' => '14 Agustus 1961',
                'answer_c' => '1 Juni 1945',
                'answer_d' => '20 Mei 1908',
                'answer_e' => '28 Oktober 1928',
                'correct_answer' => 'b',
            ],
            [
                'question' => 'Apa makna dari Tunas Kelapa sebagai lambang Pramuka?',
                'answer_a' => 'Pramuka adalah tunas bangsa',
                'answer_b' => 'Kesederhanaan hidup',
                'answer_c' => 'Kehidupan baru',
                'answer_d' => 'Keberanian dan ketangguhan',
                'answer_e' => 'Persatuan dan kesatuan',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Dalam Pramuka, apakah kode kehormatan yang digunakan oleh Pramuka Penegak?',
                'answer_a' => 'Tri Satya dan Dasa Darma',
                'answer_b' => 'Tri Dharma',
                'answer_c' => 'Janji Pramuka',
                'answer_d' => 'Tiga Pilar',
                'answer_e' => 'Kode Etik Pramuka',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Apa nama kegiatan tahunan yang diselenggarakan untuk Pramuka di seluruh dunia?',
                'answer_a' => 'World Scout Jamboree',
                'answer_b' => 'World Scout Camp',
                'answer_c' => 'World Scout Conference',
                'answer_d' => 'World Scout Day',
                'answer_e' => 'World Scout Forum',
                'correct_answer' => 'a',
            ],
             [
                'question' => 'Apa kepanjangan dari Kwartir Nasional dalam Gerakan Pramuka?',
                'answer_a' => 'Kepala Nasional',
                'answer_b' => 'Kwartir Nasional',
                'answer_c' => 'Kepemimpinan Nasional',
                'answer_d' => 'Komunitas Nasional',
                'answer_e' => 'Kelompok Nasional',
                'correct_answer' => 'b',
            ],
            [
                'question' => 'Apa makna simpul hidup dalam tali-temali Pramuka?',
                'answer_a' => 'Simbol persahabatan',
                'answer_b' => 'Simpul yang kuat dan tidak mudah lepas',
                'answer_c' => 'Simpul untuk mempererat hubungan',
                'answer_d' => 'Simpul untuk menyambungkan tali',
                'answer_e' => 'Simpul yang mudah dibuka',
                'correct_answer' => 'b',
            ],
            [
                'question' => 'Apa warna dasar bendera Gerakan Pramuka Indonesia?',
                'answer_a' => 'Merah dan putih',
                'answer_b' => 'Hijau dan putih',
                'answer_c' => 'Merah marun',
                'answer_d' => 'Putih bersih',
                'answer_e' => 'Cokelat dan putih',
                'correct_answer' => 'c',
            ],
            [
                'question' => 'Apa sebutan untuk Pramuka usia 16-20 tahun?',
                'answer_a' => 'Penggalang',
                'answer_b' => 'Siaga',
                'answer_c' => 'Penegak',
                'answer_d' => 'Pandega',
                'answer_e' => 'Pembina',
                'correct_answer' => 'c',
            ],
            [
                'question' => 'Apa tujuan dari latihan kepramukaan?',
                'answer_a' => 'Meningkatkan kemampuan fisik',
                'answer_b' => 'Membentuk kepribadian dan karakter',
                'answer_c' => 'Menguasai berbagai teknik survival',
                'answer_d' => 'Memenuhi persyaratan kenaikan tingkat',
                'answer_e' => 'Mengikuti kegiatan seru di alam bebas',
                'correct_answer' => 'b',
            ],
            [
                'question' => 'Siapa Ketua Kwartir Nasional Gerakan Pramuka Indonesia yang pertama?',
                'answer_a' => 'Sri Sultan Hamengkubuwono IX',
                'answer_b' => 'Ir. Soekarno',
                'answer_c' => 'Mohammad Hatta',
                'answer_d' => 'Ahmad Dahlan',
                'answer_e' => 'Ki Hajar Dewantara',
                'correct_answer' => 'a',
            ],
            [
                'question' => 'Apa nama janji yang diucapkan oleh anggota Pramuka dalam upacara pelantikan?',
                'answer_a' => 'Dasa Darma',
                'answer_b' => 'Tri Satya',
                'answer_c' => 'Ikrar Pramuka',
                'answer_d' => 'Kode Kehormatan',
                'answer_e' => 'Sumpah Pramuka',
                'correct_answer' => 'b',
            ],
             [
                'question' => 'Dimana Gerakan Pramuka pertama kali didirikan?',
                'answer_a' => 'Inggris',
                'answer_b' => 'Indonesia',
                'answer_c' => 'Jerman',
                'answer_d' => 'Amerika Serikat',
                'answer_e' => 'Australia',
                'correct_answer' => 'a',
            ]

        ];

        // Masukkan data ke database
        foreach ($questions as $index => $question) {
            $q = TpkQuestion::create($question);
            $exam->tpk_questions()->attach($q->id, ['order' => $index + 1]); // Urutan dimulai dari 1
        }

    }
}
