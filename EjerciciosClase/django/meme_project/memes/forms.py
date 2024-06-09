from django import forms 
from .models import Comentario,Meme
from django.contrib.auth.models import User
from django.contrib.auth.forms import UserCreationForm

class MemeForm(forms.ModelForm):
  class Meta:
    model = Meme
    fields = ['titulo', 'descripcion', 'imagen']

class ComentarioForm(forms.ModelForm):
  class Meta:
    model = Comentario
    fields = ['comentario']

class RegistroForm(UserCreationForm):
  email = forms.EmailField(required=True)

  class Meta:
    model = User
    fields = ['username','email','password1','password2']