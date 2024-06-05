from django.shortcuts import render
from .models import Character
from django.views.generic import ListView,DetailView
# Create your views here.

class CharacterListView(ListView):
  model = Character
  template_name = 'characters/character_list.html'

class CharacterDetailView(DetailView):
  model = Character
  template_name = 'characters/character_detail.html'
