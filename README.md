# 📝 LiveConnect Blog


An interactive full-stack blog application that allows users to create posts and engage in **real-time chat**.  
This project combines content sharing with instant communication, making it ideal for communities, learning platforms, or collaborative spaces.

---

## 📌 Features

- 📝 Create, edit, and delete blog posts
- 💬 Real-time chat between registered users
- 👤 User authentication and role-based access (admin, author, reader)
- 🗂️ Organized posts by category/tags
- 🔍 Search and filter blog content
- 📆 Date-based post display
- 🔔 Optional real-time notifications for comments/messages

---

## 🧑‍💻 Tech Stack

| Layer         | Technology               |
|---------------|---------------------------|
| Backend       | Laravel / Node.js |
| Realtime Chat | Laravel Echo / WebSockets / Socket.io |
| Frontend      | Blade / Vue / jQuery |
| Database      | MySQL / MongoDB  |
| Auth System   | Laravel Auth / Passport / JWT |
| Hosting       | Localhost / Firebase  |

---

## 🚀 Getting Started

### 1. Clone the Repository

```bash
git clone https://github.com/mo7amedshaban/LiveConnect-Blog.git
cd  LiveConnect-Blog

```


### 2. Terminal


```base
composer install
php artisan generate:key
npm install
npm run watch
php artisan storage:link
php artisan db:seed
php artisan serve
php artisan websockets:serve
```
### 3. For open admin panel
```base

 http://127.0.0.1:8000/admin-panel

```
