const daysInIndonesian = [
    "Minggu",
    "Senin",
    "Selasa",
    "Rabu",
    "Kamis",
    "Jumat",
    "Sabtu",
];
const selectPoli = document.getElementById("kd_poli");
const selectDokter = document.getElementById("pilih-dokter");

function loadPoli() {
    selectDokter.innerHTML = "";
    selectPoli.innerHTML = "";
    fetch("/api/poli")
        .then((response) => response.json())
        .then((poli) =>
            poli.forEach((element) => {
                // console.log(element);
                const option = document.createElement("option");
                option.value = element.kd_poli;
                option.text = element.nm_poli;
                selectPoli.appendChild(option);
            })
        );
}

function loadDokter() {
    const poli = document.getElementById("kd_poli");
    console.log(poli.value);
    const tanggalInput = document.getElementById("tanggal-periksa");
    const tanggalRaw = new Date(tanggalInput.value);
    // const tanggal = daysInIndonesian[tanggalRaw.getDay()];
    const bulan = tanggalRaw.getMonth() + 1;
    // console.log(bulan);

    selectDokter.innerHTML = ""; // clear the options first

    fetch("/api/dokter", {
        method: "POST",
        headers: {
            Accept: "application/json",
            "Content-Type": "application/json",
        },
        body: JSON.stringify({
            tanggal: `${tanggalRaw.getDate()}-${bulan}-${tanggalRaw.getFullYear()}`,
            kd_poli: poli.value,
        }),
    })
        .then((response) => response.json())
        .then((dokters) => {
            console.log(dokters);
            dokters.forEach((dokter) => {
                const option = document.createElement("option");
                option.value = dokter.kd_dokter;
                option.text = dokter.nm_dokter;
                selectDokter.appendChild(option);
            });
        });
}

// // Ambil elemen input date
// var tanggalBooking = document.getElementById("tanggal-periksa");

// // Buat objek date untuk tanggal sekarang
// var today = new Date();

// // Tambahkan 2 hari ke tanggal sekarang
// var twoDaysLater = new Date(today);
// twoDaysLater.setDate(twoDaysLater.getDate() + 2);

// // Set tanggal 2 hari mendatang pada format YYYY-MM-DD
// var twoDaysLaterStr = twoDaysLater.toISOString().substr(0, 10);

// // Tambahkan event listener untuk mengubah tanggal yang dipilih
// tanggalBooking.addEventListener("input", function () {
//     // Ambil tanggal yang dipilih oleh pengguna
//     var tanggal = this.value;

//     // Jika tanggal yang dipilih kurang dari atau sama dengan 2 hari mendatang
//     if (tanggal <= twoDaysLaterStr) {
//         // Tampilkan pesan error
//         this.setCustomValidity(
//             "Tanggal daftar harus lebih dari 2 hari mendatang"
//         );

//         // Jika tanggal yang dipilih lebih dari 2 hari mendatang
//     } else {
//         // Hapus pesan error (jika ada)
//         this.setCustomValidity("");
//     }
// });

// Ambil elemen input date
var tanggalBooking = document.getElementById("tanggal-periksa");

// Buat objek date untuk tanggal sekarang
var today = new Date();

// Tambahkan 1 hari ke tanggal sekarang
var oneDayLater = new Date(today);
oneDayLater.setDate(oneDayLater.getDate() - 1);

// Tambahkan 3 hari ke tanggal sekarang
var threeDaysLater = new Date(today);
threeDaysLater.setDate(threeDaysLater.getDate() + 3);

// Set tanggal 1 hari mendatang pada format YYYY-MM-DD
var oneDayLaterStr = oneDayLater.toISOString().substr(0, 10);

// Set tanggal 3 hari mendatang pada format YYYY-MM-DD
var threeDaysLaterStr = threeDaysLater.toISOString().substr(0, 10);

// Tambahkan event listener untuk mengubah tanggal yang dipilih
tanggalBooking.addEventListener("input", function () {
    // Ambil tanggal yang dipilih oleh pengguna
    var tanggal = this.value;

    // Jika tanggal yang dipilih kurang dari atau sama dengan 1 hari mendatang
    if (tanggal <= oneDayLaterStr) {
        // Tampilkan pesan error
        this.setCustomValidity("Tanggal daftar harus maksimal h-1");

        // Jika tanggal yang dipilih lebih dari 3 hari mendatang
    } else if (tanggal > threeDaysLaterStr) {
        // Tampilkan pesan error
        this.setCustomValidity("Tanggal daftar minimal h-3");

        // Jika tanggal yang dipilih di antara 1 dan 3 hari mendatang
    } else {
        // Hapus pesan error (jika ada)
        this.setCustomValidity("");
    }
});
