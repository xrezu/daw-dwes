from django.db import models

class Product(models.Model):
  name = models.CharField(max_length=255)
  photo = models.URLField()  # Usa URLField si las fotos están en URLs externas
  description = models.TextField()
  start_season = models.DateField()
  end_season = models.DateField()
  available_all_year = models.BooleanField()

  def __str__(self):
    return self.name
