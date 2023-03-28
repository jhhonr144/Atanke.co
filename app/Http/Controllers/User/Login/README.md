# User_Login

Servicio para logearse con clave y correo

>  #Login #user 

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción

recibe Correo y Clave para verificar y crear token

---

## Detalle de Funcionalidades

#### POST/ /api/login

obligatorios: correo,clave

##### REQUEST
```
{
    email
    password
}
```

##### RESPONSE OK
Respuesta cuando se asocian todas las empresas
```
{ 
    id=0;
    mensaje = $token;
    datos_len=$id user;
    datos=$user; 
}

```
##### RESPONSE ERROR
Ejemplo mensaje de error:
```
{  
    id = -1;
    mensaje = "Error al logearse.";
    mensaje = "usuario Inactivo";
    mensaje = "Error Logear user\n" . $e    
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