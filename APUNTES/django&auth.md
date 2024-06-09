
### Guía completa para gestionar archivos y autenticación en Django

#### 1. Configuración del entorno

1. **Instala Django** si aún no lo has hecho:
   ```bash
   pip install django
   ```

2. **Crea un nuevo proyecto**:
   ```bash
   django-admin startproject myproject
   ```

3. **Accede al directorio del proyecto**:
   ```bash
   cd myproject
   ```

4. **Crea una nueva aplicación**:
   ```bash
   python manage.py startapp memes
   ```

#### 2. Configuración del modelo

1. **Define el modelo** en `memes/models.py`:
   ```python
   from django.db import models

   class Meme(models.Model):
       title = models.CharField(max_length=100)
       description = models.TextField()
       image = models.ImageField(upload_to='memes/')
       created_at = models.DateTimeField(auto_now_add=True)

       def __str__(self):
           return self.title
   ```

2. **Crea y aplica las migraciones**:
   ```bash
   python manage.py makemigrations
   python manage.py migrate
   ```

#### 3. Configuración del formulario

1. **Define el formulario** en `memes/forms.py`:
   ```python
   from django import forms
   from django.contrib.auth.forms import UserCreationForm
   from django.contrib.auth.models import User
   from .models import Meme

   class MemeForm(forms.ModelForm):
       class Meta:
           model = Meme
           fields = ['title', 'description', 'image']

   class RegistroForm(UserCreationForm):
       email = forms.EmailField(required=True)

       class Meta:
           model = User
           fields = ['username', 'email', 'password1', 'password2']
   ```

#### 4. Configuración de las vistas

1. **Define las vistas** en `memes/views.py`:
   ```python
   from django.shortcuts import render, redirect
   from django.contrib.auth import login, authenticate, logout
   from django.contrib.auth.forms import AuthenticationForm
   from .forms import MemeForm, RegistroForm
   from .models import Meme

   def meme_list(request):
       memes = Meme.objects.all()
       return render(request, 'memes/meme_list.html', {'memes': memes})

   def upload_meme(request):
       if request.method == 'POST':
           form = MemeForm(request.POST, request.FILES)
           if form.is_valid():
               form.save()
               return redirect('meme_list')
       else:
           form = MemeForm()
       return render(request, 'memes/upload_meme.html', {'form': form})

   def registro(request):
       if request.method == 'POST':
           form = RegistroForm(request.POST)
           if form.is_valid():
               user = form.save()
               login(request, user)
               return redirect('meme_list')
       else:
           form = RegistroForm()
       return render(request, 'memes/registro.html', {'form': form})

   def iniciar_sesion(request):
       if request.method == 'POST':
           form = AuthenticationForm(request, data=request.POST)
           if form.is_valid():
               username = form.cleaned_data.get('username')
               password = form.cleaned_data.get('password')
               user = authenticate(username=username, password=password)
               if user is not None:
                   login(request, user)
                   return redirect('meme_list')
       else:
           form = AuthenticationForm()
       return render(request, 'memes/iniciar_sesion.html', {'form': form})

   def cerrar_sesion(request):
       logout(request)
       return redirect('iniciar_sesion')
   ```

#### 5. Configuración de URLs

1. **Define las URLs de la aplicación** en `memes/urls.py`:
   ```python
   from django.urls import path
   from . import views

   urlpatterns = [
       path('', views.meme_list, name='meme_list'),
       path('upload/', views.upload_meme, name='upload_meme'),
       path('registro/', views.registro, name='registro'),
       path('iniciar_sesion/', views.iniciar_sesion, name='iniciar_sesion'),
       path('cerrar_sesion/', views.cerrar_sesion, name='cerrar_sesion'),
   ]
   ```

2. **Incluye las URLs de la aplicación en el archivo principal de URLs** `myproject/urls.py`:
   ```python
   from django.contrib import admin
   from django.urls import path, include
   from django.conf import settings
   from django.conf.urls.static import static

   urlpatterns = [
       path('admin/', admin.site.urls),
       path('', include('memes.urls')),
   ] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
   ```

#### 6. Configuración de administración

