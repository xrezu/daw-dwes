from django.urls import path 
from . import views

urlpatterns = [
  path('', views.lista_familias, name='lista_familias'),
  path('familia/<int:familia_id>/', views.detalle_familia, name='detalle_familia'),
]