# Generated by Django 5.0.6 on 2024-06-09 12:43

from django.db import migrations


class Migration(migrations.Migration):

    dependencies = [
        ('memes', '0003_rename_created_at_meme_fecha'),
    ]

    operations = [
        migrations.RemoveField(
            model_name='comentario',
            name='nombre',
        ),
    ]