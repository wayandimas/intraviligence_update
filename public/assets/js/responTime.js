const waktuKejadianInput = document.getElementById("wk");
const waktuSampaiInput = document.getElementById("ws");
const waktuSelesaiInput = document.getElementById("wsi");
const responTimeInput = document.getElementById("rt");
const durasiPenangananInput = document.getElementById("dp");
const waktuInformasiDerekDibutuhkanInput = document.getElementById("widd");
const waktuDerekSampaiLokasiInput = document.getElementById("wdsl");
const responTimeDerekInput = document.getElementById("rtd");

waktuKejadianInput.addEventListener("change", hitungResponTime);
waktuSampaiInput.addEventListener("change", hitungResponTime);
waktuSelesaiInput.addEventListener("change", hitungDurasiPenanganan);
waktuInformasiDerekDibutuhkanInput.addEventListener("change",hitungResponTimeDerek);
waktuDerekSampaiLokasiInput.addEventListener("change", hitungResponTimeDerek);

function hitungResponTime() {
    const waktuKejadianString = waktuKejadianInput.value;
    var waktuKejadianTime = new Date();
    var partsKejadian = waktuKejadianString.split(":");
    waktuKejadianTime.setHours(parseInt(partsKejadian[0], 10));
    waktuKejadianTime.setMinutes(parseInt(partsKejadian[1], 10));

    const waktuSampaiString = waktuSampaiInput.value;
    var waktuSampaiTime = new Date();
    var partsSampai = waktuSampaiString.split(":");
    waktuSampaiTime.setHours(parseInt(partsSampai[0], 10));
    waktuSampaiTime.setMinutes(parseInt(partsSampai[1], 10));

    if (!isNaN(waktuKejadianTime) && !isNaN(waktuSampaiTime)) {
        if (waktuSampaiTime <= waktuKejadianTime) {
            responTimeInput.value = "";
        } else {
            const responTime = waktuSampaiTime - waktuKejadianTime;

            var jam = Math.floor(responTime / 3600000); // Menghitung jam
            var menit = Math.floor((responTime % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimeInput.value = waktuFormatted;
        }
    } else {
        responTimeInput.value = "";
    }
    // console.log(responTime);
}

function hitungDurasiPenanganan() {
    const waktuSampaiString = waktuSampaiInput.value;
    var waktuSampaiTime = new Date();
    var partsSampai = waktuSampaiString.split(":");
    waktuSampaiTime.setHours(parseInt(partsSampai[0], 10));
    waktuSampaiTime.setMinutes(parseInt(partsSampai[1], 10));

    const waktuSelesaiString = waktuSelesaiInput.value;
    var waktuSelesaiTime = new Date();
    var partsSelesai = waktuSelesaiString.split(":");
    waktuSelesaiTime.setHours(parseInt(partsSelesai[0], 10));
    waktuSelesaiTime.setMinutes(parseInt(partsSelesai[1], 10));

    if (!isNaN(waktuSelesaiTime) && !isNaN(waktuSampaiTime)) {
        if (waktuSelesaiTime <= waktuSampaiTime) {
            durasiPenangananInput.value = "";
        } else {
            const durasiPenanganan = waktuSelesaiTime - waktuSampaiTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            durasiPenangananInput.value = waktuFormatted;
        }
    } else {
        var formData = JSON.parse(localStorage.getItem('formData'));
        durasiPenangananInput.value = document.getElementsByName('dp')[0].value;
    }
    // console.log(responTime);
}

function hitungResponTimeDerek() {
    const waktuInformasiDerekDibutuhkanString =waktuInformasiDerekDibutuhkanInput.value;
    const waktuInformasiDerekDibutuhkanTime = new Date();
    const partsInformasiDerekDibutuhkan = waktuInformasiDerekDibutuhkanString.split(":");
    waktuInformasiDerekDibutuhkanTime.setHours(parseInt(partsInformasiDerekDibutuhkan[0], 10));
    waktuInformasiDerekDibutuhkanTime.setMinutes(parseInt(partsInformasiDerekDibutuhkan[1], 10));

    const waktuDerekSampaiLokasiString = waktuDerekSampaiLokasiInput.value;
    const waktuDerekSampaiTime = new Date();
    const partsDerekSampai = waktuDerekSampaiLokasiString.split(":");
    waktuDerekSampaiTime.setHours(parseInt(partsDerekSampai[0], 10));
    waktuDerekSampaiTime.setMinutes(parseInt(partsDerekSampai[1], 10));

    if (!isNaN(waktuInformasiDerekDibutuhkanTime) && !isNaN(waktuDerekSampaiTime)) {
        // if (waktuSelesaiTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan = waktuDerekSampaiTime - waktuInformasiDerekDibutuhkanTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimeDerekInput.value = waktuFormatted;
        // }
    } else {
        responTimeDerekInput.value = "";
    }
    // console.log(responTime);
}
