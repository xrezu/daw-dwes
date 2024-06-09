from django.shortcuts import render, get_object_or_404, redirect
from .models import Meme, Comentario
from .forms import ComentarioForm, RegistroForm
from django.contrib.auth import login, authenticate, logout
from django.contrib.auth.forms import AuthenticationForm
from django.contrib.auth.decorators import login_required
# Create your views here.

def registro_view(request):
    if request.method == 'POST':
        form = RegistroForm(request.POST)
        if form.is_valid():
            usuario = form.save()
            login(request, usuario)
            return redirect('meme_list')
    else:
        form = RegistroForm()
    return render(request, 'memes/registro.html', {'form': form})


def login_view(request):
  if request.method == 'POST':
    form = AuthenticationForm(request, data=request.POST)
    if form.is_valid():
      username = form.cleaned_data.get('username')
      password = form.cleaned_data.get('password')
      user = authenticate(username=username, password=password)
      if user is not None:
        login(request, user)
        return redirect('meme_list')
  else:
    form = AuthenticationForm()
  return render(request, 'memes/login.html', {'form': form})

def logout_view(request):
  logout(request)
  return redirect('meme_list')

def meme_list(request):
  memes = Meme.objects.all()
  return render(request, 'memes/meme_list.html',{'memes':memes})

def meme_detail(request, pk):
  meme = get_object_or_404(Meme, pk=pk)
  comentarios = meme.comentarios.all().order_by('-fecha')

  if request.method == 'POST':
    form = ComentarioForm(request.POST)
    if form.is_valid():
      comentario = form.save(commit=False)
      comentario.meme = meme
      comentario.usuario = request.user
      comentario.save()
      return redirect('meme_detail', pk=meme.pk)
  else:
    form = ComentarioForm()

  return render(request, 'memes/meme_detail.html',{
    'meme':meme,
    'comentarios': comentarios,
    'form': form
  })