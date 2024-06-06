const waktuInformasiDerekInput = document.getElementById("widd");
const waktuDerekSampaiInput = document.getElementById("wdsl");
waktuInformasiDerekInput.addEventListener("change",hitungResponTimeDerek);
waktuDerekSampaiInput.addEventListener("change",hitungResponTimeDerek);
const responTimeDerekInput = document.getElementById("rtd");


function hitungResponTimeDerek() {
    const waktuDerekSampaiString = waktuDerekSampaiInput.value;
    const waktuDerekSampaiTime = new Date();
    const partsDerekSampai = waktuDerekSampaiString.split(":");
    waktuDerekSampaiTime.setHours(parseInt(partsDerekSampai[0], 10));
    waktuDerekSampaiTime.setMinutes(parseInt(partsDerekSampai[1], 10));

    const waktuInformasiDerekString = waktuInformasiDerekInput.value;
    const waktuInformasiDerekTime = new Date();
    const partsInformasiDerek = waktuInformasiDerekString.split(":");
    waktuInformasiDerekTime.setHours(parseInt(partsInformasiDerek[0], 10));
    waktuInformasiDerekTime.setMinutes(parseInt(partsInformasiDerek[1], 10));
    console.log(waktuDerekSampaiString);
    if (!isNaN(waktuDerekSampaiTime) && !isNaN(waktuDerekSampaiTime)) {
        // if (waktuTime <= waktuSampaiTime) {
        //     durasiPenangananInput.value = "";
        // } else {
            const durasiPenanganan = waktuDerekSampaiTime - waktuInformasiDerekTime;

            var jam = Math.floor(durasiPenanganan / 3600000); // Menghitung jam
            var menit = Math.floor((durasiPenanganan % 3600000) / 60000); // Menghitung menit
            var waktuFormatted =
                ("0" + jam).slice(-2) + ":" + ("0" + menit).slice(-2);

            responTimeDerekInput.value = waktuFormatted;
            
        // }
    } else {
        responTimeDerekInput.value = "";
    }
   
}