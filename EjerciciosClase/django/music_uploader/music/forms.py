from django import forms
from .models import Cancion

class FormularioCancion(forms.ModelForm):
    class Meta:
        model= Cancion
        fields = ['nombre', 'tipo', 'archivo']