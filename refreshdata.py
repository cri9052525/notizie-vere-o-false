#codice per convertire il filetxt temporaneo in un file json utilizzabile
import json
file=open("data.txt", "r")
linee=file.readlines()
listaDict = []
for linea in linee:
    lineaLista = linea.strip(" ").strip(")").split("(")
    if lineaLista[1] == "FAKE)\n":
        link="no"
        real=False
    else:
        link=lineaLista[1].replace(")","")
        real=True
    lineaDict={
        "titolo": lineaLista[0],
        "real": real,
        "link": link
    }
    listaDict.append(lineaDict)
open("data.json", "w").write(json.dumps(listaDict)) 
