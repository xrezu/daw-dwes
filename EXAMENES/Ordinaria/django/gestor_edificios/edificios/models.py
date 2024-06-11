from django.db import models

# Create your models here.
class Edificio(models.Model):
  nombre = models.CharField(max_length=100)
  direccion = models.CharField(max_length=100)
  contacto = models.EmailField()

  def __str__(self):
    return self.nombre

class Tecnico(models.Model):
  nombre = models.CharField(max_length=100)
  especialidad = models.CharField(max_length=200)
  contacto = models.EmailField()

  def __str__(self):
    return self.nombre

class Mantenimiento(models.Model):
  fecha = models.DateField()
  descripcion = models.TextField()
  edificio = models.ForeignKey(Edificio, on_delete=models.CASCADE)
  tecnico = models.ForeignKey(Tecnico, on_delete=models.CASCADE)

  def __str__(self):
    return f"{self.fecha} - {self.edificio} - {self.tecnico}"