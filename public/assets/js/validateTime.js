function validateTime() {
    const wsInput = document.getElementById("ws").value;
    const wkInput = document.getElementById("wk").value;

    if (wsInput <= wkInput) {
        document.getElementById("ws-error").textContent =
            "Waktu Sampai harus lebih besar daripada Waktu Kejadian";
    } else {
        document.getElementById("ws-error").textContent = "";
    }
}

function validateTimeSelesai() {
    const wsInput = document.getElementById("ws").value;
    const wsiInput = document.getElementById("wsi").value;

    if (wsiInput <= wsInput) {
        document.getElementById("wsi-error").textContent =
            "Waktu Selesai harus lebih besar daripada Waktu Sampai";
    } else {
        document.getElementById("wsi-error").textContent = "";
    }
}

function validateTimeMedis() {
    const wkmInput = document.getElementById("wkm").value;
    const wsmInput = document.getElementById("wsm").value;

    if (wsmInput <= wkmInput) {
        document.getElementById("wsm-error").textContent =
            "Waktu Sampai harus lebih besar daripada Waktu Kejadian";
    } else {
        document.getElementById("wsm-error").textContent = "";
    }
}
function validateTimePenanganan() {
    const wsimInput = document.getElementById("wsim").value;
    const wsmInput = document.getElementById("wsm").value;

    if (wsimInput <= wsmInput) {
        document.getElementById("wsim-error").textContent =
            "Waktu Selesai harus lebih besar daripada Waktu Sampai";
    } else {
        document.getElementById("wsim-error").textContent = "";
    }
}
function validateTimeDerek() {
    const widdInput = document.getElementById("widd").value;
    const wdslInput = document.getElementById("wdsl").value;

    if (wdslInput <= widdInput) {
        document.getElementById("wdsl-error").textContent =
            "Waktu Sampai Lokasi harus lebih besar daripada Waktu Informasi Derek Dibutuhkan";
    } else {
        document.getElementById("wdsl-error").textContent = "";
    }
}
function validateTimePetugasMedis() {
    const wtmtInput = document.getElementById("wtmt").value;
    const widmInput = document.getElementById("widm").value;

    if (wtmtInput <= widmInput) {
        document.getElementById("wtmt-error").textContent =
            "Waktu Tiba Medis di TKP harus lebih besar daripada Waktu Info Medis Dibutuhkan";
    }
    else {
        document.getElementById("wtmt-error").textContent = "";
    }
}
function validateTimePenangananMedis() {
    const wtmtInput = document.getElementById("wtmt").value;
    const wmmtInput = document.getElementById("wmmt").value;

    if (wmmtInput <= wtmtInput) {
        document.getElementById("wmmt-error").textContent =
            "Waktu Medis Meninggalkan TKP harus lebih besar daripada Waktu Tiba Medis di TKP";
    }
    else {
        document.getElementById("wmmt-error").textContent = "";
    }
}

function validateTimeDurasiPerjalanan() {
    const wmrsInput = document.getElementById("wmrs").value;
    const wmmtInput = document.getElementById("wmmt").value;

    if (wmrsInput <= wmmtInput) {
        document.getElementById("wmrs-error").textContent =
            "Waktu Medis Sampai RS harus lebih besar daripada Waktu Medis Meninggalkan TKP";
    }
    else {
        document.getElementById("wmrs-error").textContent = "";
    }
}

function validateTimeResponOperasional() {
    const wspoInput = document.getElementById("wspo").value;
    const wkpoInput = document.getElementById("wkpo").value;

    if (wspoInput <= wkpoInput) {
        document.getElementById("wspo-error").textContent =
            "Waktu Sampai harus lebih besar daripada Waktu Kejadian";
    }
    else {
        document.getElementById("wspo-error").textContent = "";
    }
}
function validateTimeDurasiPenangananOperasional() {
    const wspoInput = document.getElementById("wspo").value;
    const wsipoInput = document.getElementById("wsipo").value;

    if (wspoInput <= wsipoInput) {
        document.getElementById("wsipo-error").textContent =
            "Waktu Selesai harus lebih besar daripada Waktu Sampai";
    }
    else {
        document.getElementById("wspo-error").textContent = "";
    }
}