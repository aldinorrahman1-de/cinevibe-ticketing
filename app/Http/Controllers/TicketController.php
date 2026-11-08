<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TicketController extends Controller
{
    private $movies = [
        1 => [
            'id' => 1,
            'title' => 'GJLS: Berapi-Api',
            'genre' => 'Comedy, Drama',
            'duration' => '102 Menit',
            'price' => 50000,
            'rating' => '8.9/10',
            'banner' => '/posters/gjls.jpg',
            'synopsis' => 'Trio GJLS (Rigen Rakelna, Ananta Rispo, Hifdzi Khoir) berjuang menggapai cita-cita menjadi ksatria biru pemadam kebakaran dengan aksi kocak dan penuh kekacauan.',
            'schedules' => ['12:30', '14:35', '16:45', '19:00', '21:10'],
            'studio' => 'Studio 1 (Dolby Atmos)'
        ],
        2 => [
            'id' => 2,
            'title' => 'Pirunduk',
            'genre' => 'Horror, Mitos Banjar',
            'duration' => '96 Menit',
            'price' => 45000,
            'rating' => '8.5/10',
            'banner' => '/posters/pirunduk.jpg',
            'synopsis' => 'Diangkat dari urban legend Kalimantan Selatan: Siti menikahi juragan Badarudin demi utang keluarga, berujung terjebak dalam lingkaran ilmu hitam dan teror kuno Pirunduk.',
            'schedules' => ['12:25', '14:25', '16:30', '18:40', '20:50'],
            'studio' => 'Studio 2 (Dolby 7.1)'
        ],
        3 => [
            'id' => 3,
            'title' => 'The Cat in the Hat',
            'genre' => 'Animation, Comedy, Family',
            'duration' => '98 Menit',
            'price' => 45000,
            'rating' => '8.7/10',
            'banner' => '/posters/cat.jpg',
            'synopsis' => 'Kisah petualangan ajaib seekor kucing berbulu dengan topi bergaris ikonik yang datang menghibur kakak-beradik yang baru pindah ke kota asing.',
            'schedules' => ['11:45', '13:50', '16:00', '18:10'],
            'studio' => 'Studio Velvet'
        ],
        4 => [
            'id' => 4,
            'title' => 'Pulang Kampung',
            'genre' => 'Drama, Family',
            'duration' => '110 Menit',
            'price' => 45000,
            'rating' => '8.8/10',
            'banner' => '/posters/pulang.jpg',
            'synopsis' => 'Perjalanan emosional melintasi kota menuju desa kelahiran untuk menyelesaikan wasiat leluhur dan merajut kembali tali persaudaraan yang retak.',
            'schedules' => ['13:00', '15:20', '17:40', '20:00'],
            'studio' => 'Studio 3'
        ],
        5 => [
            'id' => 5,
            'title' => 'Seporsi Mie Ayam Sebelum Mati',
            'genre' => 'Drama, Slice of Life',
            'duration' => '121 Menit',
            'price' => 45000,
            'rating' => '9.0/10',
            'banner' => '/posters/mieayam.jpg',
            'synopsis' => 'Berniat mengakhiri hidup di hari ulang tahunnya, Ale (Benidictus Siregar) hanya ingin menyantap seporsi mie ayam favoritnya. Namun perjalanan itu mempertemukannya dengan orang-orang yang memberinya alasan untuk bertahan.',
            'schedules' => ['13:15', '15:40', '18:15', '20:45'],
            'studio' => 'Studio Velvet'
        ],
        6 => [
            'id' => 6,
            'title' => 'Godzilla Minus Zero',
            'genre' => 'Action, Sci-Fi, Kaiju',
            'duration' => '135 Menit',
            'price' => 55000,
            'rating' => '9.3/10',
            'banner' => '/posters/godzilla.jpg',
            'synopsis' => 'Dua tahun pasca-perang meluluhlantakkan kota, ancaman monster purba raksasa kembali bangkit dari palung samudra terdalam, membawa bencana kehancuran total.',
            'schedules' => ['12:30', '15:30', '18:30', '21:30'],
            'studio' => 'IMAX Laser 3D'
        ],
        7 => [
            'id' => 7,
            'title' => 'Laut Bercerita',
            'genre' => 'Historical, Drama, Tragedy',
            'duration' => '115 Menit',
            'price' => 50000,
            'rating' => '9.2/10',
            'banner' => '/posters/laut.jpg',
            'synopsis' => 'Adaptasi mahakarya Leila S. Chudori tentang Biru Laut dan kawan-kawan aktivis mahasiswa yang diculik dan dihilangkan, serta keluarga yang tak pernah lelah mencari keadilan.',
            'schedules' => ['13:00', '15:45', '18:30', '21:15'],
            'studio' => 'Premiere 1 (Dolby Atmos)'
        ],
        8 => [
            'id' => 8,
            'title' => 'Gak Ada Matinya',
            'genre' => 'Dark Comedy, Drama',
            'duration' => '121 Menit',
            'price' => 50000,
            'rating' => '8.8/10',
            'banner' => 'posters/matinya.jpg',
            'synopsis' => 'Terhimpit utang KPR dan kehilangan pekerjaan, Binsar (Oki Rengga) nekat terjebak sandiwara klaim asuransi jiwa ayahnya senilai 2 Miliar rupiah yang berujung salah kaprah.',
            'schedules' => ['11:45', '14:10', '16:40', '19:15', '21:40'],
            'studio' => 'Studio 1 (Dolby Atmos)'
        ]
    ];

    public function index()
    {
        return view('movies.index', ['movies' => $this->movies]);
    }

    public function show(int $id)
    {
        abort_if(!isset($this->movies[$id]), 404);
        return view('movies.show', ['movie' => $this->movies[$id]]);
    }

    public function book(Request $request, int $id)
    {
        abort_if(!isset($this->movies[$id]), 404);
        $selectedTime = $request->query('time', $this->movies[$id]['schedules'][0]);

        return view('movies.book', [
            'movie' => $this->movies[$id],
            'selectedTime' => $selectedTime
        ]);
    }

    public function checkout(Request $request, int $id)
    {
        abort_if(!isset($this->movies[$id]), 404);

        $validated = $request->validate([
            'customer_name' => 'required|string|min:3|max:50',
            'customer_email' => 'required|email',
            'customer_phone' => 'required|numeric|digits_between:10,14',
            'showtime' => 'required|string',
            'seats' => 'required|string',
        ], [
            'customer_name.required' => 'Nama lengkap wajib diisi.',
            'customer_name.min' => 'Nama minimal 3 karakter.',
            'customer_email.required' => 'Email wajib diisi.',
            'customer_email.email' => 'Format email tidak valid.',
            'customer_phone.required' => 'Nomor WhatsApp wajib diisi.',
            'customer_phone.numeric' => 'Nomor HP hanya boleh berisi angka.',
            'seats.required' => 'Silakan klik dan pilih minimal 1 kursi.',
        ]);

        $seatsArray = array_filter(explode(',', $validated['seats']));
        $totalSeats = count($seatsArray);
        $totalPrice = $totalSeats * $this->movies[$id]['price'];
        $bookingCode = 'CV-' . strtoupper(substr(uniqid(), -6));

        return view('movies.ticket', [
            'movie' => $this->movies[$id],
            'booking' => $validated,
            'seats' => $seatsArray,
            'totalSeats' => $totalSeats,
            'totalPrice' => $totalPrice,
            'bookingCode' => $bookingCode,
            'bookingDate' => now()->translatedFormat('d F Y, H:i')
        ]);
    }
}