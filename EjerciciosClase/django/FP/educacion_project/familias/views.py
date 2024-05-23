from django.shortcuts import render, get_object_or_404
from .models import Familia
# Create your views here.

def lista_familias(request):
  familias = Familia.objects.all()
  return render(request, 'familias/lista_familias.html',{'familias': familias})

def detalle_familia(request, familia_id):
  familia = get_object_or_404(Familia, id=familia_id)
  return render(request, 'familias/detalle_familia.html', {'familia':familia})