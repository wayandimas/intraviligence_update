const waktuKejadianKecelakaanInput = document.getElementById("wkm");
const waktuPetugasSampaiInput = document.getElementById("wsm");
const waktuSelesaiKecelakaanInput = document.getElementById("wsim");
const responTimePetugasInput = document.getElementById("rtp");
const responTimePenangananKecelakaanInput = document.getElementById("dp");

waktuKejadianKecelakaanInput.addEventListener("change",hitungResponTimePetugas);
waktuPetugasSampaiInput.addEventListener("change",hitungResponTimePetugas);
waktuSelesaiKecelakaanInput.addEventListener("change",hitungResponTimePenangananKecelakaanKecelakaan);


function hitungResponTimePetugas() {
    const waktuPetugasSampaiString = waktuPetugasSampaiInput.value;
    const waktuPetugasSampaiTime = new Date();
    const partsPetugasSampai = waktuPetugasSampaiString.split(":");
    waktuPetugasSampaiTime.setHours(parseInt(partsPetugasSampai[0], 10));
    waktuPetugasSampaiTime.setMinutes(parseInt(partsPetugasSampai[1], 10));

    const waktuKejadianKecelakaanString = waktuKejadianKecelakaanInput.value;
    const waktuKejadianKecelakaanTime = new Date();
    const partsKejadianKecelakaan = waktuKejadianKecelakaanString.split(":");
    waktuKejadianKecelakaanTime.setHours(parseInt(partsKejadianKecelakaan[0], 10));
    waktuKejadianKecelakaanTime.setMinutes(parseInt(partsKejadianKecelakaan[1], 10));
    console.log(waktuPetugasSampaiString);
    if (!isNaN(waktuPetugasSampaiTime) && !isNaN(waktuPetugasSampaiTime)) {
        // if (waktuSelesaiKecelakaanTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan = waktuPetugasSampaiTime - waktuKejadianKecelakaanTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimePetugasInput.value = waktuFormatted;
            
        // }
    } else {
        responTimePetugasInput.value = "";
    }
   
}
function hitungResponTimePenangananKecelakaanKecelakaan() {
    const waktuPetugasSampaiString = waktuPetugasSampaiInput.value;
    const waktuPetugasSampaiTime = new Date();
    const partsPetugasSampai = waktuPetugasSampaiString.split(":");
    waktuPetugasSampaiTime.setHours(parseInt(partsPetugasSampai[0], 10));
    waktuPetugasSampaiTime.setMinutes(parseInt(partsPetugasSampai[1], 10));

    const waktuSelesaiKecelakaanString = waktuSelesaiKecelakaanInput.value;
    const waktuSelesaiKecelakaanTime = new Date();
    const partsSelesaiKecelakaan = waktuSelesaiKecelakaanString.split(":");
    waktuSelesaiKecelakaanTime.setHours(parseInt(partsSelesaiKecelakaan[0], 10));
    waktuSelesaiKecelakaanTime.setMinutes(parseInt(partsSelesaiKecelakaan[1], 10));
    console.log(waktuPetugasSampaiString);
    if (!isNaN(waktuPetugasSampaiTime) && !isNaN(waktuPetugasSampaiTime)) {
        // if (waktuSelesaiTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan =  waktuSelesaiKecelakaanTime-waktuPetugasSampaiTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimePenangananKecelakaanInput.value = waktuFormatted;
            
        // }
    } else {
        responTimePenangananKecelakaanInput.value = "";
    }
   
}