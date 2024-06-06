from django.urls import path
from . import views

urlpatterns = [
  path('', views.song_list, name='song_list'),
  path('upload/', views.upload_song, name='upload_song'),
]
