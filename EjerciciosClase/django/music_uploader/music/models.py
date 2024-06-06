from django.db import models

# Create your models here.
class Cancion(models.Model):
  MUSIC_TYPE_CHOICES = [
    ('rock', 'Rock'),
    ('rap', 'Rap'),
    ('reggae', 'Reggae'),
    ('r&b', 'R&B'),
    ('jazz', 'Jazz'),
  ]
  nombre = models.CharField(max_length=200)
  tipo = models.CharField(max_length=200, choices=MUSIC_TYPE_CHOICES)
  archivo = models.FileField(upload_to='music_files/')

  def __str__(self):
    return self.nombre