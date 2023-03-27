# Palabra_listar_ListarPalabraPaginada

Servicio para listar la palabra, para mostrarla a el usuario

> #palabra #Buscar_palabra

---

## Tabla de Contenido

-   [Descripción](#descripción)
-   [Detalle de Funcionalidades](#detalle-de-funcionalidades)
-   [Autores](#autores)
-   [Licencia](#licencia)

---

## Descripción

busca la palabra por los sig criterios opcionales
{
cantidad= cantidad de items a mostrar por pagina
pagina = pagina en la que el lector va
dato = palabra o parte de palabra a buscar
tipo = idioma en especifico
}
segun el id sel user y el perfil quien hace la peticion,
ya que necesita el permiso ver_palabra o ser admin

---

## Detalle de Funcionalidades

#### POST/ /Palabras

obligatorios: token
Opcional: datos

##### REQUEST

```
{
    cantidad:int
    pagina:int
    dato:array de datos 'filtros'
    tipo:int
}
```

##### RESPONSE OK

Respuesta cuando se asocian todas las empresas

```
{
    "id": 1,
    "mensaje": "Listado de Palabra #1",
    "datos_len": 2,
    "datos": [
        {
            "id": 1,
            "palabra": "Mamo",
            "pronunciar": "mamo",
            "created_at": null,
            "updated_at": null,
            "fk_user": 7,
            "fk_idioma": 3,
            "estado": "pendiente",
            "multilent": 0,
            "user": {
                "id": 7,
                "name": "Admin User",
                "email": "user@user.com"
            },
            "idioma": {
                "id": 3,
                "nombre": "Kankuamo",
                "created_at": null,
                "updated_at": null
            },
            "multimedia": []
        },
        {
            "id": 2,
            "palabra": "Mayor",
            "pronunciar": "mayor",
            "created_at": null,
            "updated_at": null,
            "fk_user": 7,
            "fk_idioma": 1,
            "estado": "pendiente",
            "multilent": 0,
            "user": {
                "id": 7,
                "name": "Admin User",
                "email": "user@user.com"
            },
            "idioma": {
                "id": 1,
                "nombre": "Español",
                "created_at": null,
                "updated_at": null
            },
            "multimedia": []
        }
    ]
}
```

##### RESPONSE ERROR

Ejemplo mensaje de error:

```
{
    id = -1;
    mensaje = "Error al listar Palabra\n" . $e;
    mensaje = "Sin Palabra\n";
    //retorna por defecto
    datos_len=0;
    datos=[];
}

```

## Autores

El equipo involucrado en la implementación de estos componentes se detalla a continuación:

-   Equipo de Desarrollo: Atanke.co
    -   Will Pozo (wpozo@unicesar.edu.co)

---

## Licencia

-   Copyright 2022 ©
