from django.shortcuts import render
from .models import Product
import calendar

def month_list(request):
    months = list(calendar.month_name)[1:]  # Obtiene la lista de meses (sin el primer elemento que es una cadena vacía)
    return render(request, 'products/month_list.html', {'months': months})

def available_products(request, month):
    month_index = list(calendar.month_name).index(month)
    products = Product.objects.filter(
        start_season__month__lte=month_index,
        end_season__month__gte=month_index
    ) | Product.objects.filter(available_all_year=True)
    return render(request, 'products/available_products.html', {'products': products, 'month': month})
