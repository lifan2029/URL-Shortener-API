# 🗒️ Todo List API

A simple REST API for creating and managing **short URLs**, built with **Laravel 12 (PHP 8.2)** and **Docker**.
This project is a **pet project** and serves as a demonstration of **Micro SaaS architecture** with online **Postman documentation**.

---

## 🚀 Tech Stack

- **PHP 8.2**
- **Laravel 12**
- **Docker / Docker Compose**
- **MySQL**
- **Composer**
- **Postman** (for API documentation)

---

## 🧩 Features

- Create new tasks  
- Retrieve all tasks  
- Update and delete tasks  
- Mark tasks as completed / uncompleted  
- Filter tasks by status  

---

## ⚙️ Installation & Setup

### 1. Clone the repository

```bash
git clone https://github.com/lifan2029/URL-Shortener-API
cd URL-Shortener-API
```

### 2. Copy environment file

```bash
cp .env.example .env
```

### 3. Configure `.env` variables

```env
DB_CONNECTION=mysql
DB_HOST=shortener_mysql
DB_PORT=3306
DB_DATABASE=shortener
DB_USERNAME=shortener_user
DB_PASSWORD=BioNIerICuLShOth
```

### 4. Build and start Docker containers

```bash
docker compose up -d --build
```

### 5. Install Laravel dependencies

```bash
docker compose exec shortener_php composer install
```

### 6. Generate application key

```bash
docker compose exec shortener_php php artisan key:generate
```

### 7. Run database migrations

```bash
docker compose exec shortener_php php artisan migrate
```

---

## 🧠 API Endpoints

| Method | Endpoint | Description |
|--------|-----------|-------------|
| `POST` | `/api/v1/make-short-url` | Make short url |
| `POST` | `/api/v1/statistic/{short_code}` | Get statistic url |
| `GET` | `/{short_code}` | Redirect from short url |

Example request (create a task):
```json
POST /api/v1/make-short-url
{
    "original_url": "https://github.com"
}
```

---

## 📘 API Documentation (Postman)

The online Postman collection is available here:  
👉 [Open Postman Collection](https://www.postman.com/coreflowx/url-shortener-api)

---

## 🔧 Useful Commands

```bash
docker compose exec shortener_php php artisan migrate:fresh --seed   # Recreate DB with seed data
docker compose exec shortener_php php artisan test                   # Run tests
docker compose logs -f shortener_php                                 # View container logs
```

---

## 💡 Author

**Your Name**  
📧 lifan2029@gmail.com  
🌐 [GitHub](https://github.com/lifan2029)

---

> 🧠 This project was created for learning purposes to demonstrate Laravel API development with Docker.
