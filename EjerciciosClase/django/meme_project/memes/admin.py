from django.contrib import admin
from .models import Meme, Comentario

@admin.register(Meme)
class MemeAdmin(admin.ModelAdmin):
    list_display = ('titulo', 'fecha')

@admin.register(Comentario)
class ComentarioAdmin(admin.ModelAdmin): 
    list_display = ('meme', 'usuario', 'fecha')
