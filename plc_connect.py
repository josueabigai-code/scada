import sys
import snap7

from snap7.util import set_bool
from snap7.type import Areas

# ================= PLC CONFIG =================

PLC_IP = "192.168.1.10"
PLC_RACK = 0
PLC_SLOT = 1

# ================= CONEXION =================

client = snap7.client.Client()

try:

    client.connect(
        PLC_IP,
        PLC_RACK,
        PLC_SLOT
    )

    if not client.get_connected():

        print("PLC OFFLINE")
        sys.exit()

    accion = sys.argv[1]

    # ================= DATA =================

    data = bytearray(1)

    # ================= ACCIONES =================

    # ENCENDER TODO

    if accion == "on_all":

        set_bool(data,0,0,True) # L1
        set_bool(data,0,1,True) # L2
        set_bool(data,0,2,True) # L3
        set_bool(data,0,3,True) # L4

    # APAGAR TODO

    elif accion == "off_all":

        set_bool(data,0,0,False)
        set_bool(data,0,1,False)
        set_bool(data,0,2,False)
        set_bool(data,0,3,False)

    # ZONA OESTE -> L1 Y L2

    elif accion == "zona_oeste":

        set_bool(data,0,0,True) # L1
        set_bool(data,0,1,True) # L2

        set_bool(data,0,2,False)
        set_bool(data,0,3,False)

    # ZONA ESTE -> L2 Y L3

    elif accion == "zona_este":

        set_bool(data,0,0,False)

        set_bool(data,0,1,True) # L2
        set_bool(data,0,2,True) # L3

        set_bool(data,0,3,False)

    # ================= ESCRIBIR PLC =================

    client.write_area(
        Areas.DB,
        1,
        0,
        data
    )

    print("OK")

except Exception as e:

    print("ERROR")
    print(e)