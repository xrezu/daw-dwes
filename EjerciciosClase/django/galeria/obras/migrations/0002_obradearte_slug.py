# Generated by Django 5.0.6 on 2024-06-09 13:49

from django.db import migrations, models


class Migration(migrations.Migration):

    dependencies = [
        ('obras', '0001_initial'),
    ]

    operations = [
        migrations.AddField(
            model_name='obradearte',
            name='slug',
            field=models.SlugField(blank=True, unique=True),
        ),
    ]
