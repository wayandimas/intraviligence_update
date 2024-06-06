const waktuKejadianOperasionalInput = document.getElementById("wkpo");
const waktuSampaiOperasionalInput = document.getElementById("wspo");
const waktuSelesaiOperasionalInput = document.getElementById("wsipo");
waktuKejadianOperasionalInput.addEventListener("change",hitungResponTime);
waktuSampaiOperasionalInput.addEventListener("change",hitungResponTime);
waktuSelesaiOperasionalInput.addEventListener("change",hitungResponTimePenanganan);
const responTimeOperasionalInput = document.getElementById("rtpo");
const responTimePenangananOperasionalInput = document.getElementById("dppo");

function hitungResponTime() {
    const waktuSampaiOperasionalString = waktuSampaiOperasionalInput.value;
    const waktuSampaiOperasionalTime = new Date();
    const partsSampaiOperasional = waktuSampaiOperasionalString.split(":");
    waktuSampaiOperasionalTime.setHours(parseInt(partsSampaiOperasional[0], 10));
    waktuSampaiOperasionalTime.setMinutes(parseInt(partsSampaiOperasional[1], 10));

    const waktuKejadianOperasionalString = waktuKejadianOperasionalInput.value;
    const waktuKejadianOperasionalTime = new Date();
    const partsKejadian = waktuKejadianOperasionalString.split(":");
    waktuKejadianOperasionalTime.setHours(parseInt(partsKejadian[0], 10));
    waktuKejadianOperasionalTime.setMinutes(parseInt(partsKejadian[1], 10));
    console.log(waktuSampaiOperasionalString);
    if (!isNaN(waktuSampaiOperasionalTime) && !isNaN(waktuSampaiOperasionalTime)) {
        // if (waktuTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan = waktuSampaiOperasionalTime - waktuKejadianOperasionalTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimeOperasionalInput.value = waktuFormatted;
            
        // }
    } else {
        responTimeOperasionalInput.value = "";
    }
   
}

function hitungResponTimePenanganan() {
    const waktuSampaiOperasionalString = waktuSampaiOperasionalInput.value;
    const waktuSampaiOperasionalTime = new Date();
    const partsSampaiOperasional = waktuSampaiOperasionalString.split(":");
    waktuSampaiOperasionalTime.setHours(parseInt(partsSampaiOperasional[0], 10));
    waktuSampaiOperasionalTime.setMinutes(parseInt(partsSampaiOperasional[1], 10));

    const waktuSelesaiOperasionalString = waktuSelesaiOperasionalInput.value;
    const waktuSelesaiOperasionalTime = new Date();
    const partsSelesai = waktuSelesaiOperasionalString.split(":");
    waktuSelesaiOperasionalTime.setHours(parseInt(partsSelesai[0], 10));
    waktuSelesaiOperasionalTime.setMinutes(parseInt(partsSelesai[1], 10));
    console.log(waktuSampaiOperasionalString);
    if (!isNaN(waktuSampaiOperasionalTime) && !isNaN(waktuSampaiOperasionalTime)) {
        // if (waktuTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan =  waktuSelesaiOperasionalTime-waktuSampaiOperasionalTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimePenangananOperasionalInput.value = waktuFormatted;
            
        // }
    } else {
        responTimePenangananOperasionalInput.value = "";
    }
   
}