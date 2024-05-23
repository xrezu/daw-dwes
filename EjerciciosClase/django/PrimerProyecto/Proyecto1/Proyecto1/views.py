from django.http import HttpResponse 
import datetime

def saludo(request):  # primera vista 
  
  documento="""<html>
  <body>
  <h1>
  Buenas tardes no que no hemos comido
  </h1>
  </body>
  </html>
  """
  
  return HttpResponse(documento)

def despedida(request):
  return HttpResponse("Bye ma G")


def dameFecha(request):

  fecha_actual=datetime.datetime.now()

  documento="""<html>
  <body>
  <h3>
  Fecha y hora actuales %s
  </h3>
  </body>
  </html>
  """ % fecha_actual

  return HttpResponse(documento) 


def calculaEdad(request, anyo, edad):

  periodo = anyo-2024
  edadFutura = edad + periodo
  document="<html><body><h2>En el año %s tendrás %s años </h2></body></html>" %(anyo, edadFutura)

  return HttpResponse(document)