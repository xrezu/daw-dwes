from django.urls import path, include
from rest_framework.routers import DefaultRouter
from . import views
from .views import EdificioViewSet, TecnicoViewSet, MantenimientoViewSet
router = DefaultRouter()
router.register(r'edificio', EdificioViewSet)
router.register(r'tecnicos', TecnicoViewSet)
router.register(r'mantenimientos', MantenimientoViewSet)

urlpatterns = [
  path('', views.listado_mantenimientos, name='listado_mantenimientos'),
  path('api/', include(router.urls)),
]