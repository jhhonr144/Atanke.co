# User_Update

Servicio para actualizar los datos de un usuario,por el id recibido,
tener encuenta que debe tener el permiso de 'editar_usuario'

>  #update #user 

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

actualiza sierta informacion del usuario
{
    nombre
    correo
    rol
    estado
}
segun el id sel user y el perfil quien hace la peticion,
ya que necesita el permiso editar_usuario o ser admin

---

## Detalle de Funcionalidades

#### POST/ /api/user

obligatorios: token,data

##### REQUEST
```
{
    nombre:string
    correo:string
    rol:int
    estado:int
}
```

##### RESPONSE OK
Respuesta cuando se asocian todas las empresas
```
{ 
    id=0;
    mensaje = "Editado el Usuario\n";
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
    mensaje = "Sin Permiso, para Editar Usuario\n";
    mensaje = "Falta datos, para Editar el Usuario\n";
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