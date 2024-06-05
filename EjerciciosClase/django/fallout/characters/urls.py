from django.urls import path
from .views import CharacterListView, CharacterDetailView

urlpatterns = [
  path('', CharacterListView.as_view(), name='character-list'),
  path('<slug:slug>/',CharacterDetailView.as_view(), name='character-detail'),
]