# Roadmap y Ejercicios para PHP y Django

## PHP

### 1. Fundamentos de PHP
- **Ejercicio 1:** Crea un script que intercambie los valores de dos variables sin usar una tercera variable.
- **Ejercicio 2:** Escribe un programa que determine si un número es primo.
- **Ejercicio 3:** Desarrolla un script que genere un array con 100 números aleatorios y luego los ordene de menor a mayor.

### 2. Avanzando en POO y Manejo de Archivos
- **Ejercicio 1:** Define una clase `Coche` con propiedades como modelo, marca y año, e implementa métodos para cambiar y obtener cada propiedad.
- **Ejercicio 2:** Crea una clase `Persona` que implemente la interfaz `JsonSerializable` para poder serializar objetos `Persona` en formato JSON.
- **Ejercicio 3:** Escribe una función de autoload que automáticamente cargue clases desde un directorio `classes`.

### 3. Interacción con Bases de Datos y CRUD
- **Ejercicio 1:** Crea un script PHP que se conecte a una base de datos y cree una tabla llamada `Clientes`.
- **Ejercicio 2:** Escribe un script para insertar datos en la tabla `Clientes` desde un formulario HTML.
- **Ejercicio 3:** Desarrolla un script para actualizar y borrar registros en la base de datos basado en la entrada del usuario.

### 4. Formularios y Validación
- **Ejercicio 1:** Crea un formulario de contacto que incluya validación de lado del servidor para email y número de teléfono.
- **Ejercicio 2:** Implementa un formulario que acepte un archivo y lo guarde en el servidor verificando que sea una imagen.
- **Ejercicio 3:** Desarrolla un formulario de login con protección contra ataques de inyección SQL.

### 5. Integración con HTML y Desarrollo Web
- **Ejercicio 1:** Integra un script PHP que muestre la fecha y hora actual en una página HTML.
- **Ejercicio 2:** Crea una página que muestre el resultado de una consulta a la base de datos, mostrando los datos en una tabla HTML.
- **Ejercicio 3:** Implementa una página PHP que utilice cookies para recordar el nombre del usuario entre visitas.

### 6. Generación de APIs y SPA
- **Ejercicio 1:** Construye una API PHP simple que devuelva la hora actual en formato JSON.
- **Ejercicio 2:** Desarrolla una API que permita a los usuarios obtener, crear y borrar notas (texto simple).
- **Ejercicio 3:** Implementa autenticación API usando tokens.

## Django

### 1. Fundamentos de Django
- **Ejercicio 1:** Configura un proyecto de Django y crea una app llamada `perfil`.
- **Ejercicio 2:** En la app `perfil`, crea un modelo `Usuario` que extienda el modelo base de Django.
- **Ejercicio 3:** Crea vistas básicas para listar y detallar los datos de `Usuario`.

### 2. CRUD y ORM Avanzado
- **Ejercicio 1:** Implementa vistas basadas en clases para el CRUD de `Usuario`.
- **Ejercicio 2:** Añade relaciones ManyToMany a `Usuario` para representar habilidades o intereses.
- **Ejercicio 3:** Utiliza los métodos `filter`, `exclude` y `order_by` del ORM para realizar consultas complejas.

### 3. Formularios y Validación en Django
- **Ejercicio 1:** Crea un `ModelForm` para el modelo `Usuario`.
- **Ejercicio 2:** Implementa validación personalizada en el `ModelForm` para verificar que el email no esté ya registrado.
- **Ejercicio 3:** Usa Django forms para crear un formulario de búsqueda que filtre usuarios por nombre.

### 4. Autenticación y Manejo del Estado
- **Ejercicio 1:** Configura el sistema de autenticación de Django para usar email en lugar de nombre de usuario.
- **Ejercicio 2:** Implementa un sistema de recuperación de contraseña para la app de `Usuario`.
- **Ejercicio 3:** Crea una funcionalidad de cambio de contraseña dentro de la app.

### 5. Avanzando con APIs y SPA
- **Ejercicio 1:** Crea una API con Django REST Framework que maneje CRUD para `Usuario`.
- **Ejercicio 2:** Integra autenticación basada en tokens en tu API.
- **Ejercicio 3:** Desarrolla endpoints que soporten operaciones de paginación y filtrado.

### 6. Aplicaciones Web Híbridas
- **Ejercicio 1:** Configura Django para servir archivos estáticos y medios para una SPA.
- **Ejercicio 2:** Utiliza Django Channels para añadir funcionalidad de WebSockets a tu aplicación.
- **Ejercicio 3:** Integra una librería frontend como React o Vue en tu aplicación Django para mejorar la interactividad.
