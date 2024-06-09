from django.urls import path
from . import views

urlpatterns = [
  path('',views.meme_list, name='meme_list'),
  path('meme/<int:pk>',views.meme_detail,name='meme_detail'),
  path('registro/', views.registro_view, name='registro'),
  path('login/', views.login_view, name='login'),
  path('logout/',views.logout_view, name='logout'),
]