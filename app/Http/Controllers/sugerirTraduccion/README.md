# sugerirTraduccion

Servicio para sugerir palabras

>  #palabras #sugerir 

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

servicio que permite traducir textos a los diferentes idiomas.

---

## Detalle de Funcionalidades

#### POST/ /api/sugerirTraduccion

Headers obligatorios: token,data

##### REQUEST
```
{
"codIdioma" :1,
"palabra": "Mama",
"traduccion": "Mon",
"pronunciacion" : "Moon",
"fkUser": 16
}

```

##### RESPONSE OK
Respuesta cuando se asocian todas las empresas
```
{
    "dataHeader": {
        "codRespuesta": 0,
        "errores": []
    },
    "mensaje": "Traducción sugerida correctamente."
}

```
##### RESPONSE ERROR
Ejemplo mensaje de error:
```
{
    "dataHeader": {
        "codRespuesta": -1,
        "errores": [
            "Parámetros requeridos."
        ]
    }
}

```
## Autores

El equipo involucrado en la implementación de estos componentes se detalla a continuación:

- Equipo de Desarrollo: Atanke.co
    - Jhon Pacheco Escalona (jhhonr144@gmail.com)
---

## Licencia

- Copyright 2022 ©