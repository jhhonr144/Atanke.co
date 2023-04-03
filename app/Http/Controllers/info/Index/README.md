# Contadore

Servicio para mostrar la info del dasboar

>  #Cantidades #revisar #info

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

informacion de palabra,relacion usuarios
---

## Detalle de Funcionalidades

#### Get/ /api/Dashboar

Headers obligatorios: token,data

##### REQUEST
```
no aplica
```

##### RESPONSE OK
Respuesta cuando se asocian todas las empresas
```
{
      "id": 0,
    "mensaje": "",
    "datos_len": 0,
    "datos": {
        "palabra": {
            "aprobado": 2,
            "rechazado": 1,
            "pendiente": 0
        },
        "usuarios": {
            "activos": 5,
            "inactivo": 1,
            "validados": 0
        },
        "relacionesPalabra": {
            "aprobado": 0,
            "rechazado": 0,
            "pendiente": 1
        }
    }
}

```
##### RESPONSE ERROR
Ejemplo mensaje de error:
```
{
    no aplica
}

```
## Autores

El equipo involucrado en la implementación de estos componentes se detalla a continuación:

- Equipo de Desarrollo: Atanke.co
    - Will Pozo (wpozo@unicesar.edu.co)
---

## Licencia

- Copyright 2022 ©