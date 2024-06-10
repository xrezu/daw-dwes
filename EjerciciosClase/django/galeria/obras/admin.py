from django.contrib import admin
from .models import ObraDeArte
# Register your models here.
@admin.register(ObraDeArte)
class ObraDeArteAdmin(admin.ModelAdmin):
  list_display = ('titulo','artista','fecha_creacion','precio','en_venta')
  search_fields = ('titulo','artista')