# Ejercicio biblioteca
## Tablas:

- Libros (ID, Título, Autor, Año de Publicación)
- Clientes (ID, Nombre, Teléfono)
- Prestamos (ID, ID_Libro, ID_Cliente, Fecha_Prestamo)
**Programa un formulario que procese esos datos.**

## Subtareas:

- Listar todos los libros publicados después del año 2000.
- Actualizar el número de teléfono de un cliente específico.
- Insertar un nuevo préstamo en la tabla Prestamos.




```php
if (el usuario sube el formulario)
  if (el form tiene errores){
    rellena el array de errores
  }
  else{
    graba el data en la bbdd
    302 redirect, si lo pide el HTTP
    exit
  }
if(tenemos errores){
  mostrar errores
  rellenar el formulario
}
mostrar formulario
```
