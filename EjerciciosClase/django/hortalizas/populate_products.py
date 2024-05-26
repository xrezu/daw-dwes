import os
import django
from datetime import date

# Configurar el entorno de Django
os.environ.setdefault('DJANGO_SETTINGS_MODULE', 'seasonal_products.settings')
django.setup()

from products.models import Product

# Borrar todos los productos existentes (opcional)
Product.objects.all().delete()

# Datos de ejemplo extendidos
products_data = [
    {
        'name': 'Manzana',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/1/15/Red_Apple.jpg',
        'description': 'Una fruta dulce y crujiente.',
        'start_season': date(2024, 9, 1),
        'end_season': date(2025, 3, 1),
        'available_all_year': False,
    },
    {
        'name': 'Naranja',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/c/c4/Orange-Fruit-Pieces.jpg',
        'description': 'Una fruta cítrica y jugosa.',
        'start_season': date(2024, 11, 1),
        'end_season': date(2025, 4, 1),
        'available_all_year': False,
    },
    {
        'name': 'Plátano',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/8/8a/Banana-Single.jpg',
        'description': 'Una fruta tropical, rica en potasio.',
        'start_season': date(2024, 1, 1),
        'end_season': date(2024, 12, 31),
        'available_all_year': True,
    },
    {
        'name': 'Zanahoria',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/3/32/Carrot.jpg',
        'description': 'Una verdura crujiente y dulce.',
        'start_season': date(2024, 10, 1),
        'end_season': date(2025, 5, 1),
        'available_all_year': False,
    },
    {
        'name': 'Tomate',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/8/89/Tomato_je.jpg',
        'description': 'Una fruta/verdura versátil y jugosa.',
        'start_season': date(2024, 6, 1),
        'end_season': date(2024, 9, 30),
        'available_all_year': False,
    },
    {
        'name': 'Espinaca',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/0/03/Spinacia_oleracea_Spinazie_bloeiend.jpg',
        'description': 'Una verdura de hojas verdes, rica en hierro.',
        'start_season': date(2024, 3, 1),
        'end_season': date(2024, 6, 30),
        'available_all_year': False,
    },
    {
        'name': 'Fresa',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/2/29/PerfectStrawberry.jpg',
        'description': 'Una fruta dulce y jugosa, perfecta para postres.',
        'start_season': date(2024, 4, 1),
        'end_season': date(2024, 7, 31),
        'available_all_year': False,
    },
    {
        'name': 'Uva',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/1/1b/Table_grapes_on_white.jpg',
        'description': 'Una fruta pequeña y dulce, ideal para picar.',
        'start_season': date(2024, 8, 1),
        'end_season': date(2024, 11, 30),
        'available_all_year': False,
    },
    {
        'name': 'Pepino',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/4/4c/Cucumis_sativus.jpg',
        'description': 'Una verdura fresca y crujiente, perfecta para ensaladas.',
        'start_season': date(2024, 5, 1),
        'end_season': date(2024, 9, 30),
        'available_all_year': False,
    },
    {
        'name': 'Calabacín',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/a/ab/Zucchini.jpg',
        'description': 'Una verdura versátil, ideal para muchas recetas.',
        'start_season': date(2024, 6, 1),
        'end_season': date(2024, 10, 31),
        'available_all_year': False,
    },
    {
        'name': 'Cereza',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/b/bb/Cherry_Stella444.jpg',
        'description': 'Una fruta pequeña y dulce, perfecta para picar.',
        'start_season': date(2024, 6, 1),
        'end_season': date(2024, 7, 31),
        'available_all_year': False,
    },
    {
        'name': 'Piña',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/c/cb/Pineapple_and_cross_section.jpg',
        'description': 'Una fruta tropical, dulce y jugosa.',
        'start_season': date(2024, 3, 1),
        'end_season': date(2024, 6, 30),
        'available_all_year': False,
    },
    {
        'name': 'Mango',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/9/90/Hapus_Mango.jpg',
        'description': 'Una fruta tropical, dulce y jugosa.',
        'start_season': date(2024, 4, 1),
        'end_season': date(2024, 8, 31),
        'available_all_year': False,
    },
    {
        'name': 'Brócoli',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/0/03/Broccoli_and_cross_section_edit.jpg',
        'description': 'Una verdura rica en nutrientes, ideal para guisos y ensaladas.',
        'start_season': date(2024, 9, 1),
        'end_season': date(2025, 2, 28),
        'available_all_year': False,
    },
    {
        'name': 'Sandía',
        'photo_url': 'https://upload.wikimedia.org/wikipedia/commons/e/eb/Watermelon_cross_BNC.jpg',
        'description': 'Una fruta grande y jugosa, perfecta para el verano.',
        'start_season': date(2024, 6, 1),
        'end_season': date(2024, 8, 31),
        'available_all_year': False,
    },
    # Añade más productos según sea necesario
]

# Crear productos en la base de datos
for product_data in products_data:
    Product.objects.create(**product_data)

print('Datos de productos insertados exitosamente.')
