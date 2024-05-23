from django.db import models

# Create your models here.
class Chiste(models.Model):
  titulo = models.CharField(max_length=200)
  texto = models.TextField()
  es_para_adultos = models.BooleanField(default=False)
  fecha_creacion = models.DateTimeField(auto_now_add=True)

  def __str__(self):
    return self.titulo