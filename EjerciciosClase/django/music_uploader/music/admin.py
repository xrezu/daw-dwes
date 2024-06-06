from django.contrib import admin
from .models import Cancion
# Register your models here.

admin.site.register(Cancion)

class SongAdmin(admin.ModelAdmin):
  list_display = ('nombre','tipo')