# Palabra_Editar_EditarPalabra

Servicio para editar la palabra

> #palabra #editar_palabra

---

## Tabla de Contenido

-   [Descripción](#descripción)
-   [Detalle de Funcionalidades](#detalle-de-funcionalidades)
-   [Autores](#autores)
-   [Licencia](#licencia)

---

## Descripción

Edita el estado de la palabra, agrega o quita multimedia

---

## Detalle de Funcionalidades

#### POST/ /Palabras/Estado

obligatorios: token, id_palabra, a
Opcional: multimedia_id

##### REQUEST

```
{
    id:int
}
```

##### RESPONSE OK

Respuesta cuando se asocian todas las empresas

```
{
    "id": 0,
    "mensaje": "Modificado",
   //retorna por defecto
    datos_len=0;
    datos=[];
}
```

##### RESPONSE ERROR

Ejemplo mensaje de error:

```
{
    id = -1;
    mensaje = "Error al buscar Palabra\n" . $e;
    mensaje = "Sin permiso\n";
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
