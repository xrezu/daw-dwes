from django.shortcuts import render
from .models import Chiste
# Create your views here.

def lista_chistes(request):
  chistes = Chiste.objects.all()
  return render(request, 'chistes/lista_chistes.html', {'chistes': chistes})