1. **Registra el modelo en el panel de administración** en `memes/admin.py`:
   ```python
   from django.contrib import admin
   from .models import Meme

   @admin.register(Meme)
   class MemeAdmin(admin.ModelAdmin):
       list_display = ('title', 'created_at')
   ```

#### 7. Configuración de archivos estáticos y de medios

1. **Configura `settings.py`** para manejar archivos estáticos y de medios:
   ```python
   # settings.py

   MEDIA_URL = '/media/'
   MEDIA_ROOT = BASE_DIR / 'media'

   # Autenticación
   LOGIN_REDIRECT_URL = '/'
   LOGOUT_REDIRECT_URL = '/iniciar_sesion/'
   ```

2. **Asegúrate de que el archivo principal de URLs** está configurado para servir archivos de medios en desarrollo:
   ```python
   # myproject/urls.py
   from django.contrib import admin
   from django.urls import path, include
   from django.conf import settings
   from django.conf.urls.static import static

   urlpatterns = [
       path('admin/', admin.site.urls),
       path('', include('memes.urls')),
   ] + static(settings.MEDIA_URL, document_root=settings.MEDIA_ROOT)
   ```

#### 8. Configuración de las plantillas

1. **Crea plantillas HTML** para las vistas en `memes/templates/memes/`:
   
   - **Plantilla para la lista de memes** (`meme_list.html`):
     ```html
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Lista de Memes</title>
     </head>
     <body>
         <h1>Lista de Memes</h1>
         <ul>
             {% for meme in memes %}
                 <li>{{ meme.title }} - <img src="{{ meme.image.url }}" alt="{{ meme.title }}" width="100"></li>
             {% endfor %}
         </ul>
         <a href="{% url 'upload_meme' %}">Subir Meme</a>
         <a href="{% url 'cerrar_sesion' %}">Cerrar Sesión</a>
     </body>
     </html>
     ```

   - **Plantilla para subir memes** (`upload_meme.html`):
     ```html
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Subir Meme</title>
     </head>
     <body>
         <h1>Subir Meme</h1>
         <form method="post" enctype="multipart/form-data">
             {% csrf_token %}
             {{ form.as_p }}
             <button type="submit">Subir</button>
         </form>
         <a href="{% url 'meme_list' %}">Volver a la lista de memes</a>
     </body>
     </html>
     ```

   - **Plantilla para el registro de usuarios** (`registro.html`):
     ```html
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Registro</title>
     </head>
     <body>
         <h1>Registro</h1>
         <form method="post">
             {% csrf_token %}
             {{ form.as_p }}
             <button type="submit">Registrarse</button>
         </form>
         <a href="{% url 'iniciar_sesion' %}">Iniciar Sesión</a>
     </body>
     </html>
     ```

   - **Plantilla para el inicio de sesión** (`iniciar_sesion.html`):
     ```html
     <!DOCTYPE html>
     <html lang="en">
     <head>
         <meta charset="UTF-8">
         <meta name="viewport" content="width=device-width, initial-scale=1.0">
         <title>Iniciar Sesión</title>
     </head>
     <body>
         <h1>Iniciar Sesión</h1>
         <form method="post">
             {% csrf_token %}
             {{ form.as_p }}
             <button type="submit">Iniciar Sesión</button>
        

 </form>
         <a href="{% url 'registro' %}">Registrarse</a>
     </body>
     </html>
     ```

#### 9. Ejecutar y probar

1. **Crea un superusuario** para acceder al panel de administración:
   ```bash
   python manage.py createsuperuser
   ```

2. **Inicia el servidor de desarrollo**:
   ```bash
   python manage.py runserver
   ```

3. **Accede al panel de administración** en `http://127.0.0.1:8000/admin/` e inicia sesión con tu superusuario.

4. **Prueba las funcionalidades**:
   - **Registro de usuarios**: `http://127.0.0.1:8000/registro/`
   - **Inicio de sesión**: `http://127.0.0.1:8000/iniciar_sesion/`
   - **Subir memes**: `http://127.0.0.1:8000/upload/`
   - **Lista de memes**: `http://127.0.0.1:8000/`
   - **Cerrar sesión**: `http://127.0.0.1:8000/cerrar_sesion/`

