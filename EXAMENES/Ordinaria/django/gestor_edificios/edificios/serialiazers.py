from rest_framework import serializers
from .models import Edificio, Tecnico, Mantenimiento

class EdificioSerializer(serializers.ModelSerializer):
  class Meta:
    model = Edificio
    fields = '__all__'

class TecnicoSerializer(serializers.ModelSerializer):
  class Meta:
    model = Tecnico
    fields = '__all__'

class MantenimientoSerializer(serializers.ModelSerializer):
  edificio = EdificioSerializer()
  tecnico = TecnicoSerializer()

  class Meta:
    model = Mantenimiento
    fields = '__all__'