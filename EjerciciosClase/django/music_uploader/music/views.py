from django.shortcuts import render, redirect
from django.core.paginator import Paginator
from .models import Cancion
from .forms import FormularioCancion

def song_list(request):
    canciones = Cancion.objects.all()
    paginator = Paginator(canciones, 3)  # Paginación de 3 canciones por página

    page_number = request.GET.get('page')
    page_obj = paginator.get_page(page_number)
    return render(request, 'music/song_list.html', {'page_obj': page_obj})

def upload_song(request):
    if request.method == 'POST':
        form = FormularioCancion(request.POST, request.FILES)
        if form.is_valid():
            form.save()
            return redirect('song_list')
    else:
        form = FormularioCancion()
    return render(request, 'music/upload_song.html', {'form': form})
