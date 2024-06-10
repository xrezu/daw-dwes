from django.urls import path, include
from rest_framework.routers import DefaultRouter
from .views import ObraDeArteViewSet, obra_detail, obra_list

router = DefaultRouter()
router.register(r'obras',ObraDeArteViewSet)

urlpatterns = [
  path('api/',include(router.urls)),
  path('', obra_list, name='obra_list'),
  path('obra/<slug:slug>/', obra_detail, name='obra_detail'),
]