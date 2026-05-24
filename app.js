let plcOnline = false;

/* =========================
   ESTADO INICIAL
========================= */

let lamps = {
    L1:false,
    L2:false,
    L3:false,
    L4:false
};

/* =========================
   ACTUALIZAR UI
========================= */

function updateUI(){

    for(let id in lamps){

        const lamp = document.getElementById(id);

        if(lamps[id]){

            lamp.style.background = "#ffe600";
            lamp.style.boxShadow = "0 0 40px #ffe600";

        }else{

            lamp.style.background = "#666";
            lamp.style.boxShadow = "none";

        }

    }

}

/* =========================
   ENCENDER TODO
========================= */

function allOn(){

    lamps.L1 = true;
    lamps.L2 = true;
    lamps.L3 = true;
    lamps.L4 = true;

    updateUI();

}

/* =========================
   APAGAR TODO
========================= */

function allOff(){

    lamps.L1 = false;
    lamps.L2 = false;
    lamps.L3 = false;
    lamps.L4 = false;

    updateUI();

}

/* =========================
   ZONA OESTE
   SOLO ABAJO
========================= */

function zonaOeste(){

    allOff();

    lamps.L3 = true;
    lamps.L4 = true;

    updateUI();

}

/* =========================
   ZONA ESTE
   SOLO ARRIBA
========================= */

function zonaEste(){

    allOff();

    lamps.L1 = true;
    lamps.L2 = true;

    updateUI();

}

/* =========================
   TOGGLE PLC
========================= */

function togglePLC(){

    if(plcOnline){

        plcOnline = false;

        document.getElementById("plcAlert")
        .innerHTML = "🔴 PLC DESCONECTADO";

        document.getElementById("plcButton")
        .innerHTML = "Conectar PLC";

    }else{

        plcOnline = true;

        document.getElementById("plcAlert")
        .innerHTML = "🟢 PLC ONLINE";

        document.getElementById("plcButton")
        .innerHTML = "Desconectar PLC";

    }

}

/* =========================
   INICIAR
========================= */

updateUI();