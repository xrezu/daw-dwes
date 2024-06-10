from django.db import models
from django.utils.text import slugify

# Create your models here.
class ObraDeArte(models.Model):
  titulo = models.CharField(max_length=200)
  artista = models.CharField(max_length=100)
  descripcion = models.TextField()
  fecha_creacion = models.DateField()
  precio = models.DecimalField(max_digits=10, decimal_places=2)
  en_venta = models.BooleanField(default=True)
  imagen = models.ImageField(upload_to='obras/', blank=True, null=True)
  slug = models.SlugField(unique=True, blank=True)

  def save(self, *args, **kwargs):
    if not self.slug:
      self.slug = slugify(self.titulo)
    super().save(*args,**kwargs)
  
  def __str__(self):
    return self.titulo