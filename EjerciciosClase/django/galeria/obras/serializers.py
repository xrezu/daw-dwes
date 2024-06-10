from rest_framework import serializers
from .models import ObraDeArte

class ObraDeArteSerializer(serializers.ModelSerializer):
  class Meta:
    model = ObraDeArte
    fields = '__all__'