# Guía para Crear un Proyecto en Django con Listado de Entidades

## Paso 1: Crear el Proyecto de Django

1. Crea un nuevo proyecto de Django llamado `chistes_project`:

    ```sh
    django-admin startproject chistes_project
    ```

2. Navega al directorio del proyecto:

    ```sh
    cd chistes_project
    ```

## Paso 3: Crear una Aplicación

1. Crea una nueva aplicación llamada `chistes`:

    ```sh
    python manage.py startapp chistes
    ```

2. Añade la aplicación `chistes` a la lista de aplicaciones instaladas en `chistes_project/settings.py`:

    ```python
    INSTALLED_APPS = [
        ...
        'chistes',
    ]
    ```

## Paso 4: Definir el Modelo

1. En `chistes/models.py`, define el modelo `Chiste`:

    ```python
    from django.db import models

    class Chiste(models.Model):
        titulo = models.CharField(max_length=200)
        texto = models.TextField()
        es_para_adultos = models.BooleanField(default=False)
        fecha_creacion = models.DateTimeField(auto_now_add=True)

        def __str__(self):
            return self.titulo
    ```

## Paso 5: Crear y Aplicar Migraciones

1. Crea las migraciones para el nuevo modelo:

    ```sh
    python manage.py makemigrations chistes
    ```

2. Aplica las migraciones para actualizar la base de datos:

    ```sh
    python manage.py migrate
    ```

## Paso 6: Registrar el Modelo en el Administrador

1. En `chistes/admin.py`, registra el modelo `Chiste` para que aparezca en el área de administración:

    ```python
    from django.contrib import admin
    from .models import Chiste

    admin.site.register(Chiste)
    ```

## Paso 7: Crear un Superusuario

1. Crea un superusuario para poder acceder al área de administración:

    ```sh
    python manage.py createsuperuser
    ```

2. Sigue las instrucciones para configurar el superusuario.

## Paso 8: Configurar URLs

1. En `chistes_project/urls.py`, incluye las URLs de la aplicación `chistes`:

    ```python
    from django.contrib import admin
    from django.urls import path, include

    urlpatterns = [
        path('admin/', admin.site.urls),
        path('', include('chistes.urls')),
    ]
    ```

2. Crea un archivo `urls.py` en el directorio de la aplicación `chistes` y define las URLs:

    ```python
    from django.urls import path
    from . import views

    urlpatterns = [
        path('', views.lista_chistes, name='lista_chistes'),
    ]
    ```

## Paso 9: Crear Vistas y Plantillas

1. En `chistes/views.py`, crea la vista para listar los chistes:

    ```python
    from django.shortcuts import render
    from .models import Chiste

    def lista_chistes(request):
        chistes = Chiste.objects.all()
        return render(request, 'chistes/lista_chistes.html', {'chistes': chistes})
    ```

2. Crea un directorio `templates` dentro del directorio `chistes` y dentro de este, crea un subdirectorio `chistes`.

3. En `templates/chistes/lista_chistes.html`, crea la plantilla para mostrar la lista de chistes:

    ```html
    <!DOCTYPE html>
    <html>
    <head>
        <title>Lista de Chistes</title>
    </head>
    <body>
        <h1>Lista de Chistes</h1>
        <ul>
            {% for chiste in chistes %}
                <li>
                    <h2>{{ chiste.titulo }}</h2>
                    <p>{{ chiste.texto }}</p>
                    <p>{{ chiste.fecha_creacion }}</p>
                    <p>{{ chiste.es_para_adultos|yesno:"Para adultos,Para todos" }}</p>
                </li>
            {% endfor %}
        </ul>
    </body>
    </html>
    ```

## Paso 10: Ejecutar el Servidor

1. Inicia el servidor de desarrollo de Django:

    ```sh
    python manage.py runserver
    ```

2. Abre un navegador y ve a `http://127.0.0.1:8000/admin` para acceder al área de administración e iniciar sesión con el superusuario que creaste.

3. Añade algunos chistes desde el área de administración.

4. Visita `http://127.0.0.1:8000` para ver la lista de chistes en la vista que creaste.

¡Y eso es todo! Ahora tienes un proyecto de Django con un área de administración y un listado de chistes.
