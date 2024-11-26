
# Lumen Guests API

This project provides an API built with **Lumen** to manage guest. It allows you to perform CRUD operations on guests.

App start:
```
git clone https://github.com/waxelite/guests.git
cd guests
docker-compose up -d
docker ps
docker exec -it lumen-guest-service-service-1 php artisan migrate
```
lumen-guest-service-service-1 - name of container

## Endpoints

### Guests

#### 1. Get all guests
```http
GET /api/guests
```
- Returns a list of all guests.

#### 2. Get guest by ID
```http
GET /api/guests/{id}
```
- Returns a single guest by its ID.

#### 3. Create a new guest
```http
POST /api/guests
```
- Request Body:
```json
{
    "name": "admin",
    "surname": "admin",
    "email": "admin@admin.com",
    "phone": "+79999999999",
    "country": "ru"
}
```
- Creates a new guest with the provided data.

#### 4. Update a guest by ID
```http
PUT /api/guests/{id}
```
- Request Body:
```json
{
    "name": "admin2",
    "surname": "admin2",
    "email": "admin2@admin.com",
    "phone": "+19999999999",
    "country": "us"
}
```
- Updates the guest with the provided ID.

#### 5. Delete a guest by ID
```http
DELETE /api/guests/{id}
```
- Deletes the guest with the specified ID.
