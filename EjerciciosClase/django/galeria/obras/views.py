from django.shortcuts import render, get_object_or_404
from .models import ObraDeArte
from .serializers import ObraDeArteSerializer
from rest_framework import viewsets
# Create your views here.
class ObraDeArteViewSet(viewsets.ModelViewSet):
  queryset = ObraDeArte.objects.all()
  serializer_class = ObraDeArteSerializer

def obra_list(request):
  obras = ObraDeArte.objects.all()
  return render(request, 'obra_list.html', {'obras': obras})

def obra_detail(request,slug):
  obra = get_object_or_404(ObraDeArte, slug=slug)
  return render(request, 'obra_detail.html', {'obra':obra})

