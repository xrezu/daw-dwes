from django.shortcuts import render, get_object_or_404
from rest_framework import viewsets
from .models import Edificio, Tecnico, Mantenimiento
from .serialiazers import EdificioSerializer, TecnicoSerializer, MantenimientoSerializer
from django.core.paginator import Paginator
# Create your views here.

class EdificioViewSet(viewsets.ModelViewSet):
  queryset = Edificio.objects.all()
  serializer_class = EdificioSerializer

class TecnicoViewSet(viewsets.ModelViewSet):
  queryset = Tecnico.objects.all()
  serializer_class = TecnicoSerializer

class MantenimientoViewSet(viewsets.ModelViewSet):
  queryset = Mantenimiento.objects.all()
  serializer_class = MantenimientoSerializer

def listado_mantenimientos(request):
  mantenimientos = Mantenimiento.objects.all()
  paginator = Paginator(mantenimientos, 3)
  
  page_number = request.GET.get('page')
  page_obj = paginator.get_page(page_number)
  return render(request, 'edificios/listado.html', {'page_obj': page_obj})

