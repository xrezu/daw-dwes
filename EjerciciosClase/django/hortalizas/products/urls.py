from django.urls import path
from . import views

urlpatterns = [
  path('',views.month_list, name='month_list'),
  path('<str:month>/',views.available_products, name='available_products'),
]