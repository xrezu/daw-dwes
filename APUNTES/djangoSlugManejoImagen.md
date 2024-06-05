### Apuntes sobre el Desarrollo de una Aplicación Web con Django para Mostrar Personajes con Imágenes

#### Introducción
En este ejercicio, hemos desarrollado una aplicación web en Django que permite mostrar personajes de Fallout con imágenes. La aplicación incluye una página de listado de personajes y una página de detalle para cada personaje. Los puntos clave incluyen la creación de modelos, vistas, plantillas y la configuración del panel de administración.

#### Puntos Clave del Ejercicio

1. **Configuración del Proyecto Django**:
    - Crear un proyecto y una aplicación en Django.
    - Registrar la aplicación en `settings.py`.

2. **Definición del Modelo**:
    - Crear un modelo `Character` con campos para el nombre, slug, descripción, foto de portada y foto de detalle.
    - Usar `SlugField` para generar URLs amigables basadas en el nombre.
    - Configurar `ImageField` para manejar la subida de imágenes.

3. **Panel de Administración**:
    - Registrar el modelo `Character` en el panel de administración de Django.
    - Configurar un formulario de administración personalizado para manejar la subida de imágenes.

4. **Vistas y URLs**:
    - Crear vistas genéricas (`ListView` y `DetailView`) para manejar el listado y el detalle de personajes.
    - Configurar rutas en `urls.py` para mapear las vistas a URLs.

5. **Plantillas**:
    - Crear plantillas HTML para el listado de personajes (`character_list.html`) y el detalle de cada personaje (`character_detail.html`).
    - Usar bucles de Django y variables de contexto para mostrar datos dinámicamente.

6. **Configuración de Archivos de Medios**:
    - Configurar `MEDIA_URL` y `MEDIA_ROOT` en `settings.py` para manejar la subida y visualización de imágenes.

### Guía Breve para Desarrollar Aplicaciones Similares

1. **Configuración Inicial del Proyecto**:
    - Crear un nuevo proyecto y aplicación en Django:
    ```sh
    django-admin startproject myproject
    cd myproject
    python manage.py startapp myapp
    ```

    - Registrar la aplicación en `settings.py`:
    ```python
    INSTALLED_APPS = [
        ...
        'myapp',
    ]
    ```

2. **Definir el Modelo**:
    - En `myapp/models.py`, define el modelo:
    ```python
    from django.db import models

    class MyModel(models.Model):
        name = models.CharField(max_length=100)
        slug = models.SlugField(max_length=100, unique=True)
        description = models.TextField()
        image = models.ImageField(upload_to='images/')

        def __str__(self):
            return self.name
    ```

    - Crear y aplicar migraciones:
    ```sh
    python manage.py makemigrations
    python manage.py migrate
    ```

3. **Configurar el Panel de Administración**:
    - En `myapp/admin.py`, registra el modelo:
    ```python
    from django.contrib import admin
    from .models import MyModel

    @admin.register(MyModel)
    class MyModelAdmin(admin.ModelAdmin):
        prepopulated_fields = {'slug': ('name',)}
        list_display = ('name', 'slug')
    ```

4. **Crear Vistas y URLs**:
    - En `myapp/views.py`, crea las vistas:
    ```python
    from django.views.generic import ListView, DetailView
    from .models import MyModel

    class MyModelListView(ListView):
        model = MyModel
        template_name = 'myapp/mymodel_list.html'

    class MyModelDetailView(DetailView):
        model = MyModel
        template_name = 'myapp/mymodel_detail.html'
    ```

    - En `myapp/urls.py`, define las rutas:
    ```python
    from django.urls import path
    from .views import MyModelListView, MyModelDetailView

    urlpatterns = [
        path('', MyModelListView.as_view(), name='mymodel-list'),
        path('<slug:slug>/', MyModelDetailView.as_view(), name='mymodel-detail'),
    ]
    ```

    - Incluir las rutas en `myproject/urls.py`:
    ```python
    from django.contrib import admin
    from django.urls import path, include
    from django.conf import settings
    from django.conf.urls.static import static

    urlpatterns = [
        path('admin/', admin.site.urls),
        path('myapp/', include('myapp.urls')),
    ] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
    ```

5. **Crear Plantillas**:
    - Crear la plantilla de listado (`myapp/templates/myapp/mymodel_list.html`):
    ```html
    <!DOCTYPE html>
    <html>
    <head>
        <title>Listado de Modelos</title>
    </head>
    <body>
        <h1>Listado de Modelos</h1>
        <ul>
            {% for item in object_list %}
                <li>
                    <a href="{% url 'mymodel-detail' item.slug %}">
                        <img src="{{ item.image.url }}" alt="{{ item.name }}">
                        <h2>{{ item.name }}</h2>
                    </a>
                </li>
            {% endfor %}
        </ul>
    </body>
    </html>
    ```

    - Crear la plantilla de detalle (`myapp/templates/myapp/mymodel_detail.html`):
    ```html
    <!DOCTYPE html>
    <html>
    <head>
        <title>{{ object.name }}</title>
    </head>
    <body>
        <h1>{{ object.name }}</h1>
        <img src="{{ object.image.url }}" alt="{{ object.name }}">
        <p>{{ object.description }}</p>
        <a href="{% url 'mymodel-list' %}">Volver al listado</a>
    </body>
    </html>
    ```

6. **Configurar Archivos de Medios**:
    - En `settings.py`, configura las rutas de los archivos de medios:
    ```python
    MEDIA_URL = '/media/'
    MEDIA_ROOT = os.path.join(BASE_DIR, 'media')
    ```

### Resumen
Estos apuntes proporcionan una guía rápida para desarrollar una aplicación Django que muestra personajes con imágenes. Los puntos clave incluyen la configuración del proyecto, definición del modelo, configuración del panel de administración, creación de vistas y URLs, y creación de plantillas. Utiliza esta guía para desarrollar aplicaciones similares de manera eficiente.