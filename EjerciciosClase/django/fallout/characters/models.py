from django.db import models
from django.utils.text import slugify
# Create your models here.

class Character(models.Model):
  name = models.CharField(max_length=100)
  slug = models.SlugField(max_length=100, unique=True)
  description = models.TextField()
  cover_photo = models.ImageField(upload_to='cover_photos/')
  detail_photo = models.ImageField(upload_to='detail_photos/')


  #metodo para crear slug automaticamente basado en el nombre
  def save(self, *args, **kwargs):
    if not self.slug:
      self.slug = slugify(self.name)
    super(Character, self).save(*args, **kwargs)

  def __str__(self):
    return self.name