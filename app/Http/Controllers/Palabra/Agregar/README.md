# Palabra_Agregar_agregarPalabra

Servicio para Agregar la palabra

> #palabra #Agregar_palabra

---

## Tabla de Contenido

-   [Descripción](#descripción)
-   [Detalle de Funcionalidades](#detalle-de-funcionalidades)
-   [Autores](#autores)
-   [Licencia](#licencia)

---

## Descripción

agrega la palabra, agrega o quita multimedia

---

## Detalle de Funcionalidades

#### POST/ /Palabras

obligatorios: token, palabra,fk_idioma
Opcional: 'pronunciar'

##### REQUEST

```
{
    'palabra', 'pronunciar','fk_idioma'
}
```

##### RESPONSE OK

Respuesta cuando se asocian todas las empresas

```
{
    "id": 0,
    "mensaje": "Agrego palabra.", 
    datos_len=id palabra;
    datos=palabra;
}
```

##### RESPONSE ERROR

Ejemplo mensaje de error:

```
{
    id = -1;
    mensaje = "Lo sentimos, un Admin te ha bloqueado esta opción.";
    mensaje = "Lo sentimos, no tienes permiso para crea palabras.";
    mensaje = "Usuario No Encontrado.";

    
    id = 1;
    mensaje = "Usuario No Encontrado.";
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
