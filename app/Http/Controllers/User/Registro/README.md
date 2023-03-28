# User_Registro

Servicio para crear un usuario nuevo

>  #create #sing_in #user 

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

recibe los dato para crear un nuevo usuario

---

## Detalle de Funcionalidades

#### POST/ /api/user

obligatorios:  
            'name' => 'required|string|max:225',
            'email' => 'required|string|email|max:225|unique:users',
            'password' => 'required|string|min:6',

##### REQUEST
```
{
    name:string
    email:string
    password:string
}
```

##### RESPONSE OK
Respuesta cuando se asocian todas las empresas
```
{ 
    id=0;
    mensaje = token; 
    datos_len=$id user;
    datos=$user; 
}

```
##### RESPONSE ERROR
Ejemplo mensaje de error:
```
{  
    id = -1;
    mensaje = "Error por datos erroneos";
    datos=cual esta mal; 

    mensaje = "error al crear usuario".$e;
    //retorna por defecto
    datos_len=0;
    datos=[]; 
}

```
## Autores

El equipo involucrado en la implementación de estos componentes se detalla a continuación:

- Equipo de Desarrollo: Atanke.co
    - Will Pozo (wpozo@unicesar.edu.co)
---

## Licencia

- Copyright 2022 ©