<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

# Booking Module

Это реализация модуля бронирования с REST API на Laravel.

## Установка

1. `composer install`
2. Создать `.env` файл на основе .env.example и указать доступы к базе данных (я использовал sqlite)
3. Если через SQLite: cоздать пустой файл с именем `database.sqlite` в папке `database`
4. `php artisan migrate:fresh --seed`
5. `php artisan serve`.

## Эндпоинты для проверки

### 1. Получение списка всех бронирований

```http
GET http://127.0.0.1:8000/api/bookings
```


### 2. Создание нового бронирования

```http
POST http://127.0.0.1:8000/api/bookings
Content-Type: application/json
Accept: application/json

{
  "client_id": 1,
  "room_id": 2,
  "start_date": "YYYY-MM-DD",  // Указать дату начала брони
  "end_date": "YYYY-MM-DD"    // Указать дату конца брони
}
```


### 3. Получение данных о конкретном бронировании

```http
GET http://127.0.0.1:8000/api/bookings/{id}
```
*Заменить `{id}` на ID, полученный на предыдущем шаге (к примеру `1`).*
