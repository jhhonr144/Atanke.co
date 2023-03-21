# Uupdateuser

Servicios para mostrarle los datos al usuario y pueda modificarlos

>  #palabras #traducir #traduccion

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

Servicios para mostrarle los datos al usuario y pueda modificarlos

---


## Detalle de Funcionalidades

#### get/ /api/users/{id}

Headers obligatorios: token,data

##### REQUEST
```
{
   "data" :http://127.0.0.1:8000/api/users/6
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

   {
  "id": 6,
  "name": "miguel",
  "email": "angelsardo@gmail.com",
  "email_verified_at": null,
  "created_at": "2023-03-01T21:56:46.000000Z",
  "updated_at": "2023-03-16T22:44:06.000000Z",
  "r_users_roles": 1,
  "r_users_estados": 1,
  "image_path": "1678938949.jpg"
}
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



#### PATCH/ /api/users/{id}

Headers obligatorios: token,data

##### REQUEST
```
{
   "data" :http://127.0.0.1:8000/api/updateusers/6
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

   {
 {
  "id": 6,
  "name": "miguelsuarez",
  "email": "angelsardo1@gmail.com",
  "email_verified_at": null,
  "created_at": "2023-03-01T21:56:46.000000Z",
  "updated_at": "2023-03-17T22:42:23.000000Z",
  "r_users_roles": 1,
  "r_users_estados": 1,
  "image_path": "1678938949.jpg"

}
}
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
            "Se produjo un problema la es contraseña incorrecta "
        ]
    }
}

```


## Autores

El equipo involucrado en la implementación de estos componentes se detalla a continuación:

- Equipo de Desarrollo: Atanke.co
    - Miguel angel sardo (msardo@unicesar.edu.co)
---

## Licencia

- Copyright 2022 ©