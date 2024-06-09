from django.db import models
from django.utils import timezone
from django.contrib.auth.models import User
# Create your models here.

class Meme(models.Model):
  titulo = models.CharField(max_length=100)
  descripcion = models.TextField()
  imagen = models.ImageField(upload_to='memes/')
  fecha = models.DateTimeField(auto_now_add=True)

  def __str__(self):
    return self.titulo

class Comentario(models.Model):
  meme = models.ForeignKey(Meme, on_delete=models.CASCADE, related_name='comentarios')
  comentario = models.TextField()
  fecha = models.DateTimeField(default=timezone.now)
  usuario = models.ForeignKey(User, on_delete=models.CASCADE)
  def __str__(self):
    return f'Comentario de {self:usuario.username} en {self.comentario[:20]}'