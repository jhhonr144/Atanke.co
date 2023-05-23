# User_Update
lista la informacion del usuario logeado

>  #update #user 

---
## Tabla de Contenido

- [Descripción](#descripción)
- [Detalle de Funcionalidades](#detalle-de-funcionalidades)
- [Autores](#autores)
- [Licencia](#licencia)

---

## Descripción
 
---

## Detalle de Funcionalidades

#### POST/ /api/user

obligatorios: token 

##### REQUEST
```
{ 
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
    datos=info user
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