from django.db import models

# Create your models here.
class Familia(models.Model):
  nombre = models.CharField(max_length=200)
  descrpcion = models.TextField()
  
  def __str__(self):
    return self.nombre

class Ciclo(models.Model):
  nombre = models.CharField(max_length=200)
  descripcion = models.TextField()
  familia = models.ForeignKey(Familia, related_name='ciclos',on_delete=models.CASCADE)

  def __str__(self):
    return self.nombre