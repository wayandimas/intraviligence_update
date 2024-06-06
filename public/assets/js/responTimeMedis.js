const waktuInformasiMedisDibutuhkanInput = document.getElementById("widm");
const waktuMedisSampaiLokasiInput = document.getElementById("wtmt");
const waktuMedisMeninggalkanTkpInput = document.getElementById("wmmt");
const waktuMedisSampaiRsInput = document.getElementById("wmrs");
const responTimeMedisInput = document.getElementById("rtpm");
const responTimePenangananInput = document.getElementById("dpn");
const responTimePerjalananInput = document.getElementById("dpe");


waktuInformasiMedisDibutuhkanInput.addEventListener("change",hitungResponTimeMedis);
waktuMedisSampaiLokasiInput.addEventListener("change", hitungResponTimeMedis);
waktuMedisMeninggalkanTkpInput.addEventListener("change",hitungResponTimePenanganan);
waktuMedisSampaiRsInput.addEventListener("change",hitungResponTimePerjalanan);


function hitungResponTimeMedis() {
    const waktuInformasiMedisDibutuhkanString = waktuInformasiMedisDibutuhkanInput.value;
    const waktuInformasiMedisDibutuhkanTime = new Date();
    const partsInformasiMedisDibutuhkan = waktuInformasiMedisDibutuhkanString.split(":");
    waktuInformasiMedisDibutuhkanTime.setHours(parseInt(partsInformasiMedisDibutuhkan[0], 10));
    waktuInformasiMedisDibutuhkanTime.setMinutes(parseInt(partsInformasiMedisDibutuhkan[1], 10));

    const waktuMedisSampaiLokasiString = waktuMedisSampaiLokasiInput.value;
    const waktuMedisSampaiTime = new Date();
    const partsMedisSampai = waktuMedisSampaiLokasiString.split(":");
    waktuMedisSampaiTime.setHours(parseInt(partsMedisSampai[0], 10));
    waktuMedisSampaiTime.setMinutes(parseInt(partsMedisSampai[1], 10));
    console.log(waktuInformasiMedisDibutuhkanString);
    if (!isNaN(waktuInformasiMedisDibutuhkanTime) && !isNaN(waktuMedisSampaiTime)) {
        // if (waktuSelesaiTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan = waktuMedisSampaiTime - waktuInformasiMedisDibutuhkanTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimeMedisInput.value = waktuFormatted;
            
        // }
    } else {
        responTimeMedisInput.value = "";
    }
   
}

function hitungResponTimePenanganan() {
    const waktuMedisMeninggalkanTkpString = waktuMedisMeninggalkanTkpInput.value;
    const waktuMedisMeninggalkanTkpTime = new Date();
    const partsMedisMeninggalkanTkp = waktuMedisMeninggalkanTkpString.split(":");
    waktuMedisMeninggalkanTkpTime.setHours(parseInt(partsMedisMeninggalkanTkp[0], 10));
    waktuMedisMeninggalkanTkpTime.setMinutes(parseInt(partsMedisMeninggalkanTkp[1], 10));

    const waktuMedisSampaiLokasiString = waktuMedisSampaiLokasiInput.value;
    const waktuMedisSampaiTime = new Date();
    const partsMedisSampai = waktuMedisSampaiLokasiString.split(":");
    waktuMedisSampaiTime.setHours(parseInt(partsMedisSampai[0], 10));
    waktuMedisSampaiTime.setMinutes(parseInt(partsMedisSampai[1], 10));
    console.log(waktuMedisMeninggalkanTkpString);
    if (!isNaN(waktuMedisMeninggalkanTkpTime) && !isNaN(waktuMedisSampaiTime)) {
        // if (waktuSelesaiTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan =   waktuMedisMeninggalkanTkpTime - waktuMedisSampaiTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimePenangananInput.value = waktuFormatted;
            
        // }
    } else {
        responTimePenangananInput.value = "";
    }
   
}
function hitungResponTimePerjalanan() {
    const waktuMedisMeninggalkanTkpString = waktuMedisMeninggalkanTkpInput.value;
    const waktuMedisMeninggalkanTkpTime = new Date();
    const partsMedisMeninggalkanTkp = waktuMedisMeninggalkanTkpString.split(":");
    waktuMedisMeninggalkanTkpTime.setHours(parseInt(partsMedisMeninggalkanTkp[0], 10));
    waktuMedisMeninggalkanTkpTime.setMinutes(parseInt(partsMedisMeninggalkanTkp[1], 10));

    const waktuMedisSampaiRsString = waktuMedisSampaiRsInput.value;
    const waktuMedisSampaiRsTime = new Date();
    const partsMedisSampaiRs = waktuMedisSampaiRsString.split(":");
    waktuMedisSampaiRsTime.setHours(parseInt(partsMedisSampaiRs[0], 10));
    waktuMedisSampaiRsTime.setMinutes(parseInt(partsMedisSampaiRs[1], 10));
    console.log(waktuMedisMeninggalkanTkpString);
    if (!isNaN(waktuMedisMeninggalkanTkpTime) && !isNaN(waktuMedisSampaiRsTime)) {
        // if (waktuSelesaiTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan =  waktuMedisSampaiRsTime - waktuMedisMeninggalkanTkpTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimePerjalananInput.value = waktuFormatted;
            
        // }
    } else {
        responTimePerjalananInput.value = "";
    }
   
}
