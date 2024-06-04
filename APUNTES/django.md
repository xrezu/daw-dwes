# <span style="color:red">TODO ESTÁ PUESTO EN EL ORDEN QUE DEBERIA IR EN EL CÓDIGO PHP</span>

# Crear el .venv (Entorno Virtual)
```bash
    python -m venv .\prueba\.venv\
```

# Activación del Entorno
```bash
    .\prueba\.venv\Scripts\activate
```

# Instalación de Django
```bash
    pip install django
```

# Actualización de Django
```bash
    python.exe -m pip install --upgrade pip
```

# Crear un Proyecto
```bash
    python -m django startproject temporada
```

# Me muevo al directorio del proyecto
```bash
    cd .\proyect_nombre\
```

# Crear una Aplicación
```bash
    python manage.py startapp productos_app
```

# Entramos en settings.py (PROYECTO) y añadimos la aplicación
```python
    INSTALLED_APPS = [
        'django.contrib.admin',
        'django.contrib.auth',
        'django.contrib.contenttypes',
        'django.contrib.sessions',
        'django.contrib.messages',
        'django.contrib.staticfiles',
        'productos_app',
    ]
```

# Entramos en models.py (APLICACIÓN) y creamos el modelo
```python
    from django.db import models

    class Producto(models.Model):
        nombre = models.CharField(max_length=200)
        foto = models.ImageField(upload_to='productos/')
        descripcion = models.TextField()
        fecha_inicio_temporada = models.DateField()
        fecha_fin_temporada = models.DateField()
        disponible_todo_el_ano = models.BooleanField(default=False)

        def __str__(self):
            return self.nombre

```

# Migramos el modelo a la base de datos
```bash
    python manage.py makemigrations
    python manage.py migrate
```

# <span style="color:red">En caso de que de error al hacer la migración y pida que instales el paquete de Pillow (ES PARA LA GESTIÓN DE IMÁGENES)</span>
```bash
    python -m pip install Pillow
```

# Entramos en admin.py (APLICACIÓN) y registramos el modelo
```python
    from django.contrib import admin
    from .models import Producto

    admin.site.register(Producto)
```

# Entramos a views.py (APLICACIÓN) y creamos la vista
```python
    from django.shortcuts import render
    from datetime import datetime
    from .models import Producto


    def listar_meses(request):
        meses = [
            'Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio',
            'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
        ]
        return render(request, 'productos/listar_meses.html', {'meses': meses})
    
    
    def productos_por_mes(request, mes):
        # Mapa de nombres de meses en español a números de mes
        meses_dict = {
            'Enero': 1, 'Febrero': 2, 'Marzo': 3, 'Abril': 4,
            'Mayo': 5, 'Junio': 6, 'Julio': 7, 'Agosto': 8,
            'Septiembre': 9, 'Octubre': 10, 'Noviembre': 11, 'Diciembre': 12
        }
        numero_mes = meses_dict[mes]
        productos = Producto.objects.filter(
            disponible_todo_el_ano=True
        ) | Producto.objects.filter(
            fecha_inicio_temporada__month__lte=numero_mes,
            fecha_fin_temporada__month__gte=numero_mes
        )
        return render(request, 'productos/productos_por_mes.html', {'mes': mes, 'productos': productos})
```

# Creamos el archivo urls.py (APLICACIÓN) y añadimos las rutas
```python
    from django.urls import path
    from . import views
    
    urlpatterns = [
        path('', views.listar_meses, name='listar_meses'),
        path('mes/<str:mes>/', views.productos_por_mes, name='productos_por_mes'),
    ]
```

# Entramos en urls.py (PROYECTO) y añadimos las rutas de la aplicación
```python
    from django.contrib import admin
    from django.urls import path, include
    
    urlpatterns = [
        path('admin/', admin.site.urls),
        path('', include('productos_app.urls')),
    ]
```

# Creamos los archivos necesarios (APLICACIÓN) en productos_app/templates/productos/

## listar_meses.html
```html
    <!DOCTYPE html>
    <html>
    <head>
        <title>Meses del Año</title>
    </head>
    <body>
    <h1>Seleccione un Mes</h1>
    <ul>
        {% for mes in meses %}
        <li><a href="{% url 'productos_por_mes' mes %}">{{ mes }}</a></li>
        {% endfor %}
    </ul>
    </body>
    </html>
```

## productos_por_mes.html
```html
    <!DOCTYPE html>
    <html>
    <head>
        <title>Productos en {{ mes }}</title>
    </head>
    <body>
    <h1>Productos disponibles en {{ mes }}</h1>
    <ul>
        {% for producto in productos %}
        <li>
            <h2>{{ producto.nombre }}</h2>
            <img src="{{ producto.foto.url }}" alt="{{ producto.nombre }}">
            <p>{{ producto.descripcion }}</p>
            <p>Temporada: {{ producto.fecha_inicio_temporada }} - {{ producto.fecha_fin_temporada }}</p>
            <p>{% if producto.disponible_todo_el_ano %}Disponible todo el año{% endif %}</p>
        </li>
        {% endfor %}
    </ul>
    <a href="{% url 'listar_meses' %}">Volver a la lista de meses</a>
    </body>
    </html>
```

# Como paso <span style="color:red">opcional</span> añadimos la configuracion en settings.py (PROYECTO) para manejar archivos estáticos
```python
    # Static files (CSS, JavaScript, Images)
    STATIC_URL = '/static/'
    
    # Media files (Uploaded files)
    MEDIA_URL = '/media/'
    MEDIA_ROOT = BASE_DIR / 'media'
```

# También deberemos actualizar urls.py (PROYECTO) para manejar archivos estáticos <span style="color:red">(OJITO PORQUE LOS IMPORTS ANTERIORES SE MANTIENEN)</span>
```python
    from django.conf import settings
    from django.conf.urls.static import static
    
    urlpatterns = [
        path('admin/', admin.site.urls),
        path('', include('productos.urls')),
    ] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
```

# Creamos un superusuario
```bash
    python manage.py createsuperuser
```

# Ejecutamos el servidor
```bash
    python manage.py runserver
